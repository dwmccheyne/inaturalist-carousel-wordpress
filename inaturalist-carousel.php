<?php
/**
 * Plugin Name: iNaturalist Carousel
 * Plugin URI: 
 * Description: Displays a carousel of observations from a given iNaturalist project.
 * Version: 1.0
 * Author: David McCheyne
 * Author URI: https://github.com/dwmccheyne
 * License: GPL3
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

function inat_carousel_enqueue_scripts() {
    // Enqueue iNaturalist Carousel styles and scripts
    wp_enqueue_style('inat-carousel-style', plugin_dir_url(__FILE__) . 'assets/css/inaturalist-carousel.css');
    wp_enqueue_script('inat-carousel-script', plugin_dir_url(__FILE__) . 'assets/js/inaturalist-carousel.js', array('jquery'), '1.0', true);

    // Enqueue Slick Carousel CSS
    wp_enqueue_style('slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');

    // Enqueue Slick Carousel JavaScript
    wp_enqueue_script('slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);
}

add_action('wp_enqueue_scripts', 'inat_carousel_enqueue_scripts');

function inat_carousel_fetch_data($project_id, $image_size) {
    $api_url = "https://api.inaturalist.org/v1/observations?project_id={$project_id}&per_page=100";
    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return null;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    return $data->results;
}

function inat_carousel_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'project_id' => '',
            'image_size' => 'large', // Default image size
        ),
        $atts,
        'inat_carousel'
    );

    $observations = inat_carousel_fetch_data($atts['project_id'], $atts['image_size']);

    if (!$observations) {
        return '<p>Error fetching iNaturalist data.</p>';
    }

    ob_start();
    ?>
    <div class="inat-carousel" data-slick='{"dots": false, "slidesToShow": 1, "slidesToScroll": 1}'>
        <?php foreach ($observations as $observation) : ?>
            <?php
            $photo_url = str_replace('square', $atts['image_size'], $observation->photos[0]->url);
            $bg_style = 'style="background-image: url(\'' . esc_url($photo_url) . '\');"';
            ?>            
            <div class="slick-slide" <?php echo $bg_style; ?>>
                <div class="overlay">
                <h3><?php echo esc_html($observation->taxon->name); ?></h3>
                    <p>Observation Date: <?php echo esc_html($observation->observed_on); ?></p>
                    <p>Observer: <?php echo esc_html($observation->user->login); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('inat_carousel', 'inat_carousel_shortcode');

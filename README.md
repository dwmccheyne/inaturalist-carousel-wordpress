# iNaturalist Carousel

A WordPress plugin that displays a carousel of observations from iNaturalist based on the provided API query parameters. The plugin is easy to use and allows users to customize the API request by passing any supported arguments in the shortcode.

## Features

- Display a carousel of iNaturalist observations
- Selectable image size [square, small, medium, large, original]
- Easily pass any supported iNaturalist API query parameters

## Installation

1. Download the plugin as a .zip file or clone the repository
2. Upload the plugin to your WordPress site's `wp-content/plugins` directory
3. Activate the plugin through the 'Plugins' menu in the WordPress admin dashboard

## Usage

To use the iNaturalist Carousel plugin, simply insert the shortcode `[inat_carousel]` into your post or page.

The plugin shortcode accepts the following optional attributes:

- `image_size`: Specify the size of the image to be displayed (default: "large"). Available sizes: "square", "small", "medium", "large", "original".
- `api_params`: Specify any iNaturalist API query parameters as a string in the format "key1=value1&key2=value2" (default: empty string).

Example:
``` html
[inat_carousel image_size="medium" api_params="project_id=123&order_by=observed_on&order=desc"]
```

## License

iNaturalist Carousel is licensed under the GNU General Public License v3.0

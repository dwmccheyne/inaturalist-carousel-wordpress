jQuery(document).ready(function ($) {
    // Initialize the Slick Carousel
    $(".inat-carousel").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      arrows: true,
      prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left" aria-hidden="true"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right" aria-hidden="true"></i></button>',
      dots: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });
  
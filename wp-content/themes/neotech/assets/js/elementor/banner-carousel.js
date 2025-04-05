(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(neotechSwiperBase, {
                $element,
            })
        }

        if ($('.elementor-widget-neotech-banner-carousel .neotech-swiper').length > 0) {
            $('.elementor-widget-neotech-banner-carousel .neotech-swiper').on('swiperInit', function(e, slider) {
                slider.on('slideChangeTransitionStart', function (e) {
                    $('.elementor-banner-wrap-box-text .elementor-banner-box-text').hide(); 
                }); 
                
                slider.on('slideChangeTransitionEnd', function (e) {
                    $('.elementor-banner-wrap-box-text .elementor-banner-box-text').eq(e.realIndex).fadeIn();    
                }); 
            });    
        }

        elementorFrontend.hooks.addAction('frontend/element_ready/neotech-banner-carousel.default', addHandler);
    })
    
})(jQuery);


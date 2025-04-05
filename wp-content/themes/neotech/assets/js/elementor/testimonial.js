(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(neotechSwiperBase, {
                $element,
            });

            if ($element.hasClass('neotech-testimonial-layout-5')) {
                
                var initSwiperControl = () => {
                    var $slider = $element.find('.neotech-swiper-testimonial-content'),
                        $item = $element.find('.elementor-testimonial-image');
                        
                    var asyncSwiper = elementorFrontend.utils.swiper;
                    new asyncSwiper($slider, {
                        spaceBetween: 10,
                        pagination: false,
                    }).then((newSwiperThumbsInstance) => {
                        $item.on('click', function (e) {
                            e.preventDefault();
                            var $this = $(this);
                            var goto = $this.closest('.caption-top').data('goto');
                            console.log(goto);
                            if (goto) {
                                newSwiperThumbsInstance.slideTo(goto);
                            }
                        });
                    });
                }

                var $wrapper = $element.find('.elementor-testimonial-item-wrapper');
                if ($wrapper.find('.neotech-swiper').length) {
                    $wrapper.find('.neotech-swiper').on('swiperInit', function(e, slider) {
                        initSwiperControl();
                    });  
                } 
                else {
                    initSwiperControl();
                }
            }

        };
        elementorFrontend.hooks.addAction('frontend/element_ready/neotech-testimonials.default', addHandler);
    });

    
})(jQuery);
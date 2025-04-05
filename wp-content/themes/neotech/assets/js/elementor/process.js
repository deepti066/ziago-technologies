(function ($) {
    "use strict";

    $(window).on('elementor/frontend/init', () => {
        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(neotechSwiperBase, {
                $element,
            });

            if ($element.hasClass('icon-run-yes')) {
                if ($element.find('.neotech-swiper').length) {
                    $element.find('.neotech-swiper').on('swiperInit', function(e, slider) {
                        var $arrow = $element.find('.elementor-process-item .neotech-process-arrow');
                        let fontSize = parseInt($arrow.css('font-size')),
                            spaceBetween = slider.params.spaceBetween;

                        const $tempElement = $('<span>').css({
                            'font-size': fontSize + 'px',
                            'white-space': 'nowrap',
                            'position': 'absolute',
                            'visibility': 'hidden'
                        }).html($arrow.html());

                        $element.append($tempElement);
                        
                        while ($tempElement.width() <= spaceBetween && fontSize < 100) {
                            fontSize++;
                            $tempElement.css('font-size', fontSize + 'px');
                        }
                        
                        fontSize--;
                        $arrow.css('--dynamic-font-size', fontSize + 'px');
                        $tempElement.remove();
                        
                        $arrow.fadeIn('slow')
                    })
                }
            }
        };
        elementorFrontend.hooks.addAction('frontend/element_ready/neotech-process.default', addHandler);
    });
})(jQuery);


(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        const addHandler = ($element) => {
            const Swipes_wrap = $('.neotech-swiper', $element);

            if (Swipes_wrap.length > 0) {
                elementorFrontend.elementsHandler.addHandler(neotechSwiperBase, {
                    $element,
                });
            }

        };
        elementorFrontend.hooks.addAction('frontend/element_ready/neotech-services.default', addHandler);
    });

})(jQuery);

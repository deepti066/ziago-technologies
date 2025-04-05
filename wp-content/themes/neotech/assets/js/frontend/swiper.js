(function ($) {
    'use strict';

    function getSwiperSettings(elementSettings) {
        const slidesToShow = +elementSettings.column || 3,
            isSingleSlide = 1 === slidesToShow,
            elementorBreakpoints = elementSettings.breakpoints,
            defaultSlidesToShowMap = {
                mobile: 1,
                tablet: isSingleSlide ? 1 : 2
            };
        const swiperOptions = {
            slidesPerView: slidesToShow,
            loop: 'yes' === elementSettings.infinite,
            speed: elementSettings.speed,
            handleElementorBreakpoints: true,
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
        };

        swiperOptions.breakpoints = {};
        let lastBreakpointSlidesToShowValue = slidesToShow;
        Object.keys(elementorBreakpoints).reverse().forEach(breakpoint => {
            const defaultSlidesToShow = defaultSlidesToShowMap[breakpoint.value] ? defaultSlidesToShowMap[breakpoint.value] : lastBreakpointSlidesToShowValue;
            swiperOptions.breakpoints[elementorBreakpoints[breakpoint].value] = {
                slidesPerView: +elementorBreakpoints[breakpoint].column || defaultSlidesToShow,
                slidesPerGroup: +elementorBreakpoints[breakpoint].column || 1
            };
            lastBreakpointSlidesToShowValue = +elementorBreakpoints[breakpoint].column || defaultSlidesToShow;
        });

        if ('yes' === elementSettings.autoplay) {
            swiperOptions.autoplay = {
                delay: elementSettings.autoplay_speed,
                disableOnInteraction: 'yes' === elementSettings.pause_on_interaction
            };
        }

        if (isSingleSlide) {
            swiperOptions.effect = elementSettings.effect;

            if ('fade' === elementSettings.effect) {
                swiperOptions.fadeEffect = {
                    crossFade: true
                };
            }
        } else {
            swiperOptions.slidesPerGroup = +elementSettings.slides_to_scroll || 1;
        }

        if (elementSettings.column_spacing) {
            swiperOptions.spaceBetween = elementSettings.column_spacing;
        }

        const showArrows = 'arrows' === elementSettings.navigation || 'both' === elementSettings.navigation,
            showDots = 'dots' === elementSettings.navigation || 'both' === elementSettings.navigation;

        if (showArrows) {
            swiperOptions.navigation = {
                prevEl: elementSettings.prevEl,
                nextEl: elementSettings.nextEl,
            };
        }

        if (showDots) {
            swiperOptions.pagination = {
                el: elementSettings.paginationel,
                type: 'bullets',
                clickable: true
            };
        }

        if ('yes' === elementSettings.lazyload) {
            swiperOptions.lazy = {
                loadPrevNext: true,
                loadPrevNextAmount: 1
            };
        }
        return swiperOptions;
    }

    // Woocommerce
    const upsellsSwiper = $('.upsells .neotech-theme-swiper');
    const relatedSwiper = $('.related .neotech-theme-swiper');
    const crossSwiper = $('.cross-sells .neotech-theme-swiper');
    if (crossSwiper.length > 0) {
        const ElementSettings = crossSwiper.data('settings');
        new Swiper('.cross-sells .neotech-swiper', getSwiperSettings(ElementSettings));
    }
    if (upsellsSwiper.length > 0) {
        const ElementSettings = upsellsSwiper.data('settings');
        new Swiper('.upsells .neotech-swiper', getSwiperSettings(ElementSettings));
    }
    if (relatedSwiper.length > 0) {
        const ElementSettings = relatedSwiper.data('settings');
        new Swiper('.related .neotech-swiper', getSwiperSettings(ElementSettings));
    }

    // Portfolio
    const portfolioRelated = $('.portfolios-related .neotech-theme-swiper');
    if (portfolioRelated.length > 0) {
        const ElementSettings = portfolioRelated.data('settings');
        new Swiper('.portfolios-related .neotech-swiper', getSwiperSettings(ElementSettings));
    }

})(jQuery);

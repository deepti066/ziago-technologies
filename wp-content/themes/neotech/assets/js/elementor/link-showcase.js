(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/neotech-link-showcase.default', ($scope) => {

            let $tabs = $scope.find('.link-showcase-title-wrapper');
            let $contents = $scope.find('.link-showcase-contnet-wrapper');
            // Active tab
            $contents.find('.elementor-active').show();
            var windowsize = $(window).width();
            if (windowsize > 567) {
                $tabs.find('.elementor-link-showcase-title').on('mouseenter', function (e) {
                    let id = $(this).attr('aria-controls');
                    e.preventDefault();
                    if($scope.hasClass('link-showcase-block-style-1')) {
                        $contents.find('.elementor-prev').removeClass('elementor-prev');
                        $contents.find('.elementor-active').addClass('elementor-prev');
                        $tabs.find('.elementor-link-showcase-title').removeClass('elementor-active');
                        $contents.find('.elementor-link-showcase-content').removeClass('elementor-active');
                        $(this).addClass('elementor-active');
                        $contents.find('#' + id).addClass('elementor-active');
                    }
                    else {
                        $contents.find('.elementor-link-showcase-content').removeClass('elementor-active');
                        $contents.find('#' + id).addClass('elementor-active');
                    }
                });
            } else {
                $tabs.find('.elementor-link-showcase-title').on('click', function (e) {
                    let id = $(this).attr('aria-controls');
                    e.preventDefault();
                    if($scope.hasClass('link-showcase-block-style-1')) {
                        $contents.find('.elementor-prev').removeClass('elementor-prev');
                        $contents.find('.elementor-active').addClass('elementor-prev');
                        $tabs.find('.elementor-link-showcase-title').removeClass('elementor-active');
                        $contents.find('.elementor-link-showcase-content').removeClass('elementor-active');
                        $(this).addClass('elementor-active');
                        $contents.find('#' + id).addClass('elementor-active');
                    }
                    else {
                        $contents.find('.elementor-link-showcase-content').removeClass('elementor-active');
                        $contents.find('#' + id).addClass('elementor-active');
                    }
                });
            }


        });
    });

})(jQuery);

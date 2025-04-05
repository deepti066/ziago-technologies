(function ($) {
    "use strict";

    function Process(selector, config) {
        this.el = $(selector);

        // options do not effect CSS, has to be set seperately
        const defaults = {
            track: {
                endAtLast: false
            },
            viewPointBottom: false,
            viewPoint: 400
        };
        this.options = $.extend({}, defaults, config || {});

        $(document).ready(() => {
            this.init();
        });

        this.init = function() {
            this.el.addClass("is-loading");
            this.el.addClass("is-init");
            this.el.each(function() {
                this.offsetHeight;
            });
            this.el.removeClass("is-loading");
            this.animation();
            // this.trackHeight();

            let self = this;
            $(document).scroll(function() {
                self.animation();
            });
            $(document).resize(function() {
                // self.trackHeight();
            });
        };

        this.animation = function() {
            let self = this;

            let scrollTop = $(document).scrollTop();
            let viewPoint = scrollTop + this.options.viewPoint;
            if (this.options.viewPointBottom) {
                viewPoint = scrollTop + window.innerHeight - this.options.viewPoint;
            }

            this.updateTrack(viewPoint);

            $(".process-item", this.el).each(function(i, v) {
                let top = $(this).offset().top;
                let bottom = $(this).offset().top + $(this).outerHeight(true);

                if (viewPoint < top) {
                    self.updateClasses(this, "is-below");
                } else if (viewPoint > bottom) {
                    self.updateClasses(this, "is-above is-visible");
                } else {
                    self.updateClasses(this, "is-current is-visible");
                }
            });
        };

        this.updateClasses = function(el, newClass) {
            $(el).removeClass("is-above is-current is-below is-visible");
            $(el).addClass(newClass);
        };

        this.updateTrack = function(viewPoint) {
            var $el = this.el.next(".process__track");
            let top = $el.offset().top;
            let height = viewPoint - top;
            $el.height(height);
        };

        this.trackHeight = function() {
            let trackMax = this.el.outerHeight();
            this.el.next(".process__track").css("max-height", trackMax);
        };
    }

    class Elementor_Process {
        static instance;

        static getInstance() {
            if (!Elementor_Process.instance) {
                Elementor_Process.instance = new Elementor_Process();
            }
            return Elementor_Process.instance;
        }

        constructor() {
            $(window).on('elementor/frontend/init', () => {
                this.init();
            });
        }

        init() {
            elementorFrontend.hooks.addAction('frontend/element_ready/neotech-process-2.default', ($scope, $) => {
                var wrapW = $scope.find('.neotech-process-2-wrapper').width();
                $scope.find('.neotech-process-2-wrapper').css('--neotech-process-wrap-width', wrapW+'px')
                $(window).on("resize", function(event){
                    wrapW = $scope.find('.neotech-process-2-wrapper').width();
                    $scope.find('.neotech-process-2-wrapper').css('--neotech-process-wrap-width', wrapW+'px')
                    $mask.height($('body').height());
                });
    
                new Process($scope.find(".neotech-process-2"));
            });
        }
    }

    Elementor_Process.getInstance();

})(jQuery);
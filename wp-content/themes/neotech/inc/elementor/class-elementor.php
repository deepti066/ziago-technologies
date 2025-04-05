<?php


if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Neotech_Elementor')) :

    /**
     * The Neotech Elementor Integration class
     */
    class Neotech_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);
            add_action('elementor/controls/register', array($this, 'include_controls'));

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Elementor Fix Noitice WooCommerce
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/register', [$this, 'add_icons']);


            // Add Breakpoints
            add_action('wp_enqueue_scripts', 'neotech_elementor_breakpoints', 9999);

            if (!neotech_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/class-custom-css.php';
                require trailingslashit(get_template_directory()) . 'inc/elementor/class-section-sticky.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
            }

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);

            if ( version_compare( ELEMENTOR_VERSION, '3.26.0', '>=' ) ) {
                add_action('wp_enqueue_scripts', function() {
                    wp_enqueue_style('e-swiper');
                }, -1);
            }

        }

        public function include_controls( $manager ) {
            require get_theme_file_path('inc/elementor/elementor-control/class-custom-typography.php');
            $manager->add_group_control( Neotech\Elementor\Neotech_Group_Control_Typography::get_type(), new Neotech\Elementor\Neotech_Group_Control_Typography() );
        }

        public function additional_fonts($fonts) {
            $fonts["Outfit"] = 'googlefonts';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = esc_html__('Shortcode', 'neotech');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            global $neotech_version;
            wp_enqueue_script('neotech-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $neotech_version);
        }

        public function add_style_editor() {
            global $neotech_version;
            wp_enqueue_style('neotech-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $neotech_version);
        }

        public function add_scripts() {
            global $neotech_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('neotech-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $neotech_version);
            wp_style_add_data('neotech-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/libs/TweenMax.min.js'), array('jquery'), '1.11.1');
            wp_enqueue_script('tweenmax');

            // Odometer Counter
            wp_register_script('odometer', get_theme_file_uri('/assets/js/libs/odometer.min.js'), array('jquery'), '');
            wp_register_style('odometer', get_template_directory_uri() . '/assets/css/libs/odometer.css', '', '');

            if (neotech_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/libs/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }
        }

        public function register_auto_scripts_frontend() {
            global $neotech_version;
            wp_register_script('neotech-elementor-banner-carousel', get_theme_file_uri('/assets/js/elementor/banner-carousel.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-image-before-after', get_theme_file_uri('/assets/js/elementor/image-before-after.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-image-carousel', get_theme_file_uri('/assets/js/elementor/image-carousel.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-image-gallery', get_theme_file_uri('/assets/js/elementor/image-gallery.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-image-hotspots', get_theme_file_uri('/assets/js/elementor/image-hotspots.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-link-showcase', get_theme_file_uri('/assets/js/elementor/link-showcase.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-portfolio', get_theme_file_uri('/assets/js/elementor/portfolio.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-process', get_theme_file_uri('/assets/js/elementor/process.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-process-2', get_theme_file_uri('/assets/js/elementor/process-2.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-product-categories', get_theme_file_uri('/assets/js/elementor/product-categories.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-service', get_theme_file_uri('/assets/js/elementor/service.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-slide-scrolling', get_theme_file_uri('/assets/js/elementor/slide-scrolling.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-tabs-target', get_theme_file_uri('/assets/js/elementor/tabs-target.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-team', get_theme_file_uri('/assets/js/elementor/team.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-text-carousel', get_theme_file_uri('/assets/js/elementor/text-carousel.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-text-scrolling', get_theme_file_uri('/assets/js/elementor/text-scrolling.js'), array('jquery','elementor-frontend'), $neotech_version, true);
            wp_register_script('neotech-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $neotech_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'neotech-addons',
                array(
                    'title' => esc_html__('Neotech Addons', 'neotech'),
                    'icon'  => 'fa fa-plug',
                ), 1);
        }

        public function add_animations_scroll($animations) {
            $animations['Neotech Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            require get_theme_file_path('inc/elementor/base_widgets.php');

            $files_custom = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files_custom as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }

            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function woocommerce_fix_notice() {
            if (neotech_is_woocommerce_activated()) {
                remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
                remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"neotech-icon-arrow-l":"arrow-l","neotech-icon-arrow-r":"arrow-r","neotech-icon-brain":"brain","neotech-icon-breadcrumb":"breadcrumb","neotech-icon-bullet-list-line":"bullet-list-line","neotech-icon-calendar":"calendar","neotech-icon-check-mark":"check-mark","neotech-icon-check-mark1":"check-mark1","neotech-icon-clock":"clock","neotech-icon-computer":"computer","neotech-icon-computer1":"computer1","neotech-icon-development":"development","neotech-icon-dot-rectangle":"dot-rectangle","neotech-icon-filters":"filters","neotech-icon-flower":"flower","neotech-icon-guide1":"guide1","neotech-icon-headset":"headset","neotech-icon-hosting":"hosting","neotech-icon-information1":"information1","neotech-icon-instagram-o":"instagram-o","neotech-icon-instructions":"instructions","neotech-icon-it-service":"it-service","neotech-icon-large-o":"large-o","neotech-icon-leadership":"leadership","neotech-icon-list-ul":"list-ul","neotech-icon-map-location":"map-location","neotech-icon-movies":"movies","neotech-icon-phone-call":"phone-call","neotech-icon-play-fill":"play-fill","neotech-icon-play":"play","neotech-icon-quicksupport":"quicksupport","neotech-icon-quote1":"quote1","neotech-icon-quote2":"quote2","neotech-icon-rating-hand":"rating-hand","neotech-icon-reply-line":"reply-line","neotech-icon-send":"send","neotech-icon-server":"server","neotech-icon-setting":"setting","neotech-icon-settings":"settings","neotech-icon-settings1":"settings1","neotech-icon-share-all":"share-all","neotech-icon-shopping-bag":"shopping-bag","neotech-icon-shoppingcart-o":"shoppingcart-o","neotech-icon-sliders-v":"sliders-v","neotech-icon-square-o":"square-o","neotech-icon-step":"step","neotech-icon-support":"support","neotech-icon-tags":"tags","neotech-icon-technology":"technology","neotech-icon-th-large-o":"th-large-o","neotech-icon-two-line":"two-line","neotech-icon-user1":"user1","neotech-icon-video-call":"video-call","neotech-icon-360":"360","neotech-icon-arrow-down":"arrow-down","neotech-icon-arrow-left":"arrow-left","neotech-icon-arrow-right":"arrow-right","neotech-icon-arrow-up":"arrow-up","neotech-icon-bars":"bars","neotech-icon-bullet-list-line2":"bullet-list-line2","neotech-icon-caret-down":"caret-down","neotech-icon-caret-left":"caret-left","neotech-icon-caret-right":"caret-right","neotech-icon-caret-up":"caret-up","neotech-icon-cart-1":"cart-1","neotech-icon-cart-empty":"cart-empty","neotech-icon-cart":"cart","neotech-icon-check-square":"check-square","neotech-icon-checkmark":"checkmark","neotech-icon-chevron-down":"chevron-down","neotech-icon-chevron-left":"chevron-left","neotech-icon-chevron-right":"chevron-right","neotech-icon-chevron-up":"chevron-up","neotech-icon-circle":"circle","neotech-icon-Clip-path-group":"Clip-path-group","neotech-icon-cloud-download-alt":"cloud-download-alt","neotech-icon-comment":"comment","neotech-icon-comments":"comments","neotech-icon-compare":"compare","neotech-icon-credit-card":"credit-card","neotech-icon-delivery-truck":"delivery-truck","neotech-icon-dot-circle":"dot-circle","neotech-icon-edit":"edit","neotech-icon-envelope":"envelope","neotech-icon-expand-alt":"expand-alt","neotech-icon-external-link-alt":"external-link-alt","neotech-icon-file-alt":"file-alt","neotech-icon-file-archive":"file-archive","neotech-icon-filter":"filter","neotech-icon-fire1":"fire1","neotech-icon-folder-open":"folder-open","neotech-icon-folder":"folder","neotech-icon-frown":"frown","neotech-icon-gift":"gift","neotech-icon-grid-view-line":"grid-view-line","neotech-icon-grip-horizontal":"grip-horizontal","neotech-icon-heart-fill":"heart-fill","neotech-icon-heart":"heart","neotech-icon-history":"history","neotech-icon-home":"home","neotech-icon-info-circle":"info-circle","neotech-icon-instagram":"instagram","neotech-icon-level-up-alt":"level-up-alt","neotech-icon-list":"list","neotech-icon-Mail":"Mail","neotech-icon-map-marker-check":"map-marker-check","neotech-icon-meh":"meh","neotech-icon-minus-circle":"minus-circle","neotech-icon-minus":"minus","neotech-icon-mobile-android-alt":"mobile-android-alt","neotech-icon-money-bill":"money-bill","neotech-icon-money":"money","neotech-icon-Online_Support":"Online_Support","neotech-icon-paper-plane":"paper-plane","neotech-icon-pencil-alt":"pencil-alt","neotech-icon-plus-circle":"plus-circle","neotech-icon-plus":"plus","neotech-icon-quickview":"quickview","neotech-icon-random":"random","neotech-icon-rating-stroke":"rating-stroke","neotech-icon-rating":"rating","neotech-icon-repeat":"repeat","neotech-icon-reply-all":"reply-all","neotech-icon-reply":"reply","neotech-icon-search-plus":"search-plus","neotech-icon-search":"search","neotech-icon-shield-check":"shield-check","neotech-icon-shopping-basket":"shopping-basket","neotech-icon-shopping-cart":"shopping-cart","neotech-icon-sign-out-alt":"sign-out-alt","neotech-icon-smile":"smile","neotech-icon-spinner":"spinner","neotech-icon-square":"square","neotech-icon-star":"star","neotech-icon-store":"store","neotech-icon-sync_alt":"sync_alt","neotech-icon-sync":"sync","neotech-icon-tachometer-alt":"tachometer-alt","neotech-icon-th-large":"th-large","neotech-icon-th-list":"th-list","neotech-icon-thumbtack":"thumbtack","neotech-icon-ticket":"ticket","neotech-icon-times-circle":"times-circle","neotech-icon-times":"times","neotech-icon-trophy-alt":"trophy-alt","neotech-icon-truck1":"truck1","neotech-icon-user-headset":"user-headset","neotech-icon-user-shield":"user-shield","neotech-icon-user":"user","neotech-icon-video":"video","neotech-icon-wishlist-empty":"wishlist-empty","neotech-icon-wishlist":"wishlist","neotech-icon-adobe":"adobe","neotech-icon-amazon":"amazon","neotech-icon-android":"android","neotech-icon-angular":"angular","neotech-icon-apper":"apper","neotech-icon-apple":"apple","neotech-icon-atlassian":"atlassian","neotech-icon-behance":"behance","neotech-icon-bitbucket":"bitbucket","neotech-icon-bitcoin":"bitcoin","neotech-icon-bity":"bity","neotech-icon-bluetooth":"bluetooth","neotech-icon-btc":"btc","neotech-icon-centos":"centos","neotech-icon-chrome":"chrome","neotech-icon-codepen":"codepen","neotech-icon-cpanel":"cpanel","neotech-icon-discord":"discord","neotech-icon-dochub":"dochub","neotech-icon-docker":"docker","neotech-icon-dribbble":"dribbble","neotech-icon-dropbox":"dropbox","neotech-icon-drupal":"drupal","neotech-icon-ebay":"ebay","neotech-icon-facebook-f":"facebook-f","neotech-icon-facebook-o":"facebook-o","neotech-icon-facebook":"facebook","neotech-icon-figma":"figma","neotech-icon-firefox":"firefox","neotech-icon-google-plus":"google-plus","neotech-icon-google":"google","neotech-icon-grunt":"grunt","neotech-icon-gulp":"gulp","neotech-icon-html5":"html5","neotech-icon-joomla":"joomla","neotech-icon-link-brand":"link-brand","neotech-icon-linkedin-in":"linkedin-in","neotech-icon-linkedin":"linkedin","neotech-icon-mailchimp":"mailchimp","neotech-icon-opencart":"opencart","neotech-icon-paypal":"paypal","neotech-icon-pinterest-p":"pinterest-p","neotech-icon-reddit":"reddit","neotech-icon-skype":"skype","neotech-icon-slack":"slack","neotech-icon-snapchat":"snapchat","neotech-icon-spotify":"spotify","neotech-icon-trello":"trello","neotech-icon-twitter":"twitter","neotech-icon-vimeo":"vimeo","neotech-icon-whatsapp":"whatsapp","neotech-icon-wordpress":"wordpress","neotech-icon-yoast":"yoast","neotech-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $neotech_version;
            $tabs['opal-custom'] = [
                'name'          => 'neotech-icon',
                'label'         => esc_html__('Neotech Icon', 'neotech'),
                'prefix'        => 'neotech-icon-',
                'displayPrefix' => 'neotech-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $neotech_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Neotech_Elementor();

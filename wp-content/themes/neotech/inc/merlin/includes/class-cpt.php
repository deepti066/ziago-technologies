<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Neotech_Handle_CPT')) :

    /**
     * The CPT Neotech class
     */
    class Neotech_Handle_CPT {

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct() {

            add_action( 'init', [$this, 'neotech_register_my_cpts'] );
            add_action( 'init', [$this, 'neotech_register_taxes'] );

            add_action( 'widgets_init', [$this, 'neotech_cpt_widgets_init'] );
            add_filter( 'neotech_theme_sidebar', [$this, 'set_sidebar'], 30 );
            add_filter( 'body_class', [$this, 'body_classes'], 30 );

            // Add icon service
            add_action( "add_meta_boxes", [$this, 'ssu_add_cpt_meta_box'] );
            add_action( "save_post", [$this, "ssu_save_cpt_custom_meta_fields"], 10, 3 );

            add_filter( 'navigation_markup_template', [$this, 'neotech_custom_navigation_single_page'], 10, 2 );

            add_action( 'wp_enqueue_scripts', array($this, 'neotech_cpt_scripts'), 20 );
            add_action( 'admin_enqueue_scripts', array($this, 'load_media' ));
            
        }

        function neotech_register_my_cpts() {

            /**
             * Post Type: Services.
             */
        
            $service_slug = neotech_get_theme_option('service_slug', 'service');
            $service_label = neotech_get_theme_option('service_label', __( "Services", "neotech" ));
        
            $args = [
                "label" => $service_label,
                "description" => "",
                "public" => true,
                "publicly_queryable" => true,
                "show_ui" => true,
                "show_in_rest" => true,
                "rest_base" => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "rest_namespace" => "wp/v2",
                "has_archive" => false,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "delete_with_user" => false,
                "exclude_from_search" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "hierarchical" => false,
                "can_export" => true,
                "rewrite" => [ "slug" => $service_slug, "with_front" => true ],
                "query_var" => true,
                "menu_position" => 20,
                "menu_icon" => "dashicons-feedback",
                "supports" => [ "title", "editor", "thumbnail", "excerpt", "author" ],
                "show_in_graphql" => false,
            ];

            $args = apply_filters('neotech_custom_args_service_pt', $args);
        
            register_post_type( "service", $args );

            /**
             * Post Type: Team.
             */
        
            $team_slug = neotech_get_theme_option('team_slug', 'team');
            $team_label = neotech_get_theme_option('team_label', __( "Teams", "neotech" ));
        
            $args = [
                "label" => $team_label,
                "description" => "",
                "public" => true,
                "publicly_queryable" => true,
                "show_ui" => true,
                "show_in_rest" => true,
                "rest_base" => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "rest_namespace" => "wp/v2",
                "has_archive" => false,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "delete_with_user" => false,
                "exclude_from_search" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "hierarchical" => false,
                "can_export" => true,
                "rewrite" => [ "slug" => $team_slug, "with_front" => true ],
                "query_var" => true,
                "menu_position" => 20,
                "menu_icon" => "dashicons-groups",
                "supports" => [ "title", "editor", "thumbnail", "excerpt", "author" ],
                "show_in_graphql" => false,
            ];

            $args = apply_filters('neotech_custom_args_team_pt', $args);
        
            register_post_type( "team", $args );

            /**
             * Post Type: Portfolio.
             */

            $portfolio_slug = neotech_get_theme_option('portfolio_slug', 'portfolio');
            $portfolio_label = neotech_get_theme_option('portfolio_label', __( "Portfolios", "neotech" ));

            $args = [
                "label" => $portfolio_label,
                "description" => "",
                "public" => true,
                "publicly_queryable" => true,
                "show_ui" => true,
                "show_in_rest" => true,
                "rest_base" => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "rest_namespace" => "wp/v2",
                "has_archive" => false,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "delete_with_user" => false,
                "exclude_from_search" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "hierarchical" => false,
                "can_export" => true,
                "rewrite" => [ "slug" => $portfolio_slug, "with_front" => true ],
                "query_var" => true,
                "menu_position" => 20,
                "menu_icon" => "dashicons-calendar-alt",
                "supports" => [ "title", "editor", "thumbnail", "excerpt", "author" ],
                "show_in_graphql" => false,
                "taxonomies" => [ "portfolio-category" ],
            ];

            $args = apply_filters('neotech_custom_args_portfolio_pt', $args);

            register_post_type( "portfolio", $args );
        }

        function neotech_register_taxes() {

            /**
             * Taxonomy: Portfolio Category.
             */
        
            $labels = [
                "name" => esc_html__( "Categories", "neotech" ),
                "singular_name" => esc_html__( "Category", "neotech" ),
            ];
            $tax_slug = 'portfolio-category';
        
            
            $args = [
                "label" => esc_html__( "Category", "neotech" ),
                "labels" => $labels,
                "public" => true,
                "publicly_queryable" => false,
                "hierarchical" => true,
                "show_ui" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "query_var" => true,
                "rewrite" => [ 'slug' => $tax_slug, 'with_front' => false, ],
                "show_admin_column" => true,
                "show_in_rest" => false,
                "show_tagcloud" => false,
                "rest_base" => "portfolio-category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "rest_namespace" => "wp/v2",
                "show_in_quick_edit" => true,
                "sort" => false,
                "show_in_graphql" => false,
            ];
            register_taxonomy( "portfolio-category", [ "portfolio" ], $args );
        }

        function neotech_cpt_widgets_init() {
            register_sidebar( array(
                'name'          => __( 'Sidebar Single Service', 'neotech' ),
                'id'            => 'sidebar-service',
                'description'   => __( 'Display in service single page', 'neotech' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<span class="gamma widget-title">',
                'after_title'   => '</span>',
            ) );

            require_once get_parent_theme_file_path('/inc/merlin/includes/class-wp-widget-service.php');
            register_widget('Neotech_WP_Widget_Service');
        }

        function set_sidebar($name) {
            if (is_singular('service')) {
                $name = 'sidebar-service';
            }
            return $name;
        }

        function body_classes($classes) {
            if (is_singular('service') && is_active_sidebar('sidebar-service')) {
                $classes[] = 'neotech-sidebar-service';
                $classes[] = 'neotech-sidebar-left';
            }
            return $classes;
        }

        public function ssu_add_cpt_meta_box() {
            add_meta_box("ssu-custom-meta-fields", "Service Meta", [$this, 'ssu_service_iconbox_markup'], "service", "side", "low", null);
        }

        public function ssu_service_iconbox_markup( $post ) {
            wp_enqueue_script('neotech-service-admin');

            wp_nonce_field( basename(__FILE__), "ssu-service-additional-fields-nonce" );
            $icon_id = get_post_meta( $post->ID, '_service_icon_id', true );

            $icon_url = ($icon_id) ? wp_get_attachment_url($icon_id) : '';
            $btn_text = ($icon_id) ? 'Change service icon' : 'Set service icon';
            ?>
            <p class="hide-if-no-js">
                <p><label for="services_video_upload_btn"><strong>Service icon</strong></label></p>
                <a href="javascript:void(0)" style="display: block;">
                    <img id="service_icon_preview" src="<?php echo esc_html($icon_url) ?>" style="max-width: 100%; height: 100%">
                </a>
                <button id="services_video_upload_btn" class="thickbox button"><?php echo esc_html($btn_text) ?></button>
            </p>
            <input type="hidden" id="_service_icon_id" name="_service_icon_id" value="<?php echo ($icon_id) ? $icon_id : '' ?>">
            <?php
        }
        
        function ssu_save_cpt_custom_meta_fields( $postID, $post, $update ) {
            if ( !isset($_POST["ssu-service-additional-fields-nonce"] ) 
                || !wp_verify_nonce( $_POST["ssu-service-additional-fields-nonce"], basename(__FILE__) ) ){
                    return $postID;
            }

            if( !current_user_can( "edit_post", $postID ) ){
                return $postID;
            }

            if( defined("DOING_AUTOSAVE") && DOING_AUTOSAVE ){
                return $postID;
            }

            $icon_id = '';
            if( isset( $_POST['_service_icon_id'] ) ){
                $icon_id = absint($_POST['_service_icon_id']);
            }
            update_post_meta( $postID, '_service_icon_id', $icon_id );
        }

        function neotech_custom_navigation_single_page($template, $css_class) {
            if (!is_singular('portfolio')) return $template;
            $pf_page_id = neotech_get_theme_option('portfolio_page', '');
            if (!$pf_page_id || empty($pf_page_id)) return $template;
            
            $back_link = '<a class="neotech_back_link" href="'.get_permalink( $pf_page_id ).'"><i class="neotech-icon-grid-view-line"></i></a>';

            $template = '
            <nav class="navigation %1$s" aria-label="%4$s">
                <h2 class="screen-reader-text">%2$s</h2>
                <div class="nav-links">%3$s '.$back_link.'</div>
            </nav>';

            return $template;
        }

        function neotech_cpt_scripts() {
            if (is_singular('portfolio')) {
                wp_enqueue_script('swiper');
                wp_enqueue_script('neotech-swiper');
            }
        }

        function load_media() {
            global $neotech_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_register_script('neotech-service-admin', get_theme_file_uri('assets/js/admin/service' . $suffix . '.js'), array(), $neotech_version, true);
        }

    }

endif;

return new Neotech_Handle_CPT();

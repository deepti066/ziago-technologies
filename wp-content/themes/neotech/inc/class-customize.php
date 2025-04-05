<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Neotech_Customize')) {

    class Neotech_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        private function get_block($kw) {
            global $post;

            $options[''] = esc_html__('Select Block', 'neotech');
            if (!neotech_is_elementor_activated()) {
                return;
            }
            $args = array(
                'post_type'      => 'elementor_library',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                's'              =>  $kw,
                'order'          => 'ASC',
            );

            $query1 = new WP_Query($args);
            while ($query1->have_posts()) {
                $query1->the_post();
                $options[$post->post_name] = $post->post_title;
            }

            wp_reset_postdata();
            return $options;
        }

        public function get_page() {
            global $post;

            $options[''] = esc_html__('Select Page', 'neotech');

            $args = array(
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            );

            $query1 = new WP_Query($args);
            while ($query1->have_posts()) {
                $query1->the_post();
                $options[$post->ID] = $post->post_title;
            }

            wp_reset_postdata();
            return $options;
        }

        
        public function get_cf7_forms() {
            $cf7               = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
            $contact_forms[''] = esc_html__('Please select form', 'neotech');
            if ($cf7) {
                foreach ($cf7 as $cform) {
                    $hash = get_post_meta( $cform->ID, '_hash', true );
                    if ($hash) {
                        $contact_forms[$hash] = $cform->post_title;
                    }
                }
            } else {
                $contact_forms[0] = esc_html__('No contact forms found', 'neotech');
            }

            wp_reset_postdata();
            return $contact_forms;
        }

        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_neotech_blog($wp_customize);
            $this->neotech_register_theme_customizer($wp_customize);


            if (neotech_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }
            
            if (post_type_exists('service')) {
                $this->init_neotech_service($wp_customize);
            }
            
            if (post_type_exists('team')) {
                $this->init_neotech_team($wp_customize);
            }

            if (post_type_exists('portfolio')) {
                $this->init_neotech_portfolio($wp_customize);
            }

            do_action('neotech_customize_register', $wp_customize);
        }

        function neotech_register_theme_customizer($wp_customize) {

        } // end neotech_register_theme_customizer

        public function neotech_active_callback_show_top_block($control) {
            $setting = $control->manager->get_setting( 'neotech_options_show_top_blog' );
            $show = $setting->value();

            return $show === 'yes';
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_neotech_blog($wp_customize) {

            $wp_customize->add_panel('neotech_blog', array(
                'title' => esc_html__('Blog', 'neotech'),
            ));

            // =========================================
            // Blog Archive
            // =========================================
            $wp_customize->add_section('neotech_blog_archive', array(
                'title'      => esc_html__('Archive', 'neotech'),
                'panel'      => 'neotech_blog',
                'capability' => 'edit_theme_options',
            ));

            if (neotech_is_elementor_activated()) {
                $wp_customize->add_setting('neotech_options_show_top_blog', array(
                    'type'              => 'option',
                    'default'           => 'no',
                    'sanitize_callback' => 'sanitize_text_field',
                ));
    
                $wp_customize->add_control('neotech_options_show_top_blog', array(
                    'section' => 'neotech_blog_archive',
                    'label'   => esc_html__('Show Top Block', 'neotech'),
                    'type'    => 'select',
                    'choices' => [
                        'no' => esc_html__('No', 'neotech'),
                        'yes' => esc_html__('Yes', 'neotech'),
                    ]
                ));

                $wp_customize->add_setting('neotech_options_top_blog_template', array(
                    'type'              => 'option',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control('neotech_options_top_blog_template', array(
                    'section'     => 'neotech_blog_archive',
                    'label'       => esc_html__('Choose Block', 'neotech'),
                    'type'        => 'select',
                    'description' => __('Block will take templates name prefix is "Blog"', 'neotech'),
                    'choices'     => $this->get_block('Blog'),
                    'active_callback' => [$this, 'neotech_active_callback_show_top_block'],
                ));
            }

            $wp_customize->add_setting('neotech_options_blog_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_blog_sidebar', array(
                'section' => 'neotech_blog_archive',
                'label'   => esc_html__('Sidebar Position', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    'none'  => esc_html__('None', 'neotech'),
                    'left'  => esc_html__('Left', 'neotech'),
                    'right' => esc_html__('Right', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_blog_style', array(
                'section' => 'neotech_blog_archive',
                'label'   => esc_html__('Blog style', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'neotech'),
                    'list'     => esc_html__('Blog List', 'neotech'),
                    'style-1'  => esc_html__('Blog Grid', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_blog_columns', array(
                'type'              => 'option',
                'default'           => 3,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_blog_columns', array(
                'section' => 'neotech_blog_archive',
                'label'   => esc_html__('Colunms', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'neotech'),
                    2 => esc_html__('2', 'neotech'),
                    3 => esc_html__('3', 'neotech'),
                    4 => esc_html__('4', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_blog_columns_laptop', array(
                'type'              => 'option',
                'default'           => 3,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_blog_columns_laptop', array(
                'section' => 'neotech_blog_archive',
                'label'   => esc_html__('Colunms Laptop', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'neotech'),
                    2 => esc_html__('2', 'neotech'),
                    3 => esc_html__('3', 'neotech'),
                    4 => esc_html__('4', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_blog_columns_tablet', array(
                'type'              => 'option',
                'default'           => 2,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_blog_columns_tablet', array(
                'section' => 'neotech_blog_archive',
                'label'   => esc_html__('Colunms Tablet', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'neotech'),
                    2 => esc_html__('2', 'neotech'),
                    3 => esc_html__('3', 'neotech'),
                    4 => esc_html__('4', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_blog_columns_mobile', array(
                'type'              => 'option',
                'default'           => 1,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_blog_columns_mobile', array(
                'section' => 'neotech_blog_archive',
                'label'   => esc_html__('Colunms Mobile', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'neotech'),
                    2 => esc_html__('2', 'neotech'),
                    3 => esc_html__('3', 'neotech'),
                    4 => esc_html__('4', 'neotech'),
                ),
            ));

            // =========================================
            // Blog Single
            // =========================================
            $wp_customize->add_section('neotech_blog_single', array(
                'title'      => esc_html__('Singular', 'neotech'),
                'panel'      => 'neotech_blog',
                'capability' => 'edit_theme_options',
            ));

            $wp_customize->add_setting('neotech_options_blog_single_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_blog_single_sidebar', array(
                'section' => 'neotech_blog_single',
                'label'   => esc_html__('Sidebar Position', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    'none'  => esc_html__('None', 'neotech'),
                    'left'  => esc_html__('Left', 'neotech'),
                    'right' => esc_html__('Right', 'neotech'),
                ),
            ));
            
            $wp_customize->add_setting('neotech_options_blog_single_style', array(
                'type'              => 'option',
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_blog_single_style', array(
                'section' => 'neotech_blog_single',
                'label'   => esc_html__('Template style', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    ''  => esc_html__('Style 1', 'neotech'),
                    '2'  => esc_html__('Style 2', 'neotech'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */


        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'neotech'),
            ));

            $wp_customize->add_section('neotech_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'neotech'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            if (neotech_is_elementor_activated()) {
                $wp_customize->add_setting('neotech_options_shop_banner', array(
                    'type'              => 'option',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control('neotech_options_shop_banner', array(
                    'section'     => 'neotech_woocommerce_archive',
                    'label'       => esc_html__('Banner', 'neotech'),
                    'type'        => 'select',
                    'description' => __('Banner will take templates name prefix is "Banner"', 'neotech'),
                    'choices'     => $this->get_block('Banner')
                ));

                $wp_customize->add_setting('neotech_options_shop_banner_position', array(
                    'type'              => 'option',
                    'default'           => 'top',
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control('neotech_options_shop_banner_position', array(
                    'section' => 'neotech_woocommerce_archive',
                    'label'   => esc_html__('Banner Position', 'neotech'),
                    'type'    => 'select',
                    'choices' => array(
                        'top'     => __('Top Page', 'neotech'),
                        'content' => __('Before Products', 'neotech'),
                    ),
                ));

            }

            $wp_customize->add_setting('neotech_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_woocommerce_archive_layout', array(
                'section' => 'neotech_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    'default'  => esc_html__('Sidebar', 'neotech'),
                    'canvas'   => esc_html__('Canvas Filter', 'neotech'),
                    'dropdown' => esc_html__('Dropdown Filter', 'neotech'),
                    'drawing'  => esc_html__('Drawing Filter', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_woocommerce_archive_sidebar', array(
                'section' => 'neotech_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'neotech'),
                    'right' => esc_html__('Right', 'neotech'),

                ),
            ));

            $wp_customize->add_setting('neotech_options_woocommerce_shop_pagination', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_woocommerce_shop_pagination', array(
                'section' => 'neotech_woocommerce_archive',
                'label'   => esc_html__('Products pagination', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    'default'  => esc_html__('Pagination', 'neotech'),
                    'more-btn' => esc_html__('Load More', 'neotech'),
                    'infinit'  => esc_html__('Infinit Scroll', 'neotech'),
                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('neotech_woocommerce_single', array(
                'title'      => esc_html__('Singular', 'neotech'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('neotech_options_wocommerce_single_style', array(
                'type'              => 'option',
                'default'           => '',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_wocommerce_single_style', array(
                'section' => 'neotech_woocommerce_single',
                'label'   => esc_html__('Single Style', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    '1' => esc_html__('Default', 'neotech'),
                    '2' => esc_html__('With Background', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_wocommerce_single_sidebar', array(
                'type'              => 'option',
                'default'           => '',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            
            $wp_customize->add_control('neotech_options_wocommerce_single_sidebar', array(
                'section' => 'neotech_woocommerce_single',
                'label'   => esc_html__('Single Sidebar', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    '' => esc_html__('Hidden', 'neotech'),
                    'show' => esc_html__('Show Sidebar', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('neotech_options_single_product_gallery_layout', array(
                'section' => 'neotech_woocommerce_single',
                'label'   => esc_html__('Gallery Style', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal'     => esc_html__('Bottom Thumbnail', 'neotech'),
                    'vertical'       => esc_html__('Left Thumbnail', 'neotech'),
                    'right_vertical' => esc_html__('Right Thumbnail', 'neotech'),
                    'without-thumb'  => esc_html__('Without Thumbnail', 'neotech'),
                    'gallery'        => esc_html__('Gallery Thumbnail', 'neotech'),
                    'sticky'         => esc_html__('Sticky Content', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_single_product_tab_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('neotech_options_single_product_tab_layout', array(
                'section'     => 'neotech_woocommerce_single',
                'label'       => esc_html__('Content In Tabs?', 'neotech'),
                'description' => esc_html__('Show content in tabs or accordion .....?', 'neotech'),
                'type'        => 'select',
                'choices'     => array(
                    'default'       => esc_html__('Default Tabs', 'neotech'),
                    'vertical'      => esc_html__('Vertical Tabs', 'neotech'),
                    'accordion'     => esc_html__('Accordion', 'neotech'),
                    'expand'        => esc_html__('Expand all', 'neotech'),
                ),
            ));

            $wp_customize->add_setting(
                'neotech_options_single_security_logo',
                array(
                    /* translators: %s privacy policy page name and link */
                    'type'              => 'upload',
                    'sanitize_callback' => 'wp_kses_post',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'postMessage',
                )
            );

            $wp_customize->add_control(
                'neotech_options_single_security_logo',
                array(

                    'label'    => esc_html__('Security logo', 'neotech'),
                    'section'  => 'neotech_woocommerce_single',
                    'settings' => 'neotech_options_single_security_logo',
                    'context'    => '' ,
                    'priority'   => 30,
                )
            );

            $wp_customize->add_setting(
                'neotech_options_single_product_content_meta',
                array(
                    /* translators: %s privacy policy page name and link */
                    'type'              => 'option',
                    'sanitize_callback' => 'wp_kses_post',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'postMessage',
                )
            );

            $wp_customize->add_control(new Neotech_Customize_Control_Editor($wp_customize, 'neotech_options_single_product_content_meta', array(
                'section' => 'neotech_woocommerce_single',
                'label'   => esc_html__('Single extra description', 'neotech'),
            )));
            
            $wp_customize->add_setting('neotech_options_single_product_ask', array(
                'type'              => 'option',
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_single_product_ask', array(
                'section'     => 'neotech_woocommerce_single',
                'label'       => esc_html__('Form asking question', 'neotech'),
                'type'        => 'select',
                'choices'     => $this->get_cf7_forms()
            ));

            // =========================================
            // Product Item Reponsive
            // =========================================
            $wp_customize->add_setting('neotech_options_wocommerce_row_laptop', array(
                'type'              => 'option',
                'default'           => 3,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_wocommerce_row_laptop', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row Laptop', 'neotech'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('neotech_options_wocommerce_row_tablet', array(
                'type'              => 'option',
                'default'           => 2,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_wocommerce_row_tablet', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row tablet', 'neotech'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('neotech_options_wocommerce_row_mobile', array(
                'type'              => 'option',
                'default'           => 1,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_wocommerce_row_mobile', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row mobile', 'neotech'),
                'type'    => 'number',
            ));

            // =========================================
            // Product Item Reponsive List View
            // =========================================
            $wp_customize->add_setting('neotech_options_wocommerce_column_list_view', array(
                'type'              => 'option',
                'default'           => 2,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_wocommerce_column_list_view', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row list view Laptop', 'neotech'),
                'description' => esc_html__('The number of products in each row of the list view)', 'neotech'),
                'type'    => 'number',
            ));

            // =========================================
            // Product
            // =========================================


            $wp_customize->add_section('neotech_woocommerce_product', array(
                'title'      => esc_html__('Product Block', 'neotech'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));
            $attribute_array      = [
                '' => esc_html__('None', 'neotech')
            ];
            $attribute_taxonomies = wc_get_attribute_taxonomies();

            if (!empty($attribute_taxonomies)) {
                foreach ($attribute_taxonomies as $tax) {
                    if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) {
                        $attribute_array[$tax->attribute_name] = $tax->attribute_label;
                    }
                }
            }

            $wp_customize->add_setting('neotech_options_wocommerce_attribute', array(
                'type'              => 'option',
                'default'           => '',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('neotech_options_wocommerce_attribute', array(
                'section' => 'neotech_woocommerce_product',
                'label'   => esc_html__('Attributes Show', 'neotech'),
                'type'    => 'select',
                'choices' => $attribute_array,
            ));

            $wp_customize->add_setting('neotech_options_wocommerce_grid_list_layout', array(
                'type'              => 'option',
                'default'           => '',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('neotech_options_wocommerce_grid_list_layout', array(
                'section' => 'neotech_woocommerce_product',
                'label'   => esc_html__('Grid - List Layout', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    ''     => esc_html__('Grid', 'neotech'),
                    'list' => esc_html__('List', 'neotech'),
                ),
            ));

            $wp_customize->add_setting('neotech_options_woocommerce_product_hover', array(
                'type'              => 'option',
                'default'           => 'none',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('neotech_options_woocommerce_product_hover', array(
                'section' => 'neotech_woocommerce_product',
                'label'   => esc_html__('Animation Image Hover', 'neotech'),
                'type'    => 'select',
                'choices' => array(
                    'none'          => esc_html__('None', 'neotech'),
                    'bottom-to-top' => esc_html__('Bottom to Top', 'neotech'),
                    'top-to-bottom' => esc_html__('Top to Bottom', 'neotech'),
                    'right-to-left' => esc_html__('Right to Left', 'neotech'),
                    'left-to-right' => esc_html__('Left to Right', 'neotech'),
                    'swap'          => esc_html__('Swap', 'neotech'),
                    'fade'          => esc_html__('Fade', 'neotech'),
                    'zoom-in'       => esc_html__('Zoom In', 'neotech'),
                    'zoom-out'      => esc_html__('Zoom Out', 'neotech'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_neotech_service($wp_customize) {

            $wp_customize->add_panel('neotech_service', array(
                'title' => esc_html__('Service', 'neotech'),
            ));
            
            $wp_customize->add_section('neotech_service_settings', array(
                'title'      => esc_html__('Settings', 'neotech'),
                'panel'      => 'neotech_service',
                'capability' => 'edit_theme_options',
            ));

            $wp_customize->add_setting(
                'neotech_options_service_slug',
                array(
                    'default'    => neotech_get_theme_option('service_slug', ''),
                    'type'       => 'option',
                    'sanitize_callback' => 'sanitize_title'
                    // 'capability' => 'manage_options',
                )
            );
    
            $wp_customize->add_control(
                'neotech_options_service_slug',
                array(
                    'label'   => __( 'Service Slug', 'neotech' ),
                    'section' => 'neotech_service_settings',
                    /* translators: %s: Admin Url */
                    'description' => sprintf(__('After change the slug, If error 404 appears, please update <a target="_blank" href="%s">the permalinks</a> in the Settings page', 'neotech'), esc_url(admin_url('options-permalink.php'))),
                )
            );
            
            $wp_customize->add_setting(
                'neotech_options_service_label',
                array(
                    'default'    => neotech_get_theme_option('service_label', ''),
                    'type'       => 'option',
                    'sanitize_callback' => 'sanitize_text_field'
                    // 'capability' => 'manage_options',
                )
            );
    
            $wp_customize->add_control(
                'neotech_options_service_label',
                array(
                    'label'   => __( 'Service Label', 'neotech' ),
                    'section' => 'neotech_service_settings',
                )
            );
        }
        
        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_neotech_team($wp_customize) {

            $wp_customize->add_panel('neotech_team', array(
                'title' => esc_html__('Team', 'neotech'),
            ));

            $wp_customize->add_section('neotech_team_settings', array(
                'title'      => esc_html__('Settings', 'neotech'),
                'panel'      => 'neotech_team',
                'capability' => 'edit_theme_options',
            ));

            $wp_customize->add_setting(
                'neotech_options_team_slug',
                array(
                    'default'    => neotech_get_theme_option('team_slug', ''),
                    'type'       => 'option',
                    'sanitize_callback' => 'sanitize_title'
                    // 'capability' => 'manage_options',
                )
            );
    
            $wp_customize->add_control(
                'neotech_options_team_slug',
                array(
                    'label'   => __( 'Team Slug', 'neotech' ),
                    'section' => 'neotech_team_settings',
                    /* translators: %s: Admin Url */
                    'description' => sprintf(__('After change the slug, If error 404 appears, please update <a target="_blank" href="%s">the permalinks</a> in the Settings page', 'neotech'), esc_url(admin_url('options-permalink.php'))),
                )
            );
            
            $wp_customize->add_setting(
                'neotech_options_team_label',
                array(
                    'default'    => neotech_get_theme_option('team_label', ''),
                    'type'       => 'option',
                    'sanitize_callback' => 'sanitize_text_field'
                    // 'capability' => 'manage_options',
                )
            );
    
            $wp_customize->add_control(
                'neotech_options_team_label',
                array(
                    'label'   => __( 'Team Label', 'neotech' ),
                    'section' => 'neotech_team_settings',
                )
            );

            if (neotech_is_elementor_activated()) {
                $wp_customize->add_section('neotech_team_single', array(
                    'title'      => esc_html__('Single Team', 'neotech'),
                    'panel'      => 'neotech_team',
                    'capability' => 'edit_theme_options',
                ));

                $wp_customize->add_setting('neotech_options_team_bottom_template', array(
                    'type'              => 'option',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control('neotech_options_team_bottom_template', array(
                    'section'     => 'neotech_team_single',
                    'label'       => esc_html__('Choose Block', 'neotech'),
                    'type'        => 'select',
                    'description' => __('Block will take templates name prefix is "Team"', 'neotech'),
                    'choices'     => $this->get_block('Team'),
                ));
            }
            
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_neotech_portfolio($wp_customize) {

            $wp_customize->add_panel('neotech_portfolio', array(
                'title' => esc_html__('Portfolio', 'neotech'),
            ));

            $wp_customize->add_section('neotech_portfolio_archive', array(
                'title'      => esc_html__('Archive', 'neotech'),
                'panel'      => 'neotech_portfolio',
                'capability' => 'edit_theme_options',
            ));

            $wp_customize->add_setting(
                'neotech_options_portfolio_page',
                array(
                    'default'    => neotech_get_theme_option('portfolio_page', ''),
                    'type'       => 'option',
                    'sanitize_callback' => 'sanitize_text_field'
                    // 'capability' => 'manage_options',
                )
            );

            $wp_customize->add_control(
                'neotech_options_portfolio_page',
                array(
                    'label'   => __( 'Choose portfolio page', 'neotech' ),
                    'section' => 'neotech_portfolio_archive',
                    'type'        => 'select',
                    'choices'     => $this->get_page()
                )
            );

            $wp_customize->add_section('neotech_portfolio_settings', array(
                'title'      => esc_html__('Settings', 'neotech'),
                'panel'      => 'neotech_portfolio',
                'capability' => 'edit_theme_options',
            ));

            $wp_customize->add_setting(
                'neotech_options_portfolio_slug',
                array(
                    'default'    => neotech_get_theme_option('portfolio_slug', ''),
                    'type'       => 'option',
                    'sanitize_callback' => 'sanitize_title'
                    // 'capability' => 'manage_options',
                )
            );

            $wp_customize->add_control(
                'neotech_options_portfolio_slug',
                array(
                    'label'   => __( 'Portfolio Slug', 'neotech' ),
                    'section' => 'neotech_portfolio_settings',
                    /* translators: %s: Admin Url */
                    'description' => sprintf(__('After change the slug, If error 404 appears, please update <a target="_blank" href="%s">the permalinks</a> in the Settings page', 'neotech'), esc_url(admin_url('options-permalink.php'))),
                )
            );
            
            $wp_customize->add_setting(
                'neotech_options_portfolio_label',
                array(
                    'default'    => neotech_get_theme_option('portfolio_label', ''),
                    'type'       => 'option',
                    'sanitize_callback' => 'sanitize_text_field'
                    // 'capability' => 'manage_options',
                )
            );

            $wp_customize->add_control(
                'neotech_options_portfolio_label',
                array(
                    'label'   => __( 'Portfolio Label', 'neotech' ),
                    'section' => 'neotech_portfolio_settings',
                )
            );
            
        }
    }
}
return new Neotech_Customize();

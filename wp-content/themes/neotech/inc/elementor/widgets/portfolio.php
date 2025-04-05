<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!post_type_exists('portfolio')) {
    return;
}

use Neotech\Elementor\Neotech_Base_Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Neotech_Elementor_Widget_Portfolio extends Neotech_Base_Widgets {


    public function get_categories() {
        return array('neotech-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'neotech-portfolio';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Neotech Portfolio', 'neotech');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-bag-medium';
    }


    public function get_script_depends() {
        return [
            'neotech-elementor-portfolio',
            'tooltipster'
        ];
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'neotech'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'limit',
            [
                'label'   => esc_html__('Posts Per Page', 'neotech'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'   => esc_html__('Show Title', 'neotech'),
                'default' => 'yes',
                'type'    => Controls_Manager::SWITCHER,
                // 'render_type'        => 'template',
                'selectors' => [
                ],
            ]
        );

        $this->add_control(
            'show_exerpt',
            [
                'label'   => esc_html__('Show Excerpt Portfolio', 'neotech'),
                'default' => 'no',
                'type'    => Controls_Manager::SWITCHER,
                // 'render_type'        => 'template',
                'selectors' => [
                ],
            ]
        );

        $this->add_control('show_category',
            [
                'label' => esc_html__('Show Category', 'neotech'),
                'type'  => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control('show_button',
            [
                'label' => esc_html__('Show Button', 'neotech'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control('show_pagination',
            [
                'label' => esc_html__('Show Pagination', 'neotech'),
                'type'  => Controls_Manager::SWITCHER,
                'condition'          => [
                    'enable_carousel!' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order By', 'neotech'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'       => esc_html__('Date', 'neotech'),
                    'id'         => esc_html__('Portfolio ID', 'neotech'),
                    'menu_order' => esc_html__('Menu Order', 'neotech'),
                    'title'      => esc_html__('Portfolio Title', 'neotech'),
                    'rand'       => esc_html__('Random', 'neotech'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'neotech'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__('ASC', 'neotech'),
                    'desc' => esc_html__('DESC', 'neotech'),
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label'     => esc_html__('Block Style', 'neotech'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => [
                    '1' => esc_html__('Style 1', 'neotech'),
                    '2' => esc_html__('Style 2', 'neotech'),
                    '3' => esc_html__('Style 3', 'neotech'),
                ],
                'render_type' => 'template',
                'prefix_class' => 'elementor-portfolio-style-',
            ]
        );

        $this->add_control(
            'enable_effect',
            [
                'label'        => esc_html__('Enable Effect', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'enable-effect-',
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->add_control(
            'style_image_hover',
            [
                'label'     => esc_html__('Image Hover', 'neotech'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'          => esc_html__('None', 'neotech'),
                    'bottom-to-top' => esc_html__('Bottom to Top', 'neotech'),
                    'top-to-bottom' => esc_html__('Top to Bottom', 'neotech'),
                    'right-to-left' => esc_html__('Right to Left', 'neotech'),
                    'left-to-right' => esc_html__('Left to Right', 'neotech'),
                    'swap'          => esc_html__('Swap', 'neotech'),
                    'fade'          => esc_html__('Fade', 'neotech'),
                    'zoom-in'       => esc_html__('Zoom In', 'neotech'),
                    'zoom-out'      => esc_html__('Zoom Out', 'neotech'),
                ],
                'condition' => [
                    'portfolio_layout' => 'grid'
                ]
            ]
        );



        $this->end_controls_section();


        //Section Query
        $this->start_controls_section(
            'section_portfolio_style',
            [
                'label' => esc_html__('Portfolio', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'portfolio_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-block'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'portfolio_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-block'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'portfolio_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'portfolio_bg_color',
            [
                'label'     => esc_html__('Background Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-block' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->add_control(
            'portfolio_overlay',
            [
                'label'     => esc_html__('Overlay Hover', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-block:hover .portfolio-caption' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_responsive_control(
            'portfolio_height',
            [
                'label'      => esc_html__('Box Height', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-block' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_portfolio_style',
            [
                'label' => esc_html__('Image', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'      => esc_html__('Image Height', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-image img' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_portfolio_style',
            [
                'label' => esc_html__('Content', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_content_head',
            [
                'label'     => esc_html__('Box Content', 'neotech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'vertical_content_position',
            [
                'label'        => esc_html__('Vertical Position', 'neotech'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'flex-start'    => [
                        'title' => esc_html__('Top', 'neotech'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'neotech'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'neotech'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-caption' => 'align-items: {{value}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_align',
            [
                'label'        => esc_html__('Content Align', 'neotech'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => esc_html__('Left', 'neotech'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'neotech'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'neotech'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'neotech'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-caption' => 'text-align: {{value}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_content_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-caption'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_content_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-caption'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_subtitle_head',
            [
                'label'     => esc_html__('Portfolio Subtitle', 'neotech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            'subtitle_align',
            [
                'label'        => esc_html__('Text Align', 'neotech'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => esc_html__('Left', 'neotech'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'neotech'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'neotech'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'neotech'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-subtitle' => 'text-align: {{value}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-subtitle'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'subtitle_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-subtitle'   => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'subtitle_color_hover',
            [
                'label'     => esc_html__('Text Color Hover', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-block:hover .portfolio-subtitle'   => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .portfolio-subtitle',
            ]
        );

        $this->add_control(
            'box_title_head',
            [
                'label'     => esc_html__('Portfolio Title', 'neotech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label'        => esc_html__('Text Align', 'neotech'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => esc_html__('Left', 'neotech'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'neotech'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'neotech'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'neotech'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-loop-title' => 'text-align: {{value}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-loop-title'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-loop-title a'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Text Color Hover', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-loop-title a:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .portfolio-loop-title, {{WRAPPER}} .portfolio-loop-title a',
            ]
        );

        $this->add_control(
            'box_excerpt_head',
            [
                'label'     => esc_html__('Portfolio Excerpt', 'neotech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'excerpt_align',
            [
                'label'        => esc_html__('Text Align', 'neotech'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => esc_html__('Left', 'neotech'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'neotech'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'neotech'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'neotech'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .portfolio-loop-excerpt' => 'text-align: {{value}}',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-loop-excerpt'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color_hover',
            [
                'label'     => esc_html__('Text Color Hover', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-loop-excerpt:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'excerpt_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .portfolio-loop-excerpt',
            ]
        );
        
        $this->end_controls_section();


        $this->get_controls_column();
        // Carousel Option
        $this->get_control_carousel();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->handle_setting($settings);
    }

    private function handle_setting($settings) {
        // echo '<pre>'; print_r($settings); echo '</pre>';
        $class = '';
        $atts  = [
            'limit'           => $settings['limit'],
            'columns'         => $settings['enable_carousel'] === 'yes' ? 1 : $settings['column'],
            'orderby'         => $settings['orderby'],
            'order'           => $settings['order'],
            'show_title'      => $settings['show_title'],
            'show_category'   => $settings['show_category'],
            'show_button'     => $settings['show_button'],
            'show_exerpt'     => $settings['show_exerpt'],
        ];

        $class         .= ' elementor-portfolio';
        $class         .= ' elementor-portfolio-style' . $settings['style'];

        if (isset($settings['style']) && $settings['style'] !== '') {
            $atts['style'] = $settings['style'];
        }

        // Carousel
        if ($settings['enable_carousel'] === 'yes') {
            $atts['enable_carousel']   = 'yes';
            $atts['carousel_settings'] = $this->get_swiper_navigation_for_portfolio();
            $class                     = ' neotech-swiper-wrapper swiper';
        }
        if ($settings['show_pagination'] === 'yes' && $settings['enable_carousel'] !== 'yes') {
            $atts['paginate'] = true;
        }
        $atts['class'] = $class;

        echo (new Neotech_Content_Portfolio($atts))->get_content(); // WPCS: XSS ok
    }

    protected function get_swiper_navigation_for_portfolio() {
        $settings = $this->get_settings_for_display();
        if ($settings['enable_carousel'] != 'yes') {
            return;
        }
        $settings_navigation = '';
        $show_dots           = (in_array($settings['navigation'], ['dots', 'both']));
        $show_arrows         = (in_array($settings['navigation'], ['arrows', 'both']));


        if ($show_dots) {
            $settings_navigation .= '<div class="swiper-pagination swiper-pagination-' . $this->get_id() . '"></div>';
        }
        if ($show_arrows && $settings['custom_navigation'] != 'yes') {
            $settings_navigation .= '<div class="elementor-swiper-button elementor-swiper-button-prev elementor-swiper-button-prev-' . $this->get_id() . '">';
            $settings_navigation .= $this->render_swiper_button('previous', true);
            $settings_navigation .= '<span class="elementor-screen-only">' . esc_html__('Previous', 'neotech') . '</span>';
            $settings_navigation .= '</div>';
            $settings_navigation .= '<div class="elementor-swiper-button elementor-swiper-button-next elementor-swiper-button-next-' . $this->get_id() . '">';
            $settings_navigation .= $this->render_swiper_button('next', true);
            $settings_navigation .= '<span class="elementor-screen-only">' . esc_html__('Next', 'neotech') . '</span>';
            $settings_navigation .= '</div>';
        }
        return $settings_navigation;
    }

    protected function get_portfolio_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'portfolio-cat',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }

        return $results;
    }
}

$widgets_manager->register(new Neotech_Elementor_Widget_Portfolio());

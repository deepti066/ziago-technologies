<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!post_type_exists('service')) {
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
use Neotech\Elementor\Neotech_Group_Control_Typography;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Neotech_Elementor_Widget_Service extends Neotech_Base_Widgets {


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
        return 'neotech-services';
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
        return esc_html__('Services', 'neotech');
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
            'neotech-elementor-service',
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
            'show_icon',
            [
                'label'   => esc_html__('Show Icon Service', 'neotech'),
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
                'label'   => esc_html__('Show Excerpt Service', 'neotech'),
                'default' => 'yes',
                'type'    => Controls_Manager::SWITCHER,
                // 'render_type'        => 'template',
                'selectors' => [
                ],
            ]
        );

        $this->add_control(
            'show_notice',
            [
                'label'   => esc_html__('Show Service Notice', 'neotech'),
                'default' => 'yes',
                'type'    => Controls_Manager::SWITCHER,
                // 'render_type'        => 'template',
                'selectors' => [
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => esc_html__('Show Pagination', 'neotech'),
                'type'  => Controls_Manager::SWITCHER,
                'condition'          => [
                    'enable_carousel!' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'show_button_service',
            [
                'label' => esc_html__('Show Button', 'neotech'),
                'type'  => Controls_Manager::SWITCHER,
                'prefix_class' => 'show-button-service-',
            ]
        );

        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'neotech'),
                'type'  => Controls_Manager::HEADING,
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
                    'id'         => esc_html__('Service ID', 'neotech'),
                    'menu_order' => esc_html__('Menu Order', 'neotech'),
                    'title'      => esc_html__('Service Title', 'neotech'),
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
                    '1'  => esc_html__('Style 1', 'neotech'),
                    '2'  => esc_html__('Style 2', 'neotech'),
                    '3'  => esc_html__('Style 3', 'neotech'),
                ],
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
                    'service_layout' => 'grid'
                ]
            ]
        );

        $this->end_controls_section();


        //Section Query
        $this->start_controls_section(
            'section_service_style',
            [
                'label' => esc_html__('Services', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'service_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-block'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .service-block .service-caption-hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'service_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-block'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'service_bg_color',
            [
                'label'     => esc_html__('Background Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-block' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'service_overlay',
            [
                'label'     => esc_html__('Overlay', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-block .service-image a::before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_responsive_control(
            'service_height',
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
                    '{{WRAPPER}} .service-block' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'service_height_image',
            [
                'label'      => esc_html__('Image Height', 'neotech'),
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
                    '{{WRAPPER}} .service-block .service-image' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'bottom_space',
            [
                'label' => esc_html__( 'Spacing Row', 'neotech' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' , '%', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--service-spacing-row: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'space_service_pagination',
            [
                'label' => esc_html__( 'Pagination', 'neotech' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-pagination'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_service_style',
            [
                'label' => esc_html__('Icon', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_width',
            [
                'label'     => esc_html__('Icon Size', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service_icon svg' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .service_icon svg g' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .service_icon svg path' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'icon_gradient_color',
            [
                'label' => esc_html__('Gradient color', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'color_icon_start',
            [
                'label'   => esc_html__('Color Start', 'neotech'),
                'type'    => Controls_Manager::COLOR,
                'default' => '',                
                'selectors'  => [
                    '{{WRAPPER}}' => '--e-global-color-linear-start: {{VALUE}}',
                ],
                'condition' => [
                    'icon_gradient_color' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'color_icon_end',
            [
                'label'   => esc_html__('Color End', 'neotech'),
                'type'    => Controls_Manager::COLOR,
                'default' => '',                
                'selectors'  => [
                    '{{WRAPPER}}' => '--e-global-color-linear-end: {{VALUE}}',
                ],
                'condition' => [
                    'icon_gradient_color' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs('color_tabs', [
            'condition' => [
                'icon_gradient_color!' => 'yes'
            ]
        ]);

        $this->start_controls_tab('colors_normal',
            [
                'label' => esc_html__('Normal', 'neotech'),
            ]
        );
        
        $this->add_control(
            'color_icon',
            [
                'label'   => esc_html__('Color Icon', 'neotech'),
                'type'    => Controls_Manager::COLOR,
                'default' => '',                
                'selectors'  => [
                    '{{WRAPPER}} .service_icon svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .service_icon svg g' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .service_icon svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'icon_gradient_color!' => 'yes'
                ]
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab('colors_hover',
            [
                'label' => esc_html__('Hover', 'neotech'),
            ]
        );
        
        $this->add_control(
            'color_icon_hover',
            [
                'label'   => esc_html__('Color Icon Hover', 'neotech'),
                'type'    => Controls_Manager::COLOR,
                'default' => '',                
                'selectors'  => [
                    '{{WRAPPER}} .service-block:hover .service_icon svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .service-block:hover .service_icon svg g' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .service-block:hover .service_icon svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'icon_gradient_color!' => 'yes'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_service_style',
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
                    '{{WRAPPER}} .service-block' => 'align-items: {{value}}',
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
                    '{{WRAPPER}} .service-block .service-caption'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'      => 'content_border',
                'selector'  => '{{WRAPPER}} .service-block .service-caption',
            ]
        );

        $this->add_control(
            'box_title_head',
            [
                'label'     => esc_html__('Service Title', 'neotech'),
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
                    '{{WRAPPER}} .service-loop-title' => 'text-align: {{value}}',
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
                    '{{WRAPPER}} .service-block .service-caption .service-loop-title'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-loop-title a'   => 'color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Text Color Hover', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-loop-title a:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .service-loop-title, {{WRAPPER}} .service-loop-title a',
            ]
        );

        $this->add_control(
            'box_excerpt_head',
            [
                'label'     => esc_html__('Service Excerpt', 'neotech'),
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
                    '{{WRAPPER}} .service-loop-excerpt' => 'text-align: {{value}}',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-loop-excerpt'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color_hover',
            [
                'label'     => esc_html__('Text Color Hover', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-loop-excerpt'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name'     => 'excerpt_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .service-loop-excerpt',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'      => 'excerpt_border',
                'selector'  => '{{WRAPPER}} .service-block .service-loop-excerpt',
            ]
        );

        $this->add_responsive_control(
            'excerpt_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-block .service-loop-excerpt'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'excerpt_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-block .service-loop-excerpt'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box_notice_head',
            [
                'label'     => esc_html__('Service Notice', 'neotech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'notice_align',
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
                    '{{WRAPPER}} .service-loop-notice' => 'text-align: {{value}}',
                ],
            ]
        );

        $this->add_control(
            'notice_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-loop-notice'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name'     => 'notice_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
                'selector' => '{{WRAPPER}} .service-loop-notice',
            ]
        );

        $this->add_responsive_control(
            'notice_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-block .service-caption .service-loop-notice'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
        $class = '';
        $atts  = [
            'limit'          => $settings['limit'],
            'columns'        => $settings['enable_carousel'] === 'yes' ? 1 : $settings['column'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
            'show_icon'      => $settings['show_icon'],
            'show_exerpt'    => $settings['show_exerpt'],
            'show_notice'    => $settings['show_notice']
        ];

        $class         .= ' elementor-service';
        $class         .= ' elementor-service-style' . $settings['style'];
        
        if (isset($settings['style']) && $settings['style'] !== '') {
            $atts['style'] = $settings['style'];
        }

        if (isset($settings['style_image_hover']) && $settings['style_image_hover'] !== '') {
            $atts['style_image_hover'] = $settings['style_image_hover'];
        }
        // Carousel
        if ($settings['enable_carousel'] === 'yes') {
            $atts['enable_carousel']   = 'yes';
            $atts['carousel_settings'] = $this->get_swiper_navigation_for_service();
            $class                     = ' neotech-swiper-wrapper swiper';
        }
        if ($settings['show_pagination'] === 'yes' && $settings['enable_carousel'] !== 'yes') {
            $atts['paginate'] = true;
        }
        $atts['class'] = $class;

        if (!empty($settings['icon_gradient_color']) && $settings['icon_gradient_color'] === 'yes') {
            $id_linear = 'service-gradient-'.$this->get_id();
            $id_linear_fill = '#'.$id_linear;
            ?>
            <svg height="0" width="0" style="position: absolute;z-index: -999;left: -1000px;">
                <defs>
                    <linearGradient id="<?php echo esc_attr($id_linear); ?>">
                        <stop offset="5%" stop-color="var(--e-global-color-linear-start)"></stop>
                        <stop offset="95%" stop-color="var(--e-global-color-linear-end)"></stop>
                    </linearGradient>
                </defs>
            </svg>
            <style>
                <?php echo esc_attr('.elementor-element-'.$this->get_id()); ?> .service_icon svg path {
                    fill: url(<?php echo esc_html($id_linear_fill) ?>);
                }
            </style>
            <?php
        }

        echo (new Neotech_Content_Service($atts))->get_content(); // WPCS: XSS ok
    }

    protected function get_swiper_navigation_for_service() {
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
}

$widgets_manager->register(new Neotech_Elementor_Widget_Service());

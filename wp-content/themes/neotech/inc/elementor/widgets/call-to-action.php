<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Neotech\Elementor\Neotech_Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Neotech_Call_To_Action extends Elementor\Widget_Base {

    public function get_name() {
        return 'neotech-banner';
    }

    public function get_title() {
        return esc_html__('Neotech Banner', 'neotech');
    }

    public function get_icon() {
        return 'eicon-image-rollover';
    }

    public function get_categories() {
        return ['neotech-addons'];
    }

    protected function register_controls( $args = [] ) {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'neotech'),
            ]
        );
        $default_args = [
            'section_condition' => [],
            'button_default_text' => esc_html__( 'Click here', 'neotech' ),
            'text_control_label' => esc_html__( 'Text', 'neotech' ),
            'alignment_control_prefix_class' => 'elementor%s-align-',
            'alignment_default' => '',
            'icon_exclude_inline_options' => [],
        ];
        $args = wp_parse_args( $args, $default_args );
        $this->add_control(
            'bg_image',
            [
                'label'   => esc_html__('Choose Background Image', 'neotech'),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'bg_image', // Actually its `image_size`
                'label'     => esc_html__('Image Resolution', 'neotech'),
                'default'   => 'large',
                'condition' => [
                    'bg_image[id]!' => '',
                ],
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'       => esc_html__('Sub title', 'neotech'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('This is the sub title', 'neotech'),
                'placeholder' => esc_html__('Enter your sub title', 'neotech'),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'sub_title_position',
            [
                'label'        => __('Position Sub Title', 'neotech'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'below',
                'options'      => [
                    'above' => __('Above', 'neotech'),
                    'below' => __('Below', 'neotech'),
                ],
                'prefix_class' => 'elementor-position-',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Heading 1', 'neotech'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('This is the heading 1', 'neotech'),
                'placeholder' => esc_html__('Enter your heading 1', 'neotech'),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'heading2',
            [
                'label'       => esc_html__('Heading 2', 'neotech'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('This is the heading 2', 'neotech'),
                'placeholder' => esc_html__('Enter your heading 2', 'neotech'),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'neotech'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'neotech'),
                'placeholder' => esc_html__('Enter your description', 'neotech'),
                'separator'   => 'none',
                'rows'        => 5,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__('Title HTML Tag', 'neotech'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                ],
                'default'   => 'h3',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'button',
            [
                'label'     => esc_html__('Button Text', 'neotech'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => esc_html__('Click Here', 'neotech'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'neotech' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin' => 'inline',
                'label_block' => false,
                'condition' => $args['section_condition'],
                'icon_exclude_inline_options' => $args['icon_exclude_inline_options'],
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label' => esc_html__( 'Icon Position', 'neotech' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__( 'Before', 'neotech' ),
                    'right' => esc_html__( 'After', 'neotech' ),
                ],
                'condition' => array_merge( $args['section_condition'], [ 'selected_icon[value]!' => '' ] ),
            ]
        );


        $this->add_responsive_control(
            'button_icon_spacing',
            [
                'label'     => esc_html__('Spacing', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button .button-icon.elementor-align-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-cta__button .button-icon.elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',

                ],
                'condition' => [
                    'button_icon[value]!' => '',
                    'show_button_link!'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => esc_html__('Link', 'neotech'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => [
                    'url' => '#',
                ],
                'placeholder' => esc_html__('https://your-link.com', 'neotech'),

            ]
        );

        $this->add_control(
            'link_click',
            [
                'label'     => esc_html__('Apply Link On', 'neotech'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'box'    => esc_html__('Whole Box', 'neotech'),
                    'button' => esc_html__('Button Only', 'neotech'),
                ],
                'default'   => 'button',
                'separator' => 'none',
                'condition' => [
                    'link[url]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_style',
            [
                'label' => esc_html__('Box', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content-stretch',
            [
                'label'        => esc_html__('Stretch', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'content-stretch-'
            ]
        );

        $this->add_responsive_control(
            'min-height',
            [
                'label'      => esc_html__('Height', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'vh'],
                'condition'  => [
                    'content-stretch' => ''
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__content' => 'min-height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .skeleton-item'          => 'min-height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .skeleton-item:before'   => 'padding-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-cta__content',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'Horizontal_align',
            [
                'label'     => esc_html__('Horizontal Align', 'neotech'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'neotech'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'neotech'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__('Right', 'neotech'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-neotech-banner.box-align-left .elementor-cta .elementor-cta__content' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_position',
            [
                'label'        => esc_html__('Vertical Position', 'neotech'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'top'    => [
                        'title' => esc_html__('Top', 'neotech'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__('Middle', 'neotech'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'neotech'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'elementor-cta--valign-',
                'separator'    => 'none',
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__bg-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'      => esc_html__('Width', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__content_inner' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'inner_padding',
            [
                'label'      => esc_html__('Padding Content', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__content_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'inner_background_color',
            [
                'label'     => esc_html__('Background Content', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__content_inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'        => esc_html__('Alignment', 'neotech'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => esc_html__('Left', 'neotech'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'neotech'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'neotech'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'neotech'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'      => '',
                'selectors'    => [
                    '{{WRAPPER}}.elementor-widget-neotech-banner.box-align-center .elementor-cta .elementor-cta__content' => 'text-align: {{VALUE}}',
                ],
                'prefix_class' => 'box-align-',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_inner_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-cta__content_inner',
            ]
        );


        $this->add_control(
            'heading_style_title',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Heading', 'neotech'),
                'separator' => 'before',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'title!'    => '',
                'name'      => 'title_typography',
                'selector'  => '{{WRAPPER}} .elementor-cta__title',
                'condition' => [
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',

                'selector'  => '{{WRAPPER}} .elementor-cta__title',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'enable-effect-heading',
            [
                'label'        => esc_html__('Enable Effect', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'enable-effect-heading-'
            ]
        );


        $this->add_responsive_control(
            'title_spacing',
            [
                'label'     => esc_html__('Spacing', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__title.elementor-content-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__title.elementor-content-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'  => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_style',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Heading 2', 'neotech'),
                'separator' => 'before',
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'heading2!' => '',
                'name'      => 'heading2_typography',
                'selector'  => '{{WRAPPER}} .elementor-cta__heading2',
                'condition' => [
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading2_text_shadow',

                'selector'  => '{{WRAPPER}} .elementor-cta__heading2',
                'condition' => [
                    'heading2!' => '',
                ],
            ]
        );

        $this->add_control(
            'enable-effect-heading2',
            [
                'label'        => esc_html__('Enable Effect', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'enable-effect-heading2-'
            ]
        );


        $this->add_responsive_control(
            'heading2_spacing',
            [
                'label'     => esc_html__('Spacing', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-content-item.elementor-cta__heading2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'heading2!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading2_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content-item.elementor-cta__heading2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'  => [
                    'heading2!' => '',
                ],
            ]
        );


        $this->add_control(
            'heading_style_subtitle',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Subtitle', 'neotech'),
                'separator' => 'before',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name'      => 'subtitle_typography',
                'selector'  => '{{WRAPPER}} .elementor-cta__subtitle',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'subtitle_text_shadow',
                'selector'  => '{{WRAPPER}} .elementor-cta__subtitle',
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_background_color',
            [
                'label'     => esc_html__('Background Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__subtitle div' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_border_radius',
            [
                'label'      => esc_html__('Border radius', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__subtitle div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'  => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__subtitle div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'  => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label'     => esc_html__('Spacing', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-content-item.elementor-cta__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading_style_description',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Description', 'neotech'),
                'separator' => 'before',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name'      => 'description_typography',
                'selector'  => '{{WRAPPER}} .elementor-cta__description',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_effects',
            [
                'label' => esc_html__('Effects', 'neotech'),
                'type'  => Controls_Manager::SWITCHER,

                'prefix_class' => 'description-effects-'
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content-item.elementor-cta__description'                               => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}}.description-effects-yes .elementor-content-item.elementor-cta__description'       => 'margin: 0',
                    '{{WRAPPER}}.description-effects-yes:hover .elementor-content-item.elementor-cta__description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'  => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-content-item.elementor-cta__description'                               => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}}.description-effects-yes .elementor-content-item.elementor-cta__description'       => 'padding: 0',
                    '{{WRAPPER}}.description-effects-yes:hover .elementor-content-item.elementor-cta__description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition'  => [
                    'description!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label'     => esc_html__('Spacing', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-content-item.elementor-cta__description'                               => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.description-effects-yes .elementor-content-item.elementor-cta__description'       => 'margin-bottom: 0',
                    '{{WRAPPER}}.description-effects-yes:hover .elementor-content-item.elementor-cta__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',

                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );


        $this->add_control(
            'heading_content_colors',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Colors', 'neotech'),
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('color_tabs');

        $this->start_controls_tab('colors_normal',
            [
                'label' => esc_html__('Normal', 'neotech'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Heading Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading2_color',
            [
                'label'     => esc_html__('Heading2 Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__heading2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'heading2!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => esc_html__('Sub title Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__subtitle'             => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-cta__subtitle span:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Description Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'colors_hover',
            [
                'label' => esc_html__('Hover', 'neotech'),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Heading Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'heading2_color_hover',
            [
                'label'     => esc_html__('Heading2 Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__heading2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'heading2!' => '',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color_hover',
            [
                'label'     => esc_html__('Sub title Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__subtitle'             => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__subtitle span:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'subtitle!' => '',
                ],
            ]
        );

        $this->add_control(
            'description_color_hover',
            [
                'label'     => esc_html__('Description Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label'     => esc_html__('Button', 'neotech'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_style_theme',
            [
                'label'        => esc_html__('Style', 'neotech'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'default' => 'Default',
                    'outline' => 'Outline',
                    'link'    => 'Link',
                ],
                'default'      => 'default',
                'prefix_class' => 'button-banner-style-neotech-',
            ]
        );


        $this->add_control(
            'button_position_bottom',
            [
                'label'        => esc_html__('Position Bottom', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
                'condition'    => [
                    'vertical_position' => 'top',
                ],
                'selectors'    => [
                    '{{WRAPPER}}.button-position-bottom-yes .elementor-cta__button-wrapper' => 'margin-top: auto',
                    '{{WRAPPER}}.button-position-bottom-yes .elementor-cta__content_inner'  => 'height: 100%; display: flex; flex-direction: column',
                ],
                'prefix_class' => 'button-position-bottom-',
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name'      => 'button_typography',
                'selector'  => '{{WRAPPER}} .elementor-cta__button',
                'condition' => [
                    'button!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_button_size',
            [
                'label'     => esc_html__('Icon Size', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

        $this->start_controls_tabs('button_tabs');

        $this->start_controls_tab('button_normal',
            [
                'label' => esc_html__('Normal', 'neotech'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.button-banner-style-neotech-link .elementor-button::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label'     => esc_html__('Background Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label'     => esc_html__('Border Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-button .elementor-button-icon i'                                        => 'fill: {{VALUE}}; color: {{VALUE}};',
                    '{{WRAPPER}}.show-button-link-yes .elementor-button .elementor-button-content-wrapper:after'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.show-button-link-yes .elementor-button .elementor-button-content-wrapper:before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button-hover',
            [
                'label' => esc_html__('Hover', 'neotech'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.button-banner-style-neotech-link .elementor-button:hover:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_box_text_color',
            [
                'label'     => esc_html__('Box Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta:hover .elementor-cta__button' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label'     => esc_html__('Background Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover .elementor-button-icon i'                                    => 'fill: {{VALUE}}; color: {{VALUE}};',
                    '{{WRAPPER}}.show-button-link-yes .elementor-button:hover .elementor-button-content-wrapper:after'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.show-button-link-yes .elementor-button:hover .elementor-button-content-wrapper:before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'button_border_width',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-cta__button',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'     => esc_html__('Border Radius', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-cta__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'button_effects',
            [
                'label' => esc_html__('Effects', 'neotech'),
                'type'  => Controls_Manager::SWITCHER,

                'prefix_class' => 'button-effects-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'hover_effects',
            [
                'label' => esc_html__('Hover Effects', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_hover_heading',
            [
                'type'  => Controls_Manager::HEADING,
                'label' => esc_html__('Background', 'neotech'),
            ]
        );

        $this->add_control(
            'transformation',
            [
                'label'        => esc_html__('Hover Animation', 'neotech'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    ''                  => 'None',
                    'zoom-in'           => 'Zoom In',
                    'zoom-out'          => 'Zoom Out',
                    'move-up-custom'    => 'Move Up',
                    'move-down-custom'  => 'Move Down',
                    'move-left-custom'  => 'Move Left',
                    'move-right-custom' => 'Move Right',
                ],
                'default'      => 'zoom-in',
                'prefix_class' => 'elementor-bg-transform elementor-bg-transform-',
            ]
        );

        $this->start_controls_tabs('bg_effects_tabs');

        $this->start_controls_tab('normal',
            [
                'label' => esc_html__('Normal', 'neotech'),
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'overlay_color',
                'types'          => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'frontend_available' => true,
                    ],
                ],
                'selector'       => '{{WRAPPER}}.elementor-widget-neotech-banner:not(:hover) .elementor-cta__bg-overlay',

            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'bg_filters',
                'selector' => '{{WRAPPER}} .elementor-cta__bg',
            ]
        );

        $this->add_control(
            'overlay_blend_mode',
            [
                'label'     => esc_html__('Blend Mode', 'neotech'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''            => esc_html__('Normal', 'neotech'),
                    'multiply'    => 'Multiply',
                    'screen'      => 'Screen',
                    'overlay'     => 'Overlay',
                    'darken'      => 'Darken',
                    'lighten'     => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'color-burn'  => 'Color Burn',
                    'hue'         => 'Hue',
                    'saturation'  => 'Saturation',
                    'color'       => 'Color',
                    'exclusion'   => 'Exclusion',
                    'luminosity'  => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-cta__bg-overlay' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('hover',
            [
                'label' => esc_html__('Hover', 'neotech'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'overlay_color_hover',
                'types'          => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'frontend_available' => true,
                    ],
                ],
                'selector'       => '{{WRAPPER}}:hover .elementor-cta__bg-overlay',

            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'bg_filters_hover',
                'selector' => '{{WRAPPER}}.elementor-widget-neotech-banner:hover .elementor-cta__bg',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_control(
            'effect_duration',
            [
                'label'       => esc_html__('Transition Duration', 'neotech'),
                'type'        => Controls_Manager::SLIDER,
                'render_type' => 'template',
                'default'     => [
                    'size' => 300,
                ],
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                    ],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .elementor-cta .elementor-cta__bg, {{WRAPPER}} .elementor-cta .elementor-cta__bg-overlay' => 'transition-duration: {{SIZE}}ms',
                ],
                'separator'   => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(Widget_Base $instance = null) {
        if ( empty( $instance ) ) {
            $instance = $this;
        }

        $settings = $instance->get_settings_for_display();

        $title_tag       = $settings['title_tag'];
        $wrapper_tag     = 'div';
        $button_tag      = 'a';
        $bg_image        = '';
        $animation_class = '';
        $print_bg        = true;

        $has_icon = !empty($settings['button_icon']);
        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
        if ( ! $is_new && empty( $settings['icon_align'] ) ) {
            // @todo: remove when deprecated
            // added as bc in 2.6
            //old default
            $settings['icon_align'] = $instance->get_settings( 'icon_align' );
        }
        $instance->add_render_attribute( [
            'icon-align' => [
                'class' => [
                    'elementor-button-icon',
                    'elementor-align-icon-' . $settings['icon_align'],
                ],
            ],
        ] );


        if (!empty($settings['bg_image']['id'])) {
            $bg_image = Group_Control_Image_Size::get_attachment_image_src($settings['bg_image']['id'], 'bg_image', $settings);
        } elseif (!empty($settings['bg_image']['url'])) {
            $bg_image = $settings['bg_image']['url'];
        }

        if (empty($bg_image)) {
            $print_bg = false;
        }

        $this->add_render_attribute('background_image', 'style', [
            'background-image: url(' . $bg_image . ');',
        ]);

        $this->add_render_attribute('title', 'class', [
            'elementor-cta__title',
            'elementor-cta__content-item',
            'elementor-content-item',
        ]);

        $this->add_render_attribute('heading2', 'class', [
            'elementor-cta__heading2',
            'elementor-cta__content-item',
            'elementor-content-item',
        ]);

        $this->add_render_attribute('subtitle', 'class', [
            'elementor-cta__subtitle',
            'elementor-cta__content-item',
            'elementor-content-item',
        ]);

        $this->add_render_attribute('description', 'class', [
            'elementor-cta__description',
            'elementor-cta__content-item',
            'elementor-content-item',
        ]);

        $this->add_render_attribute('button', 'class', [
            'elementor-cta__button',
            'elementor-button',
        ]);

        $this->add_render_attribute('wrapper', 'class', [
            'elementor-cta--skin-cover ',
            'elementor-cta',
            'elementor-neotech-banner',
        ]);



        if (!empty($settings['link']['url'])) {
            $link_element = 'button';

            if ('box' === $settings['link_click']) {
                $wrapper_tag  = 'a';
                $button_tag   = 'span';
                $link_element = 'wrapper';
            }

            $this->add_link_attributes($link_element, $settings['link']);
        }

        $this->add_inline_editing_attributes('wrapper');
        $this->add_inline_editing_attributes('title');
        $this->add_inline_editing_attributes('heading2');
        $this->add_inline_editing_attributes('description');
        $this->add_inline_editing_attributes('button');


        ?>
        <<?php echo esc_html($wrapper_tag) . ' ' . $this->get_render_attribute_string('wrapper'); ?>>
        <?php if ($print_bg) : ?>
            <div class="elementor-cta__bg-wrapper">
                <div class="elementor-cta__bg-overlay"></div>
                <div class="elementor-cta__bg elementor-bg" <?php $this->print_render_attribute_string('background_image'); ?>></div>
            </div>
        <?php endif; ?>
        <div class="elementor-cta__content">
        <div class="elementor-cta__content_inner">
        <?php if (!empty($settings['subtitle'])) : ?>
            <div <?php $this->print_render_attribute_string('subtitle'); ?>>
                <div><?php printf('%s', $settings['subtitle']); ?></div>
            </div>
        <?php endif; ?>

        <?php if (!empty($settings['title'])) : ?>
        <<?php echo esc_html($title_tag) . ' ' . $this->get_render_attribute_string('title'); ?>>
        <?php printf('%s', $settings['title']); ?>
        </<?php echo esc_html($title_tag); ?>>
    <?php endif; ?>

        <?php if (!empty($settings['heading2'])) : ?>
            <<?php echo esc_html($title_tag) . ' ' . $this->get_render_attribute_string('heading2'); ?>>
            <?php printf('%s', $settings['heading2']); ?>
            </<?php echo esc_html($title_tag); ?>>
        <?php endif; ?>

        <?php if (!empty($settings['description'])) : ?>
            <div <?php $this->print_render_attribute_string('description'); ?>>
                <?php printf('%s', $settings['description']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($settings['button'])) : ?>
        <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item <?php echo esc_attr($animation_class); ?>">
            <<?php echo esc_html($button_tag) . ' ' . $this->get_render_attribute_string('button'); ?>>
                <span class="elementor-button-content-wrapper">
                    <?php
                    if ($settings['icon_align'] == 'right') {
                        ?>
                        <span class="elementor-button-text"><?php echo sprintf('%s', $settings['button']); ?></span>
                        <?php
                    }
                    if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) :
                        ?>
                        <span <?php $instance->print_render_attribute_string( 'icon-align' ); ?>>
                            <?php if ( $is_new || $migrated ) :
                                Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                            else : ?>
                                <i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
                            <?php endif; ?>
                        </span>
                    <?php
                    endif;
                    if ($settings['icon_align'] == 'left') {
                        ?>
                        <span class="elementor-button-text"><?php echo sprintf('%s', $settings['button']); ?></span>
                        <?php
                    }
                    ?>
                </span>
            </<?php echo esc_html($button_tag); ?>>
            </div>
        <?php endif; ?>
        </div>
        </div>
        </<?php echo esc_html($wrapper_tag); ?>>
        <?php
    }
}

$widgets_manager->register(new Neotech_Call_To_Action());

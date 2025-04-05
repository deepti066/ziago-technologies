<?php
//Accordion
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

add_action( 'elementor/element/accordion/section_title_style/before_section_end', function ($element, $args ) {

    $element->remove_control( 'border_width', [
        'type' => Controls_Manager::HIDDEN,
    ] );
    $element->remove_control( 'border_color', [
        'type' => Controls_Manager::HIDDEN,
    ] );

    $element->add_control(
        'item_margin',
        [
            'label' => esc_html__( 'Margin', 'neotech' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_control(
        'style_theme',
        [
            'label' => esc_html__('Layout', 'neotech'),
            'type' => Controls_Manager::SELECT,
            'default' => 'neotech-1',
            'options' => [
                'layout-1' => esc_html__('Layout 1', 'neotech'),
                'layout-2' => esc_html__('Layout 2', 'neotech'),
                'layout-3' => esc_html__('Layout 3', 'neotech'),
            ],
            'prefix_class' => 'neotech-accordion-',
        ]
    );

},10,2);

add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', function ( $element, $args ) {

    $element->update_control( 'title_color', [
        'global' => [
            'default' => '',
        ],
    ] );

    $element->update_control( 'tab_active_color', [
        'global' => [
            'default' => '',
        ],
    ] );
//
    $element->update_control( 'title_typography', [
        'global' => [
            'default' => '',
        ],
    ] );

    $element->add_responsive_control(
        'title_margin',
        [
            'label' => esc_html__( 'Margin', 'neotech' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_control(
        'title_background_active',
        [
            'label' => esc_html__( 'Background Active', 'neotech' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
            ],
        ]
    );

},10,2);

add_action( 'elementor/element/accordion/section_toggle_style_content/before_section_end', function ( $element, $args ) {
    $element->add_responsive_control(
        'content_margin',
        [
            'label' => esc_html__( 'Margin', 'neotech' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
},10,2);

add_action( 'elementor/element/accordion/section_toggle_style_icon/before_section_end', function ( $element, $args ) {
    $element->add_responsive_control(
        'icon_size',
        [
            'label' => esc_html__('Icon Size', 'neotech'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'selected_icon[value]!' => '',
            ],
        ]
    );
},10,2);

add_action('elementor/element/nested-accordion/section_accordion_style/before_section_end', function ($element, $args) {

    $element->update_control(
        'accordion_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'neotech' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
            'selectors' => [
                '{{WRAPPER}} .e-n-accordion-item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .e-n-accordion-item-title ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow',
            'separator' => 'before',
            'selector' => '{{WRAPPER}} .e-n-accordion-item',
        ]
    );
}, 10, 2);
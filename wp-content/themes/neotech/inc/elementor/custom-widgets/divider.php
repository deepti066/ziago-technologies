<?php
//Accordion
use Elementor\Controls_Manager;

add_action('elementor/element/divider/section_divider_style/after_section_start', function ($element, $args) {

    $element->add_control(
        'gradient_color',
        [
            'label'        => esc_html__('Gradient Color', 'neotech'),
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'divider-gradient-color-'
        ]
    );

}, 10, 2);

add_action('elementor/element/divider/section_divider_style/before_section_end', function ($element, $args) {

    $element->update_control(
        'color',
        [
            'condition' => [
                'gradient_color!' => 'yes'
            ]
        ]
    );

}, 10, 2);
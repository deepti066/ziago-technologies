<?php
// Text editor
use Elementor\Controls_Manager;

add_action('elementor/element/text-editor/section_style/before_section_end', function ($element, $args) {
    /** @var \Elementor\Element_Base $element */
    $element->add_control(
        'text_color_link',
        [
            'label'     => esc_html__('Text Color Link', 'neotech'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} a:not(:hover)' => 'color: {{VALUE}};',
            ],
        ]
    );

    $element->add_control(
        'text_linear_gradient',
        [
            'label'        => esc_html__('Text linear gradient', 'neotech'),
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'text-linear-gradient-',
        ]
    );

}, 10, 2);

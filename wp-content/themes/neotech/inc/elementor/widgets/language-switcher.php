<?php

use Elementor\Controls_Manager;
use Neotech\Elementor\Neotech_Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Neotech_Elementor_Language_Switcher extends Elementor\Widget_Base
{

    public function get_categories()
    {
        return array('neotech-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'neotech-language-switcher';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('Language Switcher', 'neotech');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-global-settings';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'section_language_switcher',
            [
                'label' => esc_html__('Layout', 'neotech'),
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .neotech-language-switcher span.title',
            ]
        );

        $this->start_controls_tabs('style_color');

        $this->start_controls_tab('typo_normal',
            [
                'label' => esc_html__('Normal', 'neotech'),
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__('Label Color', 'neotech'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item .sub-item span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'neotech'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item > div span.title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'neotech'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .neotech-language-switcher .item > div i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('typo_hover',
            [
                'label' => esc_html__('Hover', 'neotech'),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Title Color', 'neotech'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item > div:hover span.title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .item > div:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'hover_right',
            [
                'label' => esc_html__('Hover Right', 'neotech'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'language-switcher-style-hover-right-',
            ]
        );

        $this->end_controls_section();


    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        neotech_language_switcher();
    }
}

$widgets_manager->register(new Neotech_Elementor_Language_Switcher());


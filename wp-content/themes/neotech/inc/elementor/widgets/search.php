<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Neotech_Elementor_Search extends Elementor\Widget_Base {
    public function get_name() {
        return 'neotech-search';
    }

    public function get_title() {
        return esc_html__('Neotech Search Form', 'neotech');
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return array('neotech-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'search-form-style',
            [
                'label' => esc_html__('Style', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__('Layout Style', 'neotech'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'neotech'),
                    'layout-2' => esc_html__('Layout 2', 'neotech'),
                    'layout-3' => esc_html__('Layout 3', 'neotech'),
                ],
                'default' => 'layout-1',
            ]
        );


        $this->add_responsive_control(
            'border_width',
            [
                'label'      => esc_html__('Border width', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} form input[type=search]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color_focus',
            [
                'label'     => esc_html__('Border Color Focus', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .button-search-popup .content' => 'color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
                    'text_color_hover',
                    [
                        'label'     => esc_html__('Text Hover', 'neotech'),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' => [
                            '{{WRAPPER}} .button-search-popup:hover .content' => 'color: {{VALUE}};',
                        ],
                    ]
                );

        $this->add_control(
            'text_color_placeholder',
            [
                'label'     => esc_html__('Text Color Placeholder', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_form',
            [
                'label'     => esc_html__('Background Form', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'background: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
              'icon_color_form',
              [
                    'label'     => esc_html__('Color Icon', 'neotech'),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}}.elementor-widget-neotech-search .widget form button[type=submit]:before' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .button-search-popup i' => 'color: {{VALUE}};',
                    ],
              ]
         );

          $this->add_control(
                 'icon_color_form_hover',
                 [
                     'label'     => esc_html__('Icon Hover', 'neotech'),
                     'type'      => Controls_Manager::COLOR,
                     'default'   => '',
                     'selectors' => [
                     '{{WRAPPER}}.elementor-widget-neotech-search .widget form button[type=submit]:hover:before' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .button-search-popup:hover i' => 'color: {{VALUE}};',
                     ],
                 ]
          );

        $this->add_control(
            'border_radius_input',
            [
                'label'      => esc_html__('Border Radius Input', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form input[type=search]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_input',
            [
                'label'      => esc_html__('Padding Input', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form input[type=search]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width_button',
            [
                'label'      => esc_html__('Width Button', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 40,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}.elementor-widget-neotech-search .widget form button[type=submit]' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['layout_style'] === 'layout-1'):
            if(neotech_is_woocommerce_activated()){
                neotech_product_search();
            }else{
                ?>
                <div class="site-search widget_search">
                    <?php get_search_form(); ?>
                </div>
                <?php
            }
        endif;

        if ($settings['layout_style'] === 'layout-2'):
            wp_enqueue_script('neotech-search-popup');
            add_action('wp_footer', 'neotech_header_search_popup', 1);
            ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup layout-2">
                    <i class="neotech-icon-search"></i>
                    <span class="content"><?php echo esc_html__('Search', 'neotech'); ?></span>
                </a>
            </div>
            <?php
        endif;

         if ($settings['layout_style'] === 'layout-3'):
            wp_enqueue_script('neotech-search-popup');
            add_action('wp_footer', 'neotech_header_search_popup', 1);
            ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup layout-3">
                    <i class="neotech-icon-search-o"></i>
                     <span class="content"><?php echo esc_html__('Search', 'neotech'); ?></span>
                </a>
            </div>
            <?php
        endif;
    }
}

$widgets_manager->register(new Neotech_Elementor_Search());

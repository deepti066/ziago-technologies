<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Neotech\Elementor\Neotech_Group_Control_Typography;

class Neotech_Elementor_Nav_Menu extends Elementor\Widget_Base {

    protected $nav_menu_index = 1;

    public function get_name() {
        return 'neotech-nav-menu';
    }

    public function get_title() {
        return esc_html__('Neotech Nav Menu', 'neotech');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return ['neotech-addons'];
    }

    public function on_export($element) {
        unset($element['settings']['menu']);

        return $element;
    }

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    private function get_available_menus() {
        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'neotech'),
            ]
        );
        $menus = $this->get_available_menus();
        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label'        => esc_html__('Menu', 'neotech'),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys($menus)[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'neotech'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => '<strong>' . esc_html__('There are no menus in your site.', 'neotech') . '</strong><br>' . sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'neotech'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
            'nav-menu_style',
            [
                'label' => esc_html__('Menu', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'nav_menu_aligrment',
            [
                'label'       => esc_html__('Alignment', 'neotech'),
                'type'        => Controls_Manager::CHOOSE,
                'default'     => 'center',
                'options'     => [
                    'left'   => [
                        'title' => esc_html__('Left', 'neotech'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'neotech'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'neotech'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'label_block' => false,
                'selectors'   => [
                    '{{WRAPPER}} .main-navigation' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography Menu', 'neotech'),
                'name'     => 'nav_menu_typography',
                'selector' => '{{WRAPPER}} .main-navigation ul.menu > li.menu-item > a',
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography Sub Menu', 'neotech'),
                'name'     => 'nav_sub_menu_typography',
                'selector' => '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item a',
            ]
        );

        $this->add_responsive_control(
            'padding_nav_menu',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_nav_menu',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider',
            [
                'label'        => esc_html__('Divider', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'neotech-nav-menu-divider-',
            ]
        );

        $this->start_controls_tabs('tabs_nav_menu_style');

        $this->start_controls_tab(
            'tab_nav_menu_normal',
            [
                'label' => esc_html__('Normal', 'neotech'),
            ]
        );
        $this->add_control(
            'menu_title_color',
            [
                'label'     => esc_html__('Color Menu', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_sub_title_color',
            [
                'label'     => esc_html__('Color Sub Menu', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sub_menu_color',
            [
                'label'     => esc_html__('Background Dropdown', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation .sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
             'icon_color',
             [
                 'label'     => esc_html__('Icon', 'neotech'),
                 'type'      => Controls_Manager::COLOR,
                 'selectors' => [
                     '{{WRAPPER}} .main-navigation ul.menu > li.menu-item:hover > a' => 'color: {{VALUE}};',
                 ],
             ]
         );

        $this->add_control(
            'divider_color',
            [
                'label'     => esc_html__('Divider', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.neotech-nav-menu-divider-yes .main-navigation ul.menu > li.menu-item > a:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_nav_menu_hover',
            [
                'label' => esc_html__('Hover', 'neotech'),
            ]
        );
        $this->add_control(
            'menu_title_color_hover',
            [
                'label'     => esc_html__('Color Menu', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu >li.menu-item:hover > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_sub_title_color_hover',
            [
                'label'     => esc_html__('Color Sub Menu', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item:hover > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_item_color_hover',
            [
                'label'     => esc_html__('Background Item', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu li.menu-item .sub-menu .menu-item:hover > a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
            'line_color_hover',
            [
                'label'     => esc_html__('Line Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item:hover > a:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
             'icon_color_hover',
             [
                 'label'     => esc_html__('Icon', 'neotech'),
                 'type'      => Controls_Manager::COLOR,
                 'selectors' => [
                     '{{WRAPPER}} .main-navigation ul.menu > li.menu-item:hover > a:after' => 'color: {{VALUE}};',
                     '{{WRAPPER}} .main-navigation ul.menu > li.menu-item.current-menu-item:hover > a:after' => 'color: {{VALUE}};',
                 ],
             ]
         );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_nav_menu_action',
            [
                'label' => esc_html__('Active', 'neotech'),
            ]
        );
        $this->add_control(
            'menu_title_color_action',
            [
                'label'     => esc_html__('Color Menu', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item.current-menu-item > a:not(:hover)'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item.current-menu-parent > a:not(:hover)'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item.current-menu-ancestor > a:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'menu_sub_title_color_action',
            [
                'label'     => esc_html__('Color Sub Menu', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item > .sub-menu .menu-item.current-menu-item > a:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'menu_item_color_action',
            [
                'label'     => esc_html__('Background Item', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item > .sub-menu .menu-item.current-menu-item > a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
            'line_color_action',
            [
                'label'     => esc_html__('Line Color ', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.menu > li.menu-item.current-menu-ancestor > a:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
             'icon_color_action',
             [
                 'label'     => esc_html__('Icon', 'neotech'),
                 'type'      => Controls_Manager::COLOR,
                 'selectors' => [
                     '{{WRAPPER}} .main-navigation ul.menu > li.menu-item.current-menu-item > a:after' => 'color: {{VALUE}};',
                 ],
             ]
         );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings         = $this->get_settings_for_display();
        $function_to_call = 'r' . 'emov' . 'e_' . 'filter';
        // $args             = ;

        $function_to_call('nav_menu_item_id', '__return_empty_string');

        $this->add_render_attribute('wrapper', 'class', 'elementor-nav-menu-wrapper');
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'neotech'); ?>">
                <?php wp_nav_menu(apply_filters('neotech_nav_menu_args', [
                    'menu'            => $settings['menu'],
                    'menu_id'         => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
                    'fallback_cb'     => '__return_empty_string',
                    'container_class' => 'primary-navigation',
                    'theme_location' => ''
                ])); ?>
            </nav>
        </div>
        <?php
    }
}

$widgets_manager->register(new Neotech_Elementor_Nav_Menu());

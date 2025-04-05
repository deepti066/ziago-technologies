<?php

//namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Background;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

class neotech_Elementor_Process_2 extends Elementor\Widget_Base {

    public function get_name() {
        return 'neotech-process-2';
    }

    public function get_title() {
        return __('Neotech Process 2', 'neotech');
    }

    public function get_categories() {
        return array('neotech-addons');
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_script_depends() {
        return [
            'neotech-elementor-process-2'
        ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => __('General', 'neotech'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => __('Title & Content', 'neotech'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Process Title', 'neotech'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'content',

            [
                'label'      => __('Content', 'neotech'),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __('Process Content', 'neotech'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => __('Link', 'neotech'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'neotech'),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'activate',
            [
                'label'     => __('Activate', 'neotech'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'neotech'),
                'label_on'  => __('On', 'neotech'),
            ]
        );


        $this->add_control(
            'process_list',
            [
                'label'       => __('Process Items', 'neotech'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'   => __('Process #1', 'neotech'),
                        'content' => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'neotech'),
                        'bottom'  => '',
                        'link'    => '#'
                    ],
                    [
                        'title'   => __('Process #2', 'neotech'),
                        'content' => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'neotech'),
                        'bottom'  => '',
                        'link'    => '#'
                    ],
                    [
                        'title'   => __('Process #3', 'neotech'),
                        'content' => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'neotech'),
                        'bottom'  => '',
                        'link'    => '#'
                    ],
                ],
                'title_field' => '{{{ title }}}',

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item_style',
            [
                'label' => __('Item', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]

        );

        $this->add_responsive_control(
            'content_align_mobile',
            [
                'label'     => __('Alignment Mobile', 'neotech'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'neotech'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'neotech'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'neotech'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .process-content ' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
        'padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .process-content ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

         $this->add_responsive_control(
            'content_radius',
            [
                'label'      => esc_html__('Border Radius', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .process-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'item_background',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .process-content ',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_shadow',
                'selector' => '{{WRAPPER}} .process-content',
            ]
        );

        $this->add_responsive_control(
            'item_spacing_item',
            [
                'label'      => __('Spacing', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => '--neotech-process-item-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

         $this->add_responsive_control(
            'min_height',
            [
                'label'      => __('Height', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 200,
                        'max' => 800,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                   '{{WRAPPER}} .process-content' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_width',
            [
                'label'      => __('Content Width', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => '--neotech-process-content-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'     => __('Title', 'neotech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .process-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .process-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'title_color_hover',
            [
                'label'     => __('Title Color Hover', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .process-title:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .process-title:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .process-title',
            ]
        );
        $this->add_responsive_control(
            'title_spacing_item',
            [
                'label'      => __('Spacing', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .process-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'content_heading',
            [
                'label'     => __('Content', 'neotech'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .content',
            ]
        );

        $this->add_responsive_control(
            'content_spacing_item',
            [
                'label'      => __('Spacing', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tracking_style',
            [
                'label' => __('Tracking Line', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tracking_width',
            [
                'label'      => __('Width', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}' => '--neotech-process-tracking-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tracking_max_height',
            [
                'label'      => __('Height', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['%', 'px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}}' => '--neotech-process-tracking-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tracking_color',
            [
                'label'     => __('Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .process__track' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tracking_position',
            [
                'label'      => __('Position X', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['%', 'px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}}' => '--neotech-process-track-line-x: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'tracking_position_y',
            [
                'label'      => __('Position Y', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['%', 'px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}}' => '--neotech-process-track-line-y: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $count_process = 0;
        if (is_array($settings['process_list'])) {
            $count_process = count($settings['process_list']);
        }

        $this->add_render_attribute('process-wrapper', 'class', 'neotech-process-2-wrapper');
        $this->add_render_attribute('process-wrapper', 'data-process-count', $count_process);

        if ($count_process > 0) {
            ?>

            <div <?php $this->print_render_attribute_string('process-wrapper'); ?>>
                <div class="neotech-process-2" <?php $this->print_render_attribute_string('neotech-process-2'); ?>>
                    <?php
                    foreach ($settings['process_list'] as $index => $item) :
                        //content
                        $content = 'content_' . $index;
                        $this->add_render_attribute($content, 'class', 'process-content process-item-part');

                        $class_item = $index;
                        $link_key = 'link_' . $index;
                        if ($item['activate']) {
                            $class_item .= ' process-item-activate';
                        }
                        if (!empty($item['link']['url'])) {
                            $this->add_render_attribute($link_key, 'href', $item['link']['url']);
                            if ($item['link']['is_external']) {
                                $this->add_render_attribute($link_key, 'target', '_blank');
                            }

                            if ($item['link']['nofollow']) {
                                $this->add_render_attribute($link_key, 'rel', 'nofollow');
                            }
                        }

                        $wrapper = 'wapper-'.$index;
                        $this->add_render_attribute($wrapper, 'class', 'process-item');
                        $this->add_render_attribute($wrapper, 'class', 'process-item-' . esc_attr($class_item));
                        if (($index + 1) == $count_process) {
                            $this->add_render_attribute($wrapper, 'class', 'process-last-item');
                        }
                        ?>
                        <div <?php $this->print_render_attribute_string($wrapper); ?>>
                            <span class="neotech-index-process"><span class="number-index"><?php echo esc_html($index + 1) ?></span></span>
                            <div <?php $this->print_render_attribute_string($content); ?>>
                                <div class="process-content-wap">
                                    <div class="process-inner-content-wap">
                                        <?php if (!empty($item['title'])) : ?>
                                            <h4 class="process-title">
                                                <a <?php $this->print_render_attribute_string($link_key); ?>>
                                                    <?php echo esc_html($item['title']); ?>
                                                </a>
                                            </h4>
                                        <?php endif; ?>
        
                                        <?php if (!empty($item['content'])) : ?>
                                            <div class="content">
                                                <?php printf('%s', $this->parse_text_editor($item['content'])); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="process__track"></div>
            </div>

            <?php
        }
    }
}

$widgets_manager->register(new neotech_Elementor_Process_2());
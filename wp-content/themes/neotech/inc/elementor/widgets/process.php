 <?php

//namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Background;
use Elementor\Controls_Manager;
 use Elementor\Group_Control_Border;
 use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
 use Elementor\Group_Control_Text_Stroke;
 use Elementor\Group_Control_Typography;
use Neotech\Elementor\Neotech_Base_Widgets;

class Neotech_Elementor_Process extends Neotech_Base_Widgets {

    public function get_name() {
        return 'neotech-process';
    }

    public function get_title() {
        return __('Neotech Process', 'neotech');
    }

    public function get_categories() {
        return array('neotech-addons');
    }

    public function get_icon() {
        return 'eicon-editor-list-ol';
    }

    public function get_script_depends() {
        return [
            'neotech-elementor-process'
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
                'label'       => __('Title', 'neotech'),
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
            'image_link_source',
            [
                'label'      => esc_html__('Choose Image', 'neotech'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
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

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image',
                'default'   => 'full',
                'separator' => 'none',
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
                        'link'    => '#'
                    ],
                    [
                        'title'   => __('Process #2', 'neotech'),
                        'content' => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'neotech'),
                        'link'    => '#'
                    ],
                    [
                        'title'   => __('Process #3', 'neotech'),
                        'content' => __('If you remember the very first time you have met with the person you love or your friend, it would be nice to let the person know that you still remember that very moment.', 'neotech'),
                        'link'    => '#'
                    ],
                ],
                'title_field' => '{{{ title }}}',

            ]
        );

        $this->add_control(
            'icon_run',
            [
                'label'        => esc_html__('Icon', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'icon-run-'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __('Wrapper', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-neotech-process-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
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
            'item_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-process-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'number_vertical_value',
            [
                'label'      => esc_html__('Spacing Y', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-neotech-process-wrapper .neotech-index-process'   => 'top: {{SIZE}}{{UNIT}} !important;',
                ]
            ]
        );

        $this->add_responsive_control(
            'indexpad_vertical_value_x',
            [
                'label'      => esc_html__('Spacing X', 'neotech'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .elementor-neotech-process-wrapper .neotech-index-process'   => 'right: {{SIZE}}{{UNIT}} !important;',
                    '.rtl {{WRAPPER}} .elementor-neotech-process-wrapper .neotech-index-process'   => 'left: {{SIZE}}{{UNIT}} !important;',
                ]
            ]
        );

        $this->start_controls_tabs( 'color_tabs' );

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'process_alignment',
            [
                'label'       => esc_html__('Alignment Content', 'neotech'),
                'type'        => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .process-content-wap'  => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .process-inner-content-wap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .process-inner-content-wap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
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
                    '{{WRAPPER}} .process-title a:hover' => 'color: {{VALUE}};',
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

        $this->get_controls_column();
        // Carousel options
        $this->get_control_carousel(false, true);

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $count_process = 0;
        if (is_array($settings['process_list'])) {
            $count_process = count($settings['process_list']);
        }

        if ($count_process > 0) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-neotech-process-wrapper');
            $this->add_render_attribute('item', 'class', 'elementor-process-item');
            $this->get_data_elementor_columns();

            $image_list = [];
            ?>
            <div <?php $this->print_render_attribute_string('wrapper'); ?>>
                <div <?php $this->print_render_attribute_string('container'); ?>>
                    <div <?php $this->print_render_attribute_string('inner'); ?>>
                        <?php foreach ($settings['process_list'] as $index => $item) : 
                            $link_key = 'link_' . $index;
                            if (!empty($item['link']['url'])) {
                                $this->add_render_attribute($link_key, 'href', $item['link']['url']);
                                if ($item['link']['is_external']) {
                                    $this->add_render_attribute($link_key, 'target', '_blank');
                                }
    
                                if ($item['link']['nofollow']) {
                                    $this->add_render_attribute($link_key, 'rel', 'nofollow');
                                }
                            }

                            $pad_index = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                            $str_index = sprintf(__('%s step', 'neotech'), $pad_index);

                            $image_url = Group_Control_Image_Size::get_attachment_image_src($item['image_link_source']['id'], 'image', $settings);
                            if (!$image_url) {
                                $image_url = Elementor\Utils::get_placeholder_image_src();
                            }
                            $image_list[] = $image_url;

                            $item_key = 'process_'.$index;
                            
                            $this->add_render_attribute($item_key, 'class', 'neotech-inner-process');
                            $this->add_render_attribute($item_key, 'data-index', $index);
                            if ($index == 0) {
                                $this->add_render_attribute($item_key, 'class', 'activate');
                            }

                            ?>
                            <div <?php $this->print_render_attribute_string('item'); ?>>
                                <div <?php $this->print_render_attribute_string($item_key); ?>>
                                    <div class="neotech-top-process">
                                        <div class="neotech-process-image">
                                            <img class="image img-neotech-process" src="<?php echo esc_url($image_url); ?>" alt="image">
                                            <span class="neotech-index-process"><span class="number-index"><?php echo esc_html($pad_index) ?></span></span>
                                        </div>
                                    </div>
                                    <div class="process-content-wap">
                                        <?php if (!empty($item['title'])) : ?>
                                            <h3 class="process-title">
                                                <a <?php $this->print_render_attribute_string($link_key); ?>>
                                                    <?php echo esc_html($item['title']); ?>
                                                </a>
                                            </h3>
                                        <?php endif; ?>
                                        <div class="process-inner-content-wap">
                                            <?php if (!empty($item['content'])) : ?>
                                                <div class="content">
                                                    <?php printf('%s', $this->parse_text_editor($item['content'])); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <span class="neotech-process-arrow" style="display: none;"><i class="neotech-icon-step"></i></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    ?>
                </div>
                <?php $this->get_swiper_navigation($count_process); ?>
                
            </div>
            <?php
        }
    }
}

$widgets_manager->register(new Neotech_Elementor_Process());
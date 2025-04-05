<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Neotech\Elementor\Neotech_Group_Control_Typography;

class Neotech_Video_Popup extends Elementor\Widget_Base {


    public function get_name() {
        return 'neotech-video-popup';
    }

    public function get_title() {
        return esc_html__('Neotech Video', 'neotech');
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_script_depends() {
        return ['neotech-elementor-video', 'magnific-popup'];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_videos',
            [
                'label' => esc_html__('General', 'neotech'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label'       => esc_html__('Link to', 'neotech'),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__('Support video from Youtube and Vimeo', 'neotech'),
                'placeholder' => esc_html__('https://your-link.com', 'neotech'),
            ]
        );

        $this->add_control(
            'video_style',
            [
                'label' => esc_html__( 'Video Style', 'neotech' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'popup',
                'options' => [
                    'popup' => esc_html__( 'Popup', 'neotech' ),
                    'background' => esc_html__( 'Background', 'neotech' ),
                ],
                'render_type' => 'template',
                'prefix_class' => 'elementor-neotech-video-style-'
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'neotech'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Tile', 'neotech'),
                'default'     => '',
            ]
        );
        $this->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'neotech'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Description', 'neotech'),
                'default'     => '',
            ]
        );

        $this->add_responsive_control(
            'video_align',
            [
                'label'     => esc_html__('Alignment', 'neotech'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_icon',
            [
                'label' => esc_html__( 'Icon', 'neotech' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ]
            ]
        );

        $this->add_control(
            'video_icon_align',
            [
                'label' => esc_html__( 'Icon Position', 'neotech' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => esc_html__( 'Before', 'neotech' ),
                    'after' => esc_html__( 'After', 'neotech' ),
                ],
                'condition' => [
                    'video_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'show_title_block',
            [
                'label'     => esc_html__('Position Vertical', 'neotech'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'neotech'),
                'label_on'  => esc_html__('On', 'neotech'),
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .neotech-video-popup .elementor-video-popup' => 'flex-direction: column; text-align: center;',
                ],
            ]
        );


        $this->end_controls_section();

        //Wrapper
        $this->start_controls_section(
            'section_video_wrapper',
            [
                'label' => esc_html__('Wrapper', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_wrapper_style');

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => esc_html__('Normal', 'neotech'),
            ]
        );

        $this->add_control(
            'background_wrapper',
            [
                'label'     => esc_html__('Background', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_hover',
            [
                'label' => esc_html__('Hover', 'neotech'),
            ]
        );

        $this->add_control(
            'background_wrapper_hover',
            [
                'label'     => esc_html__('Background', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_wrapper_hover',
            [
                'label'     => esc_html__('Border Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(

            Group_Control_Border::get_type(),
            [
                'name'        => 'border_wrapper',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-video-popup',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'section_video_style',
            [
                'label' => esc_html__('Icon', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_size',
            [
                'label'     => esc_html__('Font Size', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .neotech-video-popup .elementor-video-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_width',
            [
                'label'     => esc_html__('Width', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'video_icon[value]!' => '',
                ],

                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-icon ' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_height',
            [
                'label'     => esc_html__('Height', 'neotech'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_effects',
            [
                'label'     => esc_html__( 'Effects', 'neotech' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'prefix_class'  => 'video-icon-effects-'
            ]
        );

        $this->add_control(
            'icon_background_gradient',
            [
                'label'        => esc_html__('Icon Background Gradient', 'neotech'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'icon-background-gradient-'
            ]
        );

        $this->start_controls_tabs('tabs_video_style');

        $this->start_controls_tab(
            'tab_video_normal',
            [
                'label' => esc_html__('Normal', 'neotech'),
                'condition' => [
                    'video_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'video_color',
            [
                'label'     => esc_html__('Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .neotech-video-popup .elementor-video-icon ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_background_color',
            [
                'label'     => esc_html__('Background Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .neotech-video-popup .elementor-video-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_video_hover',
            [
                'label' => esc_html__('Hover', 'neotech'),
                'condition' => [
                    'video_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'video_hover_color',
            [
                'label'     => esc_html__('Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .elementor-video-icon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'video_hover_background_color',
            [
                'label'     => esc_html__('Background Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .elementor-video-icon:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-icon:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'video_hover_box_shadow',
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selector' => '{{WRAPPER}} .neotech-video-popup:hover .elementor-video-icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_video',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-video-popup .elementor-video-icon',
                'separator'   => 'before',
            ]
        );


        $this->add_control(
            'video_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'video_box_shadow',
                'selector' => '{{WRAPPER}} .neotech-video-popup .elementor-video-icon',
            ]
        );

        $this->add_responsive_control(
            'video_padding',
            [
                'label'      => esc_html__('Padding', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .neotech-video-popup .elementor-video-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_responsive_control(
            'video_margin',
            [
                'label'      => esc_html__('Margin', 'neotech'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .neotech-video-popup .elementor-video-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->end_controls_section();

        //title
        $this->start_controls_section(
            'section_video_title',
            [
                'label' => esc_html__('Title', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .neotech-video-popup .elementor-video-title' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__('Color Hover', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                //'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .neotech-video-popup .elementor-video-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_video_description',
            [
                'label' => esc_html__('Description', 'neotech'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Color', 'neotech'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .neotech-video-popup .elementor-video-description' => 'color: {{VALUE}};',

                ],
            ]
        );


        $this->add_group_control(
            Neotech_Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_description',
                //'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .neotech-video-popup .elementor-video-description',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['video_link'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'elementor-video-wrapper');
        $this->add_render_attribute('wrapper', 'class', 'neotech-video-popup');

        $this->add_render_attribute('button', 'class', 'elementor-video-popup');
        $this->add_render_attribute('button', 'role', 'button');
        
        if (!empty($settings['video_style']) && $settings['video_style'] == 'background') {
            $this->add_render_attribute('button', 'data-url', esc_url($settings['video_link']));
            $this->add_render_attribute('button', 'href', 'javascript:void(0)');
        }
        else {
            $this->add_render_attribute('button', 'href', esc_url($settings['video_link']));
        }
        $this->add_render_attribute('button', 'data-effect', 'mfp-zoom-in');

        $this->add_render_attribute('video-icon', 'class', 'elementor-video-icon');
        $this->add_render_attribute('video-icon', 'class', 'video-icon-align-' . esc_attr($settings['video_icon_align']));
        $titleHtml = !empty($settings['title']) ? '<span class="elementor-video-title">' . $settings['title'] . '</span>' : '';
        $this->add_render_attribute('description', 'class', ['elementor-video-description',]);


        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>

            <a <?php $this->print_render_attribute_string('button'); ?>>
                    <span class="video-content">
                        <?php printf('%s', $titleHtml); ?>

                        <?php if (!empty($settings['description'])) : ?>
                            <span <?php $this->print_render_attribute_string('description'); ?>>
                            <?php printf('%s', $settings['description']); ?>
                        </span>
                        <?php endif; ?>
                    </span>

                    <span <?php $this->print_render_attribute_string('video-icon'); ?>>
                    <span class="animation animation-1"> </span>
                    <span class="animation animation-2"> </span>
                    <span class="animation animation-3"> </span>
                    <?php  Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
            </a>
        </div>
        <?php
    }

}

$widgets_manager->register(new Neotech_Video_Popup());

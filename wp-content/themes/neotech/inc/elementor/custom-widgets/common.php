<?php
// Image
use Elementor\Controls_Manager;

class Neotech_Elementor_Custom_Mask_Common {
    public function __construct() {
        add_action('elementor/element/common/_section_masking/before_section_end', [$this, 'neotech_custom_common'], 10, 2);
    }

    public function neotech_custom_common($element, $args) {
        $element->update_control(
            '_mask_shape',
            [
                'label' => esc_html__( 'Shape Selector', 'neotech' ),
                'selectors' => $this->get_mask_selectors( '-webkit-mask-image: url( ' . ELEMENTOR_ASSETS_URL . '/mask-shapes/{{VALUE}}.svg );' ),
            ]
        );

        $element->update_control(
            '_mask_image',
            [
                'selectors' => $this->get_mask_selectors( '-webkit-mask-image: url( {{URL}} );' ),
            ]
        );

        $element->update_control(
			'_mask_size',
			[
				'selectors' => $this->get_mask_selectors( '-webkit-mask-size: {{VALUE}};' ),
			]
		);

        $element->update_control(
			'_mask_size_scale',
			[
				'selectors' => $this->get_mask_selectors( '-webkit-mask-size: {{SIZE}}{{UNIT}};' ),
			]
		);

        $element->update_control(
			'_mask_position',
			[
				'selectors' => $this->get_mask_selectors( '-webkit-mask-position: {{VALUE}};' ),
			]
		);

        $element->update_control(
			'_mask_position_x',
			[
				'selectors' => $this->get_mask_selectors( '-webkit-mask-position-x: {{SIZE}}{{UNIT}};' ),
			]
		);

        $element->update_control(
			'_mask_position_y',
			[
				'selectors' => $this->get_mask_selectors( '-webkit-mask-position-y: {{SIZE}}{{UNIT}};' ),
			]
		);

        $element->update_control(
			'_mask_repeat',
			[
				'selectors' => $this->get_mask_selectors( '-webkit-mask-repeat: {{VALUE}};' ),
			]
		);
    }

    private function get_mask_selectors( $rules ) {
        $neotech_img_selector = '{{WRAPPER}}.elementor-widget-neotech-image-basic .neotech-elementor-wrapper-image';

		$mask_selectors = [
			'default' => '{{WRAPPER}}:not( .elementor-widget-image, .elementor-widget-neotech-image-basic ) .elementor-widget-container',
			'image' => '{{WRAPPER}}.elementor-widget-image .elementor-widget-container img',
			'neotech_image' => $neotech_img_selector,
		];

		return [
			$mask_selectors['default'] => $rules,
			$mask_selectors['image'] => $rules,
			$mask_selectors['neotech_image'] => $rules,
		];
	}
}

new Neotech_Elementor_Custom_Mask_Common();
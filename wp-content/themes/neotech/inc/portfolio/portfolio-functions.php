<?php

if (!function_exists('neotech_get_settings_portfolio_caroseul')) {
    function neotech_get_settings_portfolio_caroseul() {
		$desktop = apply_filters('neotech_portfolio_row_desktop', 3);
        $laptop = apply_filters('neotech_portfolio_row_laptop', 3);
        $tablet = apply_filters('neotech_portfolio_row_tablet', 2);
        $mobile = apply_filters('neotech_portfolio_row_mobile', 1);
        $breakpoints = [
            'desktop'      => [
                'value'  => 1366,
                'column' => $desktop,
            ],
            'laptop'       => [
                'value'  => 1024,
                'column' => $laptop,
            ],
            'tablet'       => [
                'value'  => 767,
                'column' => $tablet,
            ],
            'mobile'       => [
                'value'  => 0,
                'column' => $mobile,
            ],
        ];

        if (neotech_is_elementor_activated()) {
            $elementor_breakpoints = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();
            foreach (array_reverse($elementor_breakpoints) as $breakpoint) {
                if ($breakpoint->is_enabled()) {
                    if ($breakpoint->get_name() == 'laptop') {
                        $breakpoints['desktop']['value'] = $breakpoint->get_value();
                    }
                    if ($breakpoint->get_name() == 'tablet') {
                        $breakpoints['laptop']['value'] = $breakpoint->get_value();
                    }
                    if ($breakpoint->get_name() == 'mobile') {
                        $breakpoints['tablet']['value'] = $breakpoint->get_value();
                    }
                }
            }
        }

        $settings = array(
            'breakpoints'          => $breakpoints,
            "column"               => $desktop,
            "navigation"           => "arrows",
            "column_spacing"       => 30,
            "swiper_overflow"      => "none",
            "autoplay"             => "yes",
            "pause_on_hover"       => "yes",
            "pause_on_interaction" => "yes",
            "autoplay_speed"       => 5000,
            "infinite"             => "yes",
            "speed"                => 500,
            "prevEl"               => ".elementor-swiper-button-prev",
            "nextEl"               => ".elementor-swiper-button-next",
            "paginationEl"         => ".swiper-pagination",
        );

        return $settings;
    }
}

/**
 * Sets up the neotech_portfolio_loop global from the passed args or from the main query.
 *
 * @since 3.3.0
 * @param array $args Args to pass into the global.
 */
function neotech_setup_portfolio_loop( $args = array() ) {
	$default_args = array(
		'loop'         => 0,
		'columns'      => 4,
		'name'         => '',
		'is_shortcode' => false,
		'is_paginated' => true,
		'is_search'    => false,
		'is_filtered'  => false,
		'total'        => 0,
		'total_pages'  => 0,
		'per_page'     => 0,
		'current_page' => 1,
	);

	$default_args = array_merge(
		$default_args,
		array(
			'is_search'    => $GLOBALS['wp_query']->is_search(),
			'total'        => $GLOBALS['wp_query']->found_posts,
			'total_pages'  => $GLOBALS['wp_query']->max_num_pages,
			'per_page'     => $GLOBALS['wp_query']->get( 'posts_per_page' ),
			'current_page' => max( 1, $GLOBALS['wp_query']->get( 'paged', 1 ) ),
		)
	);

	// Merge any existing values.
	if ( isset( $GLOBALS['neotech_portfolio_loop'] ) ) {
		$default_args = array_merge( $default_args, $GLOBALS['neotech_portfolio_loop'] );
	}

	$GLOBALS['neotech_portfolio_loop'] = wp_parse_args( $args, $default_args );

    // echo '<pre>'; print_r($GLOBALS['neotech_portfolio_loop']); echo '</pre>';
}

/**
 * Resets the neotech_portfolio_loop global.
 *
 * @since 3.3.0
 */
function neotech_reset_portfolio_loop() {
	unset( $GLOBALS['neotech_portfolio_loop'] );
}

/**
 * Gets a property from the neotech_portfolio_loop global.
 *
 * @since 3.3.0
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */
function neotech_get_portfolio_loop_prop( $prop, $default = '' ) {
	neotech_setup_portfolio_loop(); // Ensure shop loop is setup.

	return isset( $GLOBALS['neotech_portfolio_loop'], $GLOBALS['neotech_portfolio_loop'][ $prop ] ) ? $GLOBALS['neotech_portfolio_loop'][ $prop ] : $default;
}

/**
 * Sets a property in the neotech_portfolio_loop global.
 *
 * @since 3.3.0
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */
function neotech_set_portfolio_loop_prop( $prop, $value = '' ) {
	if ( ! isset( $GLOBALS['neotech_portfolio_loop'] ) ) {
		neotech_setup_portfolio_loop();
	}
	$GLOBALS['neotech_portfolio_loop'][ $prop ] = $value;
}


if ( ! function_exists( 'neotech_portfolio_loop_start' ) ) {

	/**
	 * Output the start of a portfolio loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function neotech_portfolio_loop_start( $echo = true ) {
		ob_start();

		neotech_set_portfolio_loop_prop( 'loop', 0 );

		// wc_get_template( 'loop/loop-start.php' );
        get_template_part( 'template-parts/portfolio/loop/loop', 'start' );

		$loop_start = apply_filters( 'neotech_portfolio_loop_start', ob_get_clean() );

		if ( $echo ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			printf('%s', $loop_start);
		} else {
			return $loop_start;
		}
	}
}

if ( ! function_exists( 'neotech_portfolio_loop_end' ) ) {

	/**
	 * Output the end of a portfolio loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function neotech_portfolio_loop_end( $echo = true ) {
		ob_start();

		// wc_get_template( 'loop/loop-end.php' );
        get_template_part( 'template-parts/portfolio/loop/loop', 'end' );

		$loop_end = apply_filters( 'neotech_portfolio_loop_end', ob_get_clean() );

		if ( $echo ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			printf('%s', $loop_end);
		} else {
			return $loop_end;
		}
	}
}

/**
 * Resets the neotech_portfolio_loop global.
 *
 * @since 3.3.0
 */
function neotech_portfolio_reset_loop() {
	unset( $GLOBALS['neotech_portfolio_loop'] );
}

if ( ! function_exists( 'neotech_get_portfolio_icon' ) ) {
	/**
	 * Output the end of a portfolio loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function neotech_get_portfolio_icon() {
		$portfolio_id = get_the_ID();
		$icon_id = intval(get_post_meta($portfolio_id, '_portfolio_icon_id', true));
		
		if (!$icon_id || $icon_id <= 0) {
			return false;
		}
		
		$icon_path = wp_get_original_image_path($icon_id);
		if(!$icon_path) return false;
		
		if(mime_content_type($icon_path) && in_array(mime_content_type($icon_path), ['image/svg+xml', 'image/svg'])) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
			require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';
			$filesystem = new WP_Filesystem_Direct( true );
			return $filesystem->get_contents($icon_path);
		}
		
		$icon_url = wp_get_attachment_image_src( $icon_id, 'large' );
		if (!$icon_url || !is_array($icon_url)) {
			return false;
		}
		return '<img class="portfolio_icon_img" src="'.$icon_url[0].'" alt="">';
	}
}

if ( ! function_exists( 'neotech_get_thumbnail_portfolio_url' ) ) {
	/**
	 * Output the end of a portfolio loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function neotech_get_thumbnail_portfolio_url() {
		$id = get_the_ID();
		$size = 'large';
		if (has_post_thumbnail( $id ) ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
			return $image[0];
		}

		// use first attached image
		$images = get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $id );
		if (!empty($images)) {
			$image = reset($images);
			$image_data = wp_get_attachment_image_src( $id, $size );
			return $image_data[0];
		}

		// use no preview fallback
		return Elementor\Utils::get_placeholder_image_src();
	}
}

if ( ! function_exists( 'neotech_related_portfolio_output' ) ) {
	/**
	 * Get portfolios related output
	 *
	 * @return void
	 */
	function neotech_related_portfolio_output() {
		if (!is_singular('portfolio')) return;

		neotech_related_portfolio_template();
	}
}

if ( ! function_exists( 'neotech_related_portfolio_template' ) ) {
	/**
	 * Get portfolios related in detail single portfolio
	 *
	 * @return void
	 */
	function neotech_related_portfolio_template() {
		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => 6,
			'orderby' => 'date',
			'order' => 'DESC',
		);
		if (is_singular('portfolio')) {
			$args = neotech_related_portfolio_exclude_current($args);
		}
		$related_query = new WP_Query( $args );

		if ($related_query->have_posts()) {
			get_template_part('template-parts/portfolio/related', '', ['related_query' => $related_query]);
		}
	}
}

if ( ! function_exists( 'neotech_related_portfolio_exclude_current' ) ) {
	/**
	 * Filter exclude current portfolio in related portfolios
	 *
	 * @return void
	 */
	function neotech_related_portfolio_exclude_current($args) {
		$cur_portfolio = get_the_ID();
		$args['post__not_in'] = [$cur_portfolio];

		return $args;
	}
}

if ( ! function_exists( 'neotech_category_implode_portfolio' ) ) {
	/**
	 * Filter exclude current portfolio in related portfolios
	 *
	 * @return void
	 */
	function neotech_category_implode_portfolio($separator = ', ', $portfolio_id = '') {
		$portfolio_id = $portfolio_id == '' ? get_the_ID() : $portfolio_id;
		$terms = get_the_terms($portfolio_id, 'portfolio-category');

		if (empty($terms) || !is_array($terms)) {
			return;
		}

		$categories = [];
        if( $terms ) {          
            foreach ($terms as $category) {
                $categories[] = $category->name;
            }       
        }
        $categories = implode($separator, $categories);

		return $categories;
	}
}
<?php

/**
 * Sets up the neotech_team_loop global from the passed args or from the main query.
 *
 * @since 3.3.0
 * @param array $args Args to pass into the global.
 */
function neotech_setup_team_loop( $args = array() ) {
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
	if ( isset( $GLOBALS['neotech_team_loop'] ) ) {
		$default_args = array_merge( $default_args, $GLOBALS['neotech_team_loop'] );
	}

	$GLOBALS['neotech_team_loop'] = wp_parse_args( $args, $default_args );

    // echo '<pre>'; print_r($GLOBALS['neotech_team_loop']); echo '</pre>';
}

/**
 * Resets the neotech_team_loop global.
 *
 * @since 3.3.0
 */
function neotech_reset_team_loop() {
	unset( $GLOBALS['neotech_team_loop'] );
}

/**
 * Gets a property from the neotech_team_loop global.
 *
 * @since 3.3.0
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */
function neotech_get_team_loop_prop( $prop, $default = '' ) {
	neotech_setup_team_loop(); // Ensure shop loop is setup.

	return isset( $GLOBALS['neotech_team_loop'], $GLOBALS['neotech_team_loop'][ $prop ] ) ? $GLOBALS['neotech_team_loop'][ $prop ] : $default;
}

/**
 * Sets a property in the neotech_team_loop global.
 *
 * @since 3.3.0
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */
function neotech_set_team_loop_prop( $prop, $value = '' ) {
	if ( ! isset( $GLOBALS['neotech_team_loop'] ) ) {
		neotech_setup_team_loop();
	}
	$GLOBALS['neotech_team_loop'][ $prop ] = $value;
}


if ( ! function_exists( 'neotech_team_loop_start' ) ) {

	/**
	 * Output the start of a team loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function neotech_team_loop_start( $echo = true ) {
		ob_start();

		neotech_set_team_loop_prop( 'loop', 0 );

		// wc_get_template( 'loop/loop-start.php' );
        get_template_part( 'template-parts/team/loop/loop', 'start' );

		$loop_start = apply_filters( 'neotech_team_loop_start', ob_get_clean() );

		if ( $echo ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			printf('%s', $loop_start);
		} else {
			return $loop_start;
		}
	}
}

if ( ! function_exists( 'neotech_team_loop_end' ) ) {

	/**
	 * Output the end of a team loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function neotech_team_loop_end( $echo = true ) {
		ob_start();

		// wc_get_template( 'loop/loop-end.php' );
        get_template_part( 'template-parts/team/loop/loop', 'end' );

		$loop_end = apply_filters( 'neotech_team_loop_end', ob_get_clean() );

		if ( $echo ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			printf('%s', $loop_end);
		} else {
			return $loop_end;
		}
	}
}

/**
 * Resets the neotech_team_loop global.
 *
 * @since 3.3.0
 */
function neotech_team_reset_loop() {
	unset( $GLOBALS['neotech_team_loop'] );
}

if ( ! function_exists( 'neotech_get_team_icon' ) ) {
	/**
	 * Output the end of a team loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function neotech_get_team_icon() {
		$team_id = get_the_ID();
		$icon_id = intval(get_post_meta($team_id, '_team_icon_id', true));
		
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
		return '<img class="team_icon_img" src="'.$icon_url[0].'" alt="">';
	}
}

if ( ! function_exists( 'neotech_get_thumbnail_team_url' ) ) {
	/**
	 * Output the end of a team loop. By default this is a UL.
	 *
	 * @param bool $echo Should echo?.
	 * @return string
	 */
	function neotech_get_thumbnail_team_url() {
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

if ( ! function_exists( 'neotech_related_team_template' ) ) {
	/**
	 * Get teams related in detail single team
	 *
	 * @return void
	 */
	function neotech_related_team_template() {
		get_template_part('template-parts/team/related', '');
	}
}

if ( ! function_exists( 'neotech_related_team_exclude_current_team' ) ) {
	/**
	 * Filter exclude current team in related teams
	 *
	 * @return void
	 */
	function neotech_related_team_exclude_current_team($args) {
		$cur_team = get_the_ID();
		$args['post__not_in'] = [$cur_team];

		return $args;
	}
}

if ( ! function_exists( 'neotech_team_bottom_template' ) ) {
	/**
	 * Elementor: show template on bottom team single
	 *
	 * @return void
	 */
	function neotech_team_bottom_template($args) {
		if (!is_singular('team')) return;
		if (!neotech_is_elementor_activated()) return;

        $slug = neotech_get_theme_option('team_bottom_template');
		if (empty($slug)) return;

        $queried_post = get_page_by_path($slug, OBJECT, 'elementor_library');
        if (isset($queried_post->ID)) {
            echo Elementor\Plugin::instance()->frontend->get_builder_content($queried_post->ID);
            $css_file = Elementor\Core\Files\CSS\Post::create( $queried_post->ID );
            $css_file->enqueue();
        }
	}
}


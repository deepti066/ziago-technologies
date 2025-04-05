<?php

if (!function_exists('neotech_elementor_parse_text_editor')) {
    function neotech_elementor_parse_text_editor($content, $obj) {
        $content = apply_filters('widget_text', $content, $obj->get_settings());

        $content = shortcode_unautop($content);
        $content = do_shortcode($content);
        $content = wptexturize($content);

        if ($GLOBALS['wp_embed'] instanceof \WP_Embed) {
            $content = $GLOBALS['wp_embed']->autoembed($content);
        }

        return $content;
    }
}

if (!function_exists('neotech_elementor_get_strftime')) {
    function neotech_elementor_get_strftime($instance, $obj) {
        $string = '';
        if ($instance['show_days']) {
            $string .= $obj->render_countdown_item($instance, 'label_days', 'days', 'elementor-countdown-days');
        }
        if ($instance['show_hours']) {
            $string .= $obj->render_countdown_item($instance, 'label_hours', 'hours', 'elementor-countdown-hours');
        }
        if ($instance['show_minutes']) {
            $string .= $obj->render_countdown_item($instance, 'label_minutes', 'minutes', 'elementor-countdown-minutes');
        }
        if ($instance['show_seconds']) {
            $string .= $obj->render_countdown_item($instance, 'label_seconds', 'seconds', 'elementor-countdown-seconds');
        }

        return $string;
    }
}

if (!function_exists('neotech_elementor_breakpoints')) {
    function neotech_elementor_breakpoints() {
        $container_width = \Elementor\Plugin::$instance->kits_manager->get_active_kit()->get_settings_for_display('container_width');
        if (!empty($container_width)) {
            $var = '.col-full{max-width:' . $container_width['size'] . $container_width['unit'] . '}';
            wp_add_inline_style('neotech-style', $var);
        }
    }
}

function neotech_get_hotspots() {
    global $post;

    $options[''] = esc_html__('Select Hotspots', 'neotech');
    if (!neotech_is_elementor_activated()) {
        return;
    }
    $args = array(
        'post_type'      => 'elementor_library',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        's'              => 'Hotspots',
        'order'          => 'ASC',
    );

    $query = new WP_Query($args);
    while ($query->have_posts()) {
        $query->the_post();
        $options[$post->post_name] = $post->post_title;
    }
    wp_reset_postdata();
    return $options;
}

function neotech_get_file_contents($path) {
    if (is_file($path)) {
        $prifix = 'file_get'.'_contents';
        return $prifix($path);
    }

    return false;
}

function neotech_get_icon_svg($path, $color = '', $width = '') {
    $content = neotech_get_file_contents($path);
    if ($content) {
        $re = '/<svg(([^\n]*\n)+)<\/svg>/';
        preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);
        if (count($matches) > 0) {
            $content = $matches[0][0];
            $css     = '';
            if ($color) {
                $content = preg_replace('/stroke="[^"]*"/', 'stroke="' . $color . '"', $content);
                $css     .= 'fill:' . $color . ';';
            }
            if ($width) {
                $css .= 'width:' . $width . '; height: auto;';
            }
            $content = preg_replace("/(<svg[^>]*)(style=(\"|')([^(\"|')]*)('|\"))/m", '$1 style="' . $css . '$4"', $content);
        }
    }

    return $content;
}
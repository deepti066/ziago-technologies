<?php

defined( 'ABSPATH' ) || exit();
/**
 * @param $menu_id
 *
 * @return array menu settings data
 */
function neotech_megamenu_get_item_data( $menu_id = false ) {
	return get_post_meta( $menu_id, 'neotech_megamenu_item_data', true );
}

/**
 * update item data
 *
 * @param $menu_id
 * @param $data
 */
function neotech_megamenu_update_item_data( $menu_id = false, $data = array() ) {
	update_post_meta( $menu_id, 'neotech_megamenu_item_data', $data );
	do_action( 'neotech_menu_item_updated', $menu_id, $data );
}

/**
 * delete menu item settings data
 *
 * @param int $menu_id
 */
function neotech_megamenu_delete_item_data( $menu_id = false ) {
	delete_post_meta( $menu_id, 'neotech_megamenu_item_data' );
	do_action( 'neotech_megamenu_item_deleted', $menu_id );
}

/**
 * get elementor post id as menu item id
 *
 * @param int $menu_id
 *
 * @return boolean
 */
function neotech_megamenu_get_post_related_menu( $menu_id = false ) {
	$post_id = 0;
	$slug    = get_post_meta( $menu_id, 'neotech_elementor_post_name', true );
	if ( $slug ) {
		$queried_post = get_page_by_path( $slug, OBJECT, 'elementor_library' );
		if ( isset( $queried_post->ID ) ) {
			$post_id = $queried_post->ID;
		}
	}

	return apply_filters( 'neotech_post_related_menu_post_id', $post_id, $menu_id );
}

/**
 * create releated post menu id
 *
 * @param $menu_id
 */
function neotech_megamenu_create_related_post( $menu_id = false ) {


	$args = apply_filters( 'neotech_megamenu_create_related_post_args', array(
		'post_type'   => 'elementor_library',
		'post_title'  => '#megamenu' . $menu_id,
		'post_name'   => 'megamenu' . $menu_id,
		'post_status' => 'publish',
		'meta_input'  => array(
			'_wp_page_template' => 'inc/megamenu/templates/single-menu.php'
		)
	) );

	$post_related_id = wp_insert_post( $args );
	// save elementor_post_id meta value
	update_post_meta( $menu_id, 'neotech_elementor_post_id', $post_related_id );
	update_post_meta( $menu_id, 'neotech_elementor_post_name', 'megamenu' . $menu_id );
	// trigger events
	do_action( 'neotech_megamenu_releated_post_created', $post_related_id, $args );

	return apply_filters( 'neotech_megamenu_create_releated_post', $post_related_id );
}

/**
 * get menu icon html
 *
 * @param $icon
 *
 * @return string html
 */
function neotech_megamenu_get_icon_html( $icon, $data ) {
	$style = '';
	if ( isset( $data['icon_color'] ) && $data['icon_color'] || isset( $data['icon_size']) && $data['icon_size']) {
        $style .= 'style="';

        if ($data['icon_color']){
            $style .= 'color:' . $data['icon_color'] . ';';
        }
		if ($data['icon_size']){
            $style .= 'font-size:' . $data['icon_size'] . 'px;';
        }

        $style .= ' "';
	}

	return apply_filters( 'neotech_menu_icon_html', '<i class="menu-icon ' . $icon . '" ' . $style . '></i>' );
}

/**
 * is enabled megamenu
 */
function neotech_megamenu_is_enabled( $menu_item_id = false ) {
	$item_settings = neotech_megamenu_get_item_data( $menu_item_id );
	$boolean       = isset( $item_settings['enabled'] ) && $item_settings['enabled'];

	return apply_filters( 'neotech_megamenu_item_enabled', $boolean );
}

function neotech_megamenu_get_fontawesome_icons() {
	$jsonfile = get_theme_file_uri( '/inc/elementor/icons.json' );
	$request  = wp_remote_get( $jsonfile );
	$response = wp_remote_retrieve_body( $request );

	$json = json_decode( $response, true );

	return $json['icons'];
}

function neotech_get_badge_html( $badge, $data ) {

    $style = '';

    if( (isset($data['badge_color']) && $data['badge_color']) ||  (isset($data['badges_bg_color']) && $data['badges_bg_color'])  ){
        $style .= 'style="';
        if( $data['badge_color'] ){
            $style .= '	color:'.$data['badge_color'].'; ';
        }
        if( $data['badges_bg_color'] ){
            $style .= '	background-color:'.$data['badges_bg_color'].'; ';
        }
        $style .= ' "';
    }

    $format = '<small class="menu-badge" %2$s>%1$s</small>';
    return sprintf( $format, esc_attr( $badge ), $style );
}


<?php
/**
 * =================================================
 * Hook neotech_page
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_single_post
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_single_post_bottom
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_loop_post
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_after_container
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_before_footer
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_footer
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_after_footer
 * =================================================
 */
add_action('neotech_after_footer', 'neotech_sticky_single_add_to_cart', 999);

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'neotech_render_woocommerce_shop_canvas', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_before_container
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_content_top
 * =================================================
 */
add_action('neotech_content_top', 'neotech_shop_messages', 10);

/**
 * =================================================
 * Hook neotech_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_sidebar
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_loop_before
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_loop_after
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_page_after
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_single_post_before
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_single_post_after
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_woocommerce_list_item_title
 * =================================================
 */
add_action('neotech_woocommerce_list_item_title', 'neotech_product_label', 5);
add_action('neotech_woocommerce_list_item_title', 'neotech_woocommerce_product_list_image', 10);

/**
 * =================================================
 * Hook neotech_woocommerce_list_item_content
 * =================================================
 */
add_action('neotech_woocommerce_list_item_content', 'woocommerce_template_loop_product_title', 10);
add_action('neotech_woocommerce_list_item_content', 'neotech_woocommerce_get_product_description', 15);
add_action('neotech_woocommerce_list_item_content', 'woocommerce_template_loop_rating', 15);
add_action('neotech_woocommerce_list_item_content', 'woocommerce_template_loop_price', 20);
add_action('neotech_woocommerce_list_item_content', 'neotech_stock_label', 25);

/**
 * =================================================
 * Hook neotech_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_woocommerce_before_shop_loop_item_image
 * =================================================
 */
add_action('neotech_woocommerce_before_shop_loop_item_image', 'neotech_product_label', 10);
add_action('neotech_woocommerce_before_shop_loop_item_image', 'woocommerce_template_loop_product_thumbnail', 15);
add_action('neotech_woocommerce_before_shop_loop_item_image', 'neotech_woocommerce_product_loop_action_start', 20);
add_action('neotech_woocommerce_before_shop_loop_item_image', 'neotech_quickview_button', 30);
add_action('neotech_woocommerce_before_shop_loop_item_image', 'neotech_woocommerce_product_loop_action_close', 40);
add_action('neotech_woocommerce_before_shop_loop_item_image', 'neotech_single__quantity_cart', 50);

/**
 * =================================================
 * Hook neotech_woocommerce_shop_loop_item_caption
 * =================================================
 */
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_woocommerce_get_product_category', 5);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_single__rating_brands', 10);
add_action('neotech_woocommerce_shop_loop_item_caption', 'woocommerce_template_loop_product_title', 15);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_woocommerce_get_product_description', 20);
add_action('neotech_woocommerce_shop_loop_item_caption', 'woocommerce_template_loop_price', 30);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_single_product_extra_label', 25);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_woocommerce_product_loop_action_start', 30);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_wishlist_button', 30);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_quickview_button', 30);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_compare_button', 30);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_woocommerce_product_loop_action_close', 30);
add_action('neotech_woocommerce_shop_loop_item_caption', 'neotech_single__quantity_cart', 35);

/**
 * =================================================
 * Hook neotech_woocommerce_after_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_product_list_start
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_product_list_image
 * =================================================
 */
add_action('neotech_product_list_image', 'neotech_woocommerce_product_list_image', 10);

/**
 * =================================================
 * Hook neotech_product_list_content
 * =================================================
 */
add_action('neotech_product_list_content', 'woocommerce_template_loop_product_title', 10);
add_action('neotech_product_list_content', 'neotech_woocommerce_list_show_rating', 15);
add_action('neotech_product_list_content', 'woocommerce_template_loop_price', 20);

/**
 * =================================================
 * Hook neotech_product_list_end
 * =================================================
 */

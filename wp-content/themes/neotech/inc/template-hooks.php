<?php
/**
 * =================================================
 * Hook neotech_page
 * =================================================
 */
add_action('neotech_page', 'neotech_page_header', 10);
add_action('neotech_page', 'neotech_page_content', 20);

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
add_action('neotech_single_post', 'neotech_post_thumbnail', 15);
add_action('neotech_single_post', 'neotech_post_excerpt', 20);
add_action('neotech_single_post', 'neotech_post_header', 10);
add_action('neotech_single_post', 'neotech_post_content', 30);

/**
 * =================================================
 * Hook neotech_single_post_bottom
 * =================================================
 */
add_action('neotech_single_post_bottom', 'neotech_post_taxonomy', 5);
add_action('neotech_single_post_bottom', 'neotech_post_nav', 10);
add_action('neotech_single_post_bottom', 'neotech_single_author', 15);
add_action('neotech_single_post_bottom', 'neotech_display_comments', 20);

/**
 * =================================================
 * Hook neotech_loop_post
 * =================================================
 */
add_action('neotech_loop_post', 'neotech_post_header', 15);
add_action('neotech_loop_post', 'neotech_post_content', 30);

/**
 * =================================================
 * Hook neotech_after_container
 * =================================================
 */
add_action('neotech_after_container', 'neotech_output_related_products', 20);

/**
 * =================================================
 * Hook neotech_before_footer
 * =================================================
 */
add_action('neotech_before_footer', 'neotech_team_bottom_template', 10);

/**
 * =================================================
 * Hook neotech_footer
 * =================================================
 */
add_action('neotech_footer', 'neotech_footer_default', 20);

/**
 * =================================================
 * Hook neotech_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'neotech_template_account_dropdown', 1);
add_action('wp_footer', 'neotech_mobile_nav', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'neotech_pingback_header', 1);

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
add_action('neotech_before_content', 'neotech_archive_blog_top', 10);

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
add_action('neotech_sidebar', 'neotech_get_sidebar', 10);

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
add_action('neotech_loop_after', 'neotech_paging_nav', 10);

/**
 * =================================================
 * Hook neotech_page_after
 * =================================================
 */
add_action('neotech_page_after', 'neotech_display_comments', 10);

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
add_action('neotech_single_post_after', 'neotech_related_portfolio_output', 10);

/**
 * =================================================
 * Hook neotech_woocommerce_list_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_woocommerce_list_item_content
 * =================================================
 */

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

/**
 * =================================================
 * Hook neotech_woocommerce_shop_loop_item_caption
 * =================================================
 */

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

/**
 * =================================================
 * Hook neotech_product_list_content
 * =================================================
 */

/**
 * =================================================
 * Hook neotech_product_list_end
 * =================================================
 */

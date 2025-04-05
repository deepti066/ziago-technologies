
		</div><!-- .col-full -->
        <?php
		/**
		 * Functions hooked in to neotech_after_container action
		 *
         * @see neotech_output_related_products - 20
         * 
		 */
		do_action('neotech_after_container');
		?>
	</div><!-- #content -->

	<?php
    /**
     * Functions hooked in to neotech_before_footer action
     *
     * @see neotech_team_bottom_template - 10
     *
     */
    do_action( 'neotech_before_footer' );
    if (neotech_is_elementor_activated() && function_exists('hfe_init') && (hfe_footer_enabled() || hfe_is_before_footer_enabled())) {
        do_action('hfe_footer_before');
        do_action('hfe_footer');
    } else {
        ?>

        <footer id="colophon" class="site-footer" role="contentinfo">
            <?php
            /**
             * Functions hooked in to neotech_footer action
             *
             * @see neotech_footer_default - 20
             *
             *
             */
            do_action('neotech_footer');

            ?>

        </footer><!-- #colophon -->

        <?php
    }

		/**
		 * Functions hooked in to neotech_after_footer action
		 * @see neotech_sticky_single_add_to_cart 	- 999 - woo
		 */
		do_action( 'neotech_after_footer' );
	?>

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see neotech_template_account_dropdown 	- 1
 * @see neotech_mobile_nav - 1
 * @see neotech_render_woocommerce_shop_canvas - 1 - woo
 */

wp_footer();
?>
</body>
</html>

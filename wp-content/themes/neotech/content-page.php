<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to neotech_page action
	 *
	 * @see neotech_page_header          - 10
	 * @see neotech_page_content         - 20
	 *
	 */
	do_action( 'neotech_page' );
	?>
</article><!-- #post-## -->

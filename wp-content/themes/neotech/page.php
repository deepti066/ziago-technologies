<?php

get_header(); ?>

	<div id="primary">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'neotech_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to neotech_page_after action
				 *
				 * @see neotech_display_comments - 10
				 */
				do_action( 'neotech_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//do_action( 'neotech_sidebar' );
get_footer();

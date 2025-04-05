<?php

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            while (have_posts()) :
                the_post();

                /**
                 * Functions hooked in to neotech_single_post_before action
                 */
                do_action('neotech_single_post_before');

                get_template_part('content', 'single');

                /**
                 * Functions hooked in to neotech_single_post_after action
                 * 
                 * @see neotech_related_portfolio_output     - 10
                 */
                do_action('neotech_single_post_after');

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php
do_action('neotech_sidebar');
get_footer();

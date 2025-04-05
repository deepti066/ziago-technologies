<?php

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            while (have_posts()) :
                the_post();

                do_action('neotech_single_team_before');

                get_template_part('template-parts/team/content', 'single');
                
                do_action('neotech_single_team_after');

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php
do_action('neotech_sidebar');
get_footer();

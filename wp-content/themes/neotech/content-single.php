<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">
        <?php
        /**
         * Functions hooked in to neotech_single_post_top action
         *
         */
        do_action('neotech_single_post_top');

        /**
         * Functions hooked in to neotech_single_post action
         * @see neotech_post_thumbnail     - 15
         * @see neotech_post_excerpt     - 20
         * @see neotech_post_header        - 10
         * @see neotech_post_content       - 30
         */
        do_action('neotech_single_post');

        /**
         * Functions hooked in to neotech_single_post_bottom action
         *
         * @see neotech_post_taxonomy        - 5
         * @see neotech_post_nav             - 10
         * @see neotech_single_author        - 15
         * @see neotech_display_comments     - 20
         */
        do_action('neotech_single_post_bottom');
        ?>

    </div>

</article><!-- #post-## -->

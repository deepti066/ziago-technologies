<article id="post-<?php the_ID(); ?>" <?php post_class('article-default'); ?>>
    <?php neotech_post_thumbnail('post-thumbnail', false); ?>
    <div class="post-content">
        <?php
        /**
         * Functions hooked in to neotech_loop_post action.
         *
         * @see neotech_post_header          - 15
         * @see neotech_post_content         - 30
         */
        do_action('neotech_loop_post');
        ?>
    </div>
</article><!-- #post-## -->
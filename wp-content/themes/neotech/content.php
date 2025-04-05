<article id="post-<?php the_ID(); ?>" <?php post_class('article-default'); ?>>
    <div class="post-inner">
        <?php neotech_post_thumbnail('post-thumbnail', true); ?>
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
    </div>
</article><!-- #post-## -->
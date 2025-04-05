<?php
/**
 * The template for displaying product content within loops
 *
 */

defined('ABSPATH') || exit;

$class = 'portfolio';
if (neotech_get_portfolio_loop_prop('enable_carousel', false) == true) {
    $class .= ' swiper-slide';
}
if ($style = neotech_get_portfolio_loop_prop('style', 1)) {
    $class .= ' portfolio-style-'.$style;
}

$show_btn = neotech_get_portfolio_loop_prop('show_button');
?>
<li class="<?php echo esc_attr($class); ?>">
    <div class="portfolio-block">
        <div class="portfolio-transition">
            <figure class="portfolio-image">
                <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                    <img src="<?php echo esc_attr(neotech_get_thumbnail_portfolio_url()) ?>" class="portfolio_thumbnail" alt="<?php the_title() ?>">
                </a>
                <?php
                if ($show_btn == 'yes' && $style != '3') {
                    ?>
                    <div class="portfolio-button"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><span><?php _e('View Portfolio', 'neotech') ?></span><i class="neotech-icon-plus"></i></a></div>
                    <?php
                }
                ?>
            </figure>
        </div>
        <div class="portfolio-caption">
            <div class="portfolio-caption-inner">
                <?php 
                if (neotech_get_portfolio_loop_prop('show_category') == 'yes') {
                    ?>
                    <div class="portfolio-subtitle"><?php echo esc_html(neotech_category_implode_portfolio()) ?></div>
                    <?php
                }
                if (neotech_get_portfolio_loop_prop('show_title') == 'yes') {
                    ?>
                    <h3 class="portfolio-loop-title">
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                    </h3>
                    <?php
                }
                if (neotech_get_portfolio_loop_prop('show_exerpt') == 'yes') {
                    ?>
                    <div class="portfolio-loop-excerpt"><?php the_excerpt() ?></div>
                    <?php
                }
                if ($show_btn == 'yes' && $style == '3') {
                    ?>
                    <div class="portfolio-button"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><span><?php _e('View Portfolio', 'neotech') ?></span><i class="neotech-icon-plus"></i></a></div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</li>

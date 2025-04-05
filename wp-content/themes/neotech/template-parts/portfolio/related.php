<?php
/**
 * Related Portfolios
 *
 * This template can be overridden by copying it to yourtheme/template-parts/portfolio/related.php
 */

if (!defined('ABSPATH')) {
    exit;
}


$class = 'neotech-theme-swiper neotech-swiper-wrapper swiper ';
$settings = neotech_get_settings_portfolio_caroseul();
$settings['prevEl'] = '.related-swiper-button-prev';
$settings['nextEl'] = '.related-swiper-button-next';
$settings['paginationEl'] = '.related-pagination';
$show_dots = (in_array($settings['navigation'], ['dots', 'both']));
$show_arrows = (in_array($settings['navigation'], ['arrows', 'both']));

$carousel_enable = (neotech_is_elementor_activated()) ? true : false;
neotech_set_portfolio_loop_prop('enable_carousel', $carousel_enable);
neotech_set_portfolio_loop_prop('show_category', 'yes');
neotech_set_portfolio_loop_prop('show_title', 'yes');

?>

<section class="related portfolios-related elementor-element">

    <?php
    $heading = apply_filters('neotech_portfolio_related_portfolios_heading', __('Our Recent Launched <br> Projects Available', 'neotech'));
    if ($heading) :
        ?>
        <div class="neotech_related_heading">
            <span class="sub-title"><i class="neotech-icon-dot-rectangle"></i><?php _e('latest studies', 'neotech') ?></span>
            <h2><?php echo wp_kses_post($heading); ?></h2>
        </div>
    <?php endif; ?>

    <div class="<?php echo esc_attr($class); ?>" data-settings="<?php echo esc_attr(wp_json_encode($settings)) ?>">

        <?php 
        neotech_portfolio_loop_start();

        while ($args['related_query']->have_posts()) {
            $args['related_query']->the_post();

            get_template_part( 'template-parts/portfolio/content', 'portfolio' );
        }

        neotech_portfolio_loop_end();
        ?>

        <?php if ($show_dots) : ?>
            <div class="swiper-pagination swiper-pagination related-swiper-pagination"></div>
        <?php endif; ?>
        <?php if ($show_arrows) : ?>
            <div class="elementor-swiper-button elementor-swiper-button-prev related-swiper-button-prev">
                <i aria-hidden="true" class="neotech-icon-arrow-left"></i>
                <span class="elementor-screen-only"><?php echo esc_html__('Previous', 'neotech'); ?></span>
            </div>
            <div class="elementor-swiper-button elementor-swiper-button-next related-swiper-button-next">
                <i aria-hidden="true" class="neotech-icon-arrow-right"></i>
                <span class="elementor-screen-only"><?php echo esc_html__('Next', 'neotech'); ?></span>
            </div>
        <?php endif; ?>
    </div>
    <?php
    if (!neotech_is_elementor_activated()) {
        ?>
        <style>
            .related .neotech-portfolios.portfolios.elementor-grid {
                display: flex;
            }
        </style>
        <?php
    }
    ?>
</section>
<?php

wp_reset_postdata();

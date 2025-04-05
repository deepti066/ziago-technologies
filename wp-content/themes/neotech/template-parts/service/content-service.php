<?php
/**
 * The template for displaying product content within loops
 *
 */

defined('ABSPATH') || exit;

$class = 'service';
if (neotech_get_service_loop_prop('enable_carousel', false) == true) {
    $class .= ' swiper-slide';
}
if ($style = neotech_get_service_loop_prop('style', 1)) {
    $class .= ' service-style-'.$style;
}

?>
<li class="<?php echo esc_attr($class); ?>">
    <div class="service-block">
        <?php
        if ($style != 4) {
            ?>
            <div class="service-transition">
                <div class="service-img-wrap bottom-to-top">
                    <div class="inner">
                        <figure class="service-image">
                            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                                <img src="<?php echo esc_attr(neotech_get_thumbnail_service_url()) ?>" class="service_thumbnail" alt="<?php the_title() ?>">
                            </a>
                        </figure>
                    </div>
                </div>
            </div>
            <?php
        }
        else {
            ?><div class="service-index-item"><span><?php echo esc_html(str_pad($args['index'], 2, '0', STR_PAD_LEFT)); ?></span></div><?php
        }
        ?>
        <div class="service-caption">
            <?php 
            if (neotech_get_service_loop_prop('show_icon') == 'yes' && $icon = neotech_get_service_icon()) {
                ?>
                <div class="service-image-icon">
                    <div class="service_icon">
                        <?php printf('%s', $icon); ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="service-content-loop">
                <h3 class="service-loop-title">
                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                </h3>
                <div class="service-content-box">
                    <?php 
                    if (neotech_get_service_loop_prop('show_exerpt') == 'yes') {
                        ?>
                        <div class="service-loop-excerpt"><?php the_excerpt() ?></div>
                        <?php
                    }
                    if (neotech_get_service_loop_prop('show_notice') == 'yes' && $notice = get_post_meta(get_the_ID(), '_service_notice', true)) {
                        ?>
                        <div class="service-loop-notice"><?php printf('%s', $notice); ?></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="service-button">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><span><?php esc_html_e('More details', 'neotech') ?></span><i class="neotech-icon neotech-icon-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</li>

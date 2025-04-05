<?php
/**
 * The template for displaying product content within loops
 *
 */

defined('ABSPATH') || exit;

$class = 'team';
if (neotech_get_team_loop_prop('enable_carousel', false) == true) {
    $class .= ' swiper-slide';
}
if ($style = neotech_get_team_loop_prop('style', 1)) {
    $class .= ' team-style-'.$style;
}

$show_btn = neotech_get_team_loop_prop('show_button');

$team_socials_group = get_post_meta(get_the_ID(), 'team_socials_group', true);
?>
<li class="<?php echo esc_attr($class); ?>">
    <div class="team-block">
        <div class="team-transition">
            <figure class="team-image">
                <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                    <img src="<?php echo esc_attr(neotech_get_thumbnail_team_url()) ?>" class="team_thumbnail" alt="<?php the_title() ?>">
                </a>
                <?php if($team_socials_group) { ?>
                    <ul class="team_socials">
                        <?php if(!empty($team_socials_group[0]['team_fb'])) { ?>
                            <li>
                                <a href="<?php echo esc_url($team_socials_group[0]['team_fb']) ?>" target="_blank"><i class="neotech-icon-facebook-f"></i></a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($team_socials_group[0]['team_x'])) { ?>
                            <li>
                                <a href="<?php echo esc_url($team_socials_group[0]['team_x']) ?>" target="_blank"><i class="neotech-icon-twitter"></i></a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($team_socials_group[0]['team_ig'])) { ?>
                            <li>
                                <a href="<?php echo esc_url($team_socials_group[0]['team_ig']) ?>" target="_blank"><i class="neotech-icon-instagram"></i></a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($team_socials_group[0]['team_in'])) { ?>
                            <li>
                                <a href="<?php echo esc_url($team_socials_group[0]['team_in']) ?>" target="_blank"><i class="neotech-icon-linkedin-in"></i></a>
                            </li>
                        <?php } ?>
                        <?php do_action('neotech_team_more_socials_loop'); ?>
                    </ul>
                <?php } ?>  
            </figure>
        </div>
        <div class="team-caption">
            <div class="team-caption-inner">
                <?php 
                if (neotech_get_team_loop_prop('show_title') == 'yes') {
                    ?>
                    <h3 class="team-loop-title">
                        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                    </h3>
                    <?php
                }
                if (neotech_get_team_loop_prop('show_job') == 'yes') {
                    $team_job = get_post_meta(get_the_ID(), 'team_job', true);
                    if(!empty($team_job)) { ?>
                        <div class="team-subtitle"><?php echo esc_html($team_job) ?></div>
                    <?php }
                }
                if (neotech_get_team_loop_prop('show_exerpt') == 'yes') {
                    ?>
                    <div class="team-loop-excerpt"><?php the_excerpt() ?></div>
                    <?php
                }
                if ($show_btn == 'yes') {
                    ?>
                    <div class="team-button"><a class="more-link" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php _e('Detail Team', 'neotech') ?></a></div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</li>

<?php
$team_job = get_post_meta(get_the_ID(), 'team_job', true);
$team_phone = get_post_meta(get_the_ID(), 'team_phone', true);
$team_email = get_post_meta(get_the_ID(), 'team_email', true);
$team_description = get_post_meta(get_the_ID(), 'team_description', true);
$team_skills_group = get_post_meta(get_the_ID(), 'team_skills_group', true);
$team_socials_group = get_post_meta(get_the_ID(), 'team_socials_group', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">
        <div class="row">
            <div class="column-12 team-wrap-left">
                <div class="team-left">
                    <?php neotech_post_thumbnail('full') ?>
                </div>
            </div>
            <div class="column-12 team-wrap-right">
                <div class="team-right">
                    <div class="col-inner">
                        <div class="neotech_team_informations">
                            <div class="content-sidebar-left">
                                <div class="entry-header">
                                    <?php the_title('<h4 class="alpha entry-title">', '</h4>'); ?>
                                    <?php if(!empty($team_job)) { ?>
                                        <div class="team_job"><?php echo esc_html($team_job) ?></div>
                                    <?php } ?>
                                </div>
                                <ul class="team_contact">
                                    <?php if(!empty($team_phone)) { ?>
                                        <li class="team_contact_phone">
                                            <strong><?php _e('Phone:', 'neotech') ?></strong>
                                            <a href="tel:<?php echo esc_attr($team_phone) ?>"><?php echo esc_html($team_phone) ?></a>
                                        </li>
                                    <?php } ?>
                                    <?php if(!empty($team_email)) { ?>
                                        <li class="team_contact_email">
                                            <strong><?php _e('Email:', 'neotech') ?></strong>
                                            <a href="mailto:<?php echo esc_attr($team_email) ?>"><?php echo esc_html($team_email) ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="team_tabs_info">
                                    <div class="team_tabs_header">
                                        <nav class="team_nav_tabs">
                                            <a class="team_nav_item show" href="#" data-tab="#personal-info"><?php _e('Biography', 'neotech') ?></a>
                                            <a class="team_nav_item" href="#" data-tab="#professional-skills"><?php _e('Professional Skills', 'neotech') ?></a>
                                            <?php do_action('neotech_more_nav_tabs_team'); ?>
                                        </nav>
                                    </div>
                                    <div class="team_tabs_content">
                                        <div id="personal-info" class="team_item_content show">
                                            <div class="team_inner_content">
                                                <?php
                                                the_content(
                                                    sprintf(
                                                    /* translators: %s: post title */
                                                        esc_html__('Read More', 'neotech') . ' %s',
                                                        '<span class="screen-reader-text">' . get_the_title() . '</span>'
                                                    )
                                                );
                                                ?>
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
                                                        <?php do_action('neotech_team_more_socials'); ?>
                                                    </ul>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div id="professional-skills" class="team_item_content">
                                            <div class="team_inner_content">
                                                <?php 
                                                $nodata = true;
                                                if(!empty($team_description)) {
                                                    echo wp_kses_post( $team_description );
                                                    $nodata = false;
                                                } 

                                                if(!empty($team_skills_group)) {
                                                    ?>
                                                    <div class="team_skills">
                                                        <?php 
                                                        foreach ($team_skills_group as $i => $skill) { 
                                                            if(empty($skill['title']) || empty($skill['level'])) continue;
                                                            ?>
                                                            <div class="team_skill_item">
                                                                <span class="team_skill_title"><?php echo esc_html($skill['title']) ?></span>
                                                                <span class="team_skill_level" style="--skill-level: <?php echo esc_attr($skill['level']) ?>%"><?php echo esc_html($skill['level']) ?>%</span>
                                                                <span class="team_skill_line"></span>
                                                                <span class="team_skill_line level_line" style="width: <?php echo esc_attr($skill['level']) ?>%"></span>
                                                            </div>
                                                            <?php
                                                        }
                                                        do_action('neotech_team_more_skill'); ?>
                                                    </div>
                                                    <?php 
                                                    $nodata = false;
                                                }
                                                
                                                if ($nodata) {
                                                    echo wp_kses(apply_filters('neotech_team_no_content', __('No data!', 'neotech')), ['p' => [], 'span' => []]);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php do_action('neotech_more_content_tabs_team'); ?>
                                    </div>
                                </div>
                                
                                <?php do_action('neotech_custom_more_team_informations'); ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</article><!-- #post-## -->

<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Neotech_CMB2_Options_Admin')) :

    /**
     * Custom Admin Field By CMB2
     */
    class Neotech_CMB2_Options_Admin {

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct() {
            add_action( 'cmb2_init', [$this, 'cmb2_add_team_metabox'] );
        }

        public function cmb2_add_team_metabox() {
            if (!post_type_exists( 'team' )) return;

            $objs = apply_filters('neotech_meta_apply_for_team', ['team']);

            $cmb = new_cmb2_box( array(
                'id'           => 'team_meta',
                'title'        => __( 'Team Meta', 'neotech' ),
                'object_types' => $objs,
                'context'      => 'normal',
                'priority'     => 'high',
            ) );

            do_action('neotech_before_team_meta', $cmb);

            $cmb->add_field( array(
                'name' => __( 'Job', 'neotech' ),
                'id' => 'team_job',
                'type' => 'text',
            ) );

            $cmb->add_field( array(
                'name' => __( 'Phone number', 'neotech' ),
                'id' => 'team_phone',
                'type' => 'text',
            ) );

            $cmb->add_field( array(
                'name' => __( 'Email', 'neotech' ),
                'id' => 'team_email',
                'type' => 'text_email',
            ) );

            $group_field_id = $cmb->add_field( array(
                'id'          => 'team_socials_group',
                'type'        => 'group',
                'repeatable'  => false,
                'options'     => array(
                    'closed'         => false,
                    'group_title' => __('Team socials', 'neotech')
                ),
            ) );
            $cmb->add_group_field( $group_field_id, array(
                'name' => __( 'Facebook', 'neotech' ),
                'id'   => 'team_fb',
                'type' => 'text_url',
            ) );
            $cmb->add_group_field( $group_field_id, array(
                'name' => __( 'X', 'neotech' ),
                'id'   => 'team_x',
                'type' => 'text_url',
            ) );
            $cmb->add_group_field( $group_field_id, array(
                'name' => __( 'Instagram', 'neotech' ),
                'id'   => 'team_ig',
                'type' => 'text_url',
            ) );
            $cmb->add_group_field( $group_field_id, array(
                'name' => __( 'LinkedIn', 'neotech' ),
                'id'   => 'team_in',
                'type' => 'text_url',
            ) );

            do_action('neotech_team_socials', $group_field_id, $cmb);

            $cmb->add_field( array(
                'name' => __('Professional Skills', 'neotech'),
                'id'   => 'team_professional_title',
                'type' => 'title',
            ) );

            $cmb->add_field( array(
                'name' => 'Professional Skills Description',
                'id' => 'team_description',
                'type' => 'textarea_small'
            ) );

            $group_field_id = $cmb->add_field( array(
                'id'          => 'team_skills_group',
                'type'        => 'group',
                // 'repeatable'  => false, // use false if you want non-repeatable group
                'options'     => array(
                    'group_title'       => __( 'Skill {#}', 'neotech' ),
                    'add_button'        => __( 'Add Another Skill', 'neotech' ),
                    'remove_button'     => __( 'Remove Skill', 'neotech' ),
                    'sortable'          => true,
                    'closed'         => false,
                ),
            ) );
            $cmb->add_group_field( $group_field_id, array(
                'name' => 'Skill Title',
                'id'   => 'title',
                'type' => 'text_small',
            ) );
            $cmb->add_group_field( $group_field_id, array(
                'name' => 'Skill Level',
                'id'   => 'level',
                'type' => 'text_small',
                'attributes' => array(
                    'type' => 'number',
                    'pattern' => '\d*',
                    'min' => 0,
                    'max' => 100,
                ),
                'sanitization_cb' => 'absint',
                'escape_cb'       => 'absint',
            ) );
            
            do_action('neotech_team_skills_group', $group_field_id, $cmb);

            do_action('neotech_after_team_meta', $cmb);
        }

    }

endif;

return new Neotech_CMB2_Options_Admin();
<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Neotech_CF7_Service')) :

    /**
     * The CF7 Neotech class
     */
    class Neotech_CF7_Service {

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct() {

            add_action( 'wpcf7_init', [$this, 'wpcf7_add_form_tag_neotech_service'], 10, 0 );
            add_action( 'wpcf7_swv_create_schema', [$this, 'wpcf7_swv_add_neotech_service_rules'], 10, 2 );
            add_action( 'wpcf7_admin_init', [$this, 'wpcf7_add_tag_generator_neotech_service_menu'], 19, 0 );

        }

        public function wpcf7_add_form_tag_neotech_service() {
            wpcf7_add_form_tag( array( 'neotechservice', 'neotechservice*' ),
                [$this, 'neotech_select_service_form_tag_handler'],
                array(
                    'name-attr' => true,
                    'selectable-values' => true,
                )
            );
        }
        
        public function neotech_select_service_form_tag_handler( $tag ) {
            if ( empty( $tag->name ) ) {
                return '';
            }
        
            $validation_error = wpcf7_get_validation_error( $tag->name );
        
            $class = wpcf7_form_controls_class( $tag->type );
        
            if ( $validation_error ) {
                $class .= ' wpcf7-not-valid';
            }
        
            $atts = array();
        
            $atts['class'] = $tag->get_class_option( $class );
            $atts['id'] = $tag->get_id_option();
            $atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );
        
            $atts['autocomplete'] = $tag->get_option(
                'autocomplete', '[-0-9a-zA-Z]+', true
            );
        
            if ( $tag->is_required() ) {
                $atts['aria-required'] = 'true';
            }
        
            if ( $validation_error ) {
                $atts['aria-invalid'] = 'true';
                $atts['aria-describedby'] = wpcf7_get_validation_error_reference(
                    $tag->name
                );
            } else {
                $atts['aria-invalid'] = 'false';
            }
        
            if ( $tag->has_option( 'size' ) ) {
                $size = $tag->get_option( 'size', 'int', true );
        
                if ( $size ) {
                    $atts['size'] = $size;
                } else {
                    $atts['size'] = 1;
                }
            }
        
            $values = [''];
            $labels = [__('Requested Services', 'neotech')];

            $args_service = [
                'post_type'        => 'service',
                'posts_per_page'   => -1,
                'post_status' => 'publish'
            ];
            
            $query_service = new WP_Query( $args_service ); 

            if ( $query_service->have_posts() ) {
                while ( $query_service->have_posts() ) {
                    $query_service->the_post(); 
                    $values[] = get_the_title();
                    $labels[] = get_the_title();
                }
            }
            wp_reset_query();

            $html = '';
        
            foreach ( $values as $key => $value ) {
                $item_atts = array(
                    'value' => $value
                );
        
                $label = isset( $labels[$key] ) ? $labels[$key] : $value;
        
                $html .= sprintf(
                    '<option %1$s>%2$s</option>',
                    wpcf7_format_atts( $item_atts ),
                    esc_html( $label )
                );
            }
        
            $atts['name'] = $tag->name;
        
            $html = sprintf(
                '<span class="wpcf7-form-control-wrap" data-name="%1$s"><select %2$s>%3$s</select>%4$s</span>',
                esc_attr( $tag->name ),
                wpcf7_format_atts( $atts ),
                $html,
                $validation_error
            );
        
            return $html;
        }

        public function wpcf7_swv_add_neotech_service_rules( $schema, $contact_form ) {
            $tags = $contact_form->scan_form_tags( array(
                'type' => array( 'neotechservice*' ),
            ) );
        
            foreach ( $tags as $tag ) {
                $schema->add_rule(
                    wpcf7_swv_create_rule( 'required', array(
                        'field' => $tag->name,
                        'error' => wpcf7_get_message( 'invalid_required' ),
                    ) )
                );
            }
        }
        
        public function wpcf7_add_tag_generator_neotech_service_menu() {
            $tag_generator = WPCF7_TagGenerator::get_instance();
            $tag_generator->add( 
                'neotechservice', 
                __( 'Neotech service', 'neotech' ),
                [$this, 'neotech_service_tag_generator_menu'],
                ['version' => '2']
            );
        }

        public function neotech_service_tag_generator_menu( $contact_form, $args = '' ) {
            $args = wp_parse_args( $args, array() );
        
            $description = __( "Generate a form-tag for a drop-down menu. For more details, see %s.", 'neotech' );
        
            $desc_link = wpcf7_link( __( 'https://contactform7.com/checkboxes-radio-buttons-and-menus/', 'neotech' ), __( 'Checkboxes, radio buttons and menus', 'neotech' ) );
        
            ?>
            <div class="control-box">
            <fieldset>
            <legend><?php echo sprintf( esc_html( $description ), $desc_link ); ?></legend>
            
            <table class="form-table">
            <tbody>
                <tr>
                <th scope="row"><?php echo esc_html( __( 'Field type', 'neotech' ) ); ?></th>
                <td>
                    <fieldset>
                    <legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'neotech' ) ); ?></legend>
                    <label><input type="checkbox" name="required" /> <?php echo esc_html( __( 'Required field', 'neotech' ) ); ?></label>
                    </fieldset>
                </td>
                </tr>
            
                <tr>
                <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'neotech' ) ); ?></label></th>
                <td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
                </tr>
            
                <tr>
                <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'neotech' ) ); ?></label></th>
                <td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
                </tr>
            
                <tr>
                <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'neotech' ) ); ?></label></th>
                <td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
                </tr>
            
            </tbody>
            </table>
            </fieldset>
            </div>
            
            <div class="insert-box">
                <input type="text" name="neotechservice" class="tag code" readonly="readonly" onfocus="this.select()" />
            
                <div class="submitbox">
                <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'neotech' ) ); ?>" />
                </div>
            
                <br class="clear" />
            
                <p class="description mail-tag"><label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'neotech' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label></p>
            </div>
            <?php
        }
    }

endif;

return new Neotech_CF7_Service();
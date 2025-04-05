<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Neotech_WooSW')) :

    /**
     * The CF7 Neotech class
     */
    class Neotech_WooSW {

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct() {

            add_action('woosw_wishlist_item_actions_before', [$this, 'neotech_woosw_wishlist_item_actions_before'], 10, 2);
            add_action('woosw_wishlist_item_actions_after', [$this, 'neotech_woosw_wishlist_item_actions_after'], 10, 2);
        }


        public function neotech_woosw_wishlist_item_actions_before($product, $key) {
    
            echo <<<HTML
            <div class="neotech_woosw_item_wrapper">
            HTML;
            
        }
    
    
        public function neotech_woosw_wishlist_item_actions_after($product, $key) {
    
            echo <<<HTML
            </div>
            HTML;
            
        }
        
        

    }        

endif;

return new Neotech_WooSW();
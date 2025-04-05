<header id="masthead" class="site-header header-1" role="banner">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                neotech_site_branding();
                if (neotech_is_woocommerce_activated()) {
                    ?>
                    <div class="site-header-cart header-cart-mobile">
                        <?php neotech_cart_link(); ?>
                    </div>
                    <?php
                }
                ?>
                <?php neotech_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php neotech_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    neotech_header_account();
                    if (neotech_is_woocommerce_activated()) {
                        neotech_header_wishlist();
                        neotech_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->

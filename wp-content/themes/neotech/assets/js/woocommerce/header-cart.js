/**
 * Makes the header cart content scrollable if the height of the dropdown exceeds the window height.
 * Mouseover is used as items can be added to the cart via ajax and we'll need to recheck.
 */
( function() {
	'use strict';

	if ( document.body.classList.contains( 'woocommerce-cart' ) || document.body.classList.contains( 'woocommerce-checkout' ) || window.innerWidth < 768 || ! document.getElementById( 'site-header-cart' ) ) {
		return;
	}

	window.addEventListener( 'load', function() {
		var cart = document.querySelector( '.site-header-cart' );

		cart.addEventListener( 'mouseover', function() {
			var windowHeight  = window.outerHeight,
				cartBottomPos = this.querySelector( '.widget_shopping_cart_content' ).getBoundingClientRect().bottom + this.offsetHeight,
				cartList      = this.querySelector( '.cart_list' );

			if ( cartBottomPos > windowHeight ) {
				cartList.style.maxHeight = '15em';
				cartList.style.overflowY = 'auto';
			}
		} );
	} );
} )();

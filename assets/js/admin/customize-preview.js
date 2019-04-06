/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).html( newval );
		} );
	} );

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( newval ) {
			$( 'body .custom-logo-link img.custom-logo' ).css( 'width', newval );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	wp.customize( 'footer_copyright', function( value ) {
		value.bind( function( newval ) {
			$( 'footer p' ).html( newval );
		} );
	} );

	wp.customize( 'home_title', function( value ) {
		value.bind( function( newval ) {
			$( '.emma-front-page .hero h1.entry-title' ).html( newval );
		} );
	} );

    wp.customize( 'home_subtitle', function( value ) {
        value.bind( function( newval ) {
            $( '.emma-front-page .hero h3.entry-subtitle' ).html( newval );
        } );
    } );

    wp.customize( 'home_date', function( value ) {
        value.bind( function( newval ) {
            $( '.emma-front-page .hero h4.entry-date' ).html( newval );
        } );
    } );

	wp.customize( 'contact_button_text', function( value ) {
		value.bind( function( newval ) {
			$( '.bean-contactform li.submit .button' ).html( newval );
		} );
	} );

} )( jQuery );

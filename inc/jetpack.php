<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

if ( ! function_exists( 'emma_jetpack_setup' ) ) :
	function emma_jetpack_setup() {
		/*
		 * Let JetPack manage the site logo.
		 * By adding theme support, we declare that this theme does use the default
		 * JetPack Site Logo functionality, if the module is activated.
		 *
		 * See: http://jetpack.me/support/site-logo/
		 */
		add_image_size( 'emma-logo', 200, 200 );

		add_theme_support( 'site-logo', array( 'size' => 'emma-logo' ) );

	}
endif;
add_action( 'after_setup_theme', 'emma_jetpack_setup' );

/**
 * Halves the size of the JetPack site logo to make it retina ready.
 *
 * @param   $html string The rendered site-logo html
 * @param   $logo array The logo-Jetpack object
 * @param   $size string The size of the logo
 * @see jetpack_the_site_logo filter in Jetpack
 */
function emma_retina_jetpack_site_logo( $html, $logo, $size ) {

	if ( ! jetpack_has_site_logo() ) {
		return $html;
	}

	/*
     * Proceed if the retina_logo Customizer option is selected.
     */
	if ( get_theme_mod( 'retina_logo' ) == true ) :

		// Get the image size
		$imageAttachment = wp_get_attachment_image_src( $logo['id'], $size );

		// Half the image size since we want a retina ready image
		$html = preg_replace( '/width="(\d+)"/i', 'width="' . ( round( $imageAttachment[1] / 2 ) ) . '"', $html );
		$html = preg_replace( '/height="(\d+)"/i', 'height="' . ( round( $imageAttachment[2] / 2 ) ) . '"', $html );

	endif;

	return $html;
}
add_filter( 'jetpack_the_site_logo', 'emma_retina_jetpack_site_logo', 10, 3 );

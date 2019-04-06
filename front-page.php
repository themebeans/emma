<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

get_header();

// Get each of our panels and show the post data.
if ( 0 !== emma_panel_count() || is_customize_preview() ) : // If we have pages to show.

	/**
	* Filter number of front page sections in Twenty Seventeen.
	*
	* @since Emma 2.0.2
	*
	* @param $num_sections integer
	*/
	$num_sections = apply_filters( 'emma_front_page_sections', 5 );
	global $emmacounter;

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$emmacounter = $i;
		emma_front_page_section( null, $i );
	}

endif;

get_footer();

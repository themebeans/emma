<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active.
 */
function emma_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $num_sections integer
	 */
	$num_sections = apply_filters( 'emma_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'home_section_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the homepage or not.
 */
function emma_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function emma_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Display a front page section.
 *
 * @param $partial WP_Customize_Partial Partial associated with a selective refresh request.
 * @param $id integer Front page section to display.
 */
function emma_front_page_section( $partial = null, $id = 0 ) {
	if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
		// Find out the id and set it up during a selective refresh.
		global $emmacounter;
		$id          = str_replace( 'home_section_', '', $partial->id );
		$emmacounter = $id;
	}

	global $post; // Modify the global post object before setting up post data.
	if ( get_theme_mod( 'home_section_' . $id ) ) {

		global $post;
		$post = get_post( get_theme_mod( 'home_section_' . $id ) );
		setup_postdata( $post );
		set_query_var( 'panel', $id );

		get_template_part( 'template-parts/page', 'loop' );

		wp_reset_postdata();

	} elseif ( is_customize_preview() ) {
	}
}

if ( ! function_exists( 'emma_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function emma_edit_link() {

		$link = edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'emma' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);

		return $link;
	}
endif;

if ( ! function_exists( 'emma_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function emma_site_logo() {

		if ( has_custom_logo() ) {
			echo '<div class="site-logo" itemscope itemtype="http://schema.org/Organization">';
				the_custom_logo();
			echo '</div>';
		} else {
			printf( '<h1 class="site-title" itemscope itemtype="http://schema.org/Organization"><a href="%1$s" rel="home" itemprop="url">%2$s</a></h1>', esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );
		}
	}

endif;

if ( ! function_exists( 'emma_page_title' ) ) :
	/**
	 * Page titles.
	 */
	function emma_page_title() {

		$page_title = '';

		$author_avatar = '
    <div class="author-avatar">
        ' . get_avatar( get_the_author_meta( 'user_email' ), '100', '' ) . '
    </div>';

		if ( is_singular() ) {
			if ( is_page() ) {
				$page_title = get_the_title();
			} elseif ( is_single() ) {
				$page_title = get_the_title();
			}
		} else {
			if ( is_archive() ) {
				if ( is_category() ) {
					$page_title = sprintf( esc_html__( 'All posts in: %s', 'emma' ), single_cat_title( '', false ) );
				} elseif ( is_tag() ) {
					$page_title = sprintf( esc_html__( 'All posts in: %s', 'emma' ), single_tag_title( '', false ) );
				} elseif ( is_date() ) {
					if ( is_month() ) {
						$page_title = sprintf( esc_html__( 'Archive for: %s', 'emma' ), get_the_time( 'F, Y' ) );
					} elseif ( is_year() ) {
						$page_title = sprintf( esc_html__( 'Archive for: %s', 'emma' ), get_the_time( 'Y' ) );
					} elseif ( is_day() ) {
						$page_title = sprintf( esc_html__( 'Archive for: %s', 'emma' ), get_the_time( get_option( 'date_format' ) ) );
					} else {
						$page_title = esc_html__( 'Archives', 'emma' );
					}
				} elseif ( is_author() ) {
					if ( get_query_var( 'author_name' ) ) {
						$curauth = get_user_by( 'login', get_query_var( 'author_name' ) );
					} else {
						$curauth = get_userdata( get_query_var( 'author' ) );
					}
					$author_name = $curauth->display_name;
					$title       = sprintf( esc_html__( 'All posts by %s', 'emma' ), $author_name );
					$page_title  = $author_avatar . $title;
				} else {
					$page_title = single_term_title( '', false );
				}
			} elseif ( is_search() ) {
				$page_title = sprintf( esc_html__( 'Search results for &#8220;%s&#8221;', 'emma' ), get_search_query() );
			}
		}
		return $page_title;
	}
endif;

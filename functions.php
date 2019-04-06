<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

if ( ! defined( 'EMMA_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'EMMA_DEBUG', true );
endif;

if ( ! defined( 'EMMA_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'EMMA_DEBUG' ) || true === EMMA_DEBUG ) {
		define( 'EMMA_ASSET_SUFFIX', null );
	} else {
		define( 'EMMA_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function emma_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Emma, use a find and replace
	 * to change 'emma' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'emma', get_parent_theme_file_path( '/languages' ) );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter Emma's custom-background support argument.
	 */
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140 );
	add_image_size( 'post-feat', 1400, 9999, false );
	add_image_size( 'grid-feat', 720, 550, true );

	/*
	 * This theme uses wp_nav_menu() in two locations.
	 */
	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Menu', 'emma' ),
			'mobile-menu'  => esc_html__( 'Mobile Menu', 'emma' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo' );

	/**
	 * Filter Emma's custom-background support argument.
	 */
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

	/*
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style( array( 'assets/css/editor' . EMMA_ASSET_SUFFIX . '.css', emma_fonts_url() ) );

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'emma_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function emma_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'emma_content_width', 1280 );
}
add_action( 'after_setup_theme', 'emma_content_width', 0 );



/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function emma_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Internal Sidebar', 'emma' ),
			'id'            => 'internal-sidebar',
			'description'   => esc_html__( 'Appears on the single post pages.', 'emma' ),
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);

}
add_action( 'widgets_init', 'emma_widgets_init' );

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function emma_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_enqueue_scripts', 'emma_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function emma_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'emma-fonts', emma_fonts_url(), array(), null );

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'emma-style', get_parent_theme_file_uri( '/style' . EMMA_ASSET_SUFFIX . '.css' ) );
		wp_enqueue_style( 'emma-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'emma-style', get_theme_file_uri( '/style' . EMMA_ASSET_SUFFIX . '.css' ) );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular( 'post' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Conditionally load masonry.
	if ( is_home() || is_archive() || is_search() ) {
		wp_enqueue_script( 'masonry' );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( SCRIPT_DEBUG || EMMA_DEBUG ) {
		wp_enqueue_script( 'imagesloaded', get_theme_file_uri( '/assets/js/vendors/imagesloaded.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'mean-menu', get_theme_file_uri( '/assets/js/vendors/mean-menu.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'fitvids', get_theme_file_uri( '/assets/js/vendors/fitvids.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'superfish', get_theme_file_uri( '/assets/js/vendors/superfish.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'jquery-validate', get_theme_file_uri( '/assets/js/vendors/validate.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'emma-functions', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );
	} else {
		wp_enqueue_script( 'emma-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'emma-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );
	}

}
add_action( 'wp_enqueue_scripts', 'emma_scripts' );

/**
 * Remove the duplicate stylesheet enqueue for older versions of the child theme.
 *
 * Since v2.2.3 @@pkg.name has a built-in auto-loader for loading the appropriate
 * parent theme stylesheet, without the need for a wp_enqueue_scripts function within
 * the child theme. This means that stylesheets will "just work" and there's less chance
 * that users will accidently disrupt stylesheet loading.
 */
function emma_remove_duplicate_child_parent_enqueue_scripts() {
	remove_action( 'wp_enqueue_scripts', 'emma_child_scripts', 10 );
}
add_action( 'init', 'emma_remove_duplicate_child_parent_enqueue_scripts' );

/**
 * Register Google fonts for Emma.
 *
 * @return string Google fonts URL for the theme.
 */
function emma_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = '';

	/* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'emma' ) ) {
		$fonts[] = 'Lato:100:400';
	}

	/* translators: If there are characters in your language that are not supported by this font translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Questrial font: on or off', 'emma' ) ) {
		$fonts[] = 'Questrial';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg(
			array(
				'family' => rawurlencode( implode( '|', $fonts ) ),
				'subset' => rawurlencode( $subsets ),
			), 'https://fonts.googleapis.com/css'
		);
	}

	return $fonts_url;
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed.
 */
function emma_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'emma-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'emma_resource_hints', 10, 2 );

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function emma_enqueue_admin_style() {
	wp_enqueue_style( 'emma-admin-style', get_theme_file_uri( '/assets/css/admin-style.css' ), false, '@@pkg.version' );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'emma_enqueue_admin_style' );

/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function emma_enqueue_admin_script( $hook ) {
	global $pagenow, $wp_customize;

	if ( 'edit.php' !== $hook ) {
		wp_enqueue_script( 'emma-post-meta', get_theme_file_uri( '/assets/js/admin/post-meta.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'wp-color-picker' );
	}
}
add_action( 'admin_enqueue_scripts', 'emma_enqueue_admin_script' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function emma_front_page_template( $template ) {
	return is_home() ? '' : $template;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function emma_body_classes( $classes ) {

	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'emma-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'emma_body_classes' );

/**
 * Filter the text prepended to the post title for protected posts.
 * Create your own emma_protected_title_format() to override in a child theme.
 *
 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
 */
function emma_protected_title_format( $title ) {
	return '%s';
}
add_filter( 'protected_title_format', 'emma_protected_title_format' );



if ( ! function_exists( 'emma_protected_form' ) ) :
	/**
	 * Filter the HTML output for the protected post password form.
	 * Create your own emma_protected_form() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
	 * @link https://codex.wordpress.org/Using_Password_Protection
	 */
	function emma_protected_form() {
		global $post;
		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$o     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	<p>' . esc_html__( 'To view, enter the password below:', 'emma' ) . '</p>
	<input name="post_password" id="' . $label . '" type="password" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'emma' ) . '" />
	</form>
	';
		return $o;
	}
	add_filter( 'the_password_form', 'emma_protected_form' );
endif;



if ( ! function_exists( 'emma_page_custom_styles' ) ) :
	/**
	 * Page Custom CSS Output
	 */
	function emma_page_custom_styles() {

		if ( ( emma_is_frontpage() || ( is_home() && is_front_page() ) ) ) :

			$port_posts = get_posts(
				array(
					'numberposts' => -1,
					'post_type'   => 'page',
				)
			);

			echo '<style>';

			foreach ( $port_posts as $post ) {
				$postid = $post->ID;

				$herotextcolor = get_post_meta( $postid, '_bean_herotext_color', true );

				if ( $herotextcolor ) {
					echo '.post-' . esc_attr( $postid ) . ' .page-item.bg-img h1 {color: ' . esc_attr( $herotextcolor ) . '} ';
					echo '.post-' . esc_attr( $postid ) . ' .page-item.bg-img h2 {color: ' . esc_attr( $herotextcolor ) . '} ';
					echo '.post-' . esc_attr( $postid ) . ' .page-item.bg-img p {color: ' . esc_attr( $herotextcolor ) . '} ';
				}
			}

			echo '</style>';

		endif;

		if ( is_singular( 'page' ) ) {

			if ( ! emma_is_frontpage() ) {
				$herotextcolor = get_post_meta( get_the_ID(), '_bean_herotext_color', true );

				if ( $herotextcolor ) {
					echo '<style>';
					echo '.hero h1 {color: ' . esc_attr( $herotextcolor ) . '} ';
					echo '.hero h2 {color: ' . esc_attr( $herotextcolor ) . '} ';
					echo '.hero h3 {color: ' . esc_attr( $herotextcolor ) . '} ';
					echo '.hero h4 {color: ' . esc_attr( $herotextcolor ) . '} ';
					echo '.hero p {color: ' . esc_attr( $herotextcolor ) . '} ';
					echo '</style>';
				}
			}
		}
	}
	add_action( 'wp_head', 'emma_page_custom_styles' );
endif;



if ( ! function_exists( 'emma_comments' ) ) :
	/**
	 * Define custom callback function for comment output.
	 * Based strongly on the output from Twenty Sixteen.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
	 * @link https://wordpress.org/themes/twentysixteen/
	 *
	 * Create your own stash_comments() to override in a child theme.
	 */
	function emma_comments( $comment, $args, $depth ) {
		$isByAuthor = false;

		if ( $comment->comment_author_email == get_the_author_meta( 'email' ) ) {
			$isByAuthor = true;
		}

		$allowed_html_array = array(
			'a'      => array(
				'href'  => array(),
				'title' => array(),
			),
			'br'     => array(),
			'cite'   => array(),
			'em'     => array(),
			'strong' => array(),
		);

		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">

				<div class="comment-author vcard">
						<?php echo get_avatar( $comment, $size = '45' ); ?>
					<?php printf( wp_kses( __( '<cite class="fn">%s</cite> ', 'emma' ), $allowed_html_array ), get_comment_author_link() ); ?> <?php
					if ( $isByAuthor ) {
?>
<span class="author-tag"><?php esc_html_e( '(Author)', 'emma' ); ?></span><?php } ?>
				</div><!-- END .comment-author.vcard -->

				<h6 class="comment-meta commentmetadata subtext">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'emma' ), get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( esc_html__( 'Edit', 'emma' ), ' &middot; ', '' ); ?>   &middot;
										<?php
										comment_reply_link(
											array_merge(
												$args, array(
													'depth' => $depth,
													'max_depth' => $args['max_depth'],
												)
											)
										);
?>
				</h6><!-- END .comment-meta.commentmetadata.subtext -->

				<div class="comment-body">
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<span class="moderation"><?php esc_html_e( 'Awaiting Moderation', 'emma' ); ?></span>
				<?php endif; ?>
				<?php comment_text(); ?>
				</div><!-- END .comment-body -->

			</div><!-- END #comment-<?php comment_ID(); ?> -->
		</li>
	<?php
	}
endif;



if ( ! function_exists( 'emma_comment_form_filters' ) ) :
	/**
	 * Comments Form Filters
	 */
	function emma_comment_form_filters( $args = array(), $post_id = null ) {
		global $id;

		if ( null === $post_id ) {
			$post_id = $id;
		} else {
			$id = $post_id;
		}

		$commenter     = wp_get_current_commenter();
		$user          = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$fields = array(
			'author' => '
		<p class="comment-form-author">
			<label for="author">' . esc_html__( 'Name', 'emma' ) . ( '<span class="required"> *</span>' ) . '</label>
			<input class="eight" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/>
		</p>',

			'email'  => '
		<p class="comment-form-email">
			<label for="email">' . esc_html__( 'Email', 'emma' ) . ( '<span class="required"> *</span>' ) . '</label>
			<input class="eight" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required/>
		</p>',

			'url'    => '
		<p class="comment-form-url">
			<label for="url">' . esc_html__( 'Website', 'emma' ) . '</label>
			<input class="eight" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/>
		</p>',
		);

		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<p class="comment-form-message"><label for="comment">' . esc_html__( 'Comment', 'emma' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8"  required></textarea></p>',
			'',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'emma' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Currently logged in as <a href="%1$s">%2$s</a> / <a href="%3$s" title="Log out of this account">Logout</a>', 'emma' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => null,
			'comment_notes_after'  => null,
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'class_submit'         => 'submit',
			'name_submit'          => 'submit',
			'submit_field'         => '<p class="form-submit">%1$s %2$s</a>',
			'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
			'title_reply'          => sprintf( esc_html__( '', 'emma' ) ),
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'emma' ),
			'cancel_reply_link'    => esc_html__( 'Cancel', 'emma' ),
			'label_submit'         => esc_html__( 'Submit', 'emma' ),
		);

		return $defaults;
	}
	add_filter( 'comment_form_defaults', 'emma_comment_form_filters' );
endif;

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function emma_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'emma_pingback_header' );

/**
 * Metaboxes.
 */
require get_theme_file_path( '/inc/meta/metaboxes.php' );
require get_theme_file_path( '/inc/meta/meta-page.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_theme_file_path( '/inc/jetpack.php' );

/**
 * Load Starter Content.
 */
require get_theme_file_path( '/inc/starter-content.php' );

/**
 * Add Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}

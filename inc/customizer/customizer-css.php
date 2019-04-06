<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function emma_customizer_css() {

	$theme_accent_color = get_theme_mod( 'theme_accent_color', '#B690C7' );

	$site_logo_width = get_theme_mod( 'custom_logo_max_width', '50' );

	$css_filter_style = get_theme_mod( 'css_filter' );
	$filter_css       = null;

	if ( '' != $css_filter_style ) {
		switch ( $css_filter_style ) {
			case 'none':
				$filter_css = null;
				break;
			case 'grayscale':
				$filter_css = '.page-item.bg-img, .post-thumb img { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
				break;
			case 'sepia':
				$filter_css = '.page-item.bg-img, .post-thumb img { -webkit-filter: sepia(30%); }';
				break;
		}
	} ?>

	<?php
	$css =
	'

	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_width ) . 'px;
	}

	a { color:' . $theme_accent_color . '; }

	.cats,

	.author-tag,
	.entry-title a:hover,
	.comment-author a:hover,
	.comment-meta a:hover,
	input[type="reset"]:hover,
	.site-description a:hover,
	.widget li a:hover,

	.bean-tabs > li.active > a,

	.entry-meta li a:hover,
	.bean-panel-title > a:hover,
	.bean-tabs > li.active > a:hover,
	.bean-tabs > li.active > a:focus,

	.widget_bean_tweets .button,
	.widget.widget_bean_tweets .button:hover,
	.bean-pricing-table .pricing-column li.info:hover,
	.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-item-title,
	.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-item-title,
	.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-caption,
	.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-caption { color:' . $theme_accent_color . '!important; }

	.new-tag,
	.bean-btn,
	.tagcloud a,
	div.jp-play-bar,
	.avatar-list li a.active,
	div.jp-volume-bar-value,
	.bean-direction-nav a:hover,
	.bean-pricing-table .table-mast,
	.entry-content .mejs-controls .mejs-time-rail span.mejs-time-current,
	.post .post-slider.fade .bean-direction-nav a:hover { background-color:' . $theme_accent_color . '; }

	.entry-content .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current { background:' . $theme_accent_color . '; }

	.bean-btn { border: 1px solid ' . $theme_accent_color . '!important; }

	a:hover, .widget_bean_tweets .button:hover { border-color: ' . $theme_accent_color . '; }

	.bean-pricing-table .pricing-column li span {color:' . $theme_accent_color . '!important;}#powerTip,.bean-pricing-table .pricing-highlighted{background-color:' . $theme_accent_color . '!important;}#powerTip:after {border-color:' . $theme_accent_color . ' transparent!important; }

	.bean-quote { background-color:' . $theme_accent_color . '!important; }

	' . $filter_css . '

	';

	/**
	 * Combine the values from above and minifiy them.
	 */
	$css_minified = $css;

	$css_minified = preg_replace( '#/\*.*?\*/#s', '', $css_minified );
	$css_minified = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css_minified );
	$css_minified = preg_replace( '/\s\s+(.*)/', '$1', $css_minified );

	wp_add_inline_style( 'emma-style', wp_strip_all_tags( $css_minified ) );

}
add_action( 'wp_head', 'emma_customizer_css', 1 );

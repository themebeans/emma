<?php
/**
 * The file is for creating the portfolio post type meta.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

add_action( 'add_meta_boxes', 'emma_metabox_page' );
function emma_metabox_page() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'bean-meta-box-page',
		'title'    => esc_html__( 'Page Settings', 'emma' ),
		'page'     => 'page',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Page Tagline:', 'emma' ),
				'id'   => $prefix . 'page_tagline',
				'type' => 'text',
				'desc' => esc_html__( 'Display a page tagline in your page hero area.', 'emma' ),
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Featured Image Background:', 'emma' ),
				'id'   => $prefix . 'feat_image_bg',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display your featured image as the page background, if this page is output on the Home Template.', 'emma' ),
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Hero Text Color:', 'emma' ),
				'id'   => $prefix . 'herotext_color',
				'type' => 'color',
				'desc' => esc_html__( 'Adjust the color for your text overlaid on the background featured image.', 'emma' ),
				'std'  => '',
				'val'  => ' ',
			),
		),
	);
	bean_add_meta_box( $meta_box );
}

<?php
/**
 * The file is for displaying page loop for the home template.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

global $emmacounter;

// USE FEATURED IMAGE IF IT"S AVAILABLE
$feat_image    = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$feat_image_bg = get_post_meta( get_the_ID(), '_bean_feat_image_bg', true );

// CONTENT CHECKER
$content = $post->post_content;

if ( ! $content ) {
	$content = ' no-content';
} else {
	$content = '';
}

// BACKGROUND IMAGE/PARRALAX
if ( true == $feat_image && 'on' == $feat_image_bg ) {
	$style = 'style="background-image: url(' . esc_url( $feat_image ) . ');"';
	$img   = ' bg-img';
} else {
	$style = '';
	$img   = '';
}
if ( true == $feat_image && 1 == get_option( 'fresh_site' ) ) {
	$style = 'style="background-image: url(' . esc_url( $feat_image ) . ');"';
	$img   = ' bg-img';
} ?>

<section id="panel<?php echo esc_attr( $emmacounter ); ?>" <?php post_class( 'emma-panel ' ); ?> >

	<div class="page-item<?php echo esc_attr( $content . $img ); ?>" <?php echo balanceTags( $style ); ?>>

		<div class="page-inner">

			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

			<?php if ( $content == '' ) { ?>

				<div class="entry-content">
					<?php
					/* translators: %s: Name of current post */
					the_content(
						sprintf(
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'emma' ),
							get_the_title()
						)
					);
					?>
				</div><!-- END .entry-content -->

			<?php } ?>

			<?php
			if ( get_page_template_slug( get_the_ID() ) ) {
				 $template = get_page_template_slug( $post->ID );
				if ( $template = 'template-rsvp.php' ) {
					get_template_part( 'content', 'rsvp-form' );
					echo '<p class="hidden">&nbsp;</p>';
				}
			}
			?>

		</div><!-- END .page-inner -->

		<?php emma_edit_link( get_the_ID() ); ?>

	</div><!-- END .page-item -->

</section>

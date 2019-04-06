<?php
/**
 * The template for displaying the singular attachment page.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

get_header(); ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
?>

		<div class="entry-content-media">
			<?php $image_info = getimagesize( $post->guid ); ?>
			<img src="<?php echo esc_url( $post->guid ); ?>" alt="<?php esc_attr( the_title() ); ?>" title="<?php esc_attr( the_title() ); ?>" <?php echo esc_attr( $image_info[3] ); ?> />
		</div><!-- END .entry-content-media-->

		<div class="entry-content">
			<h1 class="entry-title"><?php esc_html( the_title() ); ?></h1>
			<ul class="entry-meta"><li><?php esc_html_e( 'Uploaded ', 'emma' ); ?><?php the_time( get_option( 'date_format' ) ); ?></li></ul>
		</div><!-- END .entry-content-->

	<?php
	endwhile;
endif;
wp_reset_postdata();
?>

<?php
get_footer();

<?php
/**
 * The template for displaying all single posts.
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

	<section id="post-<?php the_ID(); ?>">

		<div class="page-item single-page">

			<div class="single-post-content">

			<div class="content-left">

				<?php
				get_template_part( 'template-parts/content-single' );
				get_template_part( 'template-parts/post', 'meta' );
				?>

				<div class="entry-content">

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<?php the_content(); ?>

					<?php
					wp_link_pages(
						array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'emma' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'emma' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						)
					);

					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
						?>

					</div><!-- END .entry-content -->

				</div><!-- END .content-left -->

				<div class="entry-sidebar">

					<?php dynamic_sidebar( 'internal-sidebar' ); ?>

				</div><!-- END .entry-sidebar -->

			</div><!-- END .single-post-content -->

		</div><!-- END .page-item.single-page -->

	</section>

	<?php
	endwhile;
endif;
?>

<?php
get_footer();

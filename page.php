<?php
/**
 * The template for displaying all pages
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

get_header(); ?>

<section id="post-<?php the_ID(); ?>">

	<div class="page-item single-page">

		<div class="page-inner">

			<div class="entry-content">

				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;

				wp_link_pages(
					array(
						'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'emma' ) . '</span>',
						'after'  => '</div>',
					)
				);
				?>

			</div><!-- END .entry-content -->

		</div><!-- END .page-inner -->

	</div><!-- END .page-item.single-page -->

</section>

<?php
get_footer();

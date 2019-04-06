<?php
/**
 * Template Name: RSVP
 * The template for displaying the rsvp template.
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
						'before' => '<div class="page-link"><span>' . __( 'Pages:', 'emma' ) . '</span>',
						'after'  => '</div>',
					)
				);

				get_template_part( 'template-parts/content', 'rsvp' );

				?>

			</div>

		</div>

	</div>

</section>

<?php
get_footer();

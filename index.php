<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

get_header(); ?>

<div id="masonry-container" class="hfeed">
	<?php
	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/post', 'loop' );

		endwhile;

	endif;
	?>
</div>

<div id="page_nav" class="hide">
	<?php next_posts_link(); ?>
</div>

<?php
get_footer();

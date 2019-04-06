<?php
/**
 * The template for displaying Search Results pages
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

get_header(); ?>

	<?php if ( have_posts() ) { ?>

		<div id="masonry-container" class="hfeed">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post', 'loop' );
			endwhile;
endif;
			?>
		</div><!-- END #masonry-container.hfeed -->

		<div id="page_nav" class="hide">
			<?php next_posts_link(); ?>
		</div><!-- END #page_nav -->

	<?php } else { ?>

	<div class="hero">

		<div class="page-item">

			<div class="page-inner fadein">

				<h1 class="entry-title"><?php printf( esc_html__( 'No Results', 'emma' ) ); ?></h1>

				<h4 class="entry-tagline"><?php printf( esc_html__( 'Please Search Again', 'emma' ) ); ?></h4>

				<form method="get" id="searchform" class="searchform search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" name="s" id="s" value="<?php esc_html_e( 'To search type & hit enter', 'emma' ); ?>" onfocus="if(this.value=='<?php esc_html_e( 'To search type & hit enter', 'emma' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php esc_html_e( 'To search type & hit enter', 'emma' ); ?>';" />
				</form><!-- END #searchform -->

			</div><!-- END .page-inner -->

		</div><!-- END .page-item -->

	</div>

	<?php
} //END else

get_footer();

<?php
/**
 * The template for displaying the post template/grid loop.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'template-parts/content-single' ); ?>

	<div class="inner">

		<span class="published">
			<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_time( get_option( 'date_format' ) ); ?></a>
		</span>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( ! post_password_required() ) { ?>
			<p class="entry-excerpt">
				<?php if ( ! is_search() ) { ?>
					<?php echo wp_trim_words( get_the_content(), 15 ); ?>
				<?php } else { ?>
					<?php echo wp_trim_words( get_the_content(), 15 ); ?>
				<?php } ?>
			</p><!-- END .entry-excerpt -->
		<?php } else { ?>
			<?php echo get_the_content(); ?>
		<?php } ?>

	</div><!-- END .inner -->

</article>

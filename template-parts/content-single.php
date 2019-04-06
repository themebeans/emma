<?php
/**
 * The template for displaying posts in the standard post format.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

if ( has_post_thumbnail() ) { ?>

	<div class="entry-content-media">

		<div class="post-thumb">

			<?php if ( is_singular() ) { ?>

				<?php the_post_thumbnail( 'post-feat' ); ?>

			<?php } else { ?>

				<a title="<?php printf( __( 'Permanent Link to %s', 'emma' ), get_the_title() ); ?>" href="<?php esc_url( the_permalink() ); ?>">
					<?php the_post_thumbnail( 'grid-feat' ); ?>
				</a>

			<?php } ?>

		</div><!-- END .post-thumb -->

	</div><!-- END .entry-content-media -->

<?php
}

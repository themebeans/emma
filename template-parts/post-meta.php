<?php
/**
 * The file is for displaying the blog post meta.
 * This has it's own content file because we call it among various post formats.
 * If you edit this file, its output will be edited on all post formats.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

?>
<ul class="entry-meta">

	<li><a href="<?php esc_url( the_permalink() ); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'emma' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><span><?php esc_html_e( 'Date:', 'emma' ); ?></span> <?php the_time( get_option( 'date_format' ) ); ?></a></li>

	<li><span><?php esc_html_e( 'Posted in:', 'emma' ); ?></span><?php the_category( ', ' ); ?></li>

	<?php if ( has_tag() ) { ?>
		<li><span><?php esc_html_e( 'Tags:', 'emma' ); ?></span><?php echo the_tags( '#', '&nbsp;#', '' ); ?> </li>
	<?php } ?>

	<li><?php edit_post_link( esc_html__( '[Edit]', 'emma' ), '', '' ); ?></li>

</ul><!-- END .entry-meta -->

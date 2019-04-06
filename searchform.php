<?php
/**
 * The template for displaying the default searchform whenever it is called in the theme.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */
	?>

<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" id="s" value="<?php esc_attr( 'To search type & hit enter', 'emma' ); ?>" onfocus="if(this.value=='<?php esc_attr( 'To search type & hit enter', 'emma' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php esc_attr( 'To search type & hit enter', 'emma' ); ?>';" />
</form><!-- END #searchform -->

<?php
/**
 * The header for our theme.
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>

	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>

	<?php if ( has_nav_menu( 'mobile-menu' ) ) : ?>
		<nav id="mobile-nav">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'mobile-menu',
				)
			);
			?>
		</nav><!-- END #mobile-nav -->
	<?php endif; ?>

	<?php if ( ! is_404() ) { ?>

		<header class="header headerintro">

			<?php emma_site_logo(); ?>

			<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
			<nav class="nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary-menu',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'sf-menu main-menu',
					)
				);
				?>
			</nav>
			<?php endif; ?>

		</header>

	<?php } ?>

	<?php if ( is_singular( 'page' ) && ! is_home() ) : ?>

		<div class="hero">

			<?php
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			if ( $feat_image ) {
				$style = 'style="background-image: url(' . esc_url( $feat_image ) . ');"';
				$img   = ' bg-img';
			} else {
				$style = '';
				$img   = '';
			}

			$allowed_html = array(
				'style' => array(
					'background-image' => array(),
				),
			);
			?>
			<div class="page-item parallax <?php echo esc_attr( $img ); ?>" <?php echo wp_kses( $style, $allowed_html ); ?>>

				<div class="page-inner fadein">

					<h1 class="entry-title">
						<?php
						if ( emma_is_frontpage() ) {
							echo esc_html( get_theme_mod( 'home_title', esc_html__( 'Emma & Avery', 'emma' ) ) );
						} else {
							echo esc_html( stripslashes( emma_page_title() ) );
						}
						?>
					</h1>

					<?php
					if ( emma_is_frontpage() ) {

						echo '<h3 class="entry-subtitle">' . esc_html( get_theme_mod( 'home_subtitle', esc_html__( 'Are Getting Married', 'emma' ) ) ) . '</h3>';
						echo '<h4 class="entry-date">' . esc_html( get_theme_mod( 'home_date', esc_html__( 'November 21, 2017', 'emma' ) ) ) . '</h4>';

						while ( have_posts() ) :
							the_post();
							the_content();
						endwhile;

					} else {
						$page_tagline = get_post_meta( $post->ID, '_bean_page_tagline', true );

						if ( $page_tagline ) {
							echo '<h4 class="entry-tagline">' . esc_html( $page_tagline ) . '</h4>';
						}
					}
					?>

				</div>

			</div>

		</div>

	<?php endif; ?>

	<main>

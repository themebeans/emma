<?php
/**
 * Starter Content
 *
 * See: https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

if ( ! function_exists( 'emma_starter_content' ) ) :
	/**
	 * Define starter content for the theme.
	 */
	function emma_starter_content() {

		add_theme_support(
			'starter-content', array(

				'options'     => array(
					'show_on_front'   => 'page',
					'page_on_front'   => '{{home}}',
					'page_for_posts'  => '{{blog}}',
					'blogname'        => _x( 'Emma', 'Theme starter content', 'emma' ),
					'blogdescription' => _x( 'A WordPress theme by ThemeBeans', 'Theme starter content', 'emma' ),
				),

				'attachments' => array(
					'home-img'          => array(
						'post_title' => _x( 'Home Featured Image', 'Theme starter content', 'emma' ),
						'file'       => 'assets/starter-content/home.jpg',
					),
					'rsvp-img'          => array(
						'post_title' => _x( 'RSVP Featured Image', 'Theme starter content', 'emma' ),
						'file'       => 'assets/starter-content/rsvp.jpg',
					),
					'she-said-yes-img'  => array(
						'post_title' => _x( 'She Said Yes Featured Image', 'Theme starter content', 'emma' ),
						'file'       => 'assets/starter-content/she-said-yes.jpg',
					),
					'registry-img'      => array(
						'post_title' => _x( 'Registry Featured Image', 'Theme starter content', 'emma' ),
						'file'       => 'assets/starter-content/registry.jpg',
					),
					'wedding-gifts-img' => array(
						'post_title' => _x( 'Wedding Gifts Featured Image', 'Theme starter content', 'emma' ),
						'file'       => 'assets/starter-content/wedding-gifts.jpg',
					),
				),

				'posts'       => array(
					'blog',
					'home'          => array(
						'post_type'    => 'page',
						'post_title'   => _x( 'Home', 'Theme starter content', 'emma' ),
						'thumbnail'    => '{{home-img}}',
						'post_content' => '',

					),
					'rsvp'          => array(
						'post_type'    => 'page',
						'post_title'   => _x( 'RSVP', 'Theme starter content', 'emma' ),
						'post_content' => 'Our wedding day is coming up quickly and we really hope you can join us for our big day. Please RSVP below by January 1st to let us know if you will be there. Cheers!',
						'thumbnail'    => '{{rsvp-img}}',
						'template'     => 'template-rsvp.php',
					),
					'registry'      => array(
						'post_type'    => 'page',
						'post_title'   => _x( 'Registry', 'Theme starter content', 'emma' ),
						'post_content' => 'Add your registry using our official registry plugin, Wedding Registry. Each registry link is added via the shortcode dropdown menu. Select your registry stores and add your links. Easy peasy.',
						'thumbnail'    => '{{registry-img}}',
					),
					'he-proposed'   => array(
						'post_type'    => 'page',
						'post_title'   => _x( 'He Proposed', 'Theme starter content', 'emma' ),
						'post_content' => 'On our trip to Yosemite, Avery stepped away, got down on one knee, and asked me to marry him. I was so awestruck, confused and surprised at the same time as he stood there ring in hand.<br><br>It took a moment to process, I reached for the ring, and Avery reminded me that I hadn\'t said yes. With tears in my eyes I shouted:<br><br><blockquote>Yes! Yes of course! Yes!</blockquote>',
					),
					'she-said-yes'  => array(
						'post_type'    => 'page',
						'post_title'   => _x( 'She Said Yes!', 'Theme starter content', 'emma' ),
						'post_content' => '',
						'thumbnail'    => '{{she-said-yes-img}}',
					),
					'the-big-day'   => array(
						'post_type'    => 'page',
						'post_title'   => _x( 'The Big Day', 'Theme starter content', 'emma' ),
						'post_content' => 'Coming to our wedding on November 9, 2015? Well here are the details on the big day and do not forget to RSVP. See you there!<br><br><h6>Ceremony - 3:30pm</h6><br>The White Oaks Barn<br>658 Ranch Road<br>Dahlonega, Georgia 30533<br><br><h6>Reception - 4:30pm</h6><br>Also at the White Oaks Barn',
					),
					'wedding-gifts' => array(
						'post_type'    => 'page',
						'post_title'   => _x( 'Wedding Gifts', 'Theme starter content', 'emma' ),
						'post_content' => 'You do not need to bring us gifts, your company at our wedding is enough! Though if you really want to, we are registered at the following stores.',
						'thumbnail'    => '{{wedding-gifts-img}}',
					),
				),

				'nav_menus'   => array(
					'primary-menu' => array(
						'name'  => __( 'Primary Menu', 'emma' ),
						'items' => array(
							'page_rsvp'     => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{rsvp}}',
							),
							'page_registry' => array(
								'type'      => 'post_type',
								'object'    => 'page',
								'object_id' => '{{registry}}',
							),
							'page_blog',
						),
					),
				),

				'widgets'     => array(
					'internal-sidebar' => array(
						'text_menu' => [
							'text',
							[
								'title' => _x( 'Emmma', 'Theme starter content', 'emma' ),
								'text'  => _x( 'An exceptionally beautiful engagement & wedding WordPress theme, built for displaying your special occasion\'s details and collecting your RSVPs.', 'Theme starter content', 'emma' ),
							],
						],
					),
				),

				'theme_mods'  => array(
					'home_section_1' => '{{he-proposed}}',
					'home_section_2' => '{{she-said-yes}}',
					'home_section_3' => '{{the-big-day}}',
					'home_section_4' => '{{wedding-gifts}}',
				),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'emma_starter_content' );

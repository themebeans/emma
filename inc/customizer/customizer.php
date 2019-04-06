<?php
/**
 * Theme Customizer functionality
 *
 * @package     Emma
 * @link        https://themebeans.com/themes/emma
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function emma_customize_register( $wp_customize ) {

	/**
	 * Remove unnecessary controls.
	 */
	$wp_customize->remove_control( 'site_logo_header_text' );
	$wp_customize->remove_section( 'background_image' );

	$wp_customize->get_control( 'background_color' )->label   = esc_html__( 'Background', 'emma' );
	$wp_customize->get_setting( 'background_color' )->default = '#ffffff';

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_panel(
		'emma_theme_options', array(
			'title'       => esc_html__( 'Theme Options', 'emma' ),
			'description' => esc_html__( 'Customize various options throughout the theme with the settings within this panel.', 'emma' ),
			'priority'    => 30,
		)
	);

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );

	/**
	 * Add the site logo max-width option to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => '50',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => '50',
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Logo Max Width', 'emma' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	/**
	 * Theme Customizer Sections.
	 * For more information on Theme Customizer settings and default sections:
	 *
	 * @see https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */

	/**
	 * Add the contact section.
	 */
	$wp_customize->add_section(
		'emma_home', array(
			'title' => esc_html__( 'Home', 'emma' ),
			'panel' => 'emma_theme_options',
		)
	);

	$wp_customize->add_setting(
		'home_title', array(
			'default'           => esc_html__( 'Emma & Avery', 'emma' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'home_title',
		array(
			'label'    => esc_html__( 'Title', 'emma' ),
			'section'  => 'emma_home',
			'type'     => 'text',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'home_subtitle', array(
			'default'           => esc_html__( 'Are Getting Married', 'emma' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'home_subtitle',
		array(
			'label'    => esc_html__( 'Subtitle', 'emma' ),
			'section'  => 'emma_home',
			'type'     => 'text',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'home_date', array(
			'default'           => esc_html__( 'November 21, 2017', 'emma' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		'home_date',
		array(
			'label'    => esc_html__( 'Date', 'emma' ),
			'section'  => 'emma_home',
			'type'     => 'text',
			'priority' => 1,
		)
	);

	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $num_sections integer
	 */
	$num_sections = apply_filters( 'emma_front_page_sections', 6 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting(
			'home_section_' . $i, array(
				'default'           => false,
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'home_section_' . $i, array(
				/* translators: %d is the front page section number */
				'label'           => sprintf( __( 'Home Section %d', 'emma' ), $i ),
				'description'     => ( 1 !== $i ? '' : __( 'Select pages to feature in on your home page. Add an image to a section by setting a featured image in the page editor.', 'emma' ) ),
				'section'         => 'emma_home',
				'type'            => 'dropdown-pages',
				'allow_addition'  => true,
				'active_callback' => 'emma_is_static_front_page',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'home_section_' . $i, array(
				'selector'            => '#panel' . $i,
				'render_callback'     => 'emma_front_page_section',
				'container_inclusive' => true,
			)
		);
	}

	$wp_customize->add_setting(
		'theme_accent_color', array(
			'default'           => '#B690C7',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'theme_accent_color', array(
				'label'   => esc_html__( 'Accent', 'emma' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'css_filter', array(
			'default'           => 'none',
			'sanitize_callback' => 'select',
		)
	);

	$wp_customize->add_control(
		'css_filter', array(
			'type'        => 'select',
			'label'       => esc_html__( 'CSS3 Filter', 'emma' ),
			'description' => esc_html__( 'Enable the CSS filtering effect on posts. Please note that this only works in modern browsers.', 'emma' ),
			'section'     => 'colors',
			'choices'     => array(
				'none'      => esc_html__( 'None', 'emma' ),
				'grayscale' => esc_html__( 'Black and White', 'emma' ),
				'sepia'     => esc_html__( 'Sepia', 'emma' ),
			),
		)
	);

	/**
	 * Add the contact section.
	 */
	$wp_customize->add_section(
		'emma_contact', array(
			'title' => esc_html__( 'RSVP', 'emma' ),
			'panel' => 'emma_theme_options',
		)
	);

		$wp_customize->add_setting(
			'contact_email', array(
				'default'           => '',
				'sanitize_callback' => 'is_email',
			)
		);

		$wp_customize->add_control(
			'contact_email', array(
				'type'        => 'email',
				'label'       => esc_html__( 'Email Address', 'emma' ),
				'description' => esc_html__( 'Enter the email address you would like the RSVP form to send to.', 'emma' ),
				'section'     => 'emma_contact',
			)
		);

	/**
	 * Set transports for the Customizer.
	 */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

}
add_action( 'customize_register', 'emma_customize_register', 11 );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function emma_customize_preview_js() {
	wp_enqueue_script( 'emma-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . EMMA_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'emma_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function emma_customize_controls_js() {
	wp_enqueue_script( 'emma-customize-controls', get_theme_file_uri( '/assets/js/admin/customize-controls' . EMMA_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'emma_customize_controls_js' );

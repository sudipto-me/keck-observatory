<?php
// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {
	// Set a unique slug-like ID
	$prefix = 'theme-options';
	// Create options
	CSF::createOptions( $prefix, array(
		'framework_title' => esc_html__( 'Theme Options', 'keck-observatory' ),
		'menu_title'      => esc_html__( 'Theme Options', 'keck-observatory' ),
		'menu_slug'       => 'theme_options',
		'theme'           => 'light'
	) );

	// Create a section
	CSF::createSection( $prefix, array(
		'title'  => 'Header',
		'fields' => array(
			// favicon
			array(
				'type'    => 'content',
				'content' => __( 'To upload favicon go to <strong>Appearance->Customize->Site Identity->Site Icon</strong>', 'keck-observatory' ),
				'title'   => 'Favicon',
			),
			// header logo
			array(
				'id'    => 'theme-header-logo',
				'type'  => 'media',
				'title' => __( 'Site Logo', 'keck-observatory' ),
			),
			array(
				'id'    => 'theme-cta',
				'type'  => 'link',
				'title' => __( 'Donate Page URL', 'keck-observatory' )
			),
			array(
				'id'    => 'theme-header-script',
				'type'  => 'code_editor',
				'title' => esc_html__( 'Header Script', 'keck-observatory' ),
			)
		)
	) );
	// footer
	CSF::createSection( $prefix, array(
		'title'  => 'Footer',
		'fields' => array(
			array(
				'id'    => 'theme-footer-top-heading',
				'type'  => 'text',
				'title' => __( 'Footer Top Title', 'keck-observatory' ),
			),
			array(
				'id'    => 'theme-footer-top-subheading',
				'type'  => 'text',
				'title' => __( 'Footer Top Sub Title', 'keck-observatory' ),
			),
			array(
				'id'    => 'theme-footer-top-newsletter-form',
				'type'  => 'wp_editor',
				'title' => __( 'Newsletter form shortcode', 'keck-observatory' ),
			),
			// copyright
			array(
				'id'    => 'theme-copyright-content',
				'type'  => 'wp_editor',
				'title' => esc_html__( 'Copyright content', 'keck-observatory' ),
			),
			//footer javascript
			array(
				'id'    => 'theme-footer-script',
				'type'  => 'code_editor',
				'title' => esc_html__( 'Footer Script', 'keck-observatory' ),
			)
		)
	) );

	// Create social section
	CSF::createSection( $prefix, array(
		'title'  => 'Social',
		'fields' => array(
			array(
				'id'     => 'theme-social-repeater',
				'type'   => 'repeater',
				'title'  => 'Social Links',
				'fields' => array(
					array(
						'id'    => 'social-icon',
						'type'  => 'text',
						'title' => __( 'Icon', 'keck-observatory' )
					),
					array(
						'id'    => 'social-link',
						'type'  => 'text',
						'title' => __( 'Link', 'keck-observatory' )
					),
				),
			),
		)
	) );
}

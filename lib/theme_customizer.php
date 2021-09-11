<?php

function keck_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'theme-logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_logo',
			array(
				'label'    => 'Upload Logo',
				'section'  => 'title_tagline',
				'settings' => 'theme-logo',
			) )
	);

	$wp_customize->add_setting( 'donate-page' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'donate_page',
		array(
			'label' => 'Donate Page',
			'section' => 'title_tagline',
			'settings' => 'donate-page'
		)
	));

}

add_action( 'customize_register', 'keck_customize_register' );
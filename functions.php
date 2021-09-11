<?php
/**
 * Codestar Framework
 */
require_once get_theme_file_path( '/lib/csf/codestar-framework/codestar-framework.php' );
/**
 * Admin Options
 */
// require_once get_theme_file_path( '/lib/csf/admin-options.php' );

/**
 * Bootstrap Nav Walker for this theme.
 */
require_once get_theme_file_path( '/lib/wp_bootstrap_navwalker.php' );
/**
 * Theme shortcode
 */
require_once get_theme_file_path( '/lib/theme_shortcode.php' );
/**
 * Theme metabox
 */
require_once get_theme_file_path( '/lib/theme_metabox.php' );

require_once get_theme_file_path( '/classes/class-twentytwenty-walker-comment.php' );

//edd custom files
require_once get_theme_file_path( '/lib/script-functions.php' );
require_once get_theme_file_path( '/lib/widget-functions.php' );
require_once get_theme_file_path( '/lib/theme-functions.php' );
require_once get_theme_file_path( '/lib/theme_customizer.php' );

// Define constants
define( 'KECK_OBSERVATORY_THEME_VERSION', '1.0.0' );

/**
 * Custom Login Functions
 */
//require_once get_theme_file_path( '/lib/login_functions.php' );


/* -----------------------------------------------------------------------------
* Excerpt Length
* -------------------------------------------------------------------------- */
function excerpt_length_callback_function() {
	return 25;
}

/* -----------------------------------------------------------------------------
* Excerpt More
* -------------------------------------------------------------------------- */
function read_more_callback_function() {
	return '...';
}

// register a new widget category in elementor
function register_custom_widget_category( $elements_manager ) {
	$elements_manager->add_category(
		'keck-observatory',
		array(
			'title' => __( 'Keck Observatory', 'keck-observatory' ),
			'icon'  => 'fa fa-plug',
		)

	);
}

add_action( 'elementor/elements/categories_registered', 'register_custom_widget_category' );

//register custom widget in elementor
function register_custom_widgets( $elementor ) {
	require_once get_stylesheet_directory() . '/elementor/community-widgets.php';
	require_once get_stylesheet_directory() . '/elementor/testimonial-widgets.php';

	$elementor->register_widget_type( new \KeckObservatory\Elementor\Community_Slider );
	$elementor->register_widget_type( new \KeckObservatory\Elementor\Testimonial_Slider );
}

add_action( 'elementor/widgets/widgets_registered', 'register_custom_widgets' );






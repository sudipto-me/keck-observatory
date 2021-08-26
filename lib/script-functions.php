<?php
/* -----------------------------------------------------------------------------
* Enqueue Scripts
* -------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts_callback_function' );
function theme_enqueue_scripts_callback_function() {
	$themeTemplateDirectoryUrl = get_template_directory_uri();
	wp_enqueue_style( 'custom-google-fonts', '//fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;1,400;1,700&display=swap', false );
	wp_enqueue_style( 'custom-header-fonts', '//fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap', false );
	wp_enqueue_style( 'keck-observatory-bootstrap', $themeTemplateDirectoryUrl . '/assets/css/bootstrap.min.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	wp_enqueue_style( 'keck-observatory-fontawesome', $themeTemplateDirectoryUrl . '/assets/css/font-awesome.min.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	wp_enqueue_style( 'keck-observatory-owl', $themeTemplateDirectoryUrl . '/assets/css/owl.carousel.min.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	if ( is_front_page() ) {
		wp_enqueue_style( 'keck-observatory-home-css', $themeTemplateDirectoryUrl . '/assets/css/home.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	}
	if ( is_page() || is_page_template() ) {
		wp_enqueue_style( 'keck-observatory-page', $themeTemplateDirectoryUrl . '/assets/css/page.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	}
	if ( is_home() || is_archive() || is_search() || is_author() || is_category() || is_single() || is_tag() || 'post' == get_post_type() ) {
		wp_enqueue_style( 'keck-observatory-blog', $themeTemplateDirectoryUrl . '/assets/css/blog.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	}
	wp_enqueue_style( 'keck-observatory-main', $themeTemplateDirectoryUrl . '/assets/css/main.css', '', KECK_OBSERVATORY_THEME_VERSION, 'all' );
	wp_enqueue_style( 'keck-observatory-custom', $themeTemplateDirectoryUrl . '/style.css' );
	wp_enqueue_style( 'keck-observatory-responsive', $themeTemplateDirectoryUrl . '/assets/css/responsive.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	if ( ! is_admin() && ! wp_script_is( 'jquery' ) ) {
		wp_enqueue_script( 'jquery' );
	}
	wp_enqueue_script( 'keck-observatory-bootstrap', $themeTemplateDirectoryUrl . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), KECK_OBSERVATORY_THEME_VERSION, true );
	wp_enqueue_script( 'keck-observatory-owl', $themeTemplateDirectoryUrl . '/assets/js/owl.carousel.min.js', array( 'jquery' ), KECK_OBSERVATORY_THEME_VERSION, true );
	wp_enqueue_script( 'keck-observatory-main', $themeTemplateDirectoryUrl . '/assets/js/main.js', array( 'jquery' ), KECK_OBSERVATORY_THEME_VERSION, true );
}
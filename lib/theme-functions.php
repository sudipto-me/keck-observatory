<?php
/* -----------------------------------------------------------------------------
* After Theme Setup
* -------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'support_theme_features' );
function support_theme_features() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
	) );
	add_theme_support( 'title-tag' );
	add_filter( 'excerpt_length', 'excerpt_length_callback_function' );
	add_filter( 'excerpt_more', 'read_more_callback_function' );
	add_filter( 'widget_text', 'do_shortcode' );
	register_nav_menus( array(
		'primary_navigation' => __( 'Primary Navigation', 'abcd' ),
		'footer_navigation'  => __( 'Footer Navigation', 'abcd' ),
		'my-account'         => __( 'My Account', 'abcd' ),
	) );
	//load_theme_textdomain( 'biermann' , get_template_directory().'/languages' );
	if ( current_user_can( 'edd_subscriber' ) ) {
		show_admin_bar( false );
	}
}

add_filter( 'wp_nav_menu_items', 'keck_add_menu_item', 10, 2 );
/**
 * Add Menu Item to end of menu
 *
 * @param mixed  $items Items
 * @param object $args  Arguments
 *
 * @return mixed
 */
function keck_add_menu_item( $items, $args ) {
	$theme_options   = get_option( 'theme-options' );
	$header_btn_url  = ( ! empty( $theme_options['theme-cta']['url'] ) ) ? $theme_options['theme-cta']['url'] : '#';
	$header_btn_text = ( ! empty( $theme_options['theme-cta']['text'] ) ) ? $theme_options['theme-cta']['text'] : __( 'Donate', 'keck-observatory' );
	$items           .= '<li class="site_cta"><a href="' . $header_btn_url . '">' . $header_btn_text . '</a>';

	return $items;
}
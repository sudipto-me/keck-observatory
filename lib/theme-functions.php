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
		'primary_navigation' => __( 'Primary Navigation', 'keck-observatory' ),
		'footer_social_menu'  => __( 'Footer Social Menu', 'keck-observatory' ),
	) );
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
	if ( 'slug' === $args->menu->slug ) {
		$header_btn_url  = ( ! empty( get_theme_mod( 'donate-page' ) ) ) ? get_theme_mod( 'donate-page' ) : '#';
		$items           .= '<li class="site_cta"><a href="' . $header_btn_url . '">' . esc_html__( 'Donate', 'keck-observatory' ) . '</a>';
	}


	return $items;
}
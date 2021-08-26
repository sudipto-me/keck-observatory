<?php
add_action( 'widgets_init', 'widgets_callback_function' );
function widgets_callback_function() {
	register_sidebar(
		array(
			'name'          => __( 'General Sidebar', 'keck-observatory' ),
			'id'            => 'general-sidebar',
			'description'   => '',
			'class'         => 'sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'keck-observatory' ),
			'id'            => 'blog-sidebar',
			'description'   => '',
			'class'         => 'sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area 1', 'keck-observatory' ),
			'id'            => 'footer-widget-area-1',
			'description'   => '',
			'class'         => 'sidebar',
			'before_widget' => '<aside id="%1$s" class="footer-content %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget_title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area 2', 'keck-observatory' ),
			'id'            => 'footer-widget-area-2',
			'description'   => '',
			'class'         => 'sidebar',
			'before_widget' => '<aside id="%1$s" class="footer-content %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget_title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area 3', 'keck-observatory' ),
			'id'            => 'footer-widget-area-3',
			'description'   => '',
			'class'         => 'sidebar',
			'before_widget' => '<aside id="%1$s" class="footer-content %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget_title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area 4', 'keck-observatory' ),
			'id'            => 'footer-widget-area-4',
			'description'   => '',
			'class'         => 'sidebar',
			'before_widget' => '<aside id="%1$s" class="footer-content %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget_title">',
			'after_title'   => '</h3>',
		)
	);
}
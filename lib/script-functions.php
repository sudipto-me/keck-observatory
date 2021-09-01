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
	// wp_enqueue_style( 'keck-observatory-owl', $themeTemplateDirectoryUrl . '/assets/css/owl.carousel.min.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	wp_enqueue_style( 'keck-observatory-slick', $themeTemplateDirectoryUrl . '/assets/css/slick-theme.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	wp_enqueue_style( 'keck-observatory-jquery-modal', $themeTemplateDirectoryUrl . '/assets/css/jquery.modal.min.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	if ( is_front_page() ) {
		wp_enqueue_style( 'keck-observatory-home-css', $themeTemplateDirectoryUrl . '/assets/css/home.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	}
	if ( is_page() || is_page_template() ) {
		wp_enqueue_style( 'keck-observatory-page', $themeTemplateDirectoryUrl . '/assets/css/page.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	}
	if ( is_home() || is_archive() || is_search() || is_author() || is_category() || is_single() || is_tag() || 'post' == get_post_type() || is_page_template( 'page-news.php' ) || is_page_template( 'page-full-width.php' ) || is_page_template( 'page-with-sidebar.php' ) ) {
		wp_enqueue_style( 'keck-observatory-blog', $themeTemplateDirectoryUrl . '/assets/css/blog.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	}
	wp_enqueue_style( 'keck-observatory-main', $themeTemplateDirectoryUrl . '/assets/css/main.css', '', KECK_OBSERVATORY_THEME_VERSION, 'all' );
	wp_enqueue_style( 'keck-observatory-custom', $themeTemplateDirectoryUrl . '/style.css' );
	wp_enqueue_style( 'keck-observatory-responsive', $themeTemplateDirectoryUrl . '/assets/css/responsive.css', array(), KECK_OBSERVATORY_THEME_VERSION, 'all' );
	if ( ! is_admin() && ! wp_script_is( 'jquery' ) ) {
		wp_enqueue_script( 'jquery' );
	}
	wp_enqueue_script( 'keck-observatory-bootstrap', $themeTemplateDirectoryUrl . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), KECK_OBSERVATORY_THEME_VERSION, true );
	// wp_enqueue_script( 'keck-observatory-owl', $themeTemplateDirectoryUrl . '/assets/js/owl.carousel.min.js', array( 'jquery' ), KECK_OBSERVATORY_THEME_VERSION, true );
	wp_enqueue_script( 'keck-observatory-slick', $themeTemplateDirectoryUrl . '/assets/js/slick.min.js', array( 'jquery' ), KECK_OBSERVATORY_THEME_VERSION, true );
	wp_enqueue_script( 'keck-observatory-jquery-modal', $themeTemplateDirectoryUrl . '/assets/js/jquery.modal.min.js', array( 'jquery' ), KECK_OBSERVATORY_THEME_VERSION, true );
	wp_enqueue_script( 'keck-observatory-main', $themeTemplateDirectoryUrl . '/assets/js/main.js', array( 'jquery' ), KECK_OBSERVATORY_THEME_VERSION, true );
	wp_localize_script( 'keck-observatory-main', 'carousel_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

function load_featured_carousel() {
	$carousel_id = $_REQUEST['carousel_id'];
	$post_args = array(
		'post_type' => 'post',
		'posts_per_page' => 1,
		'post_status' => 'publish',
		'post__in' => array( $carousel_id ),
	);

	$posts = get_posts( $post_args );
	if ( is_array( $posts ) && !empty( $posts ) ) {
		foreach( $posts as $post ) {

			if ( has_post_thumbnail( $post ) ) {
				$thumbImage = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			} else {
				$thumbImage = get_template_directory_uri() . '/assets/img/featured-post.jpg';
			}
			$image_alt        = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
			$image_alt        = ( empty( $image_alt ) ) ? get_the_title( $post->ID ) : $image_alt;
			$attachment_title = get_the_title( get_post_thumbnail_id( $post->ID ) );
			echo '<div class="post_img">';
			echo '<a href="' . get_the_permalink( $post->ID ) . '" class="link">';
			echo '<img src="' . $thumbImage . '" class="img-fluid img" title="' . $attachment_title . '" alt="' . $image_alt . '"></a>';
			echo '<span class="featured_tag">' . __( 'Featured Videos', 'keck-observatory' ) . '</span>';
			echo '</div>';
			echo '<div class="post_content">';
			echo '<span class="featured_tag">' . __( 'Featured Videos', 'keck-observatory' ) . '</span>';
			echo '<p class="date">' . date( 'F j, Y', strtotime( $post->post_date ) ) . '</p>';;
			echo '<div class="description"><a href="' . get_the_permalink( $post->ID ) . '"><h2 class="featured_title">' . get_the_title( $post->ID ) . '</h2></a><p>' . wp_trim_words( $post->post_content, 11, '.' ) . '</p></div>';
			echo '</div>';
		}
	}
	die();
}
add_action('wp_ajax_load_featured_carousel', 'load_featured_carousel');
add_action('wp_ajax_nopriv_load_featured_carousel','load_featured_carousel');
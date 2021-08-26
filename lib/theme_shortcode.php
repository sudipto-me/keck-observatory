<?php
/**
 * Footer Social Shortcode
 */
function footer_social_shortcode_callback( $atts, $content = null ) {
	ob_start();
	$theme_options = get_option( 'theme-options' );
	$social_links  = $theme_options['theme-social-repeater'];

	if ( is_array( $social_links ) && ! empty( $social_links ) ) { ?>
        <ul class="footer_social">
			<?php
			foreach ( $social_links as $social ) {
				if ( isset( $social['social-link'] ) && ! empty( $social['social-link'] ) ) {
					?>
                    <li><a href="<?php echo $social['social-link']; ?>"><i class="<?php echo $social['social-icon']; ?>" aria-hidden="true"></i></a></li>
					<?php
				}
			}
			?>
        </ul>
		<?php
	}

	return ob_get_clean();
}

add_shortcode( 'social_links', 'footer_social_shortcode_callback' );

/*
* display year shortcode
*/
add_shortcode( 'display_year', 'display_year_shortcode_callback' );
function display_year_shortcode_callback() {
	return date( 'Y' );
}

/**
 * recent posts shortcode
 */
add_shortcode( 'home_recent_post', 'custom_recent_post_shortcode_callback' );
function custom_recent_post_shortcode_callback( $attrs, $content = null ) {
	ob_start();
	$posts_per_page = ! empty( $attrs['count'] ) ? $attrs['count'] : 3;
	$posts          = get_posts( array(
		'post_type'      => 'post',
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC'
	) );
	if ( $posts ) { ?>
        <div class="home_recent_posts">
        <div class="row">
		<?php
		foreach ( $posts as $post ) {
			?>
			<div class="col-lg-4 col-md-6 col-sm-12">
                <div class="recent_post">
			<?php
			$categories     = get_the_terms( $post, 'category' );
			$category_url   = ( $categories ) ? get_term_link( $categories[0] ) : '#';
			$category_title = ( $categories ) ? $categories[0]->name : '';
			?>
            <div class="recent_post_img">
				<?php
				$image_alt        = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
				$image_alt        = ( empty( $image_alt ) ) ? get_the_title( $post->ID ) : $image_alt;
				$attachment_title = get_the_title( get_post_thumbnail_id( $post->ID ) );
				$thumbImage       = get_post_thumbnail_id( $post->ID ) ? $thumbImage = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) : get_template_directory_uri() . '/assets/img/home-post.jpg';
				?>
				<a href="<?php echo get_the_permalink( $post->ID ); ?>" class="post-link"></a>
                <img src="<?php echo esc_url( $thumbImage ); ?>" alt="<?php echo $image_alt; ?>" class="img-fluid">
                <button class="arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                <a href="<?php echo esc_url( $category_url ); ?>" class="category-link"><?php echo esc_attr( $category_title ); ?></a>
            </div>
            <div class="recent_post_content">
                <p class="date"><?php echo date( 'F j, Y', strtotime( $post->post_date ) ); ?></p>
                <a href="<?php echo get_the_permalink( $post->ID ); ?>"><h2 class="title"><?php echo $post->post_title; ?></h2></a>
            </div>
            </div>
            </div>

			<?php
		}
		echo '</div></div>';
	}

	return ob_get_clean();
}

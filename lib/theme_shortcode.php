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

/**
 * Sidebar social options shortcode
 */
add_shortcode( 'follow_us', 'follow_us_shortcode_callback' );
function follow_us_shortcode_callback( $attrs, $content = null ) {
	ob_start();
	?>
	<?php
	$theme_options = get_option( 'theme-options' );
	$social_links  = $theme_options['theme-social-repeater'];
	if ( is_array( $social_links ) && ! empty( $social_links ) ) { ?>
        <div class="social-wrapper">
            <h2 class="sidebar-title"><?php echo esc_attr__( 'Follow Us', 'keck-observatory' ); ?></h2>
            <ul class="sidebar-social">
				<?php foreach ( $social_links as $social ) { ?>
                    <li><a href="<?php echo $social['social-link']; ?>"><i class="<?php echo $social['social-icon']; ?>" aria-hidden="true"></i></a></li>
				<?php } ?>
            </ul>
        </div>

		<?php
	}

	return ob_get_clean();
}

/**
 * Popular posts shortcode
 */
add_shortcode( 'popular_posts', 'popular_posts_shortcode_callback' );
function popular_posts_shortcode_callback( $attrs, $content = null ) {
	ob_start();
	?>
	<?php
	$posts = get_posts(
		array(
			'post_type'      => 'post',
			'post_status'    => 'status',
			'posts_per_page' => - 1,
		)
	);
	if ( $posts ) {
		echo '<div class="popular_post_wrapper">';
		foreach ( $posts as $post ) {
			$show_in_sidebar = get_field( 'show_in_sidebar', $post->ID );
			error_log( print_r( $show_in_sidebar, true ) );
			if ( 'yes' === $show_in_sidebar ) {
				echo '<div class="popular_post">';
				if ( has_post_thumbnail() ) {
					$thumbImage = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				} else {
					$thumbImage = get_template_directory_uri() . '/assets/img/popular-post.jpg';
				}
				$image_alt        = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
				$image_alt        = ( empty( $image_alt ) ) ? get_the_title( $post->ID ) : $image_alt;
				$attachment_title = get_the_title( get_post_thumbnail_id( $post->ID ) );
				echo '<div class="popular_post_img">';
				echo '<a href="' . get_the_permalink( $post->ID ) . '"><img src="' . $thumbImage . '" alt="' . $image_alt . '" class="img-fluid"></a>';
				echo '</div>';
				echo '<div class="popular_post_content">';
				echo '<p class="date">' . date( 'F j, Y', strtotime( $post->post_date ) ) . '</p>';
				echo '<a href="' . get_the_permalink( $post->ID ) . '"><h2 class="title">' . $post->post_title . '</h2></a>';
				echo '</div>';
				echo '</div>';
			}
		}
		echo '</div>';
	}
	?>
	<?php
	return ob_get_clean();
}

/**
 * Sidebar Subscribe now shortcode
 */
function join_newsletter_shortcode_callback( $attrs, $content = null ) {
	ob_start();
	$theme_options        = get_option( 'theme-options' );
	$footer_top_title     = ( ! empty( $theme_options['theme-footer-top-heading'] ) ) ? $theme_options['theme-footer-top-heading'] : __( 'Be part of our mission', 'keck-observatory' );
	$footer_top_sub_title = ( ! empty( $theme_options['theme-footer-top-subheading'] ) ) ? $theme_options['theme-footer-top-subheading'] : __( 'Join our newsletter', 'keck-observatory' );
	echo '<div class="join-newsletter">';
	echo '<h2>' . esc_attr( $footer_top_title ) . '</h2>';
	echo '<p>' . esc_attr( $footer_top_sub_title ) . '</p>';
	echo '<div class="subscribe-form">' . do_shortcode( $theme_options['theme-footer-top-newsletter-form'] ) . '</div>';
	echo '</div>';

	return ob_get_clean();
}

add_shortcode( 'join_newsletter', 'join_newsletter_shortcode_callback' );

/**
 * Featured Post Shortcode
 */
function featured_post_shortcode_callback( $attrs, $content = null ) {
	ob_start();
	$attrs    = shortcode_atts( array(
		'id'       => '',
		'category' => ''
	), $attrs );
	$post_id  = $attrs['id'];
	$category = $attrs['category'];
	if ( ! empty( $post_id ) ) {
		$post_args = array(
			'post_type'      => 'post',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'post__in'        => array( $post_id ),
		);
		if ( ! empty( $category ) ) {
			$post_args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $category
			);
		}
		$posts = get_posts( $post_args );
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			echo '<div class="featured_post_wrapper">';
			foreach ( $posts as $post ) {
				echo '<div class="post_section">';
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
				echo '<span class="featured_tag">' . __( 'Featured', 'keck-observatory' ) . '</span>';
				echo '</div>';
				echo '<div class="post_content">';
				echo '<span class="featured_tag">' . __( 'Featured', 'keck-observatory' ) . '</span>';
				echo '<p class="date">' . date( 'F j, Y', strtotime( $post->post_date ) ) . '</p>';;
				echo '<div class="description"><a href="' . get_the_permalink( $post->ID ) . '"><h2 class="featured_title">' . get_the_title( $post->ID ) . '</h2></a><p>' . wp_trim_words( $post->post_content, 11, '.' ) . '</p></div>';
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		}
	}

	return ob_get_clean();
}

add_shortcode( 'featured_post', 'featured_post_shortcode_callback' );

function post_listing_shortcode_callback( $attrs, $content = null ) {
	ob_start();

	$attrs = shortcode_atts( array(
		'category'       => '',
		'posts_per_page' => '',
	), $attrs );

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$posts_per_page = ! empty( $attrs['posts_per_page'] ) ? $attrs['posts_per_page'] : get_option( 'posts_per_page' );
		$posts_args     = array(
			'post_type'      => 'post',
			'posts_per_page' => $posts_per_page,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'ASC',
			'paged'          => $paged,
		);

		if ( ! empty( $attrs['category'] ) ) {
		    $posts_args['tax_query'][] = array(
		            'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $attrs['category']
		    );
		}


		$post_query     = new WP_Query( $posts_args );
		if ( $post_query->have_posts() ) {

			echo '<div class="post-grid-container">';
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				?>
                <article id="post-<?php the_ID();?>" <?php post_class(); ?>>
                    <div class="blog-regular-post">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="post-img">
                                    <?php
                                        if ( has_post_thumbnail( get_the_ID() ) ) {
                                            $thumbImage = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                                        } else {
                                            $thumbImage = get_template_directory_uri() . '/assets/img/featured-post.jpg';
                                        }
                                        $image_alt        = get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true );
                                        $image_alt        = ( empty( $image_alt ) ) ? get_the_title( get_the_ID() ) : $image_alt;
                                        $attachment_title = get_the_title( get_post_thumbnail_id( get_the_ID() ) );
                                        ?>
                                          <a href="<?php echo esc_url( get_the_permalink( get_the_ID()));?>"><img src="<?php echo esc_url( $thumbImage);?>" alt="<?php echo $image_alt?>" class="img-fluid"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="post-content">
                                    <div class="post-cat">
                                        <?php
                                            $categories = get_the_terms( get_the_ID(),'category');
                                            if ( is_array( $categories ) && !empty( $categories ) ) {
                                                foreach ( $categories as $category ) { ?>
                                                    <a href="<?php echo get_term_link( $category )?>" class="cat-link"><?php echo $category->name;?></a>
                                            <?php }  }  ?>
                                    </div>
                                    <p class="date"><?php echo date( 'F j, Y', strtotime( get_the_date('F j, Y')) );?></p>
                                    <div class="post-desc">
                                        <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ));?>"><h3 class="title"><?php echo get_the_title();?></h3></a>
                                        <p class="description"><?php echo wp_trim_words( get_the_content(),'20','...')?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php
			}
			echo '</div>';
		}
		wp_reset_postdata();
		$big          = 9999999;
		$current_page = max( 1, get_query_var( 'paged' ) );
		echo '<div class="blog-pagination text-center">';
		echo paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => 'page/%#%/',
				'current'   => $current_page,
				'total'     => $post_query->max_num_pages,
				'prev_text' => '« Prev',
				'next_text' => 'Next »'
			)
		);
		echo "</div>";
	?>

	<?php
	return ob_get_clean();
}

add_shortcode( 'post_listing', 'post_listing_shortcode_callback' );

function featured_video_with_carousel_shortcode_callback( $attrs, $content = null ) {
    ob_start();
    $attrs = shortcode_atts(array(
            'featured_id' => '',
            'carousel_ids' => ''
    ), $attrs);
    $featured_post_id = $attrs['featured_id'];
    $carousel_ids = $attrs['carousel_ids'];
    $carousel_ids = explode(",", $carousel_ids );
    if ( ! empty( $featured_post_id )) {
        $post_args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'post_status' => 'publish',
                'post__in' => array( $featured_post_id ),
        );

        $posts = get_posts( $post_args );
        echo  '<div class="featured_post_wrapper featured_video_wrapper">';
        if ( is_array( $posts ) && !empty( $posts ) ) {
           foreach( $posts as $post ) {
               echo '<div class="post_section">';
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
                echo '</div>';
           }
        }
        if( ! empty( $carousel_ids ) ) {
             $carousels = get_posts( array(
                'post_type' => 'post',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'post__in' => $carousel_ids
        ) );
        if ( is_array( $carousels ) && ! empty( $carousels ) ) {
            echo '<div class="featured_video_carousel">';
            foreach ( $carousels as $carousel ) {
                echo '<div class="carousel_item">';
                echo '<input type="hidden" value="'.$carousel->ID.'" name="carousel_id">';
                echo '<div class="carousel_item_img">';
                 if ( has_post_thumbnail( $carousel ) ) {
					$thumbImage = wp_get_attachment_url( get_post_thumbnail_id( $carousel->ID ) );
				} else {
					$thumbImage = get_template_directory_uri() . '/assets/img/featured-post.jpg';
				}
                 echo '<img src="'.esc_url( $thumbImage ).'" class="img-fluid">';
                 echo '</div>';
                 echo '<div class="carousel_item_content">';
                 echo '<p class="date">' . date( 'F j, Y', strtotime( $carousel->post_date ) ) . '</p>';
                 echo '<h2 class="carousel_title">'. get_the_title( $carousel->ID).'</h2>';
                 echo '</div>';
                 echo '</div>';

            }
            echo '</div>';
             }
            }
        }
        echo '</div>';

    return ob_get_clean();
}
add_shortcode('featured_video_with_carousel','featured_video_with_carousel_shortcode_callback');


function upcoming_event_listing_shortcode_callback( $attrs, $content = null ) {
	ob_start();
		$posts_args     = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'ASC',
			'tax_query' => array(
			         array(
			                'taxonomy' => 'category',
			                'field' => 'slug',
			                'terms' => 'event'
			        )
			),
			'meta_query' => array(
			        'relation' => 'AND',
			        array(
                        'key' => 'event_starts',
                        'value' => 0,
                        'compare' => '>'
		            ),
                    array(
                        'key' => 'event_ends',
                        'value' => date( 'Y-m-d H:i:s' ),
                        'compare' => '>'
                    )
			    )
		);

		$post_query     = new WP_Query( $posts_args );
		if ( $post_query->have_posts() ) {
			echo '<div class="post-grid-container upcoming-events-grid-container">';
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				?>
                <article id="post-<?php the_ID();?>" <?php post_class(); ?>>
                    <div class="blog-regular-post event-post">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="post-img">
                                    <?php
                                        if ( has_post_thumbnail( get_the_ID() ) ) {
                                            $thumbImage = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                                        } else {
                                            $thumbImage = get_template_directory_uri() . '/assets/img/featured-post.jpg';
                                        }
                                        $image_alt        = get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true );
                                        $image_alt        = ( empty( $image_alt ) ) ? get_the_title( get_the_ID() ) : $image_alt;
                                        $attachment_title = get_the_title( get_post_thumbnail_id( get_the_ID() ) );
                                        ?>
                                          <a href="<?php echo esc_url( get_the_permalink( get_the_ID()));?>"><img src="<?php echo esc_url( $thumbImage);?>" alt="<?php echo $image_alt?>" class="img-fluid"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="post-content">
                                    <div class="post-cat">
                                        <?php
                                            $categories = get_the_terms( get_the_ID(),'category');
                                            if ( is_array( $categories ) && !empty( $categories ) ) {
                                                foreach ( $categories as $category ) { ?>
                                                    <a href="<?php echo get_term_link( $category )?>" class="cat-link"><?php echo $category->name;?></a>
                                            <?php }  }  ?>
                                    </div>
                                    <?php
                                        $event_starts =  get_field('event_starts', get_the_ID() );
                                        $event_ends =  get_field('event_ends', get_the_ID() );

                                        $start_date = new DateTime($event_starts);
                                        $start_date = date_format( $start_date, 'Ymd');
                                        $end_date = new DateTime($event_ends);
                                        $end_date = date_format( $end_date, 'Ymd');
                                    ?>
                                    <?php
                                        if( $start_date == $end_date ){
                                    ?>
                                    <p class="date"><?php echo date( 'F j, Y g:i a', strtotime( $event_starts ) ) . ' - '. date('g:i a',strtotime( $event_ends ) )?></p>
                                    <?php } else {?>
                                    <p class="date"><?php echo date( 'F j, Y g:i a', strtotime( $event_starts ) ) . ' - '. date('F j, Y g:i a',strtotime( $event_ends ) )?></p>
                                    <?php } ?>
                                    <div class="post-desc">
                                        <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ));?>"><h3 class="title"><?php echo get_the_title();?></h3></a>
                                        <p class="description"><?php echo wp_trim_words( get_the_content(),'20','...')?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php
			}
			wp_reset_postdata();
			echo '</div>';
		}
	?>

	<?php
	return ob_get_clean();
}

add_shortcode( 'upcoming_event_listing', 'upcoming_event_listing_shortcode_callback' );


function past_event_listing_shortcode_callback( $attrs, $content = null ) {
	ob_start();
	$attrs = shortcode_atts( array(
		'posts_per_page' => '',
	), $attrs );

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$posts_per_page = ! empty( $attrs['posts_per_page'] ) ? $attrs['posts_per_page'] : get_option( 'posts_per_page' );
		$posts_args     = array(
			'post_type'      => 'post',
			'posts_per_page' => $posts_per_page,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'ASC',
			'paged'          => $paged,
			'tax_query' => array(
			        array(
			               'taxonomy' => 'category',
					        'field'    => 'slug',
					        'terms'    => 'event'
			        )
			),
			'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => 'event_starts',
			'value' => 0,
			'compare' => '>'
		),
		array(
			'key' => 'event_ends',
			'value' => 0,
			'compare' => '>'
		),
		array(
			'key' => 'event_ends',
			'value' => date( 'Y-m-d H:i:s' ),
			'compare' => '<'
		    )
	    )
		);

		$post_query     = new WP_Query( $posts_args );
		if ( $post_query->have_posts() ) {

			echo '<div class="post-grid-container past-events-grid-container">';
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				?>
                <article id="post-<?php the_ID();?>" <?php post_class(); ?>>
                    <div class="blog-regular-post event-post">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="post-img">
                                    <?php
                                        if ( has_post_thumbnail( get_the_ID() ) ) {
                                            $thumbImage = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
                                        } else {
                                            $thumbImage = get_template_directory_uri() . '/assets/img/featured-post.jpg';
                                        }
                                        $image_alt        = get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true );
                                        $image_alt        = ( empty( $image_alt ) ) ? get_the_title( get_the_ID() ) : $image_alt;
                                        $attachment_title = get_the_title( get_post_thumbnail_id( get_the_ID() ) );
                                        ?>
                                          <a href="<?php echo esc_url( get_the_permalink( get_the_ID()));?>"><img src="<?php echo esc_url( $thumbImage);?>" alt="<?php echo $image_alt?>" class="img-fluid"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="post-content">
                                    <div class="post-cat">
                                        <?php
                                            $categories = get_the_terms( get_the_ID(),'category');
                                            if ( is_array( $categories ) && !empty( $categories ) ) {
                                                foreach ( $categories as $category ) { ?>
                                                    <a href="<?php echo get_term_link( $category )?>" class="cat-link"><?php echo $category->name;?></a>
                                            <?php }  }  ?>
                                    </div>
                                     <?php
                                        $event_starts =  get_field('event_starts', get_the_ID() );
                                        $event_ends =  get_field('event_ends', get_the_ID() );

                                        $start_date = new DateTime($event_starts);
                                        $start_date = date_format( $start_date, 'Ymd');
                                        $end_date = new DateTime($event_ends);
                                        $end_date = date_format( $end_date, 'Ymd');
                                    ?>
                                    <?php
                                        if( $start_date == $end_date ){
                                    ?>
                                    <p class="date"><?php echo date( 'F j, Y g:i a', strtotime( $event_starts ) ) . ' - '. date('g:i a',strtotime( $event_ends ) );?></p>
                                    <?php } else {?>
                                    <p class="date"><?php echo date( 'F j, Y g:i a', strtotime( $event_starts ) ) . ' - '. date('F j, Y g:i a',strtotime( $event_ends ) );?></p>
                                    <?php } ?>
                                    <div class="post-desc">
                                        <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ));?>"><h3 class="title"><?php echo get_the_title();?></h3></a>
                                        <p class="description"><?php echo wp_trim_words( get_the_content(),'20','...')?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php
			}
			echo '</div>';
		}
		wp_reset_postdata();
		$big          = 9999999;
		$current_page = max( 1, get_query_var( 'paged' ) );
		echo '<div class="blog-pagination text-center">';
		echo paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => 'page/%#%/',
				'current'   => $current_page,
				'total'     => $post_query->max_num_pages,
				'prev_text' => '« Prev',
				'next_text' => 'Next »'
			)
		);
		echo "</div>";
	?>

	<?php
	return ob_get_clean();
}

add_shortcode( 'past_event_listing', 'past_event_listing_shortcode_callback' );






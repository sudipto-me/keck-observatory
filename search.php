<?php get_header(); ?>
    <section class="inner_page_wrapper section_padding area">
        <section class="title-header">
            <h2 class="media-heading p-v-sm text-center"><?php echo __( 'Search results for:', 'keck-observatory' ); ?> <span><?php echo get_search_query(); ?></span></h2>
        </section>
        <div class="container">
            <div class="row blog_page_wrapper">
                <div class="col-lg-9 col-md-8 col-sm-12 blog_featured_section">
					<?php if ( have_posts() ): ?>
                        <div class="post-grid-container">
							<?php while ( have_posts() ):
								the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
                                                    <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>"><img src="<?php echo esc_url( $thumbImage ); ?>" alt="<?php echo $image_alt ?>" class="img-fluid"></a>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-12">
                                                <div class="post-content">
                                                    <div class="post-cat">
														<?php
														$categories = get_the_terms( get_the_ID(), 'category' );
														if ( is_array( $categories ) && ! empty( $categories ) ) {
															foreach ( $categories as $category ) { ?>
                                                                <a href="<?php echo get_term_link( $category ) ?>" class="cat-link"><?php echo $category->name; ?></a>
															<?php }
														} ?>
                                                    </div>
													<?php
													if ( in_category( 'event', get_the_ID() ) ) {
														?>
														<?php
														$event_starts = get_field( 'event_starts', get_the_ID() );
														$event_ends   = get_field( 'event_ends', get_the_ID() );

														$start_date = new DateTime( $event_starts );
														$start_date = date_format( $start_date, 'Ymd' );
														$end_date   = new DateTime( $event_ends );
														$end_date   = date_format( $end_date, 'Ymd' );
														?>
														<?php
														if ( $start_date == $end_date ) {
															?>
                                                            <p class="date"><?php echo __( 'Event Date : ', 'keck-observatory' ) . date( 'F j, Y g:i a', strtotime( $event_starts ) ) . ' - ' . date( 'g:i a', strtotime( $event_ends ) ) ?></p>
														<?php } else { ?>
                                                            <p class="date"><?php echo __( 'Event Date : ', 'keck-observatory' ) . date( 'F j, Y g:i a', strtotime( $event_starts ) ) . ' - ' . date( 'F j, Y g:i a', strtotime( $event_ends ) ) ?></p>
														<?php }
													} else { ?>
                                                        <p class="date"><?php echo date( 'F j, Y', strtotime( get_the_date( 'F j, Y' ) ) ); ?></p>
													<?php } ?>
                                                    <div class="post-desc">
                                                        <a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>"><h3 class="title"><?php echo get_the_title(); ?></h3></a>
                                                        <p class="description"><?php echo wp_trim_words( get_the_content(), '20', '...' ) ?></p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
							<?php
							endwhile;
							wp_reset_postdata();
							?>
                        </div>
						<?php
						echo '<div class="blog-pagination text-center">';
						the_posts_pagination( array(
							'prev_text'          => __( ' << Previous ', 'keck-observatory' ),
							'next_text'          => __( 'Next >>', 'keck-observatory' ),
							'before_page_number' => '',
							'screen_reader_text' => ' '
						) );
						echo '</div>';
						?>
					<?php else: ?>
                        <div id="post-0" class="post no-results not-found">
                            <div class="container">
                                <h3 class="entry-title"><?php _e( 'Nothing Found', 'keck-observatory' ); ?></h3>
                                <div class="entry-content">
                                    <p>
										<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'keck-observatory' ); ?>
                                    </p>
                                </div><!-- .entry-content -->
								<?php get_search_form(); ?>
                            </div>
                        </div>
					<?php endif; ?>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 blog_sidebar_section">
                    <div class="blog_sidebar_wrapper">
						<?php
						if ( is_active_sidebar( 'blog-sidebar' ) ) {
							dynamic_sidebar( 'blog-sidebar' );
						}
						?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer();

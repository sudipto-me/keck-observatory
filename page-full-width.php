<?php
/*
 * Template Name: Default Interior without sidebar
 */
get_header(); ?>
    <section class="inner_page_wrapper section_padding area">
        <div class="container">
            <div class="blog_page_wrapper">
                <div class="full_width_wrapper">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="blog_featured_post">
                                    <!-- /.social_share_options -->
                                    <div class="blog_post_content">
										<?php the_content(); ?>
                                    </div>
                                    <!-- /.blog_post_content -->
                                </div>
                                <!-- /.blog_featured_post -->
                            </article>
							<?php
						}
						wp_reset_postdata();
					}
					?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer();

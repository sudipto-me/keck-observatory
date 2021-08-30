<?php
/**
 * Template Name: Default Interior With Sidebar
 *
 **/
get_header();
$page_id = get_the_ID();
?>
    <section class="inner_page_wrapper section_padding area">
        <div class="container">
            <div class="row blog_page_wrapper">
                <div class="col-lg-9 col-md-8 col-sm-12 blog_featured_section">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="blog_featured_post">
                                    <div class="blog_post_content">
										<?php the_content(); ?>
                                    </div>
                                    <!-- /.blog_post_content -->
                                </div>
                                <!-- /.blog_featured_post -->
                            </article>
						<?php }
						wp_reset_query();
					} ?>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-3 col-md-4 col-sm-12 blog_sidebar_section">
                    <div class="blog_sidebar_wrapper">
						<?php
						$sidebarName = ! empty ( get_post_meta( $page_id, 'sidebar_name', true ) ) ? get_post_meta( $page_id, 'sidebar_name', true ) : 'blog-sidebar';
						if ( is_active_sidebar( $sidebarName ) ) {
							dynamic_sidebar( $sidebarName );
						}
						?>
                    </div>
                    <!-- /.blog_sidebar_wrapper -->
                </div>
                <!-- /.col-lg-4 -->
                <!-- /.row -->
            </div>
            <!-- /.blog_page_wrapper -->
        </div>
        <!-- /.container -->
    </section>
<?php get_footer();

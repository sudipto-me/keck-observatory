<?php get_header(); ?>
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
                                        <div class="featured_post_img">
                                            <?php
                                            if ( has_post_thumbnail() ) {
                                                $thumbImage = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
                                            } else {
                                                $thumbImage = get_template_directory_uri() . '/assets/img/single-post.jpg';
                                            }
                                            $image_alt        = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
                                            $image_alt        = ( empty( $image_alt ) ) ? get_the_title( $post->ID ) : $image_alt;
                                            $attachment_title = get_the_title( get_post_thumbnail_id( $post->ID ) ); ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo $thumbImage; ?>" alt="<?php echo $image_alt; ?>" title="<?php echo $attachment_title; ?>">
                                            </a>
                                        </div>
                                        <!-- /.featured_post_img -->
                                        <!-- /.post_options -->
                                        <h2 class="blog_post_title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <!-- /.social_share_options -->
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
<!--                        <div class="cla-comments">-->
<!--                            --><?php
//                            if ( comments_open() || get_comments_number() ) {
//                                comments_template();
//                            }
//                            ?>
<!--                        </div>-->
                    </div>
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-3 col-md-4 col-sm-12 blog_sidebar_section">
                        <div class="blog_sidebar_wrapper">
                            <?php
                            if ( is_active_sidebar( 'blog-sidebar' ) ) {
                                dynamic_sidebar( 'blog-sidebar' );
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

<?php
/**
 * Template Name: News
*/
get_header(); ?>
	<section class="default-page-without-sidebar area">
		<div class="container">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
				endif;
				?>
			</article>
		</div>
		<!-- /.container -->
	</section>
<?php get_footer();
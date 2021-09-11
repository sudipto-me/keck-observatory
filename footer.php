<?php
$theme_options        = get_option( 'theme-options' );
$footer_top_title     = ( ! empty( $theme_options['theme-footer-top-heading'] ) ) ? $theme_options['theme-footer-top-heading'] : __( 'Be part of our mission', 'keck-observatory' );
$footer_top_sub_title = ( ! empty( $theme_options['theme-footer-top-subheading'] ) ) ? $theme_options['theme-footer-top-subheading'] : __( 'Join our newsletter', 'keck-observatory' );
$copyright            = ( ! empty( $theme_options['theme-copyright-content'] ) ) ? $theme_options['theme-copyright-content'] : '';
$footer_script        = ( ! empty( $theme_options['footer-script'] ) ) ? $theme_options['footer-script'] : '';
?>
</main>

<footer class="site_footer area">
    <div class="footer-container">
        <div class="footer-top-content">
            <div class="subscribe-section">
				<?php echo do_shortcode( '[elementor-template id="997"]' ) ?>
            </div>
        </div>
    </div>
    <section class="footer_section area">
        <div class="footer-container">
            <div class="footer_content_wrapper">
                <div class="row">
					<?php if ( is_active_sidebar( 'footer-widget-area-1' ) ) : ?>
                        <div class="col-lg-3 col-md-12">
							<?php dynamic_sidebar( 'footer-widget-area-1' ); ?>
                        </div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'footer-widget-area-2' ) ) : ?>
                        <div class="col-lg-3 col-md-12">
							<?php dynamic_sidebar( 'footer-widget-area-2' ); ?>
                        </div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'footer-widget-area-3' ) ) : ?>
                        <div class="col-lg-3 col-md-12">
							<?php dynamic_sidebar( 'footer-widget-area-3' ); ?>
                        </div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'footer-widget-area-4' ) ) : ?>
                        <div class="col-lg-3 col-md-12">
							<?php dynamic_sidebar( 'footer-widget-area-4' ); ?>
                        </div>
					<?php endif; ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.footer_content_wrapper -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /.footer_widget_section area -->

    <section class="copyright_section area">
        <div class="footer-container clearfix">
			<?php if ( ! empty( $copyright ) ) {
				echo '<div class="float-left copyright-text">';
				echo '<p>' . do_shortcode( $copyright );
				echo '</p></div>';
			} else {
				echo do_shortcode( '<p>' . "&copy; [display_year] W. M. Keck Observatory." . '</p>' );
			} ?>

            <div class="float-right footer-social">
				<?php
				$theme_options = get_option( 'theme-options' );
				$social_links  = $theme_options['theme-social-repeater'];
				if ( is_array( $social_links ) && ! empty( $social_links ) ) {
					?>
                    <ul>
						<?php foreach ( $social_links as $social ) { ?>
                            <li><a href="<?php echo $social['social-link']; ?>"><?php echo $social['social-name']; ?></a></li>
						<?php } ?>
                    </ul>
				<?php } ?>
            </div>
        </div>
        <!-- /.container -->
    </section>
    <!-- /.copyright_section area -->
</footer>
<?php wp_footer();
if ( ! empty( $footer_script ) ) {
	echo $footer_script;
}
?>
</body>

</html>
<?php
$theme_options        = get_option( 'theme-options' );
$footer_top_title     = ( ! empty( $theme_options['theme-footer-top-heading'] ) ) ? $theme_options['theme-footer-top-heading'] : __( 'Be part of our mission', 'jms-vip-limo' );
$footer_top_sub_title = ( ! empty( $theme_options['theme-footer-top-subheading'] ) ) ? $theme_options['theme-footer-top-subheading'] : __( 'Join our newsletter', 'jms-vip-limo' );
$copyright            = ( ! empty( $theme_options['theme-copyright-content'] ) ) ? $theme_options['theme-copyright-content'] : '';
$footer_script        = ( ! empty( $theme_options['footer-script'] ) ) ? $theme_options['footer-script'] : '';
?>
</main>

<footer class="site_footer area">
    <div class="footer-container">
        <div class="footer-top-content">
            <div class="subscribe-section">
                <h2><?php echo esc_attr( $footer_top_title ); ?></h2>
                <p><?php echo esc_attr( $footer_top_sub_title ); ?></p>
                <div class="subscribe_form">
					<?php echo do_shortcode( $theme_options['theme-footer-top-newsletter-form'] ); ?>
                </div>
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
        <div class="footer-container">
			<?php if ( ! empty( $copyright ) ) {
				echo '<div class="float-left copyright-text">';
				echo '<p>' . do_shortcode( $copyright );
				echo '</p></div>';
			} else {
				echo do_shortcode( '<p>' . "&copy; [display_year] W. M. Keck Observatory." . '</p>' );
			} ?>
            <div class="float-right footer-social">
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Facebook</a></li>
                </ul>
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
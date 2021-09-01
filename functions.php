<?php
/**
 * Codestar Framework
 */
require_once get_theme_file_path( '/lib/csf/codestar-framework/codestar-framework.php' );
/**
 * Admin Options
 */
require_once get_theme_file_path( '/lib/csf/admin-options.php' );

/**
 * Bootstrap Nav Walker for this theme.
 */
require_once get_theme_file_path( '/lib/wp_bootstrap_navwalker.php' );
/**
 * Theme shortcode
 */
require_once get_theme_file_path( '/lib/theme_shortcode.php' );
/**
 * Theme metabox
 */
require_once get_theme_file_path( '/lib/theme_metabox.php' );
require_once get_theme_file_path( '/lib/theme_cpt.php' );

require_once get_theme_file_path( '/classes/class-twentytwenty-walker-comment.php' );

//edd custom files
require_once get_theme_file_path( '/lib/script-functions.php' );
require_once get_theme_file_path( '/lib/widget-functions.php' );
require_once get_theme_file_path( '/lib/theme-functions.php' );

// Define path and URL to the ACF plugin.
define( 'THEME_ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
define( 'THEME_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );
include_once( THEME_ACF_PATH . 'acf.php' );

// Define constants
define( 'KECK_OBSERVATORY_THEME_VERSION', '1.0.0' );

/**
 * Custom Login Functions
 */
//require_once get_theme_file_path( '/lib/login_functions.php' );


/* -----------------------------------------------------------------------------
* Excerpt Length
* -------------------------------------------------------------------------- */
function excerpt_length_callback_function() {
	return 25;
}

/* -----------------------------------------------------------------------------
* Excerpt More
* -------------------------------------------------------------------------- */
function read_more_callback_function() {
	return '...';
}

// register a new widget category in elementor
function register_custom_widget_category( $elements_manager ) {
	$elements_manager->add_category(
		'keck-observatory',
		array(
			'title' => __( 'Keck Observatory', 'keck-observatory' ),
			'icon'  => 'fa fa-plug',
		)

	);
}

add_action( 'elementor/elements/categories_registered', 'register_custom_widget_category' );

//register custom widget in elementor
function register_custom_widgets( $elementor ) {
	require_once get_stylesheet_directory() . '/elementor/community-widgets.php';
	require_once get_stylesheet_directory() . '/elementor/testimonial-widgets.php';

	$elementor->register_widget_type( new \KeckObservatory\Elementor\Community_Slider );
	$elementor->register_widget_type( new \KeckObservatory\Elementor\Testimonial_Slider );
}

add_action( 'elementor/widgets/widgets_registered', 'register_custom_widgets' );

// update acf assets url
add_filter( 'acf/settings/url', 'theme_acf_settings_url' );
function theme_acf_settings_url( $url ) {
	return THEME_ACF_URL;
}


// modal content
function keck_observatory_modal_contents() {
	if ( is_home() || is_front_page() ) {
		?>
        <div class="modal donation_modal" id="donation-modal">
			<?php
			$theme_options  = get_option( 'theme-options' );
			$img            = ( ! empty( $theme_options['modal-image']['url'] ) ) ? $theme_options['modal-image']['url'] : get_template_directory_uri() . '/assets/img/modal-img.png';
			$img_alt        = ( ! empty( $theme_options['modal-image']['alt'] ) ) ? $theme_options['modal-image']['alt'] : esc_html__( 'Modal Img', 'keck-observatory' );
			$heading        = ! empty( $theme_options['modal-header'] ) ? $theme_options['modal-header'] : __( 'Send A Donation', '' );
			$modal_btn_url  = ( ! empty( $theme_options['modal-button']['url'] ) ) ? $theme_options['modal-button']['url'] : '#';
			$modal_btn_text = ( ! empty( $theme_options['modal-button']['text'] ) ) ? $theme_options['modal-button']['text'] : __( 'Donate', 'keck-observatory' );
			?>
            <div class="footer-container">
                <div class="modal_content">
                    <div class="modal-img">
                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_html( $img_alt ) ?>" class="img-fluid">
                    </div>
                    <div class="modal-blocks">
                        <h2 class="modal_title"><?php echo esc_html( $heading ); ?></h2>
                        <div class="desc">
                            <p><?php echo $theme_options['modal-description']; ?></p>
                            <a href="<?php echo esc_url( $modal_btn_url ); ?>" class="site_cta modal-btn"> <?php echo esc_html( $modal_btn_text ); ?></a>
                        </div>
                        <p class="modal-footer"><?php echo esc_html( $theme_options['modal-footer'] ); ?></p>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

add_action( 'wp_footer', 'keck_observatory_modal_contents' );





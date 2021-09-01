<?php
$theme_options   = get_option( 'theme-options' );
$logo            = ( ! empty( $theme_options['theme-header-logo']['url'] ) ) ? $theme_options['theme-header-logo']['url'] : get_template_directory_uri() . '/assets/img/header-logo.png';
$logo_alt        = ( ! empty( $theme_options['theme-header-logo']['alt'] ) ) ? $theme_options['theme-header-logo']['alt'] : esc_html__( 'Site Logo', 'keck-observatory' );
$header_btn_url  = ( ! empty( $theme_options['theme-cta']['url'] ) ) ? $theme_options['theme-cta']['url'] : '#';
$header_btn_text = ( ! empty( $theme_options['theme-cta']['text'] ) ) ? $theme_options['theme-cta']['text'] : __( 'Donate', 'keck-observatory' );
$header_script   = ( ! empty( $theme_options['theme-header-script'] ) ) ? $theme_options['theme-header-script'] : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Meta Data -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<?php if ( ! empty( $header_script ) ) {
		echo $header_script;
	} ?>
</head>

<body <?php body_class(); ?>>

<header class="site_header area">

    <!-- /.header_top-section -->
    <section class="main_header area">
        <div class="header-container">
            <nav class="navbar navbar-expand-lg">
                <div class="header_logo">
                    <a href="<?php echo site_url( '/' ); ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $logo_alt; ?>"></a>
                </div>
                <div class="mobile_navbar">
                    <div class="menu_icons">
                        <ul>
                            <li class="search_trigger">
                                <img src="<?php echo get_template_directory_uri() . '/assets/img/search.png'; ?>" alt="...">
                                <div class="search_bar">
                                    <form action="<?php echo home_url( '/' ); ?>" id="searchform" class="abcd_sidebar-searchbar" method="get">
                                        <input type="text" class="form-control" id="s" placeholder="<?php _e( 'Search...', 'abcd' ); ?>" name="s" value="<?php echo get_search_query(); ?>">
                                        <button type="submit" class="search_submit"><img src="<?php echo get_template_directory_uri() . '/assets/img/search_icon.svg'; ?>" alt="search icon"></button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.menu_icons -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse header_nav">
					<?php
					$menu_arguments = array(
						'theme_location' => 'primary_navigation',
						'container'      => '',
						'menu_class'     => 'navbar-nav header_menu',
						'echo'           => true,
						'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'          => 5,
						'walker'         => new wp_bootstrap_navwalker()
					);
					wp_nav_menu( $menu_arguments );
					?>
                </div>
                <!-- /.header menu -->
                <div class="desktop_menu menu_icons">
                    <ul>
                        <li class="site_cta">
                            <a href="<?php echo esc_url( $header_btn_url ); ?>"><?php echo $header_btn_text; ?></a>
                        </li>
                        <li class="search_trigger">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/search.png'; ?>" alt="...">
                            <div class="search_bar">
                                <form action="<?php echo home_url( '/' ); ?>" class="abcd_sidebar-searchbar" id="searchform" method="get">
                                    <input type="text" class="form-control" id="s" placeholder="<?php _e( 'Search...', 'abcd' ); ?>" name="s" value="<?php echo get_search_query(); ?>">
                                    <button type="submit" class="search_submit"><img src="<?php echo get_template_directory_uri() . '/assets/img/search_icon.svg'; ?>" alt="search icon"></button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /.nav -->
        </div>
    </section>
    <!-- /.main_header -->
</header>

<main class="area" style="">
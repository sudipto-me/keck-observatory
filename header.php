<?php
$theme_options = get_option( 'theme-options' );

$logo = get_theme_mod( 'theme-logo' );
error_log( print_r( $logo, true ) );

$logo           = ! empty( get_theme_mod( 'theme-logo' ) ) ? get_theme_mod( 'theme-logo' ) : get_template_directory_uri() . '/assets/img/header-logo.png';
$header_btn_url = ( ! empty( get_theme_mod( 'donate-page' ) ) ) ? get_theme_mod( 'donate-page' ) : '#';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Meta Data -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site_header area">

    <!-- /.header_top-section -->
    <section class="main_header area">
        <div class="header-container">
            <nav class="navbar navbar-expand-lg">
                <div class="header_logo">
                    <a href="<?php echo site_url( '/' ); ?>"><img src="<?php echo $logo; ?>" alt="<?php echo esc_html__( 'Header Logo', 'keck-observatory' ); ?>"></a>
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
                            <a href="<?php echo esc_url( $header_btn_url ); ?>"><?php echo esc_html__( 'Donate', 'keck-observatory' ); ?></a>
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
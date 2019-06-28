<!DOCTYPE html>
  <html lang="<?php bloginfo('language'); ?>">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico" />
  </head>
  <body>
    <header class="section_middle_center w_100">
      <section class="w_90">
        <div class="logo">
          <?php
            if ( has_custom_logo() ) {
              if ( function_exists( 'the_custom_logo' ) ) {
                the_custom_logo();
              }
              else{
                echo '<a href="'.get_option( 'siteurl' ).'"><img src="'.get_stylesheet_directory_uri().'/assets/images/logo.svg" title="'.get_bloginfo( 'name' ).'" /></a>';
              }
            } else {
              echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
              echo '<a href="'.get_option( 'siteurl' ).'"><img src="'.get_stylesheet_directory_uri().'/assets/images/logo.svg" title="'.get_bloginfo( 'name' ).'" /></a>';
            }
          ?>
        </div>
        <nav class="main-nav">
          <?php wp_nav_menu( array( 'theme_location' => 'navegation' ) ); ?>
        </nav>
      </section>
      <a class="hamburguer" onclick="__openMenu(this)"> <i class="fas fa-bars"></i> </a>
    </header>
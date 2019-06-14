<?php
  /**
 * Disable the emoji's
 */
  function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
  }
  add_action( 'init', 'disable_emojis' );

  /**
   * Filter function used to remove the tinymce emoji plugin.
   * 
   * @param array $plugins 
   * @return array Difference betwen the two arrays
   */
  function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }

  /**
   * Remove emoji CDN hostname from DNS prefetching hints.
   *
   * @param array $urls URLs to print for resource hints.
   * @param string $relation_type The relation type the URLs are printed for.
   * @return array Difference betwen the two arrays.
   */
  function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
      /** This filter is documented in wp-includes/formatting.php */
      $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
      $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
  }

  /**
 * Crear nuestros menús gestionables desde el
 * administrador de Wordpress.
 */
  function menuPrincipal() {
    register_nav_menus(
      array(
        'navegation' => __( 'Header menu' ),
        'navegation_footer' => __( 'Footer menu' )
      )
    );
  }
  add_action( 'init', 'menuPrincipal' );

  /**
 * Insertar archivos css y js 
 */
  function custom_css(){
    wp_enqueue_style('bastemp', get_bloginfo('template_url')."/assets/css/bastemp.min.css", false, '1.0', 'all');
    wp_enqueue_style('font awesome', get_bloginfo('template_url')."/assets/css/font-awesome.min.css", false, '1.0', 'all');
    wp_enqueue_style('styles', get_bloginfo('template_url')."/assets/css/styles.min.css", false, '1.0', 'all');
  }
  add_action( 'wp_print_styles', 'custom_css' );


  /**LOGO WEB */
  function custom_logo() {
    add_theme_support( 'custom-logo', array(
        'height'      => 110,
        'width'       => 413,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
}
add_action( 'after_setup_theme', 'custom_logo' );


  function mis_widgets(){
    register_sidebar(
      array(
        'name'          => __( 'Sidebar' ),
        'id'            => 'sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
      )
    );
  }
  add_action('init','mis_widgets');
?>
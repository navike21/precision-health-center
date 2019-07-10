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
    wp_enqueue_style('styles', get_bloginfo('template_url')."/assets/css/styles.min.css", false, '1.1', 'all');
  }
  add_action( 'wp_print_styles', 'custom_css' );
  
  function custom_js(){
    wp_deregister_script( 'scripts' );
    wp_register_script( 'scripts', get_bloginfo('template_url').'/assets/js/ready.js', false, '1.0', false);
    wp_enqueue_script( 'scripts' );
  }
  add_action( 'wp_enqueue_scripts', 'custom_js' );

  /**LOGO WEB */
  function custom_logo() {
    add_theme_support( 'custom-logo', array(
        'height'      => 110,
        'width'       => 413,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ));
  }
  add_action( 'after_setup_theme', 'custom_logo' );

  /**WIDGETS */
  add_action( 'widgets_init', 'my_awesome_sidebar' );
  function my_awesome_sidebar() {
    $my_sidebars = array(
      array(
        'name'          => 'Slider home',
        'id'            => 'sliderHome',
        'description'   => 'Insert here a plugin slider for home web',
        'before_widget' => '<div class="w_100 section_middle_center">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="hideElement">',
        'after_title'   => '</h2>',
      ),
      array(
        'name'          => 'Contact info home',
        'id'            => 'contact-info-home',
        'description'   => 'Contact information from home web after slider home',
        'before_widget' => '<div class="info_home section_middle_justify w_90">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="hideElement">',
        'after_title'   => '</h2>',
        'class'         => 'infoHome'
      ) 
    );

    foreach( $my_sidebars as $sidebar ) {
      $args = wp_parse_args( $sidebar );
      register_sidebar( $args );
    }
  }

  /* FEATURED IMAGE*/
  add_theme_support( 'post-thumbnails' );

  /**SLIDER HOME PAGE */
  add_action( 'init', 'custom_page_slider' );
  function custom_page_slider() {
    $label_slider = array(
      'name'                  => _x( 'Slider home', 'post type general name' ),
      'singular_name'         => _x( 'Slider', 'post type singular name' ),
      'add_new'               => _x( 'Add new slider', 'book' ),
      'add_new_item'          => __( 'Add new slider' ),
      'edit_item'             => __( 'Edit slider' ),
      'new_item'              => __( 'New slider' ),
      'view_item'             => __( 'See slider' ),
      'search_items'          => __( 'Search slider' ),
      'not_found'             => __( 'Slider not found' ),
      'not_found_in_trash'    => __( 'Slider not found in the trash' ),
      'parent_item_colon'     => ''
    );
  
    // Creamos un array para $args
    $args_slider = array( 'labels' => $label_slider,
      'public'                => true,
      'publicly_queryable'    => true,
      'show_ui'               => true,
      'query_var'             => true,
      'rewrite'               => true,
      'menu_icon'             => 'dashicons-images-alt2',
      'capability_type'       => 'post',
      'hierarchical'          => false,
      'menu_position'         => 4,
      'supports'              => array( 'title', 'thumbnail' )
    );
    /* Registramos y a funcionar */
    register_post_type( 'slider', $args_slider );
  }


  /**Añadir Secciones de páginas personalizadas */

  add_action( 'init', 'custom_page_services' );
  function custom_page_services() {
	$labelServices = array(
    'name'                  => _x( 'Services', 'post type general name' ),
    'singular_name'         => _x( 'service', 'post type singular name' ),
    'add_new'               => _x( 'Add new service', 'book' ),
    'add_new_item'          => __( 'Add new service' ),
    'edit_item'             => __( 'Edit service' ),
    'new_item'              => __( 'New service' ),
    'view_item'             => __( 'See service' ),
    'search_items'          => __( 'Search service' ),
    'not_found'             => __( 'service not found' ),
    'not_found_in_trash'    => __( 'service not found in the trash' ),
    'parent_item_colon'     => ''
    );
 
    // Creamos un array para $args
    $args_services = array( 'labels' => $labelServices,
      'public'                => true,
      'show_ui'               => true,
      'show_in_nav_menus'     => true,
      'show_in_menu'          => true,
      'query_var'             => true,
      'publicly_queryable'    => true,
      'rewrite'               => true,
      'exclude_from_search'   => false,
      'menu_icon'             => 'dashicons-yes-alt',
      'menu_position'         => 5,
      'capability_type'       => 'post',
      'hierarchical'          => false,
      'menu_position'         => null,
      'supports'              => array( 'title', 'editor', 'thumbnail' )
    );
 
    register_post_type( 'services', $args_services ); /* Registramos y a funcionar */
  }
?>
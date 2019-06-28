<?php
  get_header();
  /**Slider principal*/
  if ( is_active_sidebar( 'sliderHome' ) ) {
    dynamic_sidebar( 'sliderHome' );
  }
  else{
    echo '<section class="sliderHome"><div class="dotsSlider"></div><div class="wrappItemsSlider">';
    $arraySlider = array(
      'order' => 'ASC',
      'post_type' => 'slider'
    );
    $loop = new WP_Query( $arraySlider );
    while ( $loop -> have_posts() ) : $loop -> the_post();
      $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail_size' );
      $urlImage = $src[0];
      if ( has_post_thumbnail() ){  
        echo '<div class="itemSlider"><img src="'.$urlImage.'" /></div>';
      }
      else{
        echo '<div class="itemSlider"><img src="'.get_bloginfo('template_url').'/assets/images/notFoundImg.svg" /></div>';
      }
    endwhile;
    echo '</div></section>';
  }
  /**End Slider*/

  echo '<section>';
  if ( is_active_sidebar( 'contact-info-home' ) ) {
    dynamic_sidebar( 'contact-info-home' );
  }
  echo '</section>';
  get_footer();
?>
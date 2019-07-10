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

  echo '<section class="section_middle_center w_100">';
  if ( is_active_sidebar( 'contact-info-home' ) ) {
    dynamic_sidebar( 'contact-info-home' );
  }
  echo '</section>';

  /**Formulario HOME */
  echo '<div id="frmHome" class="frmHome section_middle_center backgroundColor_blue">
    <h2 class="whiteColor align_center w_80 font_light fontBodyBold">What can we do for you?</h2>
    <form id="formData" onsubmit="return false" method="post" class="w_80 w_70_desktop section_middle_justify">
      <input id="fullname" type="text" placeholder="Full Name" class="w_33_desktop w_100 textBox">
      <input id="email" type="email" placeholder="Email" class="w_29_desktop w_100 textBox">
      <select id="services" name="services" class="w_22_desktop w_100 textBox">
        <option value="">Select a service</option>
        <option value="Smartlipo">Smartlipo</option>
        <option value="Prp Plasma (Platelet Rich Plasma) Vampire FaceLift">Prp Plasma (Platelet Rich Plasma) Vampire FaceLift</option>
        <option value="Silhouette Instalift - Mini FaceLift Procedure">Silhouette Instalift - Mini FaceLift Procedure</option>
        <option value="Tempsure envi - RF Technology">Tempsure envi - RF Technology</option>
        <option value="Botox and Fillers">Botox and Fillers</option>
        <option value="Facial Procedures">Facial Procedures</option>
        <option value="Body Treatments">Body Treatments</option>
        <option value="Diagnostic Imaging & Radiology">Diagnostic Imaging & Radiology</option>
      </select>
      <button type="submit" class="w_15_desktop w_100 buttonBox">Send</button>
    </form>
  </div>';
  
  get_footer();
?>
<?php

if ( ! function_exists( 'creative_slider_get_placeholder_image' ) ) {
  function creative_slider_get_placeholder_image() {
    return "<img src='" . CREATIVE_SLIDER_URL . "assets/images/default.jpg' class='img-fluid wp-post-image' />";
  }
}

if ( ! function_exists( 'creative_slider_options' ) ) {
  function creative_slider_options() {
    $show_bullets = isset( Creative_Slider_Settings::$options['creative_slider_bullets'] ) && 
    Creative_Slider_Settings::$options['creative_slider_bullets'] == 1 ? true : false;

    wp_enqueue_script( 'creative-slider-options-js', CREATIVE_SLIDER_URL . 'vendor/flexslider/flexslider.js', array( 'jquery' ), 
      CREATIVE_SLIDER_VERSION, true );
      wp_localize_script( 'creative-slider-options-js', 'SLIDER_OPTIONS', array( 
        'controlNav' => $show_bullets
      ) );
  }
}
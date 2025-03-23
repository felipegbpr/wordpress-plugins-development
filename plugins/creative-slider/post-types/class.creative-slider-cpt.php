<?php

if ( !class_exists( 'Creative_Slider_Post_Type' ) ) {
  class Creative_Slider_Post_Type {
    function __construct() {
      add_action( 'init', array( $this, 'create_post_type' ));
    }

    public function create_post_type() {}
  }
}
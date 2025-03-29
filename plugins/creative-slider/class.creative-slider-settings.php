<?php

if ( ! class_exists('Creative_Slider_Settings' ) ) {
  class Creative_Slider_Settings {

    public static $options;

    public function __construct() {
      self::$options = get_option( 'creative_slider_option' );
      add_action( 'admin_init', array( $this, 'admin_init' ) );
    }

    public function admin_init() {
      add_settings_section(
        'creative_slider_main_section',
        'Hows does it work?',
        null,
        'creative_slider_page1'
      );

      add_settings_field(
        'creative_slider_shortcode',
        'Shortcode',
        null,
        'creative_slider_page1',
        'creative_slider_main_section'
      );
    }

    public function creative_slider_shortcode_callback() {
      ?>
      <span>Use the shortcode [creative_slider] to display the slider in any page/post/widget</span>
      <?php
    }

  }
}

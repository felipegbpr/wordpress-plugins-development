<?php

/**
 * Plugin Name: Creative Slider
 * Plugin URI: https://www.wordpress.org/creative-slider
 * Description: My plugin's description 
 * Version: 1.0
 * Requires at latest: 5.6
 * Author: Felipe Borges
 * Author URI: https://www.authorwp.net 
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: squeeze-slider
 * Domain Path: /languages
 */

/*
Creative Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Creative Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Creative Slider. If not, see {URI to Plugin License}.
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( ! class_exists( 'Creative_Slider' ) ) {
  class Creative_Slider {
    function __construct() {
      $this->define_constants();
      
      $this->load_textdomain();

      require_once( CREATIVE_SLIDER_PATH . 'functions/functions.php' ); 

      add_action( 'admin_menu', array( $this, 'add_menu' ) );

      require_once( CREATIVE_SLIDER_PATH . 'post-types/class.creative-slider-cpt.php' );
      $Creative_Slider_Post_Type = new Creative_Slider_Post_Type();

      require_once( CREATIVE_SLIDER_PATH . 'class.creative-slider-settings.php' );
      $Creative_Slider_Settings = new Creative_Slider_Settings();

      require_once( CREATIVE_SLIDER_PATH . 'shortcodes/class.creative-slider-shortcode.php' );
      $Creative_Slider_Shortcode = new Creative_Slider_Shortcode();

      add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 999 );
      add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
    }    

    public function define_constants() {
      define( 'CREATIVE_SLIDER_PATH', plugin_dir_path( __FILE__ ) );
      define( 'CREATIVE_SLIDER_URL', plugin_dir_url( __FILE__ ) );
      define( 'CREATIVE_SLIDER_VERSION', '1.0.0' );
    }

    public static function activate() {
      update_option( 'rewrite_rules', '' );
    }

    public static function deactivate() {
      flush_rewrite_rules();
      unregister_post_type( 'creative-slider' );
    }

    public static function uninstall() {

    }

    public function load_textdomain() {
      load_plugin_textdomain(
        'creative-slider',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages/'
      );
    }

    public function add_menu() {
      add_menu_page( 
        esc_html__( 'Creative Slider Options', 'creative-slider' ),
        'Creative Slider',
        'manage_options',
        'creative_slider_admin',
        array( $this, 'creative_slider_settings_page' ),
        'dashicons-images-alt2',
      );

      add_submenu_page(
        'creative_slider_admin',
        esc_html__( 'Manage Slides', 'creative-slider' ),
        esc_html__( 'Manage Slides', 'creative-slider' ),
        'manage_options',
        'edit.php?post_type=creative-slider',
        null,
        null
      );

      add_submenu_page(
        'creative_slider_admin',
        esc_html__( 'Add New Slide', 'creative-slider' ),
        esc_html__( 'Add New Slide', 'creative-slider' ),
        'manage_options',
        'post-new.php?post_type=creative-slider',
        null,
        null
      );
    }

    public function creative_slider_settings_page() {
      if ( ! current_user_can( 'manage_options' ) ) {
        return;
      }

      if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error( 'creative_slider_options', 'creative_slider_message', esc_html__( 'Settings Saved', 'creative-slider' ), 'success' );
      }
      
      settings_errors( 'creative_slider_options' );

      require( CREATIVE_SLIDER_PATH . 'views/settings-page.php' );
    }

    public function register_scripts(){
      wp_register_script( 'creative-slider-main-jq', CREATIVE_SLIDER_URL . 'vendor/flexslider/jquery.flexslider-min.js', array( 'jquery' ), 
      CREATIVE_SLIDER_VERSION, true );
      wp_register_style( 'creative-slider-main-css', CREATIVE_SLIDER_URL . 'vendor/flexslider/flexslider.css', array(), 
      CREATIVE_SLIDER_VERSION, 'all' );
      wp_register_style( 'creative-slider-style-css', CREATIVE_SLIDER_URL . 'assets/css/frontend.css', array(), 
      CREATIVE_SLIDER_VERSION, 'all' );
    }

    public function register_admin_scripts() {
      global $typenow;
      if ( $typenow == 'creative-slider' ) {
        wp_enqueue_style( 'creative-slider-admin', CREATIVE_SLIDER_URL . 'assets/css/admin.css' );
      }
    }

  }
}

if ( class_exists( 'Creative_Slider' ) ) {
  register_activation_hook( __FILE__, array( 'Creative_Slider', 'activate' ) );
  register_deactivation_hook( __FILE__, array( 'Creative_Slider', 'deactivate' ) );
  register_uninstall_hook( __FILE__, array( 'Creative_Slider', 'uninstall' ) );

  $creative_slider = new Creative_Slider();
}
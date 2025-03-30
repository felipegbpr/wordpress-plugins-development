<?php

if ( ! class_exists('Creative_Slider_Settings' ) ) {
  class Creative_Slider_Settings {

    public static $options;

    public function __construct() {
      self::$options = get_option( 'creative_slider_options' );
      add_action( 'admin_init', array( $this, 'admin_init' ) );
    }

    public function admin_init() {

      register_setting( 'creative_slider_group', 'creative_slider_options', array( $this, 'creative_slider_validate' ) );

      add_settings_section(
        'creative_slider_main_section',
        'Hows does it work?',
        null,
        'creative_slider_page1'
      );

      add_settings_section(
        'creative_slider_second_section',
        'Other Plugin Options',
        null,
        'creative_slider_page2'
      );

      add_settings_field(
        'creative_slider_shortcode',
        'Shortcode',
        array( $this, 'creative_slider_shortcode_callback' ),
        'creative_slider_page1',
        'creative_slider_main_section'
      );

      add_settings_field(
        'creative_slider_title',
        'Slider Title',
        array( $this, 'creative_slider_title_callback' ),
        'creative_slider_page2',
        'creative_slider_second_section',
        array(
          'label_for' => 'creative_slider_title'
        )
      );

      add_settings_field(
        'creative_slider_bullets',
        'Display Bullets',
        array( $this, 'creative_slider_bullets_callback' ),
        'creative_slider_page2',
        'creative_slider_second_section',
        array(
          'label_for' => 'creative_slider_bullets'
        )
      );

      add_settings_field(
        'creative_slider_style',
        'Slider Style',
        array( $this, 'creative_slider_style_callback' ),
        'creative_slider_page2',
        'creative_slider_second_section',
        array(
          'items' => array(
            'style-1',
            'style-2'
          ),
          'label_for' => 'creative_slider_style'
        )
      );
    }

    public function creative_slider_shortcode_callback() {
      ?>
      <span>Use the shortcode [creative_slider] to display the slider in any page/post/widget</span>
      <?php
    }

    public function creative_slider_title_callback( $args ) {
      ?>
        <input 
        type="text" 
        name="creative_slider_options[creative_slider_title]" 
        id="creative_slider_title"
        value="<?php echo isset( self::$options['creative_slider_title'] ) ? esc_attr( self::$options['creative_slider_title'] ) : ''; ?>"
        >
      <?php
    }

    public function creative_slider_bullets_callback( $args ) {
      ?>
      <input 
          type="checkbox" 
          name="creative_slider_options[creative_slider_bullets]" 
          id="creative_slider_bullets"
          value="1"
          <?php 
            if ( isset( self::$options['creative_slider_bullets'] ) ) {
              checked( "1", self::$options['creative_slider_bullets'], true );
            }
          ?>
        />
        <label for="creative_slider_bullets">Whether to display bullets or not</label>

      <?php
    }

    public function creative_slider_style_callback( $args ){
      ?>
        <select 
            id="creative_slider_style" 
            name="creative_slider_options[creative_slider_style]">
            <?php 
              foreach ( $args['items'] as $item ): 
            ?>
              <option value="<?php echo esc_attr( $item ); ?>"
                <?php
                isset( self::$options['creative_slider'] ) ? selected( $item, self::$options['creative_slider_style'], true ) :
                ''
                ?>
              >
                <?php echo esc_html( ucfirst( $item ) ); ?>  
              </option>  
            <?php endforeach; ?>
        </select>
      <?php
    }

    public function creative_slider_validate( $input ) {
      $new_input = array();
      foreach ( $input as $key => $value) {
        switch ($key) {
          case 'creative_slider_title':
            if ( empty( $value ) ) {
              $value = 'Please, type some text';
            }
            $new_input[$key] = sanitize_text_field( $value );
          break;
          default:
            $new_input[$key] = sanitize_text_field( $value );
          break;    
        }
      }
      return $new_input;
    }
  }
}

<?php 

if( ! class_exists( 'Creative_Slider_Shortcode' ) ) {
    class Creative_Slider_Shortcode{
        public function __construct(){
            add_shortcode( 'creative_slider', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ){

            $atts = array_change_key_case( (array) $atts, CASE_LOWER );

            extract( shortcode_atts(
                array(
                    'id' => '',
                    'orderby' => 'date'
                ),
                $atts,
                $tag
            ));

            if( !empty( $id ) ){
                $id = array_map( 'absint', explode( ',', $id ) );
            }
            
            ob_start();
            require( CREATIVE_SLIDER_PATH . 'views/creative-slider_shortcode.php' );
            wp_enqueue_script( 'creative-slider-main-jq' );
            wp_enqueue_style( 'creative-slider-main-css' );
            wp_enqueue_style( 'creative-slider-style-css' );
            creative_slider_options();
            return ob_get_clean();
        }
    }
}

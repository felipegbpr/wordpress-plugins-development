<?php 

if( ! class_exists( 'Inspire_Translations_Shortcode' ) ) {
    class Inspire_Translations_Shortcode {
        public function __construct(){
            add_shortcode( 'ipt_translations', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode(  ){
            
            ob_start();
            require( INSPIRE_TRANSLATIONS_PATH . 'views/inspire-translations_shortcode.php' );
            wp_enqueue_script( 'custom_js' );
            wp_enqueue_script( 'validate_js' );
            return ob_get_clean();
        }
    }
}

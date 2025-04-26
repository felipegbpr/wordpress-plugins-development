<?php 

if( ! class_exists( 'Inspire_Translations_Edit_Shortcode' ) ) {
    class Inspire_Translations_Edit_Shortcode {
        public function __construct(){
            add_shortcode( 'ipt_translations_edit', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode(  ){
            
            ob_start();
            require( INSPIRE_TRANSLATIONS_PATH . 'views/inspire-translations_edit_shortcode.php' );
            wp_enqueue_script( 'custom_js' );
            wp_enqueue_script( 'validate_js' );
            return ob_get_clean();
        }
    }
}

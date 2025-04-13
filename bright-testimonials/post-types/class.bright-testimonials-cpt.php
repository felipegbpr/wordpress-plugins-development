<?php

if ( !class_exists('Bright_Testimonials_Post_Type' ) ) {
  class Bright_Testimonials_Post_Type {
    
    public function __construct() {
      
      add_action( 'init', array( $this,  'create_post_type' ) );

      add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

      add_action( 'save_post', array( $this, 'save_post' ) );
    }

    public function create_post_type() {
      register_post_type(
        'bright-testimonials',
        array(
            'label' => esc_html__( 'Testimonial', 'bright-testimonials' ),
            'description'   => esc_html__( 'Testimonials', 'bright-testimonials' ),
            'labels' => array(
                'name'  => __( 'Testimonials', 'bright-testimonials' ),
                'singular_name' => esc_html__( 'Testimonial', 'bright-testimonials' )
            ),
            'public'    => true,
            'supports'  => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'  => false,
            'show_ui'   => true,
            'show_in_menu'  => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export'    => true,
            'has_archive'   => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_in_rest'  => true,
            'menu_icon' => 'dashicons-testimonial',
        )
      );
    }

    public function add_meta_boxes() {
      add_meta_box(
        'brt_testimonials_meta_box',
        esc_html__( 'Testimonials Options', 'bright-testimonials' ),
        array( $this, 'add_inner_meta_boxes' ),
        'bright-testimonials',
        'normal',
        'high'
      );
    }

    public function add_inner_meta_boxes( $post ) {
      require_once( BRIGHT_TESTIMONIALS_PATH  . 'views/bright-testimonials_metabox.php' );
    }

		public function save_post( $post_id ) {

			if ( isset( $_POST['brt_testimonials_nonce'] ) ) {
				if ( ! wp_verify_nonce( $_POST['brt_testimonials_nonce'], 'brt_testimonials_nonce') ) {
					return;
				}
			}

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'bright-testimonials' ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}

			if (isset($_POST['action']) && $_POST['action'] == 'editpost') {

				$old_occupation = get_post_meta( $post_id, 'brt_testimonials_occupation', true ); 
				$new_occupation = $_POST['brt_testimonials_occupation'];
				$old_company    = get_post_meta( $post_id, 'brt_testimonials_company', true ); 
				$new_company    = $_POST['brt_testimonials_company'];
				$old_user_url   = get_post_meta( $post_id, 'brt_testimonials_user_url', true ); 
				$new_user_url   = $_POST['brt_testimonials_user_url']; 
		
				update_post_meta( $post_id, 'brt_testimonials_occupation', sanitize_text_field( $new_occupation ), $old_occupation );
				update_post_meta( $post_id, 'brt_testimonials_company', sanitize_text_field( $new_company ), $old_company );
				update_post_meta( $post_id, 'brt_testimonials_user_url', esc_url_raw( $new_user_url ), $old_user_url );
			}

		}
  } 
}
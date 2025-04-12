<?php

if ( !class_exists('Bright_Testimonials_Post_Type' ) ) {
  class Bright_Testimonials_Post_Type {
    
    public function __construct() {
      
      add_action( 'init', array( $this,  'create_post_type' ) );

      add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
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
  } 
}
<?php

if ( ! class_exists( 'Inspire_Translations_Post_Type' ) ) {
	class Inspire_Translations_Post_Type {
		public function __construct() {
			add_action( 'init', array( $this, 'create_post_type') );
			add_action( 'init', array( $this, 'create_taxonomy') );
			add_action( 'init', array( $this, 'register_metadata_table') );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		}

		public function create_post_type() {
			register_post_type(
				'inspire-translations',
				array(
					'label' => esc_html__( 'Translation', 'inspire-translations' ),
					'description'   => esc_html__( 'Translations', 'inspire-translations' ),
					'labels' => array(
							'name'  => esc_html__( 'Translations', 'inspire-translations' ),
							'singular_name' => esc_html__( 'Translation', 'inspire-translations' ),
					),
					'public'    => true,
					'supports'  => array( 'title', 'editor', 'author' ),
					'rewrite'   => array( 'slug' => 'translations' ),
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
					'menu_icon' => 'dashicons-admin-site',
				)
			);
		}

		public function create_taxonomy(){
			register_taxonomy(
					'singers',
					'inspire-translations',
					array(
							'labels' => array(
									'name'  => __( 'Singers', 'inspire-translations' ),
									'singular_name' => __( 'Singer', 'inspire-translations' ),
							),
							'hierarchical' => false,
							'show_in_rest' => true,
							'public'    => true,
							'show_admin_column' => true
					)
			);
		}

		public function register_metadata_table() {
			global $wpdb;
			$wpdb->translationmeta = $wpdb->prefix . 'translationmeta';
		} 

		public function add_meta_boxes() {
      add_meta_box(
        'ipt_testimonials_meta_box',
        esc_html__( 'Translations Options', 'inspire-translations' ),
        array( $this, 'add_inner_meta_boxes' ),
        'inspire-translations',
        'normal',
        'high'
      );
    }

		public function add_inner_meta_boxes( $post ) {
      require_once( INSPIRE_TRANSLATIONS_PATH  . 'views/inspire-translations_metabox.php' );
    }

	}
}

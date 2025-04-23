<?php

if ( ! class_exists( 'Inspire_Translations_Post_Type' ) ) {
	class Inspire_Translations_Post_Type {
		public function __construct() {
			add_action( 'init', array( $this, 'create_post_type') );
			add_action( 'init', array( $this, 'create_taxonomy') );
			add_action( 'init', array( $this, 'register_metadata_table') );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

			add_action( 'wp_insert_post', array( $this, 'save_post' ), 10, 2 );
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

		public function save_post($post_id, $post) {
			if ( isset( $_POST['ipt_translations_nonce'] ) ) {
				if ( ! wp_verify_nonce( $_POST['ipt_translations_nonce'], 'ipt_translations_nonce') ) {
					return;
				}
			}

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'inspire-translations' ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}

			if ( isset( $_POST['action'] ) && $_POST['action'] == 'editpost' ){

				$tansliteration = sanitize_text_field( $_POST['ipt_translations_transliteration'] );		
				$video = esc_url_raw( $_POST['ipt_translations_video_url'] );		

				global $wpdb;

				if ( get_post_type( $post ) == 'inspire-translations' &&
					$post->post_status != 'trash' &&   
					$post->post_status != 'auto-draft' &&   
					$post->post_status != 'draft' &&   
					$wpdb->get_var( 
						$wpdb->prepare( 
							"SELECT translation_id
							FROM $wpdb->translationmeta
							WHERE translation_id = %d",
							$post_id
						 )) == null
				) {
					$wpdb->insert(
						$wpdb->translationmeta,
						array(
							'translation_id' => $post_id,
							'meta_key' => 'ipt_translations_transliteration',
							'meta_value' => $tansliteration
						),
						array(
							'%d', '%s', '%s'
						)
					);
					$wpdb->insert(
						$wpdb->translationmeta,
						array(
							'translation_id' => $post_id,
							'meta_key' => 'ipt_translations_video_url',
							'meta_value' => $video
						),
						array(
							'%d', '%s', '%s'
						)
					);
				}
			}
		} 
	}
}

<?php 

if ( ! class_exists( 'Spark_News_Post_Type' ) ) {
	class Spark_News_Post_Type {

		public function __construct() {
			
			add_action( 'init', array( $this, 'create_post_type' ) );

			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

			add_action( 'save_post', array( $this, 'save_post' ) );
		}

		public function create_post_type() {
			register_post_type(
				'spark-news',
				array(
					'label' => esc_html__( 'News', 'spark-news' ),
					'description' => esc_html__( 'News', 'spark-news' ),
					'labels' => array(
						'name' => esc_html__( 'News', 'spark-news' ),
						'singular_name' => esc_html__( 'News', 'spark-news' )
					),
					'public'    => true,
					'supports'  => array( 'title', 'editor', 'thumbnail'),
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
					'menu_icon' => 'dashicons-format-aside',
				)
			);
		}

		public function add_meta_boxes() {
			add_meta_box(
				'spark_news_meta_box',
				esc_html__( 'News Options', 'spark-news' ),
				array( $this, 'add_inner_meta_boxes' ),
				'spark-news',
				'normal',
				'high'
			);
		}

		public function add_inner_meta_boxes( $post ) {
			require_once( SPARK_NEWS_PATH . 'views/spark-news_metabox.php' );
		}

		public function save_post( $post_id ) {
			if ( isset( $_POST['spark_news_nonce'] ) ) {
				if ( ! wp_verify_nonce( $_POST['spark_news_nonce'], 'spark_news_nonce' ) ) {
					return;
				}
			}

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( isset( $_POST['post_type'] ) && $_POST['post_type'] === 'spark-news' ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}

			if ( isset( $_POST['action'] ) && $_POST['action'] == 'editpost' ) {

				$old_occupation = get_post_meta( 'spark_news_occupation', true );
				$new_occupation = $_POST['spark_news_occupation'];
				$old_press_vehicle = get_post_meta( 'spark_news_press_vehicle', true );
				$new_press_vehicle = $_POST['spark_news_press_vehicle'];
				$old_author_url = get_post_meta( 'spark_news_author_url', true );
				$new_author_url = $_POST['spark_news_author_url'];
				$old_video_url = get_post_meta( 'spark_news_video_url', true );
				$new_video_url = $_POST['spark_news_video_url'];
				$old_author_name = get_post_meta( 'spark_news_author_name', true );
				$new_author_name = $_POST['spark_news_author_name'];

				update_post_meta( $post_id, 'spark_news_occupation', sanitize_text_field( $new_occupation ), $old_occupation );
				update_post_meta( $post_id, 'spark_news_press_vehicle', sanitize_text_field( $new_press_vehicle ), $old_press_vehicle );
				update_post_meta( $post_id, 'spark_news_author_url', sanitize_text_field( $new_author_url ), $old_author_url );
				update_post_meta( $post_id, 'spark_news_video_url', sanitize_text_field( $new_video_url ), $old_video_url );
				update_post_meta( $post_id, 'spark_news_author_name', sanitize_text_field( $new_author_name ), $old_author_name );

			}
		}

	}
}
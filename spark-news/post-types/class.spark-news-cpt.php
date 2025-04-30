<?php 

if ( ! class_exists( 'Spark_News_Post_Type' ) ) {
	class Spark_News_Post_Type {

		public function __construct() {
			
			add_action( 'init', array( $this, 'create_post_type' ) );

			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
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

		public function add_inner_meta_boxes() {
			require_once( SPARK_NEWS_PATH . 'views/spark-news_metabox.php' );
		}

	}
}
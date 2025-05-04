<?php

class Spark_News_Widget extends WP_Widget {

	public function __construct() {

		$widget_options = array(
			'description'  => __( 'Your most beloved news', 'spark-news' ) 
		);

		parent::__construct(
			'spark-news',
			'Spark News',
			$widget_options
		);

		add_action(
			'widgets_init', function() {
				register_widget(
					'Spark_News_Widget'
				);
			}
		);
		
	} 

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$author_name = isset( $instance['author_name'] ) ? $instance['author_name'] : '';
		$number = isset( $instance['number'] ) ? (int) $instance['number'] : 5;
		$image = isset( $instance['image'] ) ? (bool) $instance['image'] : false;
		$press_vehicle = isset( $instance['press_vehicle'] ) ? (bool) $instance['press_vehicle'] : false;
		$occupation = isset( $instance['occupation'] ) ? (bool) $instance['occupation'] : false;
		?>
			<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'spark-news' ); ?>:</label>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
			</p>

			<p>
					<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of news to show', 'spark-news' ); ?>:</label>
					<input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" step="1" min="1" size="3" value="<?php echo esc_attr( $number ); ?>">
			</p>

			<p>
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'author_name' ); ?>" name="<?php echo $this->get_field_name( 'author_name' ); ?>" <?php checked( $author_name ); ?>>
				<label for="<?php echo $this->get_field_id( 'author_name' ); ?>"><?php esc_html_e( 'Display author name?', 'spark-news' ); ?></label>
			</p>

			<p>
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" <?php checked( $image ); ?>>
					<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e( 'Display news image?', 'spark-news' ); ?></label>
			</p>

			<p>
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'occupation' ); ?>" name="<?php echo $this->get_field_name( 'occupation' ); ?>" <?php checked( $occupation ); ?>>
					<label for="<?php echo $this->get_field_id( 'occupation' ); ?>"><?php esc_html_e( 'Display author occupation?', 'spark-news' ); ?></label>
			</p>

			<p>
					<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'press_vehicle' ); ?>" name="<?php echo $this->get_field_name( 'press_vehicle' ); ?>" <?php checked( $press_vehicle ); ?>>
					<label for="<?php echo $this->get_field_id( 'press_vehicle' ); ?>"><?php esc_html_e( 'Display press vehicle?', 'spark-news' ); ?></label>
			</p>

		<?php
	}

	public function widget( $args, $instance ) {
		$default_title = 'Spark News';
		$title = !empty( $instance['title'] ) ? $instance['title'] : $default_title;
		$author_name = !empty( $instance['author_name'] ) ? $instance['author_name'] : false;
		$number = !empty( $instance['number'] ) ? $instance['number'] : 5;
		$image = !empty( $instance['image'] ) ? $instance['image'] : false;
		$press_vehicle = !empty( $instance['press_vehicle'] ) ? $instance['press_vehicle'] : false;
		$occupation = !empty( $instance['occupation'] ) ? $instance['occupation'] : false;

		echo $args['before_widget'];
		echo $args['before_title'] . $title . $args['after_title'];

		// TO-DO
		// require( SPARK_NEWS_PATH . 'views/spark-news_widget.php' );

		echo '<p>Widget Template View</p>';

		echo $args['after_widget'];
	}
	
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['author_name'] = ! empty ( $new_instance['author_name'] ) ? 1 : 0 ;
		$instance['number'] = (int) $new_instance['number'];
		$instance['image'] = ! empty ( $new_instance['image'] ) ? 1 : 0;
		$instance['press_vehicle'] = ! empty ( $new_instance['press_vehicle'] ) ? 1 : 0;
		$instance['occupation'] = ! empty ( $new_instance['occupation'] ) ? 1 : 0;
		return $instance;
	}  
}
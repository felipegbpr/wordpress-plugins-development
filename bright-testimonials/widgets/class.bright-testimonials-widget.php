<?php

class Bright_Testimonials_Widget extends WP_Widget {
	public function __construct() {
		$widget_options = array(
			'description' => __( 'Your most beloved testimonials', 'bright-testimonials' )
		);
		
		parent::__construct(
			'bright-testimonials',
			'Bright Testimonials',
			$widget_options
		);

		add_action(
			'widgets_init', function() {
				register_widget(
					'Bright_Testimonials_Widget'
				);
			}
		);
	}

	public function form( $instance ) {

	}

	public function widget( $args, $instance ) {

	}

	public function update( $new_instance, $old_instance ) {

	}
}  
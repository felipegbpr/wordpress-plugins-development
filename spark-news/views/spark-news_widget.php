<?php
	$news = new WP_Query(
		array(
			'post_type' => 'spark-news',
			'posts_per_page'  => $number,
			'post_status'    => $publish
		)
	);

	if ( $news->have_posts() ) :
		while ( $news->have_posts() ):
			$news->the_post(); 

			$author_url_meta = get_post_meta( get_the_ID(), 'spark_news_author_url', true );
			$author_name_meta = get_post_meta( get_the_ID(), 'spark_news_author_name', true );
			$occupation_meta = get_post_meta( get_the_ID(), 'spark_news_occupation', true );
			$press_vehicle_meta_url = get_post_meta( get_the_ID(), 'spark_news_press_vehicle_url', true );
			$press_vehicle_meta = get_post_meta( get_the_ID(), 'spark_news_press_vehicle', true );
?>

	<div class="news-item">
		<div class="title">
			<h4><?php the_title(); ?></h4>
		</div>
		<div class="content">
			<?php if ( $image ): ?>
				<div class="thumb">
					<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( array( 520, 520 ) );
						}
					?>
				</div>
			<?php endif; ?>	
			<?php the_content(); ?>
		</div>
		<div class="meta">
			<?php if ( $author_name ): ?>
				<span class="author_name"><a href="<?php echo esc_attr( $author_url_meta ) ?>"><?php echo esc_html( $author_name_meta ); ?></a></span>
			<?php endif; ?>
			<?php if ( $occupation ): ?>
				<span class="occupation"><?php echo esc_html( $occupation_meta ); ?></span>
			<?php endif; ?>					
			<?php if ( $press_vehicle ): ?>
				<span class="press_vehicle"><a href="<?php echo esc_attr( $press_vehicle_meta_url ) ?>" target="_blank"><?php echo esc_html( $press_vehicle_meta ); ?></a></span>
			<?php endif; ?>											
		</div>		
	</div>		
<?php
		endwhile;
	wp_reset_postdata();
endif;
?>
<a href="<?php echo get_post_type_archive_link( 'spark-news' ); ?>"><?php echo esc_html_e( 'Show More News', 'spark-news' ); ?></a>
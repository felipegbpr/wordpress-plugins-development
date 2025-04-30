<?php
    // $occupation = get_post_meta( $post->ID, 'spark_news_occupation', true );
    // $press_vehicle = get_post_meta( $post->ID, 'spark_news_press_vehicle', true );
    // $author_url = get_post_meta( $post->ID, 'spark_news_author_url', true );
    // $video_url = get_post_meta( $post->ID, 'spark_news_video_url', true );
?>
<table class="form-table spark-news-metabox"> 
    <input type="hidden" name="spark_news_nonce" value="<?php echo wp_create_nonce( "spark_news_nonce" ); ?>">
    <tr>
        <th>
            <label for="spark_news_occupation"><?php esc_html_e( 'Author occupation', 'spark-news' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="spark_news_occupation" 
                id="spark_news_occupation" 
                class="regular-text occupation"
                value=""
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="spark_news_company"><?php esc_html_e( 'Author press vehicle', 'spark-news' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="spark_news_press_vehicle" 
                id="spark_news_press_vehicle" 
                class="regular-text press-vehicle"
                value=""
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="spark_news_author_url"><?php esc_html_e( 'Author URL', 'spark-news' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="spark_news_author_url" 
                id="spark_news_author_url" 
                class="regular-text author-url"
                value=""
            >
        </td>
    </tr> 
		<tr>
        <th>
            <label for="spark_news_video_url"><?php esc_html_e( 'Video URL', 'spark-news' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="spark_news_video_url" 
                id="spark_news_video_url" 
                class="regular-text video-url"
                value=""
            >
        </td>
    </tr> 
</table>
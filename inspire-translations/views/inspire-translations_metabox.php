<?php 

global $wpdb;
$query = $wpdb->prepare(
	"SELECT * FROM $wpdb->translationmeta 
	WHERE translation_id = %d",
	$post->ID
);
$results = $wpdb->get_results( $query, ARRAY_A );
?>
<table class="form-table inspire-translations-metabox"> 
    <!-- Nonce -->
    <input type="hidden" name="ipt_translations_nonce" value="<?php echo wp_create_nonce( 'ipt_translations_nonce' ); ?>">
    
		<input 
			type="hidden" 
			name="ipt_translations_action" 
			value="<?php echo ( empty( $results[0]['meta_value'] ) || empty ( $results[1]['meta_value'] ) ? 'save' : 'update' ); ?>">
    <tr>
        <th>
            <label for="ipt_translations_transliteration"><?php esc_html_e( 'Has transliteration?', 'inspire-translations' ); ?></label>
        </th>
        <td>
            <select name="ipt_translations_transliteration" id="ipt_translations_transliteration">
                <option value="Yes" <?php if( isset( $results[0]['meta_value'] ) ) selected( $results[0]['meta_value'], 'Yes' ); ?>><?php esc_html_e( 'Yes', 'inspire-translations' )?></option>';
                <option value="No" <?php if( isset( $results[0]['meta_value'] ) ) selected( $results[0]['meta_value'], 'No' ); ?>><?php esc_html_e( 'No', 'inspire-translations' )?></option>';
            </select>            
        </td>
    </tr>
    <tr>
        <th>
            <label for="ipt_translations_video_url"><?php esc_html_e( 'Video URL', 'inspire-translations' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="ipt_translations_video_url" 
                id="ipt_translations_video_url" 
                class="regular-text video-url"
                value="<?php echo ( isset( $results[1]['meta_value'] ) ) ? esc_url( $results[1]['meta_value'] ) : ""; ?>"
            >
        </td>
    </tr> 
</table>
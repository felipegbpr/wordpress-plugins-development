<table class="form-table inspire-translations-metabox"> 
    <!-- Nonce -->
    <input type="hidden" name="ipt_translations_nonce" value="<?php echo wp_create_nonce( 'ipt_translations_nonce' ); ?>">
    <tr>
        <th>
            <label for="ipt_translations_transliteration"><?php esc_html_e( 'Has transliteration?', 'mv-translations' ); ?></label>
        </th>
        <td>
            <select name="ipt_translations_transliteration" id="ipt_translations_transliteration">
                <option value="Yes"><?php esc_html_e( 'Yes', 'mv-translations' )?></option>';
                <option value="No"><?php esc_html_e( 'No', 'mv-translations' )?></option>';
            </select>            
        </td>
    </tr>
    <tr>
        <th>
            <label for="ipt_translations_video_url"><?php esc_html_e( 'Video URL', 'mv-translations' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="ipt_translations_video_url" 
                id="ipt_translations_video_url" 
                class="regular-text video-url"
                value=""
            >
        </td>
    </tr> 
</table>
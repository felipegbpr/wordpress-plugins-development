<div class="inspire-translations">
	<form action="" method="POST" id="translations-form">
		<h2><?php esc_html_e( 'Submit new translation' , 'inspire-translations' ); ?></h2>
		
		<label for="ipt_translations_title"><?php esc_html_e( 'Title', 'inspire-translations' ); ?> *</label>
		<input type="text" name="ipt_translations_title" id="ipt_translations_title" value="" required />
		<br />
		<label for="ipt_translations_singer"><?php esc_html_e( 'Singer', 'inspire-translations' ); ?> *</label>
		<input type="text" name="ipt_translations_singer" id="ipt_translations_singer" value="" required />

		<br />
		<?php wp_editor( '', 'ipt_translations', array( 'wpautop' => true, 'media_buttons' => false ) ); ?>	
		</br />
		
		<fieldset id="additional-fields">
			<label for="ipt_translations_transliteration"><?php esc_html_e( 'Has transliteration?', 'inspire-translations' ); ?></label>
			<select name="ipt_translations_transliteration" id="ipt_translations_transliteration">
				<option value="Yes"><?php esc_html_e( 'Yes', 'inspire-translations' ); ?></option>
				<option value="No"><?php esc_html_e( 'No', 'inspire-translations' ); ?></option>
			</select>
			<label for="ipt_translations_video_url"><?php esc_html_e( 'Video URL', 'inspire-translations' ); ?></label>
			<input type="url" name="ipt_translations_video_url" id="ipt_translations_video_url" value="" />
		</fieldset>
		<br />
		<input type="hidden" name="ipt_translations_action" value="save">
		<input type="hidden" name="action" value="editpost">
		<input type="hidden" name="ipt_translations_nonce" value="<?php echo wp_create_nonce( 'ipt_translations_nonce' ); ?>">
		<input type="hidden" name="submitted" id="submitted" value="true" />
		<input type="submit" name="submit_form" value="<?php esc_attr_e( 'Submit', 'inspire-translations' ); ?>" />
	</form>
</div>
<div class="translations-list">
	<table>
			<caption><?php esc_html_e( 'Your Translations', 'inspire-translations' ); ?></caption>
			<thead>
				<tr>
					<th><?php esc_html_e( 'Date', 'inspire-translations' ); ?></th>
					<th><?php esc_html_e( 'Title', 'inspire-translations' ); ?></th>
					<th><?php esc_html_e( 'Transliteration', 'inspire-translations' ); ?></th>
					<th><?php esc_html_e( 'Edit?', 'inspire-translations' ); ?></th>
					<th><?php esc_html_e( 'Delete?', 'inspire-translations' ); ?></th>
					<th><?php esc_html_e( 'Status', 'inspire-translations' ); ?></th>
				</tr>
			</thead>  
			<tbody>  
				<tr>
					<td>Date</td>
					<td>Title</td>
					<td>Transliteraton</td>
					<td>Edit</td>
					<td>Delete</td>
					<td>Status</td>
				</tr>
	</tbody>
</table>
</div>
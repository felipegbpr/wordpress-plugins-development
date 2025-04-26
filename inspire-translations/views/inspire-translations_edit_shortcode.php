<?php

if ( ! is_user_logged_in() ) {
	iptt_register_user();
	return;
}

if ( isset( $_POST['ipt_translations_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['ipt_translations_nonce'], 'ipt_translations_nonce') ) {
		return;
	}
}

$errors = array();
$hasError = false;

if( isset( $_POST['submitted'])){
    $title              = $_POST['ipt_translations_title'];
    $content            = $_POST['ipt_translations_content'];
    $singer             = $_POST['ipt_translations_singer'];
    $transliteration    = $_POST['ipt_translations_transliteration'];
    $video              = $_POST['ipt_translations_video_url'];

		if ( trim( $title ) === '' ) {
			$errors[] = esc_html__( 'Please, enter a title', 'inspire-translations' );
			$hasError = true;
		}

		if ( trim( $content ) === '' ) {
			$errors[] = esc_html__( 'Please, enter a content', 'inspire-translations' );
			$hasError = true;
		}

		if ( trim( $singer ) === '' ) {
			$errors[] = esc_html__( 'Please, enter a singer', 'inspire-translations' );
			$hasError = true;
		}

		if ( $hasError === false ) {
			$post_info = array(
				'post_type' => 'inspire-translations',
				'post_title'  => sanitize_text_field( $title ),
				'post_content' => wp_kses_post( $content ),
				'tax_input'  => array(
					'singers'    => sanitize_text_field( $singer )
				),
				'ID'     => $_GET['post']      
			);
	
			$post_id = wp_update_post( $post_info );
	
			global $post;
			Inspire_Translations_Post_Type::save_post( $post_id, $post );
		}

}

global $current_user;
global $wpdb; 
$q = $wpdb->prepare(
	"SELECT ID, post_author, post_title, post_content, meta_key, meta_value
	FROM $wpdb->posts AS p
	INNER JOIN $wpdb->translationmeta AS tm
	ON p.ID = tm.translation_id
	WHERE p.ID = %d
	AND p.post_author = %d
	ORDER BY p.post_date DESC", 
	$_GET['post'],
	$current_user->ID
);

$results = $wpdb->get_results( $q, ARRAY_A );
?>		

<div class="inspire-translations">

	<form action="" method="POST" id="translations-form">
		<h2><?php esc_html_e( 'Submit new translation' , 'inspire-translations' ); ?></h2>

		<?php 
			if ( $errors != '' ) {
				foreach ($errors as $error) {
					?>
						<span class="error">
							<?php echo $error; ?>
						</span>
					<?php	
				}
			}
		?>
		
		<label for="ipt_translations_title"><?php esc_html_e( 'Title', 'inspire-translations' ); ?> *</label>
		<input type="text" name="ipt_translations_title" id="ipt_translations_title" 
			value="<?php if ( isset( $title ) ) echo $title; ?>" required />
		<br />
		<label for="ipt_translations_singer"><?php esc_html_e( 'Singer', 'inspire-translations' ); ?> *</label>
		<input type="text" name="ipt_translations_singer" id="ipt_translations_singer" 
			value="<?php if ( isset( $singer ) ) echo $singer; ?>" required />

		<br />
		<?php 
			if ( isset( $content ) ) {
				wp_editor( $content, 'ipt_translations_content', array( 'wpautop' => true, 'media_buttons' => false ) ); 
			} else {
				wp_editor( '', 'ipt_translations_content', array( 'wpautop' => true, 'media_buttons' => false ) ); 
			}
		?> 	
		</br />
		
		<fieldset id="additional-fields">
			<label for="ipt_translations_transliteration"><?php esc_html_e( 'Has transliteration?', 'inspire-translations' ); ?></label>
			<select name="ipt_translations_transliteration" id="ipt_translations_transliteration">
				<option value="Yes" <?php if ( isset( $transliteration ) ) selected( $transliteration, "Yes" ); ?>><?php esc_html_e( 'Yes', 'inspire-translations' ); ?></option>
				<option value="No <?php if ( isset( $transliteration ) ) selected( $transliteration, "No" ); ?>"><?php esc_html_e( 'No', 'inspire-translations' ); ?></option>
			</select>
			<label for="ipt_translations_video_url"><?php esc_html_e( 'Video URL', 'inspire-translations' ); ?></label>
			<input type="url" name="ipt_translations_video_url" id="ipt_translations_video_url" 
				value="<?php if ( isset( $video ) ) echo $video; ?>" />
		</fieldset>
		<br />
		<input type="hidden" name="ipt_translations_action" value="update">
		<input type="hidden" name="action" value="editpost">
		<input type="hidden" name="ipt_translations_nonce" value="<?php echo wp_create_nonce( 'ipt_translations_nonce' ); ?>">
		<input type="hidden" name="submitted" id="submitted" value="true" />
		<input type="submit" name="submit_form" value="<?php esc_attr_e( 'Submit', 'inspire-translations' ); ?>" />
	</form>
</div>

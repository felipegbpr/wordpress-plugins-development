<?php 
	$occupation = get_post_meta( $post->ID, 'brt_testimonials_occupation', true );
	$company = get_post_meta( $post->ID, 'brt_testimonials_company', true );
	$user_url = get_post_meta( $post->ID, 'brt_testimonials_user_url', true );	
?>

<table class="form-table bright-testimonials-metabox"> 
		<input type="hidden" name="brt_testimonials_nonce" value="<?php echo wp_create_nonce( "brt_testimonials_nonce" ); ?>">
    <tr>
        <th>
            <label for="brt_testimonials_occupation"><?php esc_html_e( 'User occupation', 'bright-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="brt_testimonials_occupation" 
                id="brt_testimonials_occupation" 
                class="regular-text occupation"
                value="<?php echo( isset( $occupation ) ) ? esc_html( $occupation ) : ''; ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="brt_testimonials_company"><?php esc_html_e( 'User company', 'bright-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="brt_testimonials_company"
                id="brt_testimonials_company" 
                class="regular-text company"
                value="<?php echo( isset( $company ) ) ? esc_html( $company ) : ''; ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="brt_testimonials_user_url"><?php esc_html_e( 'User URL', 'bright-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="brt_testimonials_user_url" 
                id="brt_testimonials_user_url" 
                class="regular-text user-url"
                value="<?php echo( isset( $user_url ) ) ? esc_url( $user_url ) : ''; ?>"
            >
        </td>
    </tr> 
</table>
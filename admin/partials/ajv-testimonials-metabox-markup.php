<?php

/**
 * Provide an admin area view for the meta boxes.
 *
 * This file is used to markup the testimonials meta box.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Testimonials
 * @subpackage AJV_Testimonials/admin/partials
 */

?>

<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="_ajv_testimonial_text"><?php _e( 'Testimonial', 'ajv-testimonials' ); ?></label>
			</th>
			<td>
				<p>
					<textarea class="widefat" rows="8" cols="78" name="_ajv_testimonial_text" id="_ajv_testimonial_text"><?php if ( isset ( $testimonials_stored_meta['_ajv_testimonial_text'] ) ) echo esc_attr( $testimonials_stored_meta['_ajv_testimonial_text'][0] ); ?></textarea>
				</p>
				<p>
					<span class="description"><em><?php _e( 'Enter the full testimonial text.', 'ajv-testimonials' ) ?></em></span>
				</p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_ajv_testimonial_position"><?php _e( 'Position', 'ajv-testimonials' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_testimonial_position" id="_ajv_testimonial_position" value="<?php if ( isset ( $testimonials_stored_meta['_ajv_testimonial_position'] ) ) echo esc_attr( $testimonials_stored_meta['_ajv_testimonial_position'][0] ); ?>">
				</p>
				<p>
					<span class="description"><em><?php _e( 'Enter the client\'s position in their company.', 'ajv-testimonials' ) ?></em></span>
				</p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_ajv_testimonial_company"><?php _e( 'Company', 'ajv-testimonials' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_testimonial_company" id="_ajv_testimonial_company" value="<?php if ( isset ( $testimonials_stored_meta['_ajv_testimonial_company'] ) ) echo esc_attr( $testimonials_stored_meta['_ajv_testimonial_company'][0] ); ?>">
				</p>
				<p>
					<span class="description"><em><?php _e( 'Enter the name of the client\'s company, business, or organization.', 'ajv-testimonials' ) ?></em></span>
				</p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_ajv_testimonial_url"><?php _e( 'Link URL', 'ajv-testimonials' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_testimonial_url" id="_ajv_testimonial_url" value="<?php if ( isset ( $testimonials_stored_meta['_ajv_testimonial_url'] ) ) echo esc_url( $testimonials_stored_meta['_ajv_testimonial_url'][0] ); ?>" placeholder="http://...">
				</p>
				<p>
					<span class="description"><em><?php _e( 'Enter the link to the client\'s company site, or the portfolio page where the work is displayed.', 'ajv-testimonials' ) ?></em></span>
				</p>
			</td>
		</tr>
	</tbody>
</table>

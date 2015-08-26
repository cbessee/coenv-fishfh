<?php
/**
 * Adds divs around all inline images (for excerpts)
 **/
function breezer_addDivToImage( $content ) {

   // A regular expression of what to look for.
   $pattern = '/(<img([^>]*)>)/i';
   // What to replace it with. $1 refers to the content in the first 'capture group', in parentheses above
   $replacement = '<div class="myphoto">$1</div>';

   // run preg_replace() on the $content
   $content = preg_replace( $pattern, $replacement, $content );

   // return the processed content
   return $content;
}
if (is_archive()):
	add_filter( 'the_content', 'breezer_addDivToImage' );
endif;

/**
 * Add custom media metadata fields
 *
 * Be sure to sanitize your data before saving it
 * http://codex.wordpress.org/Data_Validation
 *
 * @param $form_fields An array of fields included in the attachment form
 * @param $post The attachment record in the database
 * @return $form_fields The final array of form fields to use
 */
function add_image_attachment_fields_to_edit( $form_fields, $post ) {		
	// Add a Credit field
	$form_fields["credit_text"] = array(
		"label" => __("Credit"),
		"input" => "text", // this is default if "input" is omitted
		"value" => esc_attr( get_post_meta($post->ID, "_credit_text", true) ),
		"helps" => __("The owner of the image."),
	);
	
	// Add a Credit field
	$form_fields["credit_link"] = array(
		"label" => __("Credit URL"),
		"input" => "text", // this is default if "input" is omitted
		"value" => esc_url( get_post_meta($post->ID, "_credit_link", true) ),
		"helps" => __("Attribution link to the image source or owners website."),
	);
	
	return $form_fields;
}
add_filter("attachment_fields_to_edit", "add_image_attachment_fields_to_edit", null, 2);

/**
 * Save custom media metadata fields
 *
 * Be sure to validate your data before saving it
 * http://codex.wordpress.org/Data_Validation
 *
 * @param $post The $post data for the attachment
 * @param $attachment The $attachment part of the form $_POST ($_POST[attachments][postID])
 * @return $post
 */
function add_image_attachment_fields_to_save( $post, $attachment ) {
	if ( isset( $attachment['credit_text'] ) )
		update_post_meta( $post['ID'], '_credit_text', esc_attr($attachment['credit_text']) );
		
	if ( isset( $attachment['credit_link'] ) )
		update_post_meta( $post['ID'], '_credit_link', esc_url($attachment['credit_link']) );

	return $post;
}
add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", null , 2);

/**
 * Improves the caption shortcode with HTML5 figure & figcaption; microdata & wai-aria attributes
 * 
 * @param  string $val     Empty
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Shortcode content
 * @return string          Shortcode output
 */
function jk_img_caption_shortcode_filter($val, $attr, $content = null)
{
	extract(shortcode_atts(array(
		'id'      => '',
		'align'   => 'aligncenter',
		'width'   => '',
		'caption' => ''
	), $attr));
	
	// No caption, no dice... But why width? 
	if ( 1 > (int) $width || empty($caption) )
		return $val;
 
	if ( $id )
		$id = esc_attr( $id );
		$attach_id = str_replace('attachment_', '', $id);
		$photo_source = get_post_meta( $attach_id, '_credit_text', true );
		$photo_source_url = get_post_meta( $attach_id, '_credit_link', true );
	
		if ( $photo_source ) {
		if (!empty($photo_source_url)) {
			$photo_source_div = "<div class=\"source\"><a href=\"$photo_source_url\" target=\"blank\">$photo_source</a></div>";
		}
		else 
			$photo_source_div = "<div class=\"source\">$photo_source</div>";
		} else
			$photo_source_div= " ";
	


	return '<figure id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '" itemscope itemtype="http://schema.org/ImageObject" style="width: ' . (0 + (int) $width) . 'px"><div class="wp-caption-wrap clearfix">' . do_shortcode( $content ) . $photo_source_div . '</div><figcaption id="figcaption_'. $id . '" class="wp-caption-text" itemprop="description">' . $caption . '</figcaption></figure>';
	
}
add_filter( 'img_caption_shortcode', 'jk_img_caption_shortcode_filter', 10, 3 );
?>
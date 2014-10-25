<?php
/**
 * Admin settings
 */
add_action( 'admin_init', 'coenv_admin_settings' );
function coenv_admin_settings() {
	
	add_option( 'mail_address' );
	add_settings_field( 'mail_address', 'Mailing Address', 'coenv_setting_mail_address', 'general' );
	register_setting( 'general', 'mail_address' );
	
	add_option( 'public_email_address' );
	add_settings_field( 'public_email_address', 'Public Email Address', 'coenv_setting_public_email_address', 'general' );
	register_setting( 'general', 'public_email_address' );
	
	add_option( 'phone' );
	add_settings_field( 'phone', 'Phone Number', 'coenv_setting_phone', 'general' );
	register_setting( 'general', 'phone' );

	add_option( 'meta_description' );
	add_settings_field( 'meta_description', 'Site description', 'coenv_setting_meta_description', 'general' );
	register_setting( 'general', 'meta_description' );

	add_option( 'facebook' );
	add_settings_field( 'facebook', 'Facebook', 'coenv_setting_facebook', 'general' );
	register_setting( 'general', 'facebook' );

	add_option( 'twitter' );
	add_settings_field( 'twitter', 'Twitter', 'coenv_setting_twitter', 'general' );
	register_setting( 'general', 'twitter' );

	add_option( 'youtube' );
	add_settings_field( 'youtube', 'YouTube', 'coenv_setting_youtube', 'general' );
	register_setting( 'general', 'youtube' );
}

/**
 * Street Address setting
 */
function coenv_setting_mail_address() {
	$value = get_option('mail_address');

	?>	
		<p>The mailing address of the unit.</p>
				<input name="mail_address" type="text" id="mail_address" value="<?php echo $value; ?>" class="regular-text">
	<?php
}

/**
 * Public Email Address setting
 */
function coenv_setting_public_email_address() {
	$value = get_option('public_email_address');

	?>	
		<p>The public email address of the unit.</p>
				<input name="public_email_address" type="text" id="public_email_address" value="<?php echo $value; ?>" class="regular-text">
	<?php
}

/**
 * Phone Number setting
 */
function coenv_setting_phone() {
	$value = get_option('phone');

	?>	
		<p>The general phone number of the unit.</p>
				<input name="phone" type="text" id="phone" value="<?php echo $value; ?>" class="regular-text">
	<?php
}

/**
 * Meta description setting
 */
function coenv_setting_meta_description() {
	$value = get_option('meta_description');

	?>	
		<p>In one or two short sentences, describe your site. This description is used in the search results of search engines like Google.</p>
		<textarea name="meta_description" id="meta_description" cols="30" rows="10" style="width: 100%"><?php echo $value ?></textarea>
	<?php
}

/**
 * Facebook setting
 */
function coenv_setting_facebook() {
	$value = get_option('facebook');

	?>	
		<input name="facebook" type="text" id="facebook" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Full URL to your Facebook page (e.g. https://facebook.com&hellip;).</p>
	<?php
}

/**
 * Twitter setting
 */
function coenv_setting_twitter() {
	$value = get_option('twitter');

	?>	
		<input name="twitter" type="text" id="twitter" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Just the handle ONLY (e.g. @handle).</p>
	<?php
}

/**
 * YouTube setting
 */
function coenv_setting_youtube() {
	$value = get_option('youtube');

	?>	
		<input name="youtube" type="text" id="youtube" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Full URL to your YouTube Channel.</p>
	<?php
}

/**
 * Feeds setting
 */
function coenv_setting_feeds() {
	$value = get_option('feeds');

	?>	
		<input name="feeds" type="text" id="feeds" value="<?php echo $value; ?>" class="regular-text">
		<p class="description">Full URL to your Feeds aggregation page (e.g. http://www.feedburner&hellip;).</p>
	<?php
}


?>
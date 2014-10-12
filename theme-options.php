<?php
function theme_options_page()
{
	add_submenu_page('themes.php', 'Theme Settings', 'Theme Settings', 'manage_options', 'theme-options', 'build_options_page');
}
add_action('admin_menu', 'theme_options_page');

function build_options_page()
{
?>
<div id="theme-options-wrap">
	<div class="icon32" id="icon-tools"> <br /> </div>
	<h2>Theme Settings</h2>
	<p>Update various settings throughout your website.</p>
	<form method="post" action="options.php" enctype="multipart/form-data">
		<?php settings_fields('theme_options'); ?>
		<?php do_settings_sections(__FILE__); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
	</form>
</div>
<?php
}
add_action('admin_init', 'register_and_build_fields');
function register_and_build_fields() {
	register_setting('theme_options', 'theme_options', 'validate_setting');
	add_settings_section('header_settings', 'Header Settings', 'section_header', __FILE__);
	add_settings_section('homepage_settings', 'Homepage Settings', 'section_homepage', __FILE__);
	add_settings_section('footer_settings', 'Footer Settings', 'section_footer', __FILE__);
	function section_homepage() {}
	function section_header() {}
	function section_footer() {}
	add_settings_field('localphone', 'Local Phone Number', 'localphone_setting', __FILE__, 'header_settings');
	add_settings_field('freephone', 'Freephone Number', 'freephone_setting', __FILE__, 'header_settings');

	add_settings_field('button2text', 'Button 2 Text', 'button2text_setting', __FILE__, 'homepage_settings');
	add_settings_field('button2link', 'Button 2 URL', 'button2link_setting', __FILE__, 'homepage_settings');

	add_settings_field('button3text', 'Button 3 Text', 'button3text_setting', __FILE__, 'homepage_settings');
	add_settings_field('button3link', 'Button 3 URL', 'button3link_setting', __FILE__, 'homepage_settings');
	add_settings_field('phonenumber', 'Phone Number', 'phonenumber', __FILE__, 'footer_settings');
	add_settings_field('facebookurl', 'Facebook URL', 'facebookurl', __FILE__, 'footer_settings');
	add_settings_field('googleurl', 'Google+ URL', 'googleurl', __FILE__, 'footer_settings');
	add_settings_field('instagramurl', 'instagram URL', 'instagramurl', __FILE__, 'footer_settings');
}
function validate_setting($theme_options) {
	return $theme_options;
}
function localphone_setting() {
	$options = get_option('theme_options');  echo "<input name='theme_options[localphone_setting]' type='text' value='{$options['localphone_setting']}' />";
}
function freephone_setting() {
	$options = get_option('theme_options');  echo "<input name='theme_options[freephone_setting]' type='text' value='{$options['freephone_setting']}' />";
}
function button2text_setting() {
	$options = get_option('theme_options');  echo "<input name='theme_options[button2text_setting]' type='text' value='{$options['button2text_setting']}' />";
}
function button2link_setting() {
	$options = get_option('theme_options');  echo "<input name='theme_options[button2link_setting]' type='text' value='{$options['button2link_setting']}' />";
}
function button3text_setting() {
	$options = get_option('theme_options');  echo "<input name='theme_options[button3text_setting]' type='text' value='{$options['button3text_setting']}' />";
}
function button3link_setting() {
	$options = get_option('theme_options');  echo "<input name='theme_options[button3link_setting]' type='text' value='{$options['button3link_setting']}' />";
}
function phonenumber() {
	$options = get_option('theme_options');  echo "<input name='theme_options[phonenumber]' type='text' value='{$options['phonenumber']}' />";
}
function facebookurl() {
	$options = get_option('theme_options');  echo "<input name='theme_options[facebookurl]' type='text' value='{$options['facebookurl']}' />";
}
function googleurl() {
	$options = get_option('theme_options');  echo "<input name='theme_options[googleurl]' type='text' value='{$options['googleurl']}' />";
}
function instagramurl() {
	$options = get_option('theme_options');  echo "<input name='theme_options[instagramurl]' type='text' value='{$options['instagramurl']}' />";
}
?>

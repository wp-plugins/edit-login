<?php
/*
Plugin Name: Edit Login
Plugin URI: http://www.timeoutworld.net/
Description: Edit Login plugin allows you to edit the wordpress default login page: customize easily the login page background and font, the logo and its link
Version: 1.4.2
Author: Diego Foroni
Author URI: http://www.timeoutworld.net/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

For list of WordPress hooks thanks to: http://adambrown.info/p/wp_hooks/hook
*/

/** Option and Admin area **/
//Sets default options at the plugin's activation
function editLogin_activate_set_default_options() {
    add_option('editLogin_login_logo_url', get_bloginfo('url'));
    add_option('editLogin_login_logo_image', '');
    add_option('editLogin_login_bg_image', '');
    add_option('editLogin_login_custom_font', '');
}

//Registration of the plugins options
function editLogin_register_options_group() {
    register_setting('editLogin_options_group', 'editLogin_login_logo_url');
    register_setting('editLogin_options_group', 'editLogin_login_logo_image');
    register_setting('editLogin_options_group', 'editLogin_login_bg_image');
    register_setting('editLogin_options_group', 'editLogin_login_custom_font');
}

//Sets the admin PAGE
function editLogin_update_options_form()
{
?>
    <div class="wrap">
		<div class="icon32" id="icon-options-general"><br /></div>
		<h2>Edit Login - Settings</h2>
		<form method="post" action="options.php">
		<?php settings_fields('editLogin_options_group'); ?>
		<table class="form-table">
			<tbody>
			<tr valign="top">
				<th scope="row" style="width: 420px;"><label for="editLogin_login_logo_image"><strong>Logo - Image URL</strong> (example: http://www.yoursite.com/folder/file.png):</label></th>
				<td>
					<input type="text" id="editLogin_login_logo_image" value="<?php echo get_option('editLogin_login_logo_image'); ?>" name="editLogin_login_logo_image" style="width: 100%;" />
					<span class="description"></span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="editLogin_login_logo_url"><strong>Logo - Link URL</strong> (example: http://www.yoursite.com/):</label></th>
				<td>
					<input type="text" id="editLogin_login_logo_url" value="<?php echo get_option('editLogin_login_logo_url'); ?>" name="editLogin_login_logo_url" style="width: 100%;" />
					<span class="description"></span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="editLogin_login_bg_image"><strong>Background image URL</strong> (example: http://www.yoursite.com/folder/file.png):</label></th>
				<td>
					<input type="text" id="editLogin_login_bg_image" value="<?php echo get_option('editLogin_login_bg_image'); ?>" name="editLogin_login_bg_image" style="width: 100%;" />
					<span class="description"></span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="editLogin_login_custom_font"><strong>Custom Font</strong> - use only <a href="http://www.google.com/fonts/" target="_blank">Google Fonts</a>:</label></th>
				<td valign="top">
					<input type="text" id="editLogin_login_custom_font" value="<?php echo get_option('editLogin_login_custom_font'); ?>" name="editLogin_login_custom_font" style="width: 100%;" /><br />
					<strong>Example</strong>: http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700
					<span class="description"></span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<p>
						<input type="submit" class="button-primary" id="submit" name="submit" value="<?php _e('Save Changes') ?>" /></form>
						<br /><br/><br />
						This program is free software; you can redistribute it and/or
						modify it under the terms of the GNU General Public License
						as published by the Free Software Foundation; either version 2
						of the License, or (at your option) any later version.
						<br /><br />
						This program is distributed in the hope that it will be useful,
						but WITHOUT ANY WARRANTY; without even the implied warranty of
						MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
						GNU General Public License for more details.
						<br /><br/>
						Created by TimeoutWorld.net
						<br /><br /><br />
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="EGH5F69Z8Y5R4">
							<input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - Il metodo rapido, affidabile e innovativo per pagare e farsi pagare.">
							<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
						</form>
					</p>
				</th>
				<td align="center"><img src="<? echo plugins_url('sample.jpg' , __FILE__ ); ?>" /></td>
			</tr>
			</tbody>
		</table>		
		</div>
	</div>
<?php
}

//Inserts the admin page's link in the menu and in the plugin's list
function editLogin_add_option_page() {
    add_options_page('Edit Login', 'Edit Login', 'administrator', 'editlogin-options-page', 'editLogin_update_options_form');
}

function editLogin_add_option_page_link($links, $file) {
	if ($file == plugin_basename( dirname(__FILE__).'/editLogin.php' ) ) {
		$links[] = '<a href="' . admin_url( 'admin.php?page=editlogin-options-page' ) . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}
/** END **/

//Logo's page: logo picture, background customization and custom font
function editLogin_change_login_logo() {
    $bgLink = get_option('editLogin_login_bg_image');
	$logoPic = get_option('editLogin_login_logo_image');
	$font = get_option('editLogin_login_custom_font');
	
	echo '<style type="text/css">';
	if(empty($bgLink)){} else {
		echo 'body.login {
			background-image: url('.$bgLink.');
			background-attachment: fixed;
		}';
	}
	if(empty($logoPic)){} else {
		echo 'h1 {
			background-image:url('.$logoPic.') !important; background-size: 320px 38px !important; height: 38px !important; background-repeat: no-repeat !important; background-position: center !important;
		}';
		echo 'h1 a {
			background-position: -9999px;
		}';
	}
	
	if(empty($font)){} else {
		$urlData = parse_url($font);
		$fontName = str_replace("+"," ",substr($urlData["query"], (strrpos($urlData["query"], "=") + 1), (strrpos($urlData["query"], ":") - strrpos($urlData["query"], "=") - 1)));
		echo 'body.login {
			font-family: '.$fontName.', sans-serif;
		}';
	}
	echo '</style>';
}

//Logo: link customization
function editLogin_change_login_page_url() {
	$link = get_option('editLogin_login_logo_url');
	if(empty($link)){
		return get_bloginfo('url');
	} else {
		return $link;
	}
}

//Logo's title: sets the logo's title with the blog's name  
function editLogin_change_login_logo_title() {
	return get_bloginfo('name');
}

//Login page: sets te custom Google fonts
function editLogin_customGoogleGonts() {
	$font = get_option('editLogin_login_custom_font');
	if(empty($font)){} else {
		echo '<link href="'.$font.'" rel="stylesheet" type="text/css">';
	}	
}

//All the plugin hook
add_action('login_headerurl', 'editLogin_change_login_page_url' );
add_action('login_headertitle', 'editLogin_change_login_logo_title');
add_action('login_head', 'editLogin_customGoogleGonts');
add_action('login_head', 'editLogin_change_login_logo');
add_action('admin_menu', 'editLogin_add_option_page');
add_action('admin_init', 'editLogin_register_options_group');
add_filter( 'plugin_action_links', 'editLogin_add_option_page_link', 10, 2 );
register_activation_hook( __FILE__, 'editLogin_activate_set_default_options');
?>
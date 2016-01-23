<?php
add_action( 'admin_menu', 'wsp_add_admin_menu' );
add_action( 'admin_init', 'wsp_settings_init' );
add_option( 'wp-sys-profile_key', '');

function wsp_add_admin_menu(  ) {

	add_options_page( 'wp_sys_profile', 'wp_sys_profile', 'manage_options', 'wp_sys_profile', 'wp_sys_profile_options_page' );

}


function wsp_settings_init(  ) {

	register_setting( 'pluginPage', 'wsp_settings' );

	add_settings_section(
		'wsp_pluginPage_section',
		__( 'Your section description', 'wordpress' ),
		'wsp_settings_section_callback',
		'pluginPage'
	);

}

function wp_sys_profile_options_page(){

$new_key = $_GET["key_gen"];

	if($new_key == 'y'){
            $length = 5;

//I should probably make this a function someday
            $randystring_one =  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+!"), 0, $length);
						$randystring_two =  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+!"), 0, $length);
						$randystring_three =  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+!"), 0, $length);
						$randystring_four =  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+!"), 0, $length);
						$randy_api_key = $randystring_one.$randystring_two.$randystring_three.$randystring_four;


update_option( 'wp-sys-profile_key', $randy_api_key);

	}



$stored_api_key = get_option('wp-sys-profile_key');
echo '<h1>WP Sys Profile Settings</h1>';
echo 'API KEY: '.$stored_api_key.'<br><br><a href="/wp-admin/options-general.php?page=wp_sys_profile&key_gen=y">Create a new API key</a>';
}

?>

<?php
add_action( 'admin_menu', 'wsp_add_admin_menu' );
add_action( 'admin_init', 'wsp_settings_init' );


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
echo '<h1>WP Sys Profile Settings</h1>';
}

?>

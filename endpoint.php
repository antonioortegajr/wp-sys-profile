<?php
/*
Plugin Name: WP Sys Profile
Plugin URI: http://antonioortegajr.com
Description: This plugin creates a custom REST API Endpoint that displays information on the WordPress install and the stack it runs on.
Version: 1.0.0
Author: Antonio Ortega Jr
Author URI: http://antonioortegajr.com
License: GPL2
*/
include('wp-sys-profile-options.php');


add_action( 'rest_api_init', function () {

  //set up routes
    register_rest_route( 'sys_profile/v1', '/profile', array(
        'methods' => 'GET',
        'callback' => 'sys_profile_func',
    ) );
    register_rest_route( 'sys_profile/v1', '/private_profile', array(
        'methods' => 'GET',
        'callback' => 'sys_private_profile_func',
    ) );
} );


//public route
function sys_profile_func( WP_REST_Request $request ){
  // Check if get_plugins() function exists. This is required on the front end of the
  // site, since it is in a file that is normally only loaded in the admin.
  if ( ! function_exists( 'get_plugins' ) ) {
  	require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }

$all_plugins = get_plugins();

$plugin_names = array();

foreach ($all_plugins as $key => $value) {
  array_push($plugin_names, $value["Name"]);
}



global $required_php_version;

$php_min_version_check = PHP_VERSION;
  //profile this WordPress account
      $output = array(
      'url'=>get_site_url(),
      'php_version'=>PHP_VERSION,
      'required_php_version'=>$required_php_version,
      'wordpress_version'=>get_bloginfo('version'),
      'encoding'=>get_bloginfo('charset'),
      'multi_site'=>is_multisite(),
      'current_theme'=>get_current_theme(),
      'installed_plugins'=>$plugin_names
      );

return $output;
}

//private route
function sys_private_profile_func( WP_REST_Request $request ){

//get headers to look for a key
$headers = array(getallheaders());
$api_key = $headers[0]["Apikey"];

//api key from database
$stored_api_key = get_option('wp-sys-profile_key');

//evaluate api key
if ($api_key == $stored_api_key) {

//look for cURL. thanks to http://www.mattsbits.co.uk/item-164.html for this bit
// Define function to test
function _is_curl_installed() {
	if  (in_array  ('curl', get_loaded_extensions())) {
		return true;
	}
	else {
		return false;
	}
}

// Output text to user based on test
if (_is_curl_installed()) {
  $got_curl = true;
} else {
  $got_curl = false;
}

    // Check if get_plugins() function exists. This is required on the front end of the
  // site, since it is in a file that is normally only loaded in the admin.
  if ( ! function_exists( 'get_plugins' ) ) {
  	require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }
  $all_plugins = get_plugins();
$plugin_info = array();

foreach ($all_plugins as $key => $value) {

  $plugin_private_info = $value["Name"].','.$value["Version"].','.$value["PluginURI"];
  array_push($plugin_info, $plugin_private_info);
}

global $required_php_version;
global $required_mysql_version;

  //profile this WordPress account private
      $output = array(

      'url'=>get_site_url(),
      'server_info'=>$_SERVER['SERVER_SOFTWARE'],
      'php_version'=>PHP_VERSION,
      'required_php_version'=>$required_php_version,
      'php_memory_limit'=>ini_get("memory_limit"),
      'mysql_info'=>mysql_get_server_info(),
      'required_mysql_version'=>$required_mysql_version,
      'curl_enabled'=>$got_curl,
      'wordpress_version'=>get_bloginfo('version'),
      'encoding'=>get_bloginfo('charset'),
      'wp_mem_limit'=>WP_MEMORY_LIMIT,
      'wp_max_mem_limit'=>WP_MAX_MEMORY_LIMIT,
      'permalink_structure'=>get_option('permalink_structure'),
      'multi_site'=>is_multisite(),
      'current_theme'=>get_current_theme(),
      'installed_plugins'=>$plugin_info
      );
}
else {
$output = "{'api_key':'no'}";
}
  return $output;
}
?>

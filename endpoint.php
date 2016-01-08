<?php
/*
Plugin Name: WP Sys Profile
Plugin URI: http://antonioortegajr.com
Description: This plugin creates a custom REST API Endpoint that displays information on the WordPress install and the stack it runs on.
Version: 0.5
Author: Antonio Ortega Jr
Author URI: http://antonioortegajr.com
License: GPL2
*/
/*
This registers the plugin. Functionality is currently under construction. Based on http://v2.wp-api.org/extending/adding/
*/

add_action( 'rest_api_init', function () {
    register_rest_route( 'sys_profile/v1', '/profile', array(
        'methods' => 'GET',
        'callback' => 'sys_profile_func',
    ) );
} );
function sys_profile_func( WP_REST_Request $request ){

  // Check if get_plugins() function exists. This is required on the front end of the
  // site, since it is in a file that is normally only loaded in the admin.
  if ( ! function_exists( 'get_plugins' ) ) {
  	require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }

  $all_plugins = get_plugins();

  //profile this WordPress account
      $output = array(
      'url'=>get_site_url(),
      'php_version'=>phpversion(),
      'wordpress_Version'=>get_bloginfo('version'),
      'encoding'=>get_bloginfo('charset'),
      'multi_site'=>is_multisite(),
      'current_theme'=>get_current_theme(),
      'installed_plugins'=>$all_plugins
      );


return $output;


}

?>

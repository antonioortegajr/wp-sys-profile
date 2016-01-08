<?php
/*
Plugin Name: WP Sys Profile
Plugin URI: http://antonioortegajr.com
Description: This plugin creates a custom REST API Endpoint that displays information on the WordPress install and the stack it runs on.
Version: 0.1
Author: Antonio Ortega Jr
Author URI: http://antonioortegajr.com
License: GPL2
*/
/*
This registers the plugin. Functionality is currently under construction. Based on http://v2.wp-api.org/extending/adding/
*/

add_action( 'rest_api_init', function () {
    register_rest_route( 'myplugin/v1', '/author', array(
        'methods' => 'GET',
        'callback' => 'my_awesome_func',
    ) );
} );
function my_awesome_func( WP_REST_Request $request ){

$output = get_site_url();

return $output;


}

?>

WP Sys Profile
============================================

This plugin creates a custom REST API Endpoint that displays information on the WordPress install and the stack it runs on.

Requires WordPress 4.4 or higher.

No authentication is required for public route. Private route looks for a key passed in the request headers. OAuth is probably better, but this might make this plugin useful for larger scale support where getting information quickly with a little customer effort is valuable.


NO sensitive information (usernames, passwords, etc...) is passed in the public route.

Some is in the private route.

If you need to report further sensitive information feel free to fork this repo.

Displays the following information:

URL
PHP Version
WordPress Version
Encoding
Is a MultiSite
Current Theme
Array of installed plugins

If you have security concerns about displaying this kind of information publicly, fork this repo and remove any of the info you like. Or disable the public route. Or add in some further level of security. Pulls welcome.


Live example of this on my site: http://antonioortegajr.com/wp-json/sys_profile/v1/profile

WP API docs: http://wp-api.org/guides/extending.html

WP Sys Profile

This plugin creates a custom REST API Endpoint that displays information on the WordPress install and the stack it runs on.

Requires WordPress 4.4 or higher.

No authentication is required
NO sensitive information (usernames, passwords, etc...) is passed. If you need to report sensitive information feel free to fork this repo.

Displays the following information:

URL
PHP Version
WordPress Version
Encoding
Is a MultiSite
Current Theme
Array of installed plugins

If you have security concerns about displaying this kind of information publicly, fork this repo and remove any of the info you like. Or add in some level of security. Pulls welcome.


Live example of this on my site: http://antonioortegajr.com/wp-json/sys_profile/v1/profile

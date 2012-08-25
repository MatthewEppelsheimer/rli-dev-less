# Rocket Lift Dev LESS

_This plugin is in Beta._

This plugin solves two problems for WordPress theme developers using LESS to write stylesheets:

1. It automatically sets up your LESS development environment for WordPress.
2. It will not load LESS front-end resources outside of a development environment, so you never have to dismantle your LESS development before taking a site into production again.

The plugin makes two assumptions:

1. Your theme's wp-config.php file includes `define( 'WP_DEBUG', true );` in development environments.
2. Your theme adds your LESS stylesheets to the `wp_head` hook with a priority between 1 and 9, for example, add the following to your functions.php:

````
/**
 * Load LESS styles in development
 */

function theme_enqueue_dev_styles() {
	echo "<link rel='stylesheet' href='" . get_template_directory_uri() . "/css/style.less' type='text/less' media='screen' />";
}
   
function theme_setup_development() {
	if ( WP_DEBUG ) add_action( 'wp_head', 'theme_enqueue_dev_styles', 1 );
}
add_action( 'template_redirect', 'theme_setup_development' );
````

You can copy and paste that directly into your theme's `functions.php` file, and write LESS styles at `/css/style.less`.

## Notes

For information on LESS, see http://lesscss.org.

This plugin includes scripts to flush LESS data from the browser's localStorage on each page refresh, so your changes to LESS stylesheets during development will take effect immediately.

This plugin doesn't add any admin screens, settings, or options. The only options is whether WP_DEBUG is enabled.

All this plugin does is efficiently enqueue resources for the LESS javascript compiler when and where it's appropriate.

Note that even though this plugin won't load LESS resources in production, it's still a good idea to disable and remove this plugin on production sites for security.

__BONUS!__ This plugin includes `grid.less` for the [Semantic Grid System](http://semantic.gs/). We'll probably remove this before publishing to the dot org repo because separation of concerns or something.

## Changelog

__Version 0.1__

Release for public beta.

## License

See `LICENSE` file.

Copyright (c) 2012 Rocket Lift Inc.

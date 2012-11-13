<?php
/*
Plugin Name: Rocket Lift LESS
Plugin URI: http://rocketlift.com/software/wordpress-plugins/rli-dev-less/
Description: Load Less.js in the front-end in a development environment
Version: 1.0
Author: Rocket Lift Incorporated
Author URI: http://rocketlift.com
License: GPLv2
*/

/*  Copyright 2012  Matthew Eppelsheimer  (email : matthew.eppelsheimer@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
 *	ACTIVATION
 */

function rli_dev_less_activate() {	
    // Check for WordPress version compatibility
    if ( version_compare( get_bloginfo( 'version' ), '3.3', '<' ) ) {// UPDATE VERSION

            //SEND ALERT TO USER ATTEMPTING TO ACTIVATE

            deactivate_plugins( basename(__FILE__ ) );  //Deactivation
    }
}

register_activation_hook( __FILE__, 'rli_dev_less_activate' );	

/*
 *  TEMPLATE_REDIRECT HOOK
 */

 function rli_dev_less_page_setups(){   
     // WordPress now knows what page we're viewing.
     // This only happens in the front-end.
     // DO FRONT-END PAGE VIEW-SPECIFIC STUFF HERE.
	 if ( WP_DEBUG ) {
	 	rli_dev_less_include();
	}
 }

 add_action('template_redirect', 'rli_dev_less_page_setups' );    

/*
 * The very special sauce
 */

function rli_dev_less_include() {

	$plugin_url = plugin_dir_url( __FILE__ );

	wp_enqueue_script( 'less', $plugin_url . 'js/less-1.1.3.min.js', '', '1.1.3' );
	wp_enqueue_script( 'less-env-setup', $plugin_url . 'js/setup.js', array( 'less' ) );
	wp_enqueue_script( 'less-flush-local-storage', $plugin_url . 'js/flush-local-storage.js', array( 'less-env-setup' ) );
}


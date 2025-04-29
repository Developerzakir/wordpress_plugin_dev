<?php
/**
 * Plugin Name:       Wordpress Customizer Login Page
 * Plugin URI:        https://wordpress.org/plugins/wp-customizer-login-page-wp/
 * Description:       The WP Customizer Login Page plugin will help you to enable a custom login page to your WordPress website.
 * Version:           1.1.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Zakir Hossen
 * Author URI:       https://developerzakir.blogspot.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpclp
 */

  /*
 * Plugin Option Page Function
 */
function wpclp_add_theme_page(){
    add_menu_page( 'Login Option for Admin', 'Login Option', 'manage_options', 'wpclp-plugin-option', 'wpclp_create_page', 'dashicons-unlock', 101 );
}
add_action( 'admin_menu', 'wpclp_add_theme_page' );



 ?>
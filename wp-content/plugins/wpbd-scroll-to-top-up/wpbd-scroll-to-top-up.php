<?php 

/**
 * Plugin Name:       Wpbd Scroll To Top Up
 * Plugin URI:        https://wordpress.org/plugins/wpbd-scroll-to-top-up/
 * Description:       Wpbd Simple Scroll to top plugin will help you to enable Back to Top button to your WordPress website.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            Zakir Hossain
 * Author URI:        https://developerzakir.blogspot.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/Developerzakir
 * Text Domain:       wpbdstt
 */



   // Including CSS
   function wpbdstt_enqueue_style(){
     wp_enqueue_style('wpbdstt-style', plugins_url('css/wpbdstt-style.css', __FILE__));
   }
   add_action( "wp_enqueue_scripts", "wpbdstt_enqueue_style" );

  // Including JavaScript
  function wpbdstt_enqueue_scripts(){
        wp_enqueue_script('jquery');
        wp_enqueue_script('wpbdstt-plugin-script', plugins_url('js/wpbdstt-plugin.js', __FILE__), array(), '1.0.0', 'true');
  }
  add_action( "wp_enqueue_scripts", "wpbdstt_enqueue_scripts" );

  // jQuery Plugin Setting Activation
  function wpbdstt_scroll_script(){?>
    <script>
        jQuery(document).ready(function () {
        jQuery.scrollUp();
        });
    </script>
  <?php }

add_action( "wp_footer", "wpbdstt_scroll_script" );


?>
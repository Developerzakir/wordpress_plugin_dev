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



// Plugin Customization Sattings
add_action( "customize_register", "wpbdstt_scroll_to_top" );
function wpbdstt_scroll_to_top($wp_customize){
  $wp_customize-> add_section('wpbdstt_scroll_top_section', array(
    'title' => __('Scroll To Top', 'zakirhossen'),
    'description' => 'Wordpress Scroll to top plugin will help you to enable Back to Top button to your WordPress website.',
  ));

  $wp_customize ->add_setting('wpbdstt_default_color', array(
    'default' => '#000000',
  ));
  $wp_customize->add_control('wpbdstt_default_color', array(
      'label'   => 'Background Color',
      'section' => 'wpbdstt_scroll_top_section',
      'type'    => 'color',
  ));

  // Adding Rounded Corner
  $wp_customize ->add_setting('wpbdstt_rounded_corner', array(
    'default' => '5px',
    'description' => 'If you need fully rounded or circular then use 25px here.',
  ));
  $wp_customize->add_control('wpbdstt_rounded_corner', array(
      'label'   => 'Rounded Corner',
      'section' => 'wpbdstt_scroll_top_section',
      'type'    => 'text',
  ));
}

// Theme CSS Customization
function wpbdstt_theme_color_cus(){
  ?>
  <style>
    #scrollUp {
    background-color: <?php print get_theme_mod("wpbdstt_default_color"); ?>;
    border-radius: <?php print get_theme_mod("wpbdstt_rounded_corner"); ?>;
  }
  </style>
  <?php 
}
add_action('wp_head', 'wpbdstt_theme_color_cus');


?>
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


  /*
  * Plugin Option Page Style
  */
  function wpclp_add_theme_css(){
    wp_enqueue_style( 'wpclp-admin-style', plugins_url( 'css/wpclp-admin-style.css', __FILE__ ), false, "1.0.0");
  
  }
  add_action('admin_enqueue_scripts', 'wpclp_add_theme_css');


  /**
   * Plugin Callback
   */
  function wpclp_create_page(){
    ?>
    <div class="wpclp_main_area">
      <div class="wpclp_body_area">
        <h3 id="title"><?php print esc_attr( 'Login Page Customizer' ); ?></h3>
        <form action="options.php" method="post">
          <?php wp_nonce_field('update-options'); ?>

            <!-- Primary Color -->
            <label for="wpclp-primary-color" name="wpclp-primary-color"><?php print esc_attr( 'Primary Color' ); ?></label>
            <input type="color" name="wpclp-primary-color" value="<?php print get_option('wpclp-primary-color') ?>">

            <!-- Secondary Color -->
            <label for="wpclp-sec-color" name="wpclp-sec-color"><?php print esc_attr( 'Secondary Color' ); ?></label>
            <input type="color" name="wpclp-sec-color" value="<?php print get_option('wpclp-sec-color') ?>">

            <!-- Main Logo -->
            <label for="wpclp-logo-image-url" name="wpclp-logo-image-url"><?php print esc_attr( 'Upload your logo' ); ?></label>
            <input type="text" name="wpclp-logo-image-url" value="<?php print get_option('wpclp-logo-image-url') ?>" placeholder="Paste your Logo URL here">

            <!-- Background Image -->
            <label for="wpclp-custom-bg-image" name="wpclp-custom-bg-image"><?php print esc_attr( 'Upload your Bacground Image' ); ?></label>
            <input type="text" name="wpclp-custom-bg-image" value="<?php print get_option('wpclp-custom-bg-image') ?>" placeholder="Paste your Background Image URL here">

            <!-- Bacground Brightness -->
            <label for="wpclp-custom-bg-brightness" name="wpclp-custom-bg-brightness"><?php print esc_attr( 'Background Brightness {Between 0.1 to 0.9}' ); ?></label>
            <input type="text" name="wpclp-custom-bg-brightness" value="<?php print get_option('wpclp-custom-bg-brightness') ?>" placeholder="Between 0.1 to 0.9">


          <input type="hidden" name="action" value="update">
          <input type="hidden" name="page_options" value="wpclp-primary-color, wpclp-logo-image-url, wpclp-custom-bg-image, wpclp-sec-color, wpclp-custom-bg-brightness">
          <input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'wpclp') ?>">
        </form>
      </div>

      <div class="wpclp_sidebar_area wpclp_common">
      <h3 id="title"><?php print esc_attr( 'About Author' ); ?></h3>
      <p>I'm <strong><a href=" https://developerzakir.blogspot.com/" target="_blank">Zakir Hossen</a></strong> a Front End Web developer who is passionate about making error-free websites with 100% client satisfaction. I have a passion for learning and sharing my knowledge with others as publicly as possible. I love to solve real-world problems.</p>
      </div>
    </div>
  <?php
  }


// Loading CSS file
function wpclp_login_enqueue_register(){
  wp_enqueue_style( 'wpclp_login_enqueue', plugins_url( 'css/wpclp-styles.css', __FILE__ ), false, "1.0.0");

}
add_action('login_enqueue_scripts', 'wpclp_login_enqueue_register');

// Changing Login form logo
function wpclp_login_logo_change(){
  ?>
  <style>
        #login h1 a, .login h1 a{
        background-image: url(<?php print get_option('wpclp-logo-image-url'); ?>) !important;
        }
        #login form p.submit input {
        background: <?php print get_option('wpclp-logo-image-url'); ?>;
        }
        .login #login_error,
        .login .message,
        .login .success {
        border-left: 4px solid <?php print get_option('wpclp-primary-color'); ?> !important;
        }
        input#user_login,
        input#user_pass {
        border-left: 4px solid <?php print get_option('wpclp-primary-color'); ?> !important;
        }
        #login form p.submit input {
        background: <?php print get_option('wpclp-primary-color'); ?> !important;
        }
        .login #backtoblog a {
        background: <?php print get_option('wpclp-sec-color'); ?> !important;
        }
        body.login {
        background-image: url(<?php print get_option('wpclp-custom-bg-image'); ?>) !important;
        }
        body.login::after {
        opacity: <?php print get_option('wpclp-custom-bg-brightness'); ?> !important;
        }
  </style>

  <?php
}
add_action( 'login_enqueue_scripts', 'wpclp_login_logo_change');

// Changing Login form logo url
function wpclp_login_logo_url_change(){
  return home_url();
}
add_filter( 'login_headerurl', 'wpclp_login_logo_url_change');




 ?>
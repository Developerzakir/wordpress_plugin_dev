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
          <label for="wpclp-primary-color" name="wpclp-primary-color"><?php print esc_attr( 'Primary Color' ); ?></label>
          <input type="color" name="wpclp-primary-color" value="<?php print get_option('wpclp-primary-color') ?>">


          <input type="hidden" name="action" value="update">
          <input type="hidden" name="page_options" value="wpclp-primary-color">
          <input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'wpclp') ?>">
        </form>
      </div>
      <div class="wpclp_sidebar_area"></div>
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
      background-image: url(<?php print plugin_dir_url( __FILE__ ) . '/img/logo-sm.png'; ?>);
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
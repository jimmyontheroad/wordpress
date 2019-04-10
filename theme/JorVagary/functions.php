<?php

// Styles and Scripts
  function startwordpress_scripts() {
      wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );
      wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/blog.css' );
      wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
    }

  add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );

// Menus
  function JORVagary_menu_setup() {
      register_nav_menus(
          array(
              'primary' => __( 'Primary Menu', 'jorvagary' ), // we will be using this top_menu location
          )
      );
  }

  add_action( 'after_setup_theme', 'JORVagary_menu_setup' );

  require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// Title
    add_theme_support( 'title-tag' );

// Background
  add_theme_support( 'custom-background', $args );

// Background
  add_theme_support( 'custom-image', $args );


// Custom settings
    function custom_settings_add_menu() {
      add_menu_page( 'SN Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );

}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Custom Global Settings
    function custom_settings_page() { ?>
      <div class="wrap">
          <h1>Custom Settings</h1>
          <form method="post" action="options.php">
              <?php
                settings_fields( 'section' );
                do_settings_sections( 'theme-options' );
                submit_button();
            ?>
          </form>
        </div>
    <?php }

// Twitter
  function setting_facebook() { ?>
      <input type="text" name="facebook" id="facebook" value="<?php echo get_option( 'facebook' ); ?>" />
    <?php }

// Github
  function setting_github() { ?>
        <input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
    <?php }  

// SN settings
    function custom_settings_page_setup() {
        add_settings_section( 'section', 'All Settings', null, 'theme-options' );
        add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );
      add_settings_field( 'github', 'GitHub URL', 'setting_github', 'theme-options', 'section' );

      register_setting( 'section', 'facebook' );
        register_setting( 'section', 'github' );
    }

    add_action( 'admin_init', 'custom_settings_page_setup' );

// Featured Images
    add_theme_support( 'post-thumbnails' );

// Excerpt Length
    function new_excerpt_length($length) {
      return 150;
    }

    add_filter('excerpt_length', 'new_excerpt_length');

// Sidebar Widget
  if ( function_exists('register_sidebar') )
    register_sidebar(array('name'=>'Sidebar',
      'before_widget' => '<div>',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>',
  ));






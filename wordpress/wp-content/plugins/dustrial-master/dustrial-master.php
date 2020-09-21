<?php 
/*
Plugin Name: Dustrial Master
Plugin URI: http://pluginspoint.com/dustrialwp/
Author: Johanspond
Description: After install the Dustrial Theme, you must need to install "Dustrial Master" plugin first to get all features.
Author URI: http://pluginspoint.com/
Version: 2.0.8
Text Domain: Dustrial
Domain Path: /languages
*/


/*------------------------------------------------------------------------------------------------------------------*/
/*  Plugin define.
/*------------------------------------------------------------------------------------------------------------------*/
define( 'DUSTRIAL_PLG_URL', plugin_dir_url( __FILE__ ) );
define( 'DUSTRIAL_PLG_DIR', dirname( __FILE__ ) ); 


/*------------------------------------------------------------------------------------------------------------------*/
/*  Plugin action and filter hook.
/*------------------------------------------------------------------------------------------------------------------*/
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'dustrial_plugin_action_links' );
add_filter( 'plugin_row_meta', 'custom_plugin_row_meta', 10, 2 );


/*------------------------------------------------------------------------------------------------------------------*/
/*  Plugin include files.
/*------------------------------------------------------------------------------------------------------------------*/
require_once DUSTRIAL_PLG_DIR . '/inc/dm-admin.php';
require_once DUSTRIAL_PLG_DIR . '/inc/custom-style.php';
require_once DUSTRIAL_PLG_DIR . '/inc/custom-widgets.php';
require_once DUSTRIAL_PLG_DIR . '/inc/custom-posttype.php';
require_once DUSTRIAL_PLG_DIR . '/inc/helper.php';


/*------------------------------------------------------------------------------------------------------------------*/
/*  Theme option framework.
/*------------------------------------------------------------------------------------------------------------------*/
require_once DUSTRIAL_PLG_DIR . '/framework/dustrial-framework.php';


/* Visual composer addons style
=====================================================*/
add_action( 'wp_enqueue_scripts', 'dustrial_extra_master_scripts' );
function dustrial_extra_master_scripts() {
  // Css
  wp_enqueue_style('dustrial-visual-composer-css', DUSTRIAL_PLG_URL . 'assets/admin/visual-composer.css' , array(), '' );
  wp_enqueue_style('smoothbox', DUSTRIAL_PLG_URL . 'assets/css/smoothbox-min.css' , array(), '' );
  wp_enqueue_style('viewer', DUSTRIAL_PLG_URL . 'assets/css/viewer.css' , array(), '' );
  wp_enqueue_style('dustrial-master-css', DUSTRIAL_PLG_URL . 'assets/css/dustrial-master.css' , array(), '' );

  // Js
  wp_enqueue_script('smoothbox', DUSTRIAL_PLG_URL . 'assets/js/smoothbox-min.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('viewer', DUSTRIAL_PLG_URL . 'assets/js/viewer.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('dustrial-master', DUSTRIAL_PLG_URL . 'assets/js/dustrial-master.js', array('jquery'), '1.0.0', true);
}

/* Visual composer addons style
=====================================================*/
add_action( 'admin_enqueue_scripts', 'dustrial_master_scripts' );
function dustrial_master_scripts() {
  wp_enqueue_style('dustrial-visual-composer', DUSTRIAL_PLG_URL . 'assets/admin/visual-composer.css' , array(), '' );
  wp_enqueue_style('dustrial-admin-style', DUSTRIAL_PLG_URL . 'assets/admin/dustrial-admin-style.css' , array(), '' );
  wp_enqueue_style('dustrial-flaticon', DUSTRIAL_PLG_URL . '/assets/css/flaticon.css');
}


/**  shortcode.
--------------------------------------------------------------------------------------------------- */
require_once DUSTRIAL_PLG_DIR . '/shortcodes/xtl-shortcode-action.php';


/*------------------------------------------------------------------------------------------------------------------*/
/* Dustrial Demo Import
/*------------------------------------------------------------------------------------------------------------------*/ 
function dustrial_import_files() {
    return array(

        //Home Setup
        array(
            'import_file_name'             => 'Demo Import',
            'categories'                   => array( 'Dustrial' ),
            'local_import_file'            => trailingslashit( DUSTRIAL_PLG_DIR ) . '/demo-importer/demo/demo-content.xml',
            'local_import_widget_file'     => trailingslashit( DUSTRIAL_PLG_DIR ) . '/demo-importer/demo/widgets.wie',
            'local_import_customizer_file' => trailingslashit( DUSTRIAL_PLG_DIR ) . '/demo-importer/demo/customizer.dat',
            'import_notice'                => __( 'After import this demo, you will have to setup the theme options and WooCommerce separately. Please see the documentation for theme options and WooCommerce setup.', 'dustrial' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'dustrial_import_files' );

function dustrial_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'dustrial_after_import_setup' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );




?>

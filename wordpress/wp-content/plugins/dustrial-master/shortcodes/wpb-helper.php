<?php
if(function_exists( 'Vc_Manager' ) ) { 
/* Visual composer addons custom fonts
=====================================================*/
function dustrial_add_new_icon_set_to_iconbox( ) {
    $param = WPBMap::getParam( 'vc_icon', 'type' );
    $param['value'][__( 'Flaticons', 'total' )] = 'flaticon';
    vc_update_shortcode_param( 'vc_icon', $param );
}
add_filter( 'init', 'dustrial_add_new_icon_set_to_iconbox', 40 );
// Add font picker setting to icon box module when you select your font family from the dropdown
function dustrial_add_font_picker() {
    vc_add_param( 'vc_icon', array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'total' ),
            'param_name' => 'icon_flaticon',
            'settings' => array(
                'emptyIcon' => true,
                'type' => 'flaticon',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'flaticon',
            ),
        )
    );
}
add_filter( 'vc_after_init', 'dustrial_add_font_picker', 40 );

}
// Add array of your fonts so they can be displayed in the font selector
function dustrial_icon_array($icons) {
    $stroke = array(
        array('dustrial-icon flaticon-factory-1' => 'factory'),
        array('dustrial-icon flaticon-tree' => 'tree'),
        array('dustrial-icon flaticon-handout' => 'handout'),
        array('dustrial-icon flaticon-train' => 'train'),
        array('dustrial-icon flaticon-machinery' => 'machinery'),
        array('dustrial-icon flaticon-tractor' => 'tractor'),
        array('dustrial-icon flaticon-solution' => 'solution'),
        array('dustrial-icon flaticon-wheel' => 'wheel'),
        array('dustrial-icon flaticon-gloves' => 'gloves'),
        array('dustrial-icon flaticon-truck' => 'truck'),
        array('dustrial-icon flaticon-reward' => 'reward'),
        array('dustrial-icon flaticon-travel' => 'travel'),
        array('dustrial-icon flaticon-factory' => 'factory'),
        array('dustrial-icon flaticon-analytics' => 'analytics'),
        array('dustrial-icon flaticon-crop' => 'crop'),
        array('dustrial-icon flaticon-maps-and-location' => 'maps-and-location'),
        array('dustrial-icon flaticon-plus' => 'plus'),
        array('dustrial-icon flaticon-right-arrow' => 'right-arrow'),
        array('dustrial-icon flaticon-gear' => 'gear'),
        array('dustrial-icon flaticon-motor' => 'motor'),
        array('dustrial-icon flaticon-flight' => 'flight'),
        array('dustrial-icon flaticon-ship' => 'ship'),
        array('dustrial-icon flaticon-green-energy' => 'green-energy'),
        array('dustrial-icon flaticon-machine' => 'machine'),
        array('dustrial-icon flaticon-oil-platform' => 'oil-platform'),
        array('dustrial-icon flaticon-concrete' => 'concrete'),
        array('dustrial-icon flaticon-cogwheel' => 'cogwheel'),
        array('dustrial-icon flaticon-piston' => 'piston')
    );
    return array_merge( $icons, $stroke );
}
add_filter( 'vc_iconpicker-type-flaticon', 'dustrial_icon_array' );
/**
 * Register Backend and Frontend CSS Styles
 */
add_action( 'vc_base_register_front_css', 'dustrial_vc_iconpicker_base_register_css' );
add_action( 'vc_base_register_admin_css', 'dustrial_vc_iconpicker_base_register_css' );
function dustrial_vc_iconpicker_base_register_css(){
    wp_register_style('flaticon', get_stylesheet_directory_uri() . '/assets/css/flaticon.css');
}
/**
 * Enqueue Backend and Frontend CSS Styles
 */
add_action( 'vc_backend_editor_enqueue_js_css', 'dustrial_vc_iconpicker_editor_jscss' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'dustrial_vc_iconpicker_editor_jscss' );
function dustrial_vc_iconpicker_editor_jscss(){
    wp_enqueue_style( 'flaticon' );
}
/**
 * Enqueue CSS in Frontend when it's used
 */
add_action('vc_enqueue_font_icon_element', 'dustrial_enqueue_font_flaticon');
function dustrial_enqueue_font_flaticon($font){
    switch ( $font ) {
        case 'flaticon': wp_enqueue_style( 'flaticon' );
    }
}


// Init Visual Composer
if( ! function_exists( 'dustrial_init_vc_shortcodes' ) ) {
  function dustrial_init_vc_shortcodes() {
    if ( defined( 'WPB_VC_VERSION' ) ) {

        /* Set VC editor as default in following post types */
        $list = array(
          'post',
          'page',
          'service',
          'our_project',
        );
        vc_set_default_editor_post_types( $list );
    }
  }

  add_action( 'vc_before_init', 'dustrial_init_vc_shortcodes' );
}
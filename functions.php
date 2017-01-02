<?php

define( 'ONETONE_THEME_BASE_URL', get_template_directory_uri());
define( 'ONETONE_OPTIONS_FRAMEWORK', get_template_directory().'/admin/' ); 
define( 'ONETONE_OPTIONS_FRAMEWORK_URI',  ONETONE_THEME_BASE_URL. '/admin/'); 
define( 'ONETONE_OPTIONS_PREFIXED' ,'onetone_' );


define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
require_once dirname( __FILE__ ) . '/admin/options-framework.php';


/**
 * google fonts
 **/
 
load_template( trailingslashit( get_template_directory() ) . 'includes/google-fonts.php' );


require_once get_template_directory() . '/includes/admin-options.php';
/**
 * Theme Functions
 **/
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-functions.php' );





/**
 * Required: include options framework.
 **/
load_template( trailingslashit( get_template_directory() ) . 'admin/options-framework.php' );

/**
 * Mobile Detect Library
 **/
 if(!class_exists("Mobile_Detect")){
   load_template( trailingslashit( get_template_directory() ) . 'includes/Mobile_Detect.php' );
 }
/**
 * Theme setup
 **/
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-setup.php' );




/**
 * Onetone Shortcodes
 **/
 
load_template( trailingslashit( get_template_directory() ) . 'includes/shortcodes.php' );


/**
 * Theme breadcrumb
 */
load_template( trailingslashit( get_template_directory() ) . 'includes/breadcrumb-trail.php');

/**
 * Theme widget
 **/
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-widget.php' );

/**
 * Meta box
 **/
 
load_template( trailingslashit( get_template_directory() ) . 'includes/metabox-options.php' );



 /**
 * Woocommerce template
 **/
 

if (class_exists('WooCommerce')) {
	require_once ( get_template_directory() .'/woocommerce/config.php' );
	}
	

/**
 * Magee Importer
 */
 
require get_template_directory() . '/lib/importer/importer.php';


/**
 * Magee shortcodes
 */
if( ! class_exists( 'Magee_Core' ) ) 
require get_template_directory() . '/lib/magee-shortcodes-pro/Magee.php';
	


add_filter('widget_text', 'do_shortcode');


function onetone_deactivate_plugin_conditional() {
    if ( is_plugin_active('magee-shortcodes/Magee.php') ) {
    deactivate_plugins('magee-shortcodes/Magee.php');    
    }
	if ( is_plugin_active('magee-shortcodes-pro/Magee.php') ) {
    deactivate_plugins('magee-shortcodes-pro/Magee.php');    
    }
}
add_action( 'admin_init', 'onetone_deactivate_plugin_conditional' );
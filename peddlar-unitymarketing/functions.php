<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// WooFramework init
require_once ( get_template_directory() . '/functions/admin-init.php' );

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 				// Options panel settings and custom settings
				'includes/theme-functions.php', 			// Custom theme functions
				'includes/theme-actions.php', 				// Theme actions & user defined hooks
				'includes/theme-comments.php', 				// Custom comments/pingback loop
				'includes/theme-js.php', 					// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 				// Initialize widgetized areas
				'includes/theme-widgets.php',				// Theme widgets
				'includes/theme-plugin-integrations.php'	// Theme plugin integrations
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );

foreach ( $includes as $i ) {
	locate_template( $i, true );
}

if ( is_woocommerce_activated() ) {
	locate_template( 'includes/theme-woocommerce.php', true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

/*add SVG functionality*/
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Enqueue scripts and styles.
 */
function unity_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'svg_magic', get_stylesheet_directory_uri() . '/js/jquery.svgmagic.js', array(), '20120206', true );
	wp_enqueue_script( 'functions', get_stylesheet_directory_uri() . '/js/functions.js', array(), '20130115', true );
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
add_action( 'wp_enqueue_scripts', 'unity_scripts' );


// Register Custom Sidebar
function blog_sidebar() {
	$args = array(
		'name'          => __( 'Blog', 'unity' ),
		'id'            => 'sidebar-1'
	);
	register_sidebar( $args );
}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'blog_sidebar' );

/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>
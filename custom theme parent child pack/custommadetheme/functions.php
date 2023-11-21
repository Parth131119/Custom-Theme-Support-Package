<?php

/*
 * Theme function file.  
 */
 
 
/*** Breadcrumbs ***/
require get_template_directory() . '/functions/breadcrumbs.php';   

/*** Theme Option ***/
require get_template_directory() . '/theme-options/customthemes.php';

	
function custom_css_enqueue()       
{	   	
    wp_enqueue_style('custom-custom',get_template_directory_uri().'/css/custom.css', array(), null, 'all'); 
}      
add_action('wp_enqueue_scripts', 'custom_css_enqueue');

function custom_js_enqueue()       
{   	   	 
    wp_enqueue_script('custom-script_custom',get_template_directory_uri().'/js/custom.js','1.1',true);	
}
add_action('wp_enqueue_scripts', 'custom_js_enqueue');  		



/*
 * Register widget areas.
 */
function custom_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Area One', 'custom' ),
		'id'            => 'footer-1',
		'description'   => __( 'Footer Area One that appears on the right.', 'custom' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="no-padding text-left">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Area Two', 'custom' ),
		'id'            => 'footer-2',
		'description'   => __( 'Footer Area Two that appears on the center.', 'custom' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="no-padding text-left">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Area Three', 'custom' ),
		'id'            => 'footer-3',
		'description'   => __( 'Footer Area Three that appears on the left.', 'custom' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget no-padding %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="no-padding text-left">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'custom_widgets_init' );

add_theme_support( 'post-thumbnails' );

add_image_size( 'single-feature', 500, 500, true );  

// This theme uses wp_nav_menu() in two locations.
// register menus

register_nav_menus(array(
	'main_menu' 	=> __('Main Menu'),
	'footer_menu' 	=> __('Footer Menu'),
));

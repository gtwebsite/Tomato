<?php
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

/* =Removing some unnecessary on headers
----------------------------------------------- */

remove_action( 'wp_head', 'feed_links_extra' ); 			// Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links' ); 					// Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); 					// Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); 			// Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); 				// index link
remove_action( 'wp_head', 'parent_post_rel_link' ); 		// prev link
remove_action( 'wp_head', 'start_post_rel_link' ); 			// start link
remove_action( 'wp_head', 'adjacent_posts_rel_link' ); 		// Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); 				// Display the XHTML generator that is generated on the wp_head hook, WP version


/* =CYON Theme Setup
----------------------------------------------- */

// Set content width
if ( ! isset( $content_width ) ) $content_width = 1010;

if( !function_exists( 'cyon_setup' ) ) {
function cyon_setup() {

	// Languages
	load_theme_textdomain( 'cyon', get_template_directory() . '/languages' );
	
	// Register menu
	register_nav_menus( array(
		'main-nav' 			=> __( 'Main Navigation', 'cyon' ),
		'footer-nav' 		=> __( 'Footer Navigation', 'cyon' )
	) );
	
	// Use shortcodes in text widgets.
	add_filter( 'widget_text', 'shortcode_unautop' );
	add_filter( 'widget_text', 'do_shortcode' );
	
	// This theme styles the visual editor to match the theme style 
	add_editor_style();
	
	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	
	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

} }
add_action( 'after_setup_theme', 'cyon_setup' );

/* =Formatter, before displaying for viewing, apply this function
----------------------------------------------- */
if( !function_exists( 'cyon_formatter' ) ) {
function cyon_formatter( $content ) {
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);

	$content = strtr( $content, $array );
	return $content;
} }
add_filter( 'the_content', 'cyon_formatter', 10 );


/* =Register Widgets
----------------------------------------------- */
if( !function_exists( 'cyon_widgets_init' ) ) {
function cyon_widgets_init() {
	global $smof_data;

	/* Check home bucket columns */
	if( $smof_data['homepage_bucket_layout'] == 'bucket-4columns' ){
		$homeclass = ' uk-width-medium-1-4';
	}elseif( $smof_data['homepage_bucket_layout'] == 'bucket-3columns' ){
		$homeclass = ' uk-width-medium-1-3';
	}elseif( $smof_data['homepage_bucket_layout'] == 'bucket-2columns' ){
		$homeclass = ' uk-width-medium-1-2';
	}else{
		$homeclass = ' uk-width-1-1 uk-grid-margin';
	}

	/* Check footer bucket columns */
	if( $smof_data['footer_bucket_layout'] == 'bucket-4columns' ){
		$footclass = ' uk-width-medium-1-4';
	}elseif( $smof_data['footer_bucket_layout'] == 'bucket-3columns' ){
		$footclass = ' uk-width-medium-1-3';
	}elseif( $smof_data['footer_bucket_layout'] == 'bucket-2columns' ){
		$footclass = ' uk-width-medium-1-2';
	}else{
		$footclass = ' uk-width-1-1';
	}
	
	// Homepage
	register_sidebar( array(
		'name' 				=> __( 'Homepage Widget Area', 'cyon' ),
		'id' 				=> 'home-columns',
		'before_widget' 	=> '<aside id="%1$s" class="uk-panel widget uk-text-center %2$s' . $homeclass . '">',
		'after_widget' 		=> '</aside>',
		'before_title' 		=> '<h3 class="uk-panel-title">',
		'after_title'		=> '</h3>',
	) );
	
	// Sidebar
	register_sidebar( array(
		'name' 				=> __( 'Sidebar Widget Area', 'cyon' ),
		'id' 				=> 'sidebar-widgets',
		'before_widget' 	=> '<aside id="%1$s" class="uk-panel widget uk-width-1-1 %2$s">',
		'after_widget' 		=> '</aside>',
		'before_title' 		=> '<h3 class="uk-panel-title">',
		'after_title' 		=> '</h3>',
	) );

	// Footer
	register_sidebar( array(
		'name' 				=> __( 'Footer Widget Area', 'cyon' ),
		'id' 				=> 'footer-columns',
		'before_widget' 	=> '<aside id="%1$s" class="uk-panel widget %2$s' . $footclass . '">',
		'after_widget' 		=> '</aside>',
		'before_title' 		=> '<h3 class="uk-panel-title">',
		'after_title' 		=> '</h3>',
	) );
} }
add_action( 'widgets_init', 'cyon_widgets_init' );


/* =Script Registers
----------------------------------------------- */
// Admin
if( !function_exists( 'cyon_admin_styles_scripts' ) ) {
function cyon_admin_styles_scripts() {
	wp_register_script( 'cyon_custom_admin_script', CYON_JS . 'jquery.admin.js', array( 'jquery' ), '1.0.0', true );
	wp_register_style( 'cyon_custom_admin_style', CYON_CSS . 'style-admin.css' );
} }
add_action( 'admin_enqueue_scripts', 'cyon_admin_styles_scripts' );

// Front-end
if(!function_exists( 'cyon_styles_scripts' ) ) {
function cyon_styles_scripts() {
	wp_register_script( 'swiper', CYON_JS . 'jquery.swiper.min.js', array( 'jquery' ), '2.2.0', true );
	wp_register_style( 'swiper_style', CYON_CSS . 'style-swiper.css', array(), '2.2.0' );
	wp_register_script( 'fancybox', CYON_JS . 'jquery.fancybox.min.js', array( 'jquery' ), '2.1.5', true );
	wp_register_style( 'fancybox_style', CYON_CSS . 'style-fancybox.css', array(), '2.1.5' );
	wp_register_script( 'fancybox_thumbs', CYON_JS . 'jquery.fancybox-thumbs.js', array( 'fancybox' ), '2.1.5', true );
	wp_register_style( 'fancybox_style_thumbs', CYON_CSS . 'style-fancybox-thumbs.css', array( 'fancybox_style' ), '2.1.5' );
	wp_register_script( 'fancybox_buttons', CYON_JS . 'jquery.fancybox-buttons.js', array( 'fancybox' ), '2.1.5', true );
	wp_register_style( 'fancybox_style_buttons.', CYON_CSS . 'style-fancybox-buttons.css', array( 'fancybox_style' ), '2.1.5' );
	wp_register_script( 'fancybox_media', CYON_JS . 'jquery.fancybox-media.js', array( 'fancybox' ), '2.1.5', true );
	wp_register_script( 'camera', CYON_JS . 'jquery.camera.min.js', array( 'jquery' ), '1.3.4', true );
	wp_register_style( 'camera_style', CYON_CSS . 'style-camera.css', array(), '1.3.4' );
	wp_register_script( 'fotorama', CYON_JS . 'jquery.fotorama.min.js', array( 'jquery' ), '4.3.0', true );
	wp_register_style( 'fotorama_style', CYON_CSS . 'style-fotorama.css', array(), '4.3.0' );
	wp_register_script( 'mousewheel', CYON_JS . 'jquery.mousewheel.min.js', array( 'jquery' ), '3.0.6', true );
	
	wp_register_script( 'lazyload', CYON_JS . 'jquery.lazyload.min.js', array( 'jquery' ), '1.9', true );
	wp_register_script( 'gmap_api','http://maps.google.com/maps/api/js?sensor=false', array(), '1.0.0', false );
	wp_register_script( 'gmap', CYON_JS . 'jquery.gmap.min.js', array( 'jquery', 'gmap_api' ), '3.3.3', true );
	wp_register_script( 'supersized', CYON_JS . 'jquery.supersized.min.js', array( 'jquery' ), '3.2.7', true );
	wp_register_style( 'supersized_style', CYON_CSS . 'style-supersized.css', array(), '3.2.7' );
} }
add_action( 'wp_enqueue_scripts', 'cyon_styles_scripts' );


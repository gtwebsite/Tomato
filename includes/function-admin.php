<?php
if ( !defined('ABSPATH') )
	die('-1');

/* =Override SMOF's Constants
----------------------------------------------- */
define( 'ADMIN_PATH', CYON_ADMIN );
define( 'ADMIN_DIR', CYON_ADMIN_DIR );

/* =Load SMOF
----------------------------------------------- */
include_once(CYON_ADMIN . 'index.php');

/* =Override Metabox's Constants
----------------------------------------------- */
define( 'RWMB_DIR', trailingslashit( CYON_INCLUDES . 'plugins/meta-box' ) );
define( 'RWMB_URL', trailingslashit( CYON_INCLUDES_DIR . 'plugins/meta-box' ) );

/* =Load Metabox
----------------------------------------------- */
require_once( CYON_INCLUDES . 'plugins/meta-box/meta-box.php' );

/* =Load JS/CSS
----------------------------------------------- */
if ( !function_exists( 'cyon_admin_scripts_styles' ) ){
function cyon_admin_scripts_styles() {
	wp_enqueue_script( 'cyon_custom_admin_script' );
	wp_enqueue_style( 'cyon_custom_admin_style' );
} }
add_action( 'admin_enqueue_scripts', 'cyon_admin_scripts_styles' );


/* =Menu items on Admin tool bar
----------------------------------------------- */
if ( !function_exists( 'cyon_admin_tool_menu' ) ){
function cyon_admin_tool_menu( $wp_admin_bar ) {
	if ( !is_super_admin() || !is_admin_bar_showing() )
        return;
	$wp_admin_bar->add_node( array(
		'parent' 	=> 'appearance',
		'id'   		=> 'cyon-theme-options',
        'meta' 		=> array(),
        'title' 	=> __( 'Theme Options', 'cyon' ),
        'href' 		=> home_url().'/wp-admin/themes.php?page=optionsframework'
	) );
} }
add_action( 'admin_bar_menu', 'cyon_admin_tool_menu', 999 );

/* =Adding Meta Boxes
----------------------------------------------- */
global $cyon_meta_boxes, $smof_data;

$prefix = 'cyon_';
$cyon_meta_boxes = array();

// Page Options
$cyon_meta_boxes[] = array(
	'id' 		=> 'settings',
	'title' 	=> __( 'Page Options' , 'cyon' ),
	'pages' 	=> array( 'post' , 'page' ), // multiple post types, accept custom post types
	'context' 	=> 'normal', // normal, advanced, side (optional)
	'fields' 	=> array(
			array(
				'name' 		=> __( 'Headline' , 'cyon' ),
				'id' 		=> $prefix .'headline',
				'type'		=> 'textarea',
				'std' 		=> ''
			),
			array(
				'name' 		=> __( 'Layout' , 'cyon' ),
				'id' 		=> $prefix .'layout',
				'type'		=> 'radio',
				'std' 		=> 'default', 
				'options' => array( // array of name, value pairs for radio options
								'default' 			=> __( 'Default' , 'cyon' ),
								'general-1column' 	=> __( '1 Column' , 'cyon' ),
								'general-2left' 	=> __( '2 Columns - Left' , 'cyon' ),
								'general-2right' 	=> __( '2 Columns - Right' , 'cyon' ),
				)
			)
	)
);

// Portfolio Options
$cyon_meta_boxes[] = array(
	'id' 		=> 'settings',
	'title' 	=> __( 'Page Options' , 'cyon' ),
	'pages' 	=> array( 'portfolio' ), // multiple post types, accept custom post types
	'context' 	=> 'normal', // normal, advanced, side (optional)
	'fields' 	=> array(
			array(
				'name' 		=> __( 'Show in homepage' , 'cyon' ),
				'id' 		=> $prefix .'portfolio_homepage',
				'type'		=> 'checkbox'
			),
			array(
				'name' 		=> __( 'Layout' , 'cyon' ),
				'id' 		=> $prefix .'layout',
				'type'		=> 'radio',
				'std' 		=> 'default', 
				'options' => array( // array of name, value pairs for radio options
								'default' 			=> __( 'Default' , 'cyon' ),
								'general-1column' 	=> __( '1 Column' , 'cyon' ),
								'general-2left' 	=> __( '2 Columns - Left' , 'cyon' ),
								'general-2right' 	=> __( '2 Columns - Right' , 'cyon' ),
				)
			)
	)
);

if( $smof_data['meta_headers'] == 1 ){
	$cyon_meta_boxes[] = array(
		'id' 		=> 'seo',
		'title' 	=> __( 'SEO Options' , 'cyon' ),
		'pages' 	=> array( 'post' , 'page', 'portfolio' ), // multiple post types, accept custom post types
		'context' 	=> 'normal', // normal, advanced, side (optional)
		'fields'	=> array(
				array(
					'name' 		=> __( 'Meta title' , 'cyon' ),
					'id' 		=> $prefix .'meta_title',
					'type' 		=> 'text',
					'std' 		=> ''
				),
				array(
					'name' 		=> __( 'Description' , 'cyon' ),
					'id'		=> $prefix .'meta_desc',
					'type' 		=> 'textarea',
					'std' 		=> ''
				),
				array(
					'name' 		=> __( 'Keywords' , 'cyon' ),
					'id' 		=> $prefix .'meta_keywords',
					'type' 		=> 'text',
					'std' 		=> ''
				),
				array(
					'name' 		=> __( 'Hide from search engines' , 'cyon' ),
					'id' 		=> $prefix .'robot',
					'type' 		=> 'checkbox'
				)
			)
	);
}

/* =Register Custom Post Type
----------------------------------------------- */
if( !function_exists( 'cyon_register_post_type' ) ){
function cyon_register_post_type(){
	global $smof_data;
	register_post_type( 'portfolio',
		array(
			'labels' 			=> array(
				'name' 			=> $smof_data['portfolio_title'],
				'singular_name' => $smof_data['portfolio_title'] . ' ' . __( 'Entry', 'cyon' )
			),
		'public'				=> true,
		'has_archive'			=> true,
		'menu_position' 		=> 6,
		'supports' 				=> array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
		'rewrite'				=> array( 'slug' => $smof_data['portfolio_url'] )
		)
	);
} }
add_action( 'init', 'cyon_register_post_type' );


/* =Register Post/Page metaboxes
----------------------------------------------- */
if( !function_exists( 'cyon_register_meta_boxes' ) ){
function cyon_register_meta_boxes(){
	global $cyon_meta_boxes;
	if ( class_exists( 'RW_Meta_Box' ) ){
		foreach ( $cyon_meta_boxes as $cyon_meta_box ){
			new RW_Meta_Box( $cyon_meta_box );
		}
	}
} }
add_action( 'admin_init', 'cyon_register_meta_boxes' );


/* =Load Tax Meta Class
----------------------------------------------- */
require_once( CYON_INCLUDES . 'plugins/tax-meta-class/Tax-meta-class.php' );

/* =Adding Taxonomy Meta boxes on Post Categories
----------------------------------------------- */
if ( is_admin() ){
	if ( class_exists( 'Tax_Meta_Class' ) ){
		$prefix = 'cyon_';
		$config = array(
			'id' 				=> 'tax_meta_category',         
			'title' 			=> __( 'Category Meta Box', 'cyon' ),       
			'pages' 			=> array('category'), 
			'context' 			=> 'normal',        
			'fields' 			=> array(),          
			'local_images' 		=> false,    
			'use_with_theme' 	=> false 
		);
		$new_cat_meta = new Tax_Meta_Class( $config );
		
		$new_cat_meta->addSelect( $prefix.'cat_page_layout',
						array(
								'default' 			=> __( 'Default', 'cyon' ),
								'general-1column'	=> __( '1 Column', 'cyon' ),
								'general-2left'		=> __( '2 Columns Left', 'cyon' ),
								'general-2right'	=> __( '2 Columns Right', 'cyon' )
						),
						array(
								'name' 		=> __( 'Page Layout', 'cyon' ),
								'std'		=> array( 'default' )
						));

		$new_cat_meta->addSelect( $prefix.'cat_layout_listing',
						array(
								'default' 	=> __( 'Default', 'cyon' ),
								'1'			=> __( '1 Column', 'cyon' ),
								'2'			=> __( '2 Columns', 'cyon' ),
								'3'			=> __( '3 Columns', 'cyon' ),
								'4'			=> __( '4 Columns', 'cyon' )
						),
						array(
								'name' 		=> __( 'Listing Layout', 'cyon' ),
								'std'		=> array( 'default' )
						));
						
		$new_cat_meta->Finish();
	}
}

/* =Custom admin login
----------------------------------------------- */
if( !function_exists( 'cyon_admin_login' ) ){
function cyon_admin_login(){
	global $smof_data; ?>
	<style type="text/css">
		<?php if( $smof_data['admin_login_color'] != '' ) { ?>
		body.login, html {
			background-color:<?php echo $smof_data['admin_login_color']; ?>;
		}
		body.login form {
			border-radius:5px;
			background:rgba(0,0,0,.3);
		}
		body.login label {
			color:#fff;
		}
		<?php } ?>
		<?php if( $smof_data['admin_login_logo'] != '' ) { ?>
		body.login h1 a {
			width:320px;
			background:url(<?php echo $smof_data['admin_login_logo']; ?>) 50% 50% no-repeat;
			background-size:auto;
		}
		<?php } ?>
	</style>
<?php } }
add_action( 'login_head', 'cyon_admin_login' );

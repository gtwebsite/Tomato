<?php
if ( !defined('ABSPATH') )
	die('-1');

/* =Start building theme options here
----------------------------------------------- */
remove_action( 'init', 'of_options' );
add_action( 'init', 'cyon_of_options' );


if ( !function_exists( 'cyon_of_options' ) ){
function cyon_of_options() {

	/* =The options array
	----------------------------------------------- */
	/* Set the option array */
	global $of_options;
	$of_options = array();
	
	/* =Background Images array
	----------------------------------------------- */
	$alt_img_path = CYON_IMAGES;
	$alt_img_bg = array();
	if ( is_dir($alt_img_path) ) {
		if ($alt_img_dir = opendir($alt_img_path) ) { 
			while ( ($alt_img_file = readdir($alt_img_dir)) !== false ) {
				if(strstr($alt_img_file,'bg-') !== false){
					$alt_img_bg[$alt_img_file] = $alt_img_file;
				}
			}    
		}
	}
	$bg_images_path = CYON_IMAGES;
	$bg_images_url = CYON_IMAGES_DIR;
	$bg_images = array();
	
	if ( is_dir($bg_images_path) ) {
		if ($bg_images_dir = opendir($bg_images_path) ) { 
			while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
				if(strstr($bg_images_file,'bg-') !== false) {
					natsort($bg_images); //Sorts the array into a natural order
					$bg_images[$bg_images_file] = $bg_images_url . $bg_images_file;
				}
			}    
		}
	}

	/* =Homepage blocks for the layout manager (sorter)
	----------------------------------------------- */
	$of_options_homepage_blocks = array
	( 
		'disabled' => array (
			'placebo' 					=> 'placebo'
		), 
		'enabled' => array (
			'placebo' 					=> 'placebo', 
			'home_block_slider' 		=> __( 'Slider', 'cyon' ),
			'home_block_bucket' 		=> __( 'Bucket Widgets', 'cyon' ),
			'home_block_static' 		=> __( 'Static Content', 'cyon' ),
			'home_block_portfolio' 		=> __( 'Portfolio / Feedback', 'cyon' )
		),
	);

	/* =Styling
	----------------------------------------------- */
	$of_options[] = array( 	'name'		=> __( 'Styling', 'cyon' ),
							'type' 		=> 'heading'
						);
						
	/* Color Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Color Theme', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Color selection
	$of_options[] = array( 	'name' 		=> __( 'Select a color theme', 'cyon' ),
							'id' 		=> 'theme_color',
							'std' 		=> '#bd2c1d',
							'type' 		=> 'color'
						);
						
	/* Color End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Fonts Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Fonts Selection', 'cyon' ),
							'type' 		=> 'group_begin'
						);
	// Primary Font
	$of_options[] = array( 	'name' 		=> __( 'General', 'cyon' ),
							'id' 		=> 'primary_font',
							'std' 		=> array(	'size' 			=> '15px',
													'face' 			=> '\'Segoe UI\', Arial, sans-serif'),
							'type' 		=> 'typography'
						);

	// Main Navigation Font
	$of_options[] = array( 	'name' 		=> __( 'Navigation', 'cyon' ),
							'desc' 		=> __( 'Font use for main navigation', 'cyon' ),
							'id' 		=> 'menu_font',
							'std' 		=> array(	'size' 			=> '15px',
													'face' 			=> '\'Segoe UI\', Arial, sans-serif'
												),
							'type'		=> 'typography'
						);

	// Secondary Font
	$of_options[] = array(	'name'		=> __( 'Headers', 'cyon' ),
							'desc'		=> __( 'Font use for headers like H1, H2 and H3', 'cyon' ),
							'id'		=> 'secondary_font',
							'std'		=> array(	'face' 			=> '\'Segoe UI Light\', Arial, sans-serif'
												),
							'type'		=> 'typography');

	/* Fonts End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Preset Background Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Preset Background Images', 'cyon' ),
							'type' 		=> 'group_begin'
						);
	
	// Background
	$of_options[] = array( 	'name' 		=> __( 'Select a background', 'cyon' ),
							'id' 		=> 'background_preset',
							'std' 		=> 'bg-00.png',
							'type' 		=> 'images',
							'options' 	=> $bg_images
						);  

	/* Preset Background End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Custom Background Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Custom Background', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Background Image
	$of_options[] = array( 	'name' 		=> __( 'Image', 'cyon' ),
							'id' 		=> 'background_style_image',
							'std' 		=> '',
							'type' 		=> 'media'
						);  

	// Background color
	$of_options[] = array( 	'name' 		=> __( 'Color', 'cyon' ),
							'id' 		=> 'background_color',
							'std' 		=> '#ffffff',
							'type' 		=> 'color');  

	// Background repeat
	$of_options[] = array( 	'name' 		=> __( 'Repeat', 'cyon' ),
							'id' 		=> 'background_style_pattern_repeat',
							'std' 		=> 'repeat',
							'type' 		=> 'select',
							'folds' 	=> 1,
							'options' 	=> array(	'full'			=>__('Full screen','cyon'),
													'repeat'		=>__('Repeat','cyon'), 
													'no-repeat'		=>__('No repeat','cyon'), 
													'repeat-x'		=>__('Repeat horizontally','cyon'), 
													'repeat-y'		=>__('Repeat vertically','cyon')
												)
						);  

	// Background position
	$of_options[] = array( 	'name' 		=> __( 'Position', 'cyon' ),
							'id' 		=> 'background_style_pattern_position',
							'std' 		=> '50% 0',
							'type' 		=> 'text',
							'mod'		=> 'mini',
							'fold' 		=> array(	'background_style_pattern_repeat_repeat',
													'background_style_pattern_repeat_no-repeat',
													'background_style_pattern_repeat_repeat-y',
													'background_style_pattern_repeat_repeat-x'
												)
						);

	/* Custom Background End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* =General
	----------------------------------------------- */
	$of_options[] = array( 	'name' 		=> __( 'General', 'cyon' ),
							'type' 		=> 'heading'
						);

	/* Layout Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Site-wide Layout', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Layout
	$of_options[] = array( 	'name' 		=> __( 'Default layout', 'cyon' ),
							'id' 		=> 'general_layout',
							'std' 		=> 'general-2right',
							'type' 		=> 'images',
							'options' 	=> array(	'general-1column' 	=> CYON_IMAGES_DIR . 'col-1-center.png',
													'general-2left'		=> CYON_IMAGES_DIR . 'col-2-left.png',
													'general-2right'	=> CYON_IMAGES_DIR . 'col-2-right.png'
						));  

	// Width
	$of_options[] = array( 	'name' 		=> __( 'Full width layout enabled', 'cyon' ),
							'std' 		=> 0,
							'desc' 		=> __( 'Layout will be stretch', 'cyon' ),
							'id' 		=> 'page_width_stretch',
							'type' 		=> 'switch'
						);


	// Breadcrumbs
	$of_options[] = array( 	'name' 		=> __( 'Breadcrumbs enabled', 'cyon' ),
							'std' 		=> 1,
							'desc' 		=> __( 'Breadcrumbs on inner pages will be enabled.', 'cyon' ),
							'id' 		=> 'breadcrumbs',
							'type' 		=> 'switch'
						);

	// Responsive
	$of_options[] = array( 	'name' 		=> __( 'Responsive enabled', 'cyon' ),
							'std' 		=> 1,
							'desc' 		=> __( 'Allow special styles for mobile devices', 'cyon' ),
							'id' 		=> 'responsive',
							'type' 		=> 'switch'
						);

	/* Layout End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Icon Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Icons Upload', 'cyon' ),
							'type'		=> 'group_begin'
						);

	// Favicon PC
	$of_options[] = array( 	'name' 		=> __( 'Favicon file', 'cyon' ),
							'desc' 		=> __( 'Upload a 16px x 16px icon/png/gif image that will represent your website\'s favicon.', 'cyon' ),
							'id' 		=> 'favicon',
							'std' 		=> '',
							'type' 		=> 'media'
						);  

	// Favicon iOS
	$of_options[] = array( 	'name' 		=> __( 'iOS icon file', 'cyon' ),
							'desc' 		=> __( 'Upload a 114px x 114px png image that will show on iOS devices', 'cyon' ),
							'id' 		=> 'iosicon',
							'std' 		=> '',
							'type' 		=> 'media'
						);  

	/* Icon End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');


	/* Blog Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Blog/Post Type Options', 'cyon' ),
							'type'		=> 'group_begin'
						);


	// Layout
	$of_options[] = array( 	'name' 		=> __( 'Default layout', 'cyon' ),
							'id' 		=> 'blog_layout',
							'std' 		=> '1',
							'type' 		=> 'images',
							'options' 	=> array(	'1' 		=> CYON_IMAGES_DIR . 'blog-col-1.png',
													'2' 		=> CYON_IMAGES_DIR . 'blog-col-2.png',
													'3' 		=> CYON_IMAGES_DIR . 'blog-col-3.png',
													'4' 		=> CYON_IMAGES_DIR . 'blog-col-4.png'
						));  

	// Excerpt character count
	$of_options[] = array( 	'name' 		=> __( 'Excerpt character count', 'cyon' ),
							'id' 		=> 'blog_excerpt_count',
							'desc' 		=> __( 'Set 0 if you want to show the full content.', 'cyon' ),
							'mod'		=> 'mini',
							'std' 		=> '30',
							'type' 		=> 'text'
						);

	// Options enable
	$of_options[] = array( 	'name' 		=> __( 'Show meta info', 'cyon' ),
							'std' 		=> array( 	__( 'Date', 'cyon' ),
													__( 'Author', 'cyon' ),
													__( 'Categories', 'cyon' ),
													__( 'Tags', 'cyon' ),
													__( 'Post Format', 'cyon' ),
													__( 'Comments', 'cyon' )
											),
							'id' 		=> 'blog_meta',
							'type' 		=> 'multicheck',
							'options' 	=> array( 	__( 'Date', 'cyon' ),
													__( 'Author', 'cyon' ),
													__( 'Categories', 'cyon' ),
													__( 'Tags', 'cyon' ),
													__( 'Post Format', 'cyon' ),
													__( 'Comments', 'cyon' )
											),
						);


	// Read more text
	$of_options[] = array( 	'name' 		=> __( 'Read more text', 'cyon' ),
							'id' 		=> 'blog_readmore',
							'std' 		=> __( 'Read more', 'cyon' ) . " <i class='uk-icon-chevron-right'></i>",
							'type' 		=> 'text'
						);


	/* Blog End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');


	/* SEO Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'SEO', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Meta headers
	$of_options[] = array( 	'name' 		=> __( 'Meta headers', 'cyon' ),
							'std' 		=> 1,
							'desc' 		=> __( 'Switch off if you are using other SEO plugins.', 'cyon' ),
							'id' 		=> 'meta_headers',
							'folds' 	=> 1,
							'type' 		=> 'switch'
						);

	/* Meta title format */
	$of_options[] = array( 	'name' 		=> __( 'Meta title format', 'cyon' ),
							'desc' 		=> __( 'Accepts:' , 'cyon' ).' {PAGETITLE}, {BLOGTITLE}, {BLOGTAGLINE}',
							'id' 		=> 'meta_title_format',
							'std' 		=> '{PAGETITLE} | {BLOGTITLE}',
							'fold' 		=> 'meta_headers',
							'type' 		=> 'text'
						);

	/* Home meta title */
	$of_options[] = array( 	'name' 		=> __( 'Homepage meta title', 'cyon' ),
							'id' 		=> 'meta_home_title',
							'std' 		=> get_bloginfo( 'name' ),
							'fold' 		=> 'meta_headers',
							'type' 		=> 'text'
						);

	/* Home meta description */
	$of_options[] = array( 	'name' 		=> __( 'Homepage meta description', 'cyon' ),
							'id' 		=> 'meta_home_description',
							'std' 		=> get_bloginfo( 'description' ),
							'fold' 		=> 'meta_headers',
							'type' 		=> 'text'
						);

	/* Home meta keywords */
	$of_options[] = array( 	'name' 		=> __( 'Homepage meta keywords', 'cyon' ),
							'id' 		=> 'meta_home_keywords',
							'fold' 		=> 'meta_headers',
							'type' 		=> 'text'
						);

	// Google Analytics
	$of_options[] = array( 	'name' 		=> __( 'Google Analytics code', 'cyon' ),
							'id' 		=> 'seo_google',
							'type' 		=> 'text'
						);

	/* SEO End ------- */
	$of_options[] = array( 'type' => 'group_end' );

	/* Custom Scripts Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Scripts', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Fancybox
	$of_options[] = array( 	'name' 		=> __( 'Fancybox enabled', 'cyon' ),
							'std' 		=> 1,
							'desc' 		=> __( 'Force images to open in lightbox. Disable this feature if you are using 3rd-party plugin.', 'cyon' ),
							'id' 		=> 'fancybox',
							'folds' 	=> 1,
							'type' 		=> 'switch'
						);

	// Header
	$of_options[] = array( 	'name' 		=> __( 'Custom scripts', 'cyon' ),
							'desc' 		=> __( 'Scripts and links placed inside the head tag.', 'cyon' ),
							'id' 		=> 'header_scripts',
							'type' 		=> 'textarea'
						);

	/* Custom Scripts End ------- */
	$of_options[] = array( 'type' => 'group_end' );


	/* =Header
	----------------------------------------------- */
	$of_options[] = array( 	'name' 		=> __( 'Header', 'cyon' ),
							'type' 		=> 'heading'
						);

	/* Options Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Header Options', 'cyon' ),
							'type' 		=> 'group_begin');

	// Logo
	$of_options[] = array( 	'name' 		=> __( 'Logo file', 'cyon' ),
							'desc' 		=> __( 'This will replace the website name text and use the image instead. Maximum dimension should be 190x90.', 'cyon' ),
							'id' 		=> 'header_logo',
							'type' 		=> 'media'
						);  

	// Search
	$of_options[] = array( 	'name' 		=> __( 'Search enabled', 'cyon' ),
							'std' 		=> 1,
							'id' 		=> 'header_search',
							'type' 		=> 'switch'
						);

	/* Options End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Social Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Social Icons', 'cyon' ),
							'type' 		=> 'group_begin');

	// Enabled
	$of_options[] = array( 	'name' 		=> __( 'Social icons enabled', 'cyon' ),
							'std' 		=> 1,
							'id' 		=> 'header_social',
							'type' 		=> 'switch'
						);

	// Facebook
	$of_options[] = array( 	'name' 		=> __( 'Facebook', 'cyon' ),
							'id' 		=> 'header_facebook',
							'std' 		=> 'https://www.facebook.com/',
							'type' 		=> 'text'
						);

	// Twitter
	$of_options[] = array( 	'name' 		=> __( 'Twitter', 'cyon' ),
							'id' 		=> 'header_twitter',
							'std' 		=> 'https://twitter.com/',
							'type' 		=> 'text'
						);

	// Google Plus
	$of_options[] = array( 	'name' 		=> __( 'Google Plus', 'cyon' ),
							'id' 		=> 'header_gplus',
							'std' 		=> '',
							'type' 		=> 'text'
						);

	// Email
	$of_options[] = array( 	'name' 		=> __( 'Email Address', 'cyon' ),
							'id' 		=> 'header_email',
							'std' 		=> get_bloginfo('admin_email'),
							'type' 		=> 'text'
						);

	/* Social End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* =Footer
	----------------------------------------------- */
	$of_options[] = array( 	'name'		=> __( 'Footer', 'cyon' ),
							'type' 		=> 'heading'
						);

	/* Options Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Footer Options', 'cyon' ),
							'type' 		=> 'group_begin');

	// Copyright
	$of_options[] = array( 	'name' 		=> __( 'Copyright', 'cyon' ),
							'std'		=> __( '&copy; 2013 MyCompany.com. All Rights Reserved.', 'cyon' ),
							'id' 		=> 'footer_copyright',
							'type' 		=> 'text'
						);

	/* Widget Layout */
	$of_options[] = array( 	'name' 		=> __( 'Bucket layout', 'cyon' ),
							'id' 		=> 'footer_bucket_layout',
							'desc' 		=> __( 'Shows number of widget columns to be used.', 'cyon' ),
							'std' 		=> 'bucket-4columns',
							'type' 		=> 'images',
							'options' 	=> array(	'bucket-1column' 	=> CYON_IMAGES_DIR . 'widget-col-1.png',
													'bucket-2columns' 	=> CYON_IMAGES_DIR . 'widget-col-2.png',
													'bucket-3columns' 	=> CYON_IMAGES_DIR . 'widget-col-3.png',
													'bucket-4columns' 	=> CYON_IMAGES_DIR . 'widget-col-4.png'
												)
						);  

	// Back to Top
	$of_options[] = array( 	'name' 		=> __( 'Back to top enabled', 'cyon' ),
							'std' 		=> 1,
							'id' 		=> 'footer_backtotop',
							'type' 		=> 'switch'
						);

	/* Options End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Newsletter Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Newsletter', 'cyon' ),
							'type' 		=> 'group_begin');

	// Enabled
	$of_options[] = array( 	'name' 		=> __( 'Newsletter enabled', 'cyon' ),
							'desc'		=> __( 'Email will be sent to the admin email address.', 'cyon' ),
							'std' 		=> 1,
							'id' 		=> 'footer_newsletter',
							'type' 		=> 'switch'
						);

	// Title
	$of_options[] = array( 	'name' 		=> __( 'Title', 'cyon' ),
							'id' 		=> 'footer_newsletter_title',
							'std' 		=> __( 'Sign Up for Our Newsletter', 'cyon' ),
							'type' 		=> 'text'
						);

	// Description
	$of_options[] = array( 	'name' 		=> __( 'Description', 'cyon' ),
							'id' 		=> 'footer_newsletter_description',
							'std' 		=> __( 'Get the latest news and updates directly to your mailbox.', 'cyon' ),
							'type' 		=> 'text'
						);

	/* Newsletter End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* =Homepage
	----------------------------------------------- */
	$of_options[] = array( 	'name' 		=> __( 'Homepage', 'cyon' ),
							'type' 		=> 'heading'
						);

	/* Options Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Homepage Options', 'cyon' ),
							'type' 		=> 'group_begin');

	// Sorter
	$of_options[] = array( 	'name' 		=> __( 'Block sorter', 'cyon' ),
							'id' 		=> 'homepage_blocks',
							'desc' 		=> __( 'Organize how you want the layout to appear on the homepage', 'cyon' ),
							'std' 		=> $of_options_homepage_blocks,
							'type' 		=> 'sorter'
						);  

	/* Options End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Slider Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Slider', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Slider Images
	$of_options[] = array( 	'name' 		=> __( 'Images', 'cyon' ),
							'desc' 		=> __( 'Unlimited slider with drag and drop sortings. Important: upload image minimum height of 350px.', 'cyon' ),
							'id' 		=> 'homepage_slider',
							'type' 		=> 'slider'
						);

	/* Slider End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Bucket Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Bucket Widgets', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Widget Layout
	$of_options[] = array( 	'name' 		=> __( 'Layout', 'cyon' ),
							'id' 		=> 'homepage_bucket_layout',
							'desc' 		=> __( 'Shows number of widget columns to be used.', 'cyon' ),
							'std' 		=> 'bucket-3columns',
							'type' 		=> 'images',
							'options' 	=> array(	'bucket-1column' 	=> CYON_IMAGES_DIR . 'widget-col-1.png',
													'bucket-2columns' 	=> CYON_IMAGES_DIR . 'widget-col-2.png',
													'bucket-3columns' 	=> CYON_IMAGES_DIR . 'widget-col-3.png',
													'bucket-4columns' 	=> CYON_IMAGES_DIR . 'widget-col-4.png'
												)
						);  

	/* Bucket End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Static Content Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Static Content', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Title
	$of_options[] = array( 	'name' 		=> __( 'Title', 'cyon' ),
							'std' 		=> __( 'Hi there, welcome.', 'cyon' ),
							'id' 		=> 'homepage_static_title',
							'type' 		=> 'text'
						);

	// Subitle
	$of_options[] = array( 	'name' 		=> __( 'Subtitle', 'cyon' ),
							'std' 		=> __( 'Step up to the game and be a winner', 'cyon' ),
							'id' 		=> 'homepage_static_subtitle',
							'type' 		=> 'text'
						);

	// Text
	$of_options[] = array( 	'name' 		=> __( 'Text content', 'cyon' ),
							'std' 		=> '<p>We use latest web technologies and industrial standards. Our websites not only look good and work well on desktop computers, but also on all mobile devices. Our team consists of passionate and experienced people, who love what they do and are always one step ahead.</p>'."\n".'[button url="#"]Know why you should[button]',
							'desc' 		=> __( 'Can accept HTML tags and shortcodes.', 'cyon' ),
							'id' 		=> 'homepage_static_text',
							'type' 		=> 'textarea'
						);

	// Background
	$of_options[] = array( 	'name' 		=> __( 'Side image', 'cyon' ),
							'desc' 		=> __( 'The image will left align full width of the container.', 'cyon' ),
							'id' 		=> 'homepage_static_bg',
							'type' 		=> 'media'
						);  

	/* Static Content End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Portfolio/Feedback Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Portfolio / Feedback', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Portfolio Title
	$of_options[] = array( 	'name' 		=> __( 'Portfolio title', 'cyon' ),
							'std' 		=> __( 'Portfolio', 'cyon' ),
							'id' 		=> 'homepage_portfolio_title',
							'type' 		=> 'text'
						);

	// Feedback Title
	$of_options[] = array( 	'name' 		=> __( 'Feedback title', 'cyon' ),
							'std' 		=> __( 'Clients', 'cyon' ),
							'id' 		=> 'homepage_feedback_title',
							'type' 		=> 'text'
						);

	/* Manager */
	$of_options[] = array( 	'name' 		=> __( 'Feedback entries', 'cyon' ),
							'desc' 		=> __( 'Unlimited feedback with drag and drop sortings.', 'cyon' ),
							'id' 		=> 'feedback',
							'type' 		=> 'feedback'
						);

	/* Portfolio/Feedback End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');



	/* =Portfolio
	----------------------------------------------- */
	$of_options[] = array( 	'name' 		=> __( 'Portfolio', 'cyon' ),
							'type' 		=> 'heading'
						);

	/* Name Options begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Names', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Title
	$of_options[] = array( 	'name' 		=> __( 'Title', 'cyon' ),
							'id' 		=> 'portfolio_title',
							'std' 		=> __( 'Portfolio', 'cyon' ),
							'type' 		=> 'text'
						);

	// Permalink
	$of_options[] = array( 	'name' 		=> __( 'Permalink', 'cyon' ),
							'desc' 		=> sprintf( __( 'You need to resave the permalinks for this to work from <a href="%s">this page</a>.', 'cyon' ), admin_url() .'options-permalink.php' ),
							'id' 		=> 'portfolio_url',
							'std' 		=> __( 'portfolio', 'cyon' ),
							'type' 		=> 'text'
						);

	// Description
	$of_options[] = array( 	'name' 		=> __( 'Description', 'cyon' ),
							'desc' 		=> __( 'Can accept HTML tags and shortcodes.', 'cyon' ),
							'id' 		=> 'portfolio_description',
							'type' 		=> 'textarea'
						);

	// Read more text
	$of_options[] = array( 	'name' 		=> __( 'Read more text', 'cyon' ),
							'id' 		=> 'portfolio_readmore',
							'std' 		=> __( 'View details', 'cyon' ) . " <i class='uk-icon-chevron-right'></i>",
							'type' 		=> 'text'
						);


	/* Name Options End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');

	/* Layout Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Layout', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Page Layout
	$of_options[] = array( 	'name' 		=> __( 'Page layout', 'cyon' ),
							'id' 		=> 'portfolio_page_layout',
							'desc' 		=> __( 'This layout will be used as a default instead.', 'cyon' ),
							'std' 		=> 'general-1column',
							'type' 		=> 'images',
							'options' 	=> array(	'general-1column' 	=> CYON_IMAGES_DIR . 'col-1-center.png',
													'general-2left'		=> CYON_IMAGES_DIR . 'col-2-left.png',
													'general-2right'	=> CYON_IMAGES_DIR . 'col-2-right.png'
						));  

	// List layout
	$of_options[] = array( 	'name' 		=> __( 'List layout', 'cyon' ),
							'id' 		=> 'portfolio_layout',
							'desc' 		=> __( 'Shows number of columns to be used.', 'cyon' ),
							'std' 		=> '3',
							'type' 		=> 'images',
							'options' 	=> array(	'1' 		=> CYON_IMAGES_DIR . 'blog-col-1.png',
													'2' 		=> CYON_IMAGES_DIR . 'blog-col-2.png',
													'3' 		=> CYON_IMAGES_DIR . 'blog-col-3.png',
													'4' 		=> CYON_IMAGES_DIR . 'blog-col-4.png'
												)
						);  

	// Per page
	$of_options[] = array( 	'name' 		=> __( 'Items per page', 'cyon' ),
							'id' 		=> 'portfolio_perpage',
							'desc' 		=> __( 'Set -1 if you want to show all items in one page', 'cyon' ),
							'mod'		=> 'mini',
							'std' 		=> '12',
							'type' 		=> 'text'
						);

	/* Layout End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');


	/* =Admin
	----------------------------------------------- */
	$of_options[] = array( 	'name' 		=> __( 'Admin', 'cyon' ),
							'type' 		=> 'heading'
						);

	/* Login Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Login options', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Logo
	$of_options[] = array( 	'name' 		=> __( 'Logo file', 'cyon' ),
							'desc' 		=> __( 'This will replace the admin logo. Maximum dimension should be 320x80.', 'cyon' ),
							'id' 		=> 'admin_login_logo',
							'type' 		=> 'media'
						);  

	// Color selection
	$of_options[] = array( 	'name' 		=> __( 'Select a background color', 'cyon' ),
							'id' 		=> 'admin_login_color',
							'std' 		=> '#bd2c1d',
							'type' 		=> 'color'
						);

	/* Login End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');


	/* Offline Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Offline options', 'cyon' ),
							'type' 		=> 'group_begin'
						);

	// Enabled
	$of_options[] = array( 	'name' 		=> __( 'Offline enabled', 'cyon' ),
							'desc'		=> __( 'Only admin users who logged in can view the site.', 'cyon' ),
							'std' 		=> 0,
							'id' 		=> 'offline',
							'type' 		=> 'switch'
						);

	// Title
	$of_options[] = array( 	'name' 		=> __( 'Title', 'cyon' ),
							'std' 		=> __( 'We are building something great here', 'cyon' ),
							'id' 		=> 'offline_title',
							'type' 		=> 'text'
						);

	// Text
	$of_options[] = array( 	'name' 		=> __( 'Text content', 'cyon' ),
							'std' 		=> '<p>Sorry for inconvenience, but the website you are looking at still under development. Please be patient and visit us next time. You can subscribe to our mailing list to get notified.</p>'."\n".'[newsletter_form]',
							'desc' 		=> __( 'Can accept HTML tags and shortcodes.', 'cyon' ),
							'id' 		=> 'offline_text',
							'type' 		=> 'textarea'
						);


	// Newsletter
	$of_options[] = array( 	'name' 		=> __( 'Newsletter enabled', 'cyon' ),
							'std' 		=> 1,
							'id' 		=> 'offline_newsletter',
							'type' 		=> 'switch'
						);

	/* Offline End ------- */
	$of_options[] = array( 	'type' 		=> 'group_end');
	
	/* Maintenance Begin ------- */
	$of_options[] = array( 	'name' 		=> __( 'Maintenance', 'cyon' ),
							'type' 		=> 'group_begin');
	// Backup
	$of_options[] = array( 	'name' 		=> __( 'Backup and restore theme options', 'cyon' ),
							'desc' 		=> __( 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'cyon' ),
							'id' 		=> 'of_backup',
							'type' 		=> 'backup'
						);

	// Transfer
	$of_options[] = array( 	'name' 		=> __( 'Transfer theme options', 'cyon' ),
							'desc' 		=> __( 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'cyon' ),
							'id' 		=> 'of_transfer',
							'type' 		=> 'transfer'
						);

	/* Maintenance End ------- */
	$of_options[] = array( 'type' => 'group_end');

} }

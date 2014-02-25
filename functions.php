<?php

if ( !defined('ABSPATH') )
	die('-1');

/*	
*	---------------------------------------------------------------------
*	CYON Functions
*	--------------------------------------------------------------------- 
*/

/* =Define Directories
----------------------------------------------- */
define( 'CYON_PATH' , get_template_directory_uri() . '/' );
define( 'CYON_INCLUDES' , get_template_directory() . '/includes/' );
define( 'CYON_INCLUDES_DIR' , get_template_directory_uri() . '/includes/' );
define( 'CYON_ADMIN' , get_template_directory() . '/includes/theme-options/' );
define( 'CYON_ADMIN_DIR' , get_template_directory_uri() . '/includes/theme-options/' );
define( 'CYON_CSS' , get_template_directory_uri() . '/assets/css/' );
define( 'CYON_JS' , get_template_directory_uri() . '/assets/js/' );
define( 'CYON_IMAGES' , get_template_directory() . '/assets/images/' );
define( 'CYON_IMAGES_DIR' , get_template_directory_uri() . '/assets/images/' );

/* =Initialize
----------------------------------------------- */
include_once( CYON_INCLUDES . 'function-init.php' );

/* =Admin
----------------------------------------------- */
include_once( CYON_INCLUDES . 'function-admin.php' );
include_once( CYON_INCLUDES . 'function-theme.php' );

/* =Front-end
----------------------------------------------- */
include_once( CYON_INCLUDES . 'function-core.php' );
include_once( CYON_INCLUDES . 'plugins/aq_resizer.php' );

/* =Shortcodes
----------------------------------------------- */
include_once( CYON_INCLUDES . 'shortcodes/shortcode-elements.php' );
include_once( CYON_INCLUDES . 'shortcodes/shortcode-media.php' );
include_once( CYON_INCLUDES . 'shortcodes/shortcode-columns.php' );
include_once( CYON_INCLUDES . 'shortcodes/shortcode-boxes.php' );
include_once( CYON_INCLUDES . 'shortcodes/shortcode-animations.php' );
include_once( CYON_INCLUDES . 'shortcodes/shortcode-query.php' );

/* =Widgets
----------------------------------------------- */
include_once( CYON_INCLUDES . 'widgets/widget-text.php' );


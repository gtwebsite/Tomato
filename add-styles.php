<?php
header("Content-type: text/css;");

/* =CSS loaders
----------------------------------------------- */

// Load WP variables
$current_url = dirname(__FILE__);
$wp_content_pos = strpos($current_url, 'wp-content');
$wp_content = substr($current_url, 0, $wp_content_pos);
require_once($wp_content . 'wp-load.php');

global $smof_data, $primary_font_face;

?>

/* Custom backbround */
body {
<?php if( $smof_data['background_style_pattern_repeat'] != 'full' && $smof_data['background_style_image'] != '' && $smof_data['background_preset'] == 'bg-00.png' ){ ?>
	background-color: <?php echo $smof_data['background_color']; ?>;
	background-image: url( '<?php echo $smof_data['background_style_image']; ?>' );
	background-repeat: <?php echo $smof_data['background_style_pattern_repeat']; ?>;
	background-position: <?php echo $smof_data['background_style_pattern_position']; ?>;
<?php }elseif( $smof_data['background_preset'] != 'bg-00.png' ) { ?>
	background-image: url( '<?php echo CYON_IMAGES_DIR . 'bg/' . str_replace( 'png', 'jpg', $smof_data['background_preset'] ); ?>' );
	background-repeat: repeat-x;
	background-position: 50% 0;
	background-attachment: fixed;
<?php }else{ ?>
	background-color: <?php echo $smof_data['background_color']; ?>;
<?php } ?>
}

/* Preset background larger than 1600 */
<?php if( $smof_data['background_preset'] != 'bg-00.png' ) { ?>
@media (min-width: 1601px) {
	body {
		background-size:100% auto;
	}
}
<?php } ?>

/* Custom body font */
body, blockquote small span {
<?php if($smof_data['primary_font']['face']=='google_font'){ ?>
	font-family:<?php echo $smof_data['primary_font']['google']; ?>, sans-serif;
	font-weight:<?php echo $smof_data['primary_font']['googlew']; ?> !important;
<?php }else{ ?>
	font-family:<?php echo $smof_data['primary_font']['face']; ?>;
<?php } ?>
	font-size:<?php echo $smof_data['primary_font']['size']; ?>;
}

/* Custom header font */
h1, h2, h3, blockquote small, .uk-navbar-brand {
<?php if($smof_data['secondary_font']['face']=='google_font'){ ?>
	font-family:<?php echo $smof_data['secondary_font']['google']; ?>, sans-serif;
	font-weight:<?php echo $smof_data['secondary_font']['googlew']; ?> !important;
<?php }else{ ?>
	font-family:<?php echo $smof_data['secondary_font']['face']; ?>;
<?php } ?>
}

/* Custom main navigation font */
.uk-navbar-nav > li > a, .uk-nav-offcanvas > li > a {
<?php if($smof_data['menu_font']['face']=='google_font'){ ?>
	font-family:<?php echo $smof_data['menu_font']['google']; ?>, sans-serif;
	font-weight:<?php echo $smof_data['menu_font']['googlew']; ?> !important;
<?php }else{ ?>
	font-family:<?php echo $smof_data['menu_font']['face']; ?>;
<?php } ?>
}

/* Theme color */
a, a:hover, 
#access .uk-navbar-nav > li.uk-active > a, 
#access .uk-navbar-nav > li:hover > a, 
#access .uk-navbar-nav > li > a:focus, 
#access .uk-navbar-nav > li.uk-open > a,
#social .uk-icon-button:hover,
.uk-button-link,
.portfolio .uk-panel:hover h3,
.uk-tab>li>a, .uk-tab>li>a:hover
{
	color:<?php echo $smof_data['theme_color']; ?>;
}

.uk-button-primary,
.uk-button-primary:hover,
.uk-button-primary:focus,
.uk-nav-navbar li a:hover,
.uk-nav-navbar li a:focus,
#access .uk-navbar-brand,
.brand-logo,
.cyon-text .icon-header,
.uk-button-link:hover,
.feedback blockquote p,
.uk-nav-offcanvas > li.current-menu-item > a,
.uk-nav-offcanvas > li.current-menu-item > a:hover,
.uk-nav-offcanvas > li.current-menu-item > a:focus,
.uk-nav-offcanvas > li.current-menu-ancestor > a,
.uk-pagination > li.uk-active span
{
	background:<?php echo $smof_data['theme_color']; ?>;
}

::-moz-selection{background:<?php echo $smof_data['theme_color']; ?>;}
::selection{background:<?php echo $smof_data['theme_color']; ?>;}

.feedback blockquote p:before {
		border-top:20px solid <?php echo $smof_data['theme_color']; ?>;
}
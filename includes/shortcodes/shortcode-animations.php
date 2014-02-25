<?php

/* =Animation
----------------------------------------------- */
if( !function_exists( 'cyon_animate' ) ){
function cyon_animate( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'style'			=> 'fade',
			'repeat'		=> '',
			'delay'			=> '',
			'class'			=> ''
		), $atts);

		// Animation
		$params = '';
		if( $atts['style'] != '' ) {
			$params .= ' data-uk-scrollspy="{cls:\'uk-animation-' . $atts['style'] . '\''; 
			if( $atts['repeat'] == 1 ) {
				$params .= ', repeat: true';
			}
			if( $atts['delay'] != '' ) {
				$params .= ', delay: ' . $atts['delay'];
			}
			$params .= '}"';
		}
		
		// Class names
		if( $atts['class'] != '' ) {
			$params .= ' class="' . $atts['class'] . '"';
		}
		
	return '<div' . $params . '>' . do_shortcode( $content ) . '</div>';
} }
add_shortcode( 'animate', 'cyon_animate' ); 


/* =Toggle
----------------------------------------------- */
// Global variable used in tabs
$cyonShortToggle = 0;

if( !function_exists( 'cyon_toggle' ) ){
function cyon_toggle( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title'			=> '',
			'show'			=> '0',
			'icon'			=> '',
			'box_type'		=> '',
			'class'			=> ''
		), $atts);

		// Matching variables
		global $cyonShortToggle;

		$cyonShortToggle++;
		
		// Class names
		$params = ' class="toggle uk-panel';
		if( $atts['class'] != '' ) {
			$params .= ' ' . $atts['class'];
		}
		if( $atts['box_type'] == 'primary' || $atts['box_type'] == 'secondary' ) {
			$params .= ' uk-panel-box uk-panel-box-' . $atts['box_type'];
		}
		if( $atts['box_type'] == 'header' || $atts['box_type'] == 'space' || $atts['box_type'] == 'divider' ) {
			$params .= ' uk-panel-' . $atts['box_type'];
		}
		$params .= '"';

		// Class names
		$params2 = ' class="toggle-content';
		if( $atts['show'] == 0 ) {
			$params2 .= ' uk-hidden';
		}
		$params2 .= '" id="toggle' . $cyonShortToggle . '"';

		// Icon
		$title = '';
		if( $atts[ 'icon' ] != '' ) {
			$title .= '<i class="uk-icon-' . $atts[ 'icon' ] . '"></i> ';
		}
		$title .= $atts[ 'title' ];

	return '<div' . $params . '><h3 data-uk-toggle="{target: \'#toggle' . $cyonShortToggle . '\'}" class="toggle-button uk-panel-title">' . $title . '</h3><div' . $params2 . '>' . do_shortcode( $content ) . '</div></div>';
	
} }
add_shortcode( 'toggle', 'cyon_toggle' ); 


/* =Tabs
----------------------------------------------- */

// Global variable used in tabs
$cyonShortTabs = NULL;
$cyonShortTabCount = NULL;
$cyonShortTabTotal = 0;

if( !function_exists( 'cyon_tabs' ) ){
function cyon_tabs( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'position' 		=> '', // flip, bottom
			'grid' 			=> '',
			'center'		=> '',
			'class'			=> ''
		), $atts);

		// Matching variables
		global $cyonShortTabs, $cyonShortTabCount, $cyonShortTabTotal;
		$cyonShortTabCount = 0;
		$x = $cyonShortTabTotal;
		$html = '';
		do_shortcode($content);

		// Class names
		$class = 'uk-tab';
		if( $atts[ 'position' ] == 'flip' || $atts[ 'position' ] == 'bottom' ) {
			$class .= ' uk-tab-' . $atts[ 'position' ];
		}		
		if( $atts[ 'grid' ] == 1 ) {
			$class .= ' uk-tab-grid';
		}		
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}		

		// Output
		if( $atts[ 'position' ] == 'bottom' ) {
		
			$html .= '<ul id="tab' . $x . '" class="uk-switcher uk-margin">';
	
			foreach( $cyonShortTabs as $tab ){
				$html .= '<li>' . do_shortcode( $tab[ 'content' ] ) . '</li>';
			}
	
			$html .= '</ul>';
		}

		if( $atts[ 'center' ] == 1 ) {
			$html .= '<div class="uk-tab-center">';
		}

		$html .= '<ul class="' . $class . '" data-uk-tab="{connect:\'#tab' . $x . '\'}">';
		
		foreach( $cyonShortTabs as $tab ){
			$icon = '';
			$class_li = ' class="';
			if( $tab[ 'active' ] == 1 ) {
				$class_li .= 'uk-active';
			}elseif( $tab[ 'disable' ] == 1 ) {
				$class_li .= 'uk-disabled';
			}else{
				$class_li .= '';
			}
			if( $atts[ 'grid' ] == 1 ) {
				$class_li .= ' uk-width-1-' . $cyonShortTabCount;
			}
			$class_li .= '"';
			if( $tab[ 'icon' ] != '' ){
				$icon .= '<i class="uk-icon-' . $tab[ 'icon' ] . '"></i> ';
			}
			$html .= '<li' . $class_li . '><a href="#">' . $icon . $tab[ 'title' ] . '</a></li>';
		}
		
		$html .= '</ul>';
		
		if( $atts[ 'center' ] == 1 ) {
			$html .= '</div>';
		}
		
		if( $atts[ 'position' ] != 'bottom' ) {
		
			$html .= '<ul id="tab' . $x . '" class="uk-switcher uk-margin">';
	
			foreach( $cyonShortTabs as $tab ){
				$html .= '<li>' . do_shortcode( $tab[ 'content' ] ) . '</li>';
			}
	
			$html .= '</ul>';
		}
		
		$cyonShortTabTotal++;

	return $html;
} }
add_shortcode( 'tabs', 'cyon_tabs' );

if( !function_exists( 'cyon_tab' ) ){
function cyon_tab( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'title' 		=> '',
			'active' 		=> '',
			'disable' 		=> '',
			'icon' 			=> ''
		), $atts);

		// Matching variables
		global $cyonShortTabs, $cyonShortTabCount;
		$x = $cyonShortTabCount;
		$cyonShortTabs[$x] = array( 
									'title'		=> $atts['title'],
									'icon'		=> $atts['icon'],
									'active'	=> $atts['active'],
									'disable'	=> $atts['disable'],
									'content' 	=> $content, 
									'index' 	=> $x
								);
		$cyonShortTabCount++;
	
} }
add_shortcode( 'tab', 'cyon_tab' ); 


/* =Modal
----------------------------------------------- */
if( !function_exists( 'cyon_modal' ) ){
function cyon_modal( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'id' 			=> '',
			'slide'			=> '',
			'close' 		=> '1',
			'class'			=> ''
		), $atts);
		
		// Button
		if( $atts[ 'close' ] == 1 ){
			$content = '<a class="uk-modal-close uk-close"></a>' . $content;
		}
		
		// Slide
		$slide = '';
		if( $atts[ 'slide' ] == 1 ){
			$slide .= ' uk-modal-dialog-slide';
		}

		// Class names
		$params = ' class="uk-modal';
		if( $atts['class'] != '' ) {
			$params .= ' ' . $atts['class'];
		}
		$params .= '"';

	return '<div id="' . $atts[ 'id' ] . '"' . $params . '><div class="uk-modal-dialog' . $slide . '">' . do_shortcode( $content ) . '</div></div>';	
	
} }
add_shortcode( 'modal', 'cyon_modal' ); 


/* =Scroll
----------------------------------------------- */
if( !function_exists( 'cyon_scroll' ) ){
function cyon_scroll( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'id' 			=> 'page-wrapper',
			'title' 		=> __( 'Back to top', 'cyon' ),
			'icon' 			=> 'angle-up',
			'class'			=> ''
		), $atts);
	
		$params = ' data-uk-smooth-scroll';
		$params .= ' href="#' . $atts['id'] . '"';

		// Class names
		if( $atts['class'] != '' ) {
			$params .= '  class="' . $atts['class'] . '"';
		}

		// Icon
		$title = '';
		if( $atts[ 'icon' ] != '' ) {
			$title .= '<i class="uk-icon-' . $atts[ 'icon' ] . '"></i> ';
		}
		$title .= $atts[ 'title' ];

	return '<p><a' . $params . '>' . $title . '</a></p>';

} }
add_shortcode( 'scroll', 'cyon_scroll' ); 


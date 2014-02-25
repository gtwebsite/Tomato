<?php

/* =Headers
----------------------------------------------- */
if( !function_exists( 'cyon_header' ) ){
function cyon_header( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'size'			=> '2',
			'color'			=> '',
			'icon'			=> '',
			'style'			=> '',
			'ani'			=> '',
			'ani_repeat'	=> '',
			'ani_delay'		=> '',
			'class'			=> ''
		), $atts);

		// Color
		$params = '';
		if( $atts[ 'color' ] != '' ){
			$params .= ' style="';
			if( $atts[ 'color' ] != '' ) {
				$params .= 'color:' . $atts[ 'color' ] . ';';
			}
			$params .= '"';
		}
		
		// Animation
		if( $atts['ani'] != '' ) {
			$params .= ' data-uk-scrollspy="{cls:\'uk-animation-' . $atts['ani'] . '\''; 
			if( $atts['ani_repeat'] == 1 ) {
				$params .= ', repeat: true';
			}
			if( $atts['ani_delay'] != '' ) {
				$params .= ', delay: ' . $atts['ani_delay'];
			}
			$params .= '}"';
		}

		// Class names
		$class = $atts[ 'size' ];
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}
		if( $atts[ 'style' ] != '' ) {
			$class .= ' cyon-header-style-' . $atts[ 'style' ];
		}
		
		// Icon
		if( $atts[ 'icon' ] != '' ) {
			$content = '<i class="uk-icon-' . $atts[ 'icon' ] . '"></i> ' . $content;
		}

	return '<h' . $atts['size'] . ' class="uk-h' . $class . '"' . $params . '>' . do_shortcode( $content ) . '</h' . $atts['size'] . '>';
} }
add_shortcode( 'header', 'cyon_header' );


/* =Button
----------------------------------------------- */
if( !function_exists( 'cyon_button' ) ){
function cyon_button( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'url'			=> '',
			'target'		=> '',
			'size'			=> '',
			'color'			=> '',
			'icon'			=> '',
			'expand'		=> '',
			'disabled'		=> '',
			'modal'			=> '',
			'tooltip'		=> '',
			'ani'			=> '',
			'ani_repeat'	=> '',
			'ani_delay'		=> '',
			'class'			=> ''
		), $atts);

		// element
		$ele = '';
		if( $atts[ 'url' ] != '' ) {
			$ele .= 'a';
		}else{
			$ele .= 'button';
		}

		// Parameters
		$params = '';
		if( $atts[ 'url' ] != '' ) {
			$params .= ' href="' . $atts[ 'url' ] . '"';
		}
		if( $atts[ 'target' ] == '1' && $atts[ 'url' ] != '' ) {
			$params .= ' target="_blank"';
		}
		if( $atts[ 'disabled' ] == '1' && $atts[ 'url' ] == '' ) {
			$params .= ' disabled';
		}
		
		// Class names
		$params .= ' class="uk-button';
		if( $atts[ 'size' ] != '' ) {
			$params .= ' uk-button-' . $atts[ 'size' ];
		}
		if( $atts[ 'color' ] == 'primary' || $atts[ 'color' ] == 'success' || $atts[ 'color' ] == 'danger' || $atts[ 'color' ] == 'link' ) {
			$params .= ' uk-button-' . $atts[ 'color' ];
		}
		if( $atts[ 'expand' ] == 1 ) {
			$params .= ' uk-button-expand';
		}
		if( $atts[ 'class' ] != '' ) {
			$params .= ' ' . $atts[ 'class' ];
		}
		$params .= '"';
		
		// Custom color
		if( $atts[ 'color' ] != 'primary' && $atts[ 'color' ] != 'success' && $atts[ 'color' ] != 'danger' && $atts[ 'color' ] != 'link' && $atts[ 'color' ] != '' ) {
			$params .= ' style="color:#fff; background-color:' . $atts[ 'color' ] . '"';
		}
		
		// Animation
		if( $atts['ani'] != '' ) {
			$params .= ' data-uk-scrollspy="{cls:\'uk-animation-' . $atts['ani'] . '\''; 
			if( $atts['ani_repeat'] == 1 ) {
				$params .= ', repeat: true';
			}
			if( $atts['ani_delay'] != '' ) {
				$params .= ', delay: ' . $atts['ani_delay'];
			}
			$params .= '}"';
		}
		
		// Modal
		if( $atts['modal'] == '1' ) {
			$params .= ' data-uk-modal';
		}

		// Tooltip
		if( $atts['tooltip'] != '' ) {
			$params .= ' data-uk-tooltip title="' . $atts['tooltip'] . '"';
		}

		// Icon
		if( $atts[ 'icon' ] != '' ) {
			$content = '<i class="uk-icon-' . $atts[ 'icon' ] . '"></i> ' . $content;
		}

	return '<' . $ele . $params . '>' . do_shortcode( $content ) . '</' . $ele . '>';
} }
add_shortcode( 'button', 'cyon_button' );


/* =Icons
----------------------------------------------- */
if( !function_exists( 'cyon_icon' ) ){
function cyon_icon( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'size'		=> '',
			'color'		=> '',
			'bg'		=> '',
			'element'	=> 'i',
			'type'		=> 'check',
			'url'		=> '',
			'target'	=> '',
			'button'	=> '',
			'spin'		=> '',
			'class'		=> ''
		), $atts);

		// Element
		$elem = $atts[ 'element' ];
		if( $atts[ 'url' ] != '' || $atts[ 'button' ] == 1 ){
			$elem = 'a';
		}

		// Parameters
		$params = '';
		if( $atts[ 'color' ] != '' || $atts[ 'bg' ] != '' ){
			$params .= ' style="';
			if( $atts[ 'color' ] != '' ) {
				$params .= 'color:' . $atts[ 'color' ] . ';';
			}
			if( $atts[ 'bg' ] != '' ) {
				$params .= 'background-color:' . $atts[ 'bg' ] . ';';
			}
			$params .= '"';
		}
		if( $atts[ 'url' ] != '' ){
			$params .= ' href="' . $atts[ 'url' ] . '"';
		}
		if( $atts[ 'target' ] != '' && $atts[ 'url' ] != '' ){
			$params .= ' target="_blank"';
		}
		
		// Class names
		$class = $atts[ 'type' ];
		if( $atts[ 'size' ] != '' ) {
			$class .= ' uk-icon-' . $atts[ 'size' ];
		}
		if( $atts[ 'spin' ] == 1 ) {
			$class .= ' uk-icon-spin';
		}
		if( $atts[ 'button' ] == 1 ) {
			$class .= ' uk-icon-button';
		}
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}
		
	return '<' . $elem . ' class="uk-icon-' . $class . '"' . $params . '></' . $elem . '>';
} }
add_shortcode( 'icon', 'cyon_icon' );


/* =Horizontal divider
----------------------------------------------- */
if( !function_exists( 'cyon_dropcap' ) ){
function cyon_dropcap( $atts, $content = null ) {
	// Extract attributes
	$atts = shortcode_atts(
		array(
			'style'		=> '',
			'class'		=> ''
		), $atts);


		// Class names
		$class = 'dropcap';
		if( $atts[ 'style' ] != '' ) {
			$class .= ' dropcap-style-' . $atts[ 'style' ];
		}
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}

	return '<p class="' . $class . '">' . do_shortcode( $content ) . '</p>';
} }
add_shortcode( 'dropcap', 'cyon_dropcap' );

/* =Horizontal divider
----------------------------------------------- */
if( !function_exists( 'cyon_hr' ) ){
function cyon_hr( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'border'	=> '',
			'color'		=> '',
			'thick'		=> '',
			'class'		=> ''
		), $atts);

		// Parameters
		$params = '';
		if( $atts[ 'border' ] != '' || $atts[ 'color' ] != '' || $atts[ 'thick' ] != '' ){
			$params .= ' style="';
			if( $atts[ 'border' ] != '' ) {
				$params .= 'border-top-style:' . $atts[ 'border' ] . ';';
			}
			if( $atts[ 'color' ] != '' ) {
				$params .= 'border-top-color:' . $atts[ 'color' ] . ';';
			}
			if( $atts[ 'thick' ] != '' ) {
				$params .= 'border-top-width:' . $atts[ 'thick' ] . 'px;';
			}
			$params .= '"';
		}
		
		// Class names
		$class = '';
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}
		
	return '<hr class="uk-article-divider' . $class . '"' . $params . ' />';
} }
add_shortcode( 'hr', 'cyon_hr' );


/* =Unordered List
Can be line, striped, space
----------------------------------------------- */
if( !function_exists( 'cyon_list' ) ){
function cyon_list( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'style'		=> '',
			'class'		=> ''
		), $atts);

		// Class names
		$class = '';
		if( $atts[ 'style' ] != '' ) {
			$class .= ' uk-list-' . $atts[ 'style' ];
		}
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}
		
	return '<ul class="uk-list' . $class . '">' . do_shortcode( $content ) . '</ul>';
} }
add_shortcode( 'list', 'cyon_list' );

if( !function_exists( 'cyon_list_li' ) ){
function cyon_list_li( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'class'		=> ''
		), $atts);

		// Class names
		$class = '';
		if( $atts[ 'class' ] != '' ) {
			$class .= ' class="' . $atts[ 'class' ] . '"';
		}
		
	return '<li' . $class . '>' . do_shortcode( $content ) . '</li>';
} }
add_shortcode( 'li', 'cyon_list_li' );



/* =Definition List
Can be horizontal, line
----------------------------------------------- */
if( !function_exists( 'cyon_define' ) ){
function cyon_define( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'style'		=> '',
			'class'		=> ''
		), $atts);

		// Class names
		$class = '';
		if( $atts[ 'style' ] != '' ) {
			$class .= ' uk-description-list-' . $atts[ 'style' ];
		}
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}
		
	return '<dl class="uk-description-list' . $class . '">' . do_shortcode( $content ) . '</dl>';
} }
add_shortcode( 'define', 'cyon_define' );

if( !function_exists( 'cyon_define_li' ) ){
function cyon_define_li( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'class'		=> ''
		), $atts);

		$content = explode( ' | ', $content );

		// Class names
		$class = '';
		if( $atts[ 'class' ] != '' ) {
			$class .= ' class="' . $atts[ 'class' ] . '"';
		}
		
	return '<dt' . $class . '>' . do_shortcode( $content[0] ) . '</dt><dd>' . do_shortcode( $content[1] ) . '</dd>';
} }
add_shortcode( 'term', 'cyon_define_li' );


/* =Map
----------------------------------------------- */
if( !function_exists( 'cyon_map' ) ){
function cyon_map( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'width'		=> '',
			'height'	=> '350px',
			'zoom'		=> '14',
			'lat'		=> '',
			'long'		=> '',
			'address'	=> 'New York, USA',
			'class'		=> ''
		), $atts);
	ob_start();
		wp_enqueue_script('gmap');
	ob_get_clean();
	return '<div class="gmap" data-address="' . $atts['address'] . '" data-lat="' . $atts['lat'] . '" data-long="' . $atts['long'] . '" data-zoom="' . $atts['zoom'] . '" style="max-width: ' . $atts['width'] . '; height: ' . $atts['height'] . ';">' . $content . '</div>';
} }
add_shortcode( 'map', 'cyon_map' ); 


/* =Iframe
----------------------------------------------- */
if( !function_exists( 'cyon_iframe' ) ){
function cyon_iframe( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'width'		=> '500',
			'height'	=> '350',
			'scroll'	=> '1',
			'url'		=> 'http://lipsum.com/',
			'class'		=> ''
		), $atts);

		// Parameter
		$params = '';
		if( $atts[ 'class' ] != '' ) {
			$params .= ' class="' . $atts[ 'class' ] . '"';
		}
		if( $atts[ 'scroll' ] == 1 ) {
			$params .= ' scrolling="yes"';
		}

	return '<div style="width:' . $atts['width'] . 'px; max-width:100%; height:' . $atts['height'] . 'px; overflow:visible;"><iframe style="max-width:100%;" width="' . $atts['width'] . '" height="' . $atts['height'] . '" frameborder="0" marginheight="0" marginwidth="0" src="' . $atts['url'] . '"' . $params . '></iframe></div>';
} }
add_shortcode( 'iframe', 'cyon_iframe' ); 



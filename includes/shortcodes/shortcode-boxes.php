<?php

/* =Alert
----------------------------------------------- */
if( !function_exists( 'cyon_alert' ) ){
function cyon_alert( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'color'		=> '',
			'large'		=> '',
			'close'		=> '',
			'class'		=> ''
		), $atts);

		// Content
		if( $atts[ 'close' ] != '' ) {
			$content = '<a href="" class="uk-alert-close uk-close"></a>' . $content;
		}

		// Class names
		$class = 'uk-alert';
		if( $atts[ 'color' ] == 'success' || $atts[ 'color' ] == 'warning' || $atts[ 'color' ] == 'danger' ) {
			$class .= ' uk-alert-' . $atts[ 'color' ];
		}
		if( $atts[ 'large' ] == 1 ) {
			$class .= ' uk-alert-large';
		}
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}
		
	return '<div class="' . $class . '" data-uk-alert>' . do_shortcode( $content ) . '</div>';
} }
add_shortcode( 'alert', 'cyon_alert' ); 



/* =Progress Bar
----------------------------------------------- */
if( !function_exists( 'cyon_bar' ) ){
function cyon_bar( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'width'		=> '100%',
			'size'		=> '',
			'color'		=> '',
			'stripe'	=> '',
			'active'	=> '',
			'icon'		=> '',
			'class'		=> ''
		), $atts);

		// Class names
		$class = 'uk-progress';
		$style = '';
		if( $atts[ 'size' ] == 'mini' || $atts[ 'size' ] == 'small' ) {
			$class .= ' uk-progress-' . $atts[ 'size' ];
		}
		if( $atts[ 'color' ] != '' ) {
			if( $atts[ 'color' ] == 'success' || $atts[ 'color' ] == 'warning' || $atts[ 'color' ] == 'danger' ) {
				$class .= ' uk-progress-' . $atts[ 'color' ];
			}else{
				$style .= ' background-color:' . $atts[ 'color' ] . ';';
			}
		}
		if( $atts[ 'stripe' ] == 1 ) {
			$class .= ' uk-progress-striped';
		}
		if( $atts[ 'active' ] == 1 ) {
			$class .= ' uk-active';
		}
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}
		
		// Icon
		$icon = '';
		if( $atts[ 'icon' ] != '' ) {
			$icon .= '<i class="uk-icon-' . $atts[ 'icon' ] . '"></i> ';
		}

	return '<div class="' . $class . '"><div class="uk-progress-bar" style="width: ' . $atts[ 'width' ] . ';' . $style . '"><span class="progress-text">' . $icon . do_shortcode( $content ) . '</span></div></div>';
} }
add_shortcode( 'bar', 'cyon_bar' ); 



/* =Panels
----------------------------------------------- */
if( !function_exists( 'cyon_panel' ) ){
function cyon_panel( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'title' 		=> '',
			'icon'	 		=> '',
			'badge'	 		=> '',
			'badge_type'	=> '',
			'box'			=> '',
			'box_type'		=> '',
			'ani'			=> '',
			'ani_repeat'	=> '',
			'ani_delay'		=> '',
			'class'			=> ''
		), $atts);

		// Content
		if( $atts['title'] != '' ) {
			$icon = '';
			if( $atts['icon'] != '' ) {
				$icon .= '<i class="uk-icon-' . $atts['icon'] . '"></i> ';
			}
			$content = '<h3 class="uk-panel-title">' . $icon . $atts['title'] . '</h3>' . $content;
		}
		if( $atts['badge'] != '' ) {
			$badge = '';
			if( $atts['badge_type'] == 'success' || $atts['badge_type'] == 'warning' || $atts['badge_type'] == 'danger' ) {
				$badge .= ' uk-badge-' . $atts['badge_type'];
			}
			$content = '<div class="uk-panel-badge uk-badge' . $badge . '">' . $atts['badge'] . '</div>' . $content;
		}

		// Class names
		$params = ' class="uk-panel';
		if( $atts['box'] == 1 ) {
			$params .= ' uk-panel-box';
		}
		if( $atts['box_type'] == 'primary' || $atts['box_type'] == 'secondary' ) {
			$params .= ' uk-panel-box uk-panel-box-' . $atts['box_type'];
		}
		if( $atts['box_type'] == 'header' || $atts['box_type'] == 'space' || $atts['box_type'] == 'divider' ) {
			$params .= ' uk-panel-' . $atts['box_type'];
		}
		if( $atts[ 'class' ] != '' ) {
			$params .= ' ' . $atts[ 'class' ];
		}
		$params .= '"';
		
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

	return '<div' . $params . '>' . do_shortcode( $content ) . '</div>';
} }
add_shortcode( 'panel', 'cyon_panel' );


/* =Badge
----------------------------------------------- */
if( !function_exists( 'cyon_badge' ) ){
function cyon_badge( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'color'		=> '',
			'class'		=> ''
		), $atts);

		// Class names
		$class = 'uk-badge';
		if( $atts[ 'color' ] == 'success' || $atts[ 'color' ] == 'warning' || $atts[ 'color' ] == 'danger' ) {
			$class .= ' uk-badge-' . $atts[ 'color' ];
		}
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}
		
	return '<span class="' . $class . '">' . do_shortcode( $content ) . '</span>';
} }
add_shortcode( 'badge', 'cyon_badge' ); 
<?php

/* =Columns
The grid supports 2, 3, 4, 5, 6 and 10 unit divisions.
----------------------------------------------- */

// Global variable used in columns
$cyonShortCol = NULL;

if( !function_exists( 'cyon_columns' ) ){
function cyon_columns( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'border' 	=> 0,
			'class'		=> ''
		), $atts);

		// Matching variables
		global $cyonShortCol;
		$reg = get_shortcode_regex();
		preg_match_all( '~' . $reg . '~', $content, $matches );
		$cyonShortCol = count( $matches[0] );
		
		// Class names
		$class = '';
		if( $atts['border'] == 1 ) {
			$class .= ' uk-grid-divider';
		}
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}

	return '<div class="uk-grid' . $class . '" data-uk-grid-match data-uk-grid-margin>' . do_shortcode( $content ) . '</div>';
} }
add_shortcode( 'columns', 'cyon_columns' );

if( !function_exists( 'cyon_col' ) ){
function cyon_col( $atts, $content = null ) {

	// Extract attributes
	$atts = shortcode_atts(
		array(
			'width' 	=> 0,
			'class'		=> ''
		), $atts);

		// Matching variables
		global $cyonShortCol;

		// Class names
		$class = $atts['width'] != '' ? $atts['width'] : '1-' . $cyonShortCol;
		if( $atts[ 'class' ] != '' ) {
			$class .= ' ' . $atts[ 'class' ];
		}

	return '<div class="uk-width-medium-' . $class . '">' . do_shortcode( $content ) . '</div>';
} }
add_shortcode( 'col', 'cyon_col' );

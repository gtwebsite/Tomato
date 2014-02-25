<?php

/* =Sitemap
use [sitemap]
----------------------------------------------- */
if( !function_exists( 'cyon_sitemap' ) ){
function cyon_sitemap( $atts, $content = null ) {
	$html = '<div class="cyon-sitemap uk-grid">';
	$locations = get_nav_menu_locations();
	$footer_id = wp_get_nav_menu_object( $locations['footer-nav'] );
	$footer_items = wp_get_nav_menu_items( $footer_id->term_id );
	$header_id = wp_get_nav_menu_object( $locations['main-nav'] );
	$header_items = wp_get_nav_menu_items( $header_id->term_id );
	$html .= '<div class="uk-width-medium-1-3">';
			if($header_id->term_id!=''){
				$html .= '<h3>' . __( 'Main Menu', 'cyon' ) . ':</h3>' . wp_nav_menu( array( 'menu' => $header_id->term_id, 'container' => '', 'echo' => false ) );
			}else{
				$html .= '<h3>' . __( 'Pages', 'cyon' ) . ':</h3><ul class="menu">' . wp_list_pages( array( 'title_li' => '' , 'echo' => false ) ) . '</ul>';
			}
			if( $footer_id->term_id != '' && $header_id->term_id != '' ){
				$html .= '<h3>' . __( 'Footer Menu' , 'cyon' ) . ':</h3><ul class="menu">';
				foreach ( (array) $footer_items as $key => $footer_item ) {
					$html .= '<li><a href="' . $footer_item->url . '" title="' . $footer_item->title . '">' . $footer_item->title . '</a></li>';
				}
				$html .= '</ul>';
			}
	$html .= '</div><div class="uk-width-medium-1-3">
				<h3>' .__( 'Blog Categories', 'cyon' ) . ':</h3><ul class="menu">' . wp_list_categories( array( 'show_count' => 1, 'echo' => false, 'title_li' => '', 'feed' => __( 'feed', 'cyon' ) ) ) . '</ul>
				<h3>' .__( 'Blog Archives', 'cyon' ) . ':</h3><ul class="menu">' . wp_get_archives( array( 'show_post_count' => true, 'echo' => false ) ).'</ul>';
			if( class_exists( 'Woocommerce' ) ) {
				$html .= '<h3>' . __( 'Product Categories', 'cyon' ) . ':</h3><ul class="menu">' . wp_list_categories( array( 'show_count' => 1, 'echo' => false, 'taxonomy' => 'product_cat' , 'title_li' => '', 'feed' => _( 'feed', 'cyon' ) ) ) . '</ul>';
			}
			
	$recent_posts = wp_get_recent_posts( array( 'numberposts' => 50 )) ;
	$html .= '</div><div class="uk-width-medium-1-3">
				<h3>' . __( 'Blog Posts', 'cyon' ) . ':</h3><ul class="menu">';
				foreach( $recent_posts as $recent ){
					$html .= '<li><a href="' . get_permalink( $recent['ID'] ) . '" title="' . esc_attr( $recent['post_title'] ) . '">' . $recent['post_title'] . '</a></li>';
				}
	$html .= '</ul></div></div>';
	return $html;
} }
add_shortcode( 'sitemap', 'cyon_sitemap' ); 

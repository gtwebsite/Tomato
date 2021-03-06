<?php

/* =Gallery custom
Override default gallery code
----------------------------------------------- */
if(!function_exists('cyon_post_gallery')){
function cyon_post_gallery( $blank = NULL, $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'div',
		'icontag'    => 'div',
		'captiontag' => 'figcaption',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery'));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'div';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'figcaption';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'div';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$thumb_url = wp_get_attachment_image_src( $id, $size, false );
		if ( ! empty( $link ) && 'file' === $link ) {
			//$image_output = wp_get_attachment_link( $id, $size, false, false );
			$image_url = wp_get_attachment_image_src( $id, 'large', false );
			$image_output = '<a href="' . $image_url[0] . '" class="fancybox" rel="fancybox-{$id}" title="' . wptexturize($attachment->post_excerpt) . '"><img src="' . CYON_IMAGES_DIR . 'blank.png" data-original="' . $thumb_url[0] . '" alt="" class="lazyload" width="' . $thumb_url[1] . '" height="' . $thumb_url[2] . '" /><div class="uk-overlay-area"></div></a>';
		} elseif ( ! empty( $link ) && 'none' === $link ) {
			//$image_output = wp_get_attachment_image( $id, $size, false );
			$image_output = '<img src="' . CYON_IMAGES_DIR . 'blank.png" data-original="' . $thumb_url[0] . '" alt="" class="lazyload" width="' . $thumb_url[1] . '" height="' . $thumb_url[2] . '" />';
		} else {
			//$image_output = wp_get_attachment_link( $id, $size, true, false );
			$image_output = '<a href="' . get_attachment_link( $id ) . '"><img src="' . CYON_IMAGES_DIR . 'blank.png" data-original="' . $thumb_url[0] . '" alt="" class="lazyload" width="' . $thumb_url[1] . '" height="' . $thumb_url[2] . '" /><div class="uk-overlay-area"></div></a>';
		}
		
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) )
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

		$output .= "<{$itemtag} class='gallery-item'><figure class='uk-thumbnail uk-overlay-toggle'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation} uk-overlay'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</figure></{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
} }
add_filter( 'post_gallery', 'cyon_post_gallery', 10, 2);

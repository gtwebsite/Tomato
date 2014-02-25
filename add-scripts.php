<?php
header("Content-type: application/javascript;");

/* =jQuery loaders
----------------------------------------------- */

// Load WP variables
$current_url = dirname(__FILE__);
$wp_content_pos = strpos($current_url, 'wp-content');
$wp_content = substr($current_url, 0, $wp_content_pos);
require_once($wp_content . 'wp-load.php');

global $smof_data;

?>
if (typeof jQuery == 'undefined') {  
	document.write( '<?php echo __( 'Javascript is not running. This website requires javascript, please turn it on.', 'cyon' ); ?>' );
}

jQuery(document).ready(function() {

	jQuery( '#page-wrapper' ).css( 'opacity', 1 );

	// Lazy Load Support
	jQuery('img.lazyload').show().lazyload({ 
		effect : 'fadeIn',
		skip_invisible : false,
		failure_limit : 100
	});

<?php if( $smof_data['background_style_pattern_repeat'] == 'full' && $smof_data['background_style_image'] != '' && $smof_data['background_preset'] == 'bg-00.png' ){ ?>
	// Supersized Support
	jQuery.supersized({ 
		slides  :  	[ {image : '<?php echo $smof_data['background_style_image']; ?>', title : ''} ]
	});
<?php } ?>	

<?php if ( is_active_widget( false, false, 'search', true ) ) { ?>
	// Search sidebar
	jQuery('.widget_search form').addClass('uk-form').find('input[type=text]').attr('placeholder','<?php _e( 'Search entire site...', 'cyon' ) ?>').parent().find('input[type=submit]').addClass('uk-button uk-button-primary').val('<?php _e( 'Go', 'cyon' ) ?>');
<?php } ?>	

<?php if ( is_active_widget( false, false, 'categories', true ) ) { ?>
	// Categories sidebar
	jQuery('.widget_categories').addClass('uk-form').find('select').addClass('uk-width-1-1');
<?php } ?>	

	// Pagination
	jQuery('article .uk-pagination li').each(function(){
		if( !jQuery(this).find('a').length && !jQuery(this).find('span').length ){
			jQuery(this).addClass('uk-active').wrapInner('<span></span>');
		}
	});

<?php if( $smof_data['fancybox'] == 1 ) { ?>
	// Fancybox
	jQuery('.fancybox').fancybox({
		padding		: 0,
		helpers		: {
			title		: { type : 'over' }
		}
	});
<?php } ?>	

<?php if( $smof_data['footer_newsletter'] == 1 ) { ?>
	// Newsletter
	jQuery( '#newsletter form, .offline footer form' ).each(function(){
		jQuery(this).submit(function(e){
			var email = new RegExp(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
			if( !jQuery(this).find( 'input[type=email]' ).val().match(email) ) {
				jQuery(this).find( 'input[type=email]' ).addClass( 'uk-form-danger' );
			} else {
				var email = jQuery(this).find( 'input[type=email]' ).val();
				var nonce = jQuery(this).find( 'input.nonce' ).val();
				var data = {
					action: 'cyon_form_submit',
					nonce: nonce,
					name: name
				};
				jQuery(this).addClass( 'form-sending' );
				jQuery.ajax({
					url		: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
					type	: 'POST',
					data	: data,
					success	: function( results ) {
						jQuery( '#newsletter form' ).removeClass( 'form-sending' );
						if( results == 1 ){
							jQuery( '#newsletter input[type=email]' ).removeClass( 'uk-form-danger' );
							jQuery( '#newsletter input[type=email]' ).val('');
							jQuery( '#newsletter fieldset' ).hide();
							jQuery( '#newsletter form' ).append( '<div class="uk-alert uk-alert-success" style="display:none"><?php _e( 'Thank you for subscribing', 'cyon' ); ?></div>' );
							jQuery( '#newsletter .uk-alert' ).fadeIn();
						}else{
							jQuery( '#newsletter input[type=email]' ).addClass( 'uk-form-danger' );
						}
					}
				});
			}
			e.preventDefault ? e.preventDefault() : e.returnValue = false;
		});
	});
<?php } ?>	

});

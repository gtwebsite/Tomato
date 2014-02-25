<?php
if ( !defined('ABSPATH') )
	die('-1');

?>
<div id="comments"><?php echo PRIMARY_BEGIN; ?>

	<?php if ( post_password_required() ) { ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'cyon' ); ?></p>
		<?php echo PRIMARY_END; ?></div>
	<?php return; }	?>

	<?php if ( have_comments() ) { ?>
		<h3 class="tm-article-subtitle">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'cyon' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>
	
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'cyon' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cyon' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cyon' ) ); ?></div>
		</nav>
		<?php } ?>

		<ol class="uk-comment-list">
			<?php wp_list_comments( array( 'callback' => 'cyon_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'cyon' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cyon' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cyon' ) ); ?></div>
		</nav>
		<?php } ?>

	<?php }
	
	if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="nocomments uk-alert"><?php _e( 'Comments are closed.', 'cyon' ); ?></p>
	<?php } ?>

	<?php
	
	$args = array (
		'comment_field' =>  '<div class="uk-form-row"><label for="comment" class="uk-form-label">' . __( 'Comment', 'cyon' ) .
    						'</label><div class="uk-form-controls"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
    						'</textarea></div></div>',
		'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' =>
						'<div class="uk-form-row">' .
						'<label for="author" class="uk-form-label">' . __( 'Name', 'cyon' ) . '</label><div class="uk-form-controls">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30" /></div></div>',
					
					'email' =>
						'<div class="uk-form-row"><label for="email" class="uk-form-label">' . __( 'Email', 'cyon' ) . '</label><div class="uk-form-controls">' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30" /></div></div>',
					
					'url' =>
						'<div class="uk-form-row"><label for="url" class="uk-form-label">' .
						__( 'Website', 'cyon' ) . '</label><div class="uk-form-controls">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
						'" size="30" /></div></div>'
		))
	);
	
	comment_form( $args ); ?>

	<script type="application/javascript">
		jQuery(document).ready(function() {
			jQuery('#commentform').each(function() {
				jQuery(this).addClass('uk-form uk-form-stacked').find('.form-submit input').addClass('uk-button uk-button-primary');
				jQuery(this).submit(function(e){
					<?php if( !is_user_logged_in() ){ ?>
					var email = new RegExp(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
					if( !jQuery(this).find( '#email' ).val().match(email) ) {
						jQuery(this).find( '#email' ).addClass( 'uk-form-danger' );
						e.preventDefault ? e.preventDefault() : e.returnValue = false;
					}else{
						jQuery(this).find( '#email' ).removeClass( 'uk-form-danger' );
					}
					if( jQuery(this).find( '#author' ).val() == '' ) {
						jQuery(this).find( '#author' ).addClass( 'uk-form-danger' );
						e.preventDefault ? e.preventDefault() : e.returnValue = false;
					}else{
						jQuery(this).find( '#author' ).removeClass( 'uk-form-danger' );
					}
					<?php } ?>
					if( jQuery(this).find( '#comment' ).val() == '' ) {
						jQuery(this).find( '#comment' ).addClass( 'uk-form-danger' );
						e.preventDefault ? e.preventDefault() : e.returnValue = false;
					}else{
						jQuery(this).find( '#comment' ).removeClass( 'uk-form-danger' );
					}
				});
			});
		});
	</script>

<?php echo PRIMARY_END; ?></div>
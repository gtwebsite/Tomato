<?php

/* =Thickbox for admin selection. Used in shortcodes primarily.
----------------------------------------------- */

// Load WP variables
$current_url = dirname(__FILE__);
$wp_content_pos = strpos($current_url, 'wp-content');
$wp_content = substr($current_url, 0, $wp_content_pos);
require_once($wp_content . 'wp-load.php');

// Get all includes
$includes = array();
if( isset( $_GET['includes'] ) ) {
	$includes = explode( ',' , $_GET['includes'] );
}

$ico_web = array('adjust' => 'adjust', 'anchor' => 'anchor', 'archive' => 'archive', 'arrows' => 'arrows', 'arrows-h' => 'arrows-h', 'arrows-v' => 'arrows-v', 'asterisk' => 'asterisk', 'ban' => 'ban', 'bar-chart-o' => 'bar-chart-o', 'barcode' => 'barcode', 'bars' => 'bars', 'beer' => 'beer', 'bell' => 'bell', 'bell-o' => 'bell-o', 'bolt' => 'bolt', 'book' => 'book', 'bookmark' => 'bookmark', 'bookmark-o' => 'bookmark-o', 'briefcase' => 'briefcase', 'bug' => 'bug', 'building-o' => 'building-o', 'bullhorn' => 'bullhorn', 'bullseye' => 'bullseye', 'calendar' => 'calendar', 'calendar-o' => 'calendar-o', 'camera' => 'camera', 'camera-retro' => 'camera-retro', 'caret-square-o-down' => 'caret-square-o-down', 'caret-square-o-left' => 'caret-square-o-left', 'caret-square-o-right' => 'caret-square-o-right', 'caret-square-o-up' => 'caret-square-o-up', 'certificate' => 'certificate', 'check' => 'check', 'check-circle' => 'check-circle', 'check-circle-o' => 'check-circle-o', 'check-square' => 'check-square', 'check-square-o' => 'check-square-o', 'circle' => 'circle', 'circle-o' => 'circle-o', 'clock-o' => 'clock-o', 'cloud' => 'cloud', 'cloud-download' => 'cloud-download', 'cloud-upload' => 'cloud-upload', 'code' => 'code', 'code-fork' => 'code-fork', 'coffee' => 'coffee', 'cog' => 'cog', 'cogs' => 'cogs', 'comment' => 'comment', 'comment-o' => 'comment-o', 'comments' => 'comments', 'comments-o' => 'comments-o', 'compass' => 'compass', 'credit-card' => 'credit-card', 'crop' => 'crop', 'crosshairs' => 'crosshairs', 'cutlery' => 'cutlery', 'dashboard' => 'dashboard <span class="uk-text-muted">(alias)</span>', 'desktop' => 'desktop', 'dot-circle-o' => 'dot-circle-o', 'download' => 'download', 'edit' => 'edit <span class="uk-text-muted">(alias)</span>', 'ellipsis-h' => 'ellipsis-h', 'ellipsis-v' => 'ellipsis-v', 'envelope' => 'envelope', 'envelope-o' => 'envelope-o', 'eraser' => 'eraser', 'exchange' => 'exchange', 'exclamation' => 'exclamation', 'exclamation-circle' => 'exclamation-circle', 'exclamation-triangle' => 'exclamation-triangle', 'external-link' => 'external-link', 'external-link-square' => 'external-link-square', 'eye' => 'eye', 'eye-slash' => 'eye-slash', 'female' => 'female', 'fighter-jet' => 'fighter-jet', 'film' => 'film', 'filter' => 'filter', 'fire' => 'fire', 'fire-extinguisher' => 'fire-extinguisher', 'flag' => 'flag', 'flag-checkered' => 'flag-checkered', 'flag-o' => 'flag-o', 'flash' => 'flash <span class="uk-text-muted">(alias)</span>', 'flask' => 'flask', 'folder' => 'folder', 'folder-o' => 'folder-o', 'folder-open' => 'folder-open', 'folder-open-o' => 'folder-open-o', 'frown-o' => 'frown-o', 'gamepad' => 'gamepad', 'gavel' => 'gavel', 'gear' => 'gear <span class="uk-text-muted">(alias)</span>', 'gears' => 'gears <span class="uk-text-muted">(alias)</span>', 'gift' => 'gift', 'glass' => 'glass', 'globe' => 'globe', 'group' => 'group <span class="uk-text-muted">(alias)</span>', 'hdd-o' => 'hdd-o', 'headphones' => 'headphones', 'heart' => 'heart', 'heart-o' => 'heart-o', 'home' => 'home', 'inbox' => 'inbox', 'info' => 'info', 'info-circle' => 'info-circle', 'key' => 'key', 'keyboard-o' => 'keyboard-o', 'laptop' => 'laptop', 'leaf' => 'leaf', 'legal' => 'legal <span class="uk-text-muted">(alias)</span>', 'lemon-o' => 'lemon-o', 'level-down' => 'level-down', 'level-up' => 'level-up', 'lightbulb-o' => 'lightbulb-o', 'location-arrow' => 'location-arrow', 'lock' => 'lock', 'magic' => 'magic', 'magnet' => 'magnet', 'mail-forward' => 'mail-forward <span class="uk-text-muted">(alias)</span>', 'mail-reply' => 'mail-reply <span class="uk-text-muted">(alias)</span>', 'mail-reply-all' => 'mail-reply-all', 'male' => 'male', 'map-marker' => 'map-marker', 'meh-o' => 'meh-o', 'microphone' => 'microphone', 'microphone-slash' => 'microphone-slash', 'minus' => 'minus', 'minus-circle' => 'minus-circle', 'minus-square' => 'minus-square', 'minus-square-o' => 'minus-square-o', 'mobile' => 'mobile', 'mobile-phone' => 'mobile-phone <span class="uk-text-muted">(alias)</span>', 'money' => 'money', 'moon-o' => 'moon-o', 'music' => 'music', 'pencil' => 'pencil', 'pencil-square' => 'pencil-square', 'pencil-square-o' => 'pencil-square-o', 'phone' => 'phone', 'phone-square' => 'phone-square', 'picture-o' => 'picture-o', 'plane' => 'plane', 'plus' => 'plus', 'plus-circle' => 'plus-circle', 'plus-square' => 'plus-square', 'plus-square-o' => 'plus-square-o', 'power-off' => 'power-off', 'print' => 'print', 'puzzle-piece' => 'puzzle-piece', 'qrcode">/i> qrcode', 'question' => 'question', 'question-circle' => 'question-circle', 'quote-left' => 'quote-left', 'quote-right' => 'quote-right', 'random' => 'random', 'refresh' => 'refresh', 'reply' => 'reply', 'reply-all' => 'reply-all', 'retweet' => 'retweet', 'road' => 'road', 'rocket' => 'rocket', 'rss' => 'rss', 'rss-square' => 'rss-square', 'search' => 'search', 'search-minus' => 'search-minus', 'search-plus' => 'search-plus', 'share' => 'share', 'share-square' => 'share-square', 'share-square-o' => 'share-square-o', 'shield' => 'shield', 'shopping-cart' => 'shopping-cart', 'sign-in' => 'sign-in', 'sign-out' => 'sign-out', 'signal' => 'signal', 'sitemap' => 'sitemap', 'smile-o' => 'smile-o', 'sort' => 'sort', 'sort-alpha-asc' => 'sort-alpha-asc', 'sort-alpha-desc' => 'sort-alpha-desc', 'sort-amount-asc' => 'sort-amount-asc', 'sort-amount-desc' => 'sort-amount-desc', 'sort-asc' => 'sort-asc', 'sort-desc' => 'sort-desc', 'sort-down' => 'sort-down <span class="uk-text-muted">(alias)</span>', 'sort-numeric-asc' => 'sort-numeric-asc', 'sort-numeric-desc' => 'sort-numeric-desc', 'sort-up' => 'sort-up <span class="uk-text-muted">(alias)</span>', 'spinner' => 'spinner', 'square' => 'square', 'square-o' => 'square-o', 'star' => 'star', 'star-half' => 'star-half', 'star-half-empty' => 'star-half-empty <span class="uk-text-muted">(alias)</span>', 'star-half-full' => 'star-half-full <span class="uk-text-muted">(alias)</span>', 'star-half-o' => 'star-half-o', 'star-o' => 'star-o', 'subscript' => 'subscript', 'suitcase' => 'suitcase', 'sun-o' => 'sun-o', 'superscript' => 'superscript', 'tablet' => 'tablet', 'tachometer' => 'tachometer', 'tag' => 'tag', 'tags' => 'tags', 'tasks' => 'tasks', 'terminal' => 'terminal', 'thumb-tack' => 'thumb-tack', 'thumbs-down' => 'thumbs-down', 'thumbs-o-down' => 'thumbs-o-down', 'thumbs-o-up' => 'thumbs-o-up', 'thumbs-up' => 'thumbs-up', 'ticket' => 'ticket', 'times' => 'times', 'times-circle' => 'times-circle', 'times-circle-o' => 'times-circle-o', 'tint' => 'tint', 'toggle-down' => 'toggle-down <span class="uk-text-muted">(alias)</span>', 'toggle-left' => 'toggle-left <span class="uk-text-muted">(alias)</span>', 'toggle-right' => 'toggle-right <span class="uk-text-muted">(alias)</span>', 'toggle-up' => 'toggle-up <span class="uk-text-muted">(alias)</span>', 'trash-o' => 'trash-o', 'trophy' => 'trophy', 'truck' => 'truck', 'umbrella' => 'umbrella', 'unlock' => 'unlock', 'unlock-alt' => 'unlock-alt', 'unsorted' => 'unsorted <span class="uk-text-muted">(alias)</span>', 'upload' => 'upload', 'user' => 'user', 'users' => 'users', 'video-camera' => 'video-camera', 'volume-down' => 'volume-down', 'volume-off' => 'volume-off', 'volume-up' => 'volume-up', 'warning' => 'warning <span class="uk-text-muted">(alias)</span>', 'wheelchair' => 'wheelchair', 'wrench' => 'wrench');

$ico_form = array('check-square' => 'check-square', 'check-square-o' => 'check-square-o', 'circle' => 'circle', 'circle-o' => 'circle-o', 'dot-circle-o' => 'dot-circle-o', 'minus-square' => 'minus-square', 'minus-square-o' => 'minus-square-o', 'plus-square' => 'plus-square', 'plus-square-o' => 'plus-square-o', 'square' => 'square', 'square-o' => 'square-o');

$ico_currency = array('bitcoin' => 'bitcoin <span class="uk-text-muted">(alias)</span>', 'btc' => 'btc', 'cny' => 'cny <span class="uk-text-muted">(alias)</span>', 'dollar' => 'dollar <span class="uk-text-muted">(alias)</span>', 'eur' => 'eur', 'euro' => 'euro <span class="uk-text-muted">(alias)</span>', 'gbp' => 'gbp', 'inr' => 'inr', 'jpy' => 'jpy', 'krw' => 'krw', 'money' => 'money', 'rmb' => 'rmb <span class="uk-text-muted">(alias)</span>', 'rouble' => 'rouble <span class="uk-text-muted">(alias)</span>', 'rub' => 'rub', 'ruble' => 'ruble <span class="uk-text-muted">(alias)</span>', 'rupee' => 'rupee <span class="uk-text-muted">(alias)</span>', 'try' => 'try', 'turkish-lira' => 'turkish-lira <span class="uk-text-muted">(alias)</span>', 'usd' => 'usd', 'won' => 'won <span class="uk-text-muted">(alias)</span>', 'yen' => 'yen <span class="uk-text-muted">(alias)</span>');

$ico_editor = array('align-center' => 'align-center', 'align-justify' => 'align-justify', 'align-left' => 'align-left', 'align-right' => 'align-right', 'bold' => 'bold', 'chain' => 'chain <span class="uk-text-muted">(alias)</span>', 'chain-broken' => 'chain-broken', 'clipboard' => 'clipboard', 'columns' => 'columns', 'copy' => 'copy <span class="uk-text-muted">(alias)</span>', 'cut' => 'cut <span class="uk-text-muted">(alias)</span>', 'dedent' => 'dedent <span class="uk-text-muted">(alias)</span>', 'eraser' => 'eraser', 'file' => 'file', 'file-o' => 'file-o', 'file-text' => 'file-text', 'file-text-o' => 'file-text-o', 'files-o' => 'files-o', 'floppy-o' => 'floppy-o', 'font' => 'font', 'indent' => 'indent', 'italic' => 'italic', 'link' => 'link', 'list' => 'list', 'list-alt' => 'list-alt', 'list-ol' => 'list-ol', 'list-ul' => 'list-ul', 'outdent' => 'outdent', 'paperclip' => 'paperclip', 'paste' => 'paste <span class="uk-text-muted">(alias)</span>', 'repeat' => 'repeat', 'rotate-left' => 'rotate-left <span class="uk-text-muted">(alias)</span>', 'rotate-right' => 'rotate-right <span class="uk-text-muted">(alias)</span>', 'save' => 'save <span class="uk-text-muted">(alias)</span>', 'scissors' => 'scissors', 'strikethrough' => 'strikethrough', 'table' => 'table', 'text-height' => 'text-height', 'text-width' => 'text-width', 'th' => 'th', 'th-large' => 'th-large', 'th-list' => 'th-list', 'underline' => 'underline', 'undo' => 'undo', 'unlink' => 'unlink <span class="uk-text-muted">(alias)</span>');

$ico_direct = array('angle-double-down' => 'angle-double-down', 'angle-double-left' => 'angle-double-left', 'angle-double-right' => 'angle-double-right', 'angle-double-up' => 'angle-double-up', 'angle-down' => 'angle-down', 'angle-left' => 'angle-left', 'angle-right' => 'angle-right', 'angle-up' => 'angle-up', 'arrow-circle-down' => 'arrow-circle-down', 'arrow-circle-left' => 'arrow-circle-left', 'arrow-circle-o-down' => 'arrow-circle-o-down', 'arrow-circle-o-left' => 'arrow-circle-o-left', 'arrow-circle-o-right' => 'arrow-circle-o-right', 'arrow-circle-o-up' => 'arrow-circle-o-up', 'arrow-circle-right' => 'arrow-circle-right', 'arrow-circle-up' => 'arrow-circle-up', 'arrow-down' => 'arrow-down', 'arrow-left' => 'arrow-left', 'arrow-right' => 'arrow-right', 'arrow-up' => 'arrow-up', 'arrows' => 'arrows', 'arrows-alt' => 'arrows-alt', 'arrows-h' => 'arrows-h', 'arrows-v' => 'arrows-v', 'caret-down' => 'caret-down', 'caret-left' => 'caret-left', 'caret-right' => 'caret-right', 'caret-square-o-down' => 'caret-square-o-down', 'caret-square-o-left' => 'caret-square-o-left', 'caret-square-o-right' => 'caret-square-o-right', 'caret-square-o-up' => 'caret-square-o-up', 'caret-up' => 'caret-up', 'chevron-circle-down' => 'chevron-circle-down', 'chevron-circle-left' => 'chevron-circle-left', 'chevron-circle-right' => 'chevron-circle-right', 'chevron-circle-up' => 'chevron-circle-up', 'chevron-down' => 'chevron-down', 'chevron-left' => 'chevron-left', 'chevron-right' => 'chevron-right', 'chevron-up' => 'chevron-up', 'hand-o-down' => 'hand-o-down', 'hand-o-left' => 'hand-o-left', 'hand-o-right' => 'hand-o-right', 'hand-o-up' => 'hand-o-up', 'long-arrow-down' => 'long-arrow-down', 'long-arrow-left' => 'long-arrow-left', 'long-arrow-right' => 'long-arrow-right', 'long-arrow-up' => 'long-arrow-up', 'toggle-down' => 'toggle-down <span class="text-muted">(alias)</span>', 'toggle-left' => 'toggle-left <span class="text-muted">(alias)</span>', 'toggle-right' => 'toggle-right <span class="text-muted">(alias)</span>', 'toggle-up' => 'toggle-up <span class="text-muted">(alias)</span>');

$ico_player = array('arrows-alt' => 'arrows-alt', 'backward' => 'backward', 'compress' => 'compress', 'eject' => 'eject', 'expand' => 'expand', 'fast-backward' => 'fast-backward', 'fast-forward' => 'fast-forward', 'forward' => 'forward', 'pause' => 'pause', 'play' => 'play', 'play-circle' => 'play-circle', 'play-circle-o' => 'play-circle-o', 'step-backward' => 'step-backward', 'step-forward' => 'step-forward', 'stop' => 'stop', 'youtube-play' => 'youtube-play');

$ico_brands = array('adn' => 'adn', 'android' => 'android', 'apple' => 'apple', 'bitbucket' => 'bitbucket', 'bitbucket-square' => 'bitbucket-square', 'bitcoin' => 'bitcoin <span class="text-muted">(alias)</span>', 'btc' => 'btc', 'css3' => 'css3', 'dribbble' => 'dribbble', 'dropbox' => 'dropbox', 'facebook' => 'facebook', 'facebook-square' => 'facebook-square', 'flickr' => 'flickr', 'foursquare' => 'foursquare', 'github' => 'github', 'github-alt' => 'github-alt', 'github-square' => 'github-square', 'gittip' => 'gittip', 'google-plus' => 'google-plus', 'google-plus-square' => 'google-plus-square', 'html5' => 'html5', 'instagram' => 'instagram', 'linkedin' => 'linkedin', 'linkedin-square' => 'linkedin-square', 'linux' => 'linux', 'maxcdn' => 'maxcdn', 'pagelines' => 'pagelines', 'pinterest' => 'pinterest', 'pinterest-square' => 'pinterest-square', 'renren' => 'renren', 'skype' => 'skype', 'stack-exchange' => 'stack-exchange', 'stack-overflow' => 'stack-overflow', 'trello' => 'trello', 'tumblr' => 'tumblr', 'tumblr-square' => 'tumblr-square', 'twitter' => 'twitter', 'twitter-square' => 'twitter-square', 'vimeo-square' => 'vimeo-square', 'vk' => 'vk', 'weibo' => 'weibo', 'windows' => 'windows', 'xing' => 'xing', 'xing-square' => 'xing-square', 'youtube' => 'youtube', 'youtube-play' => 'youtube-play', 'youtube-square' => 'youtube-square');

$ico_medical = array('ambulance' => 'ambulance', 'h-square' => 'h-square', 'hospital-o' => 'hospital-o', 'medkit' => 'medkit', 'plus-square' => 'plus-square', 'stethoscope' => 'stethoscope', 'user-md' => 'user-md', 'wheelchair' => 'wheelchair');

?>
<!DOCTYPE html>
<!--[if IE 6]><html id="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title>Shortcode Editor</title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/style-admin.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/style-uikit.css" />
	<script type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/jquery/jquery-migrate.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			<?php if( isset( $_GET['id'] ) ) { ?>
				jQuery('#icons').val( jQuery('#<?php echo $_GET['id']; ?>', top.document).val() );
				jQuery('#icon-view').addClass( 'uk-icon-' + jQuery('#<?php echo $_GET['id']; ?>', top.document).val() );
			<?php }?>
			jQuery('#icons').on('change',function(e){
				jQuery('#icon-view').attr( 'class', '' );
				jQuery('#icon-view').addClass( 'uk-icon-' + jQuery(this).val() );
			});
			jQuery('form button').on('click',function(e){
				<?php if( isset( $_GET['id'] ) ) { ?>
					jQuery('#<?php echo $_GET['id']; ?>', top.document).val( jQuery('#icons').val() );
				<?php }else{ ?>
					htmlcode = '[icon type="' + jQuery('#icons').val() +'"]';
					self.parent.send_to_editor(htmlcode);
				<?php } ?>
				self.parent.tb_remove();
				e.preventDefault();
			});
		});
	</script>
</head>

<body class="editor">
	<div id="page-wrapper" class="uk-container uk-container-center">
		<form class="uk-form">
		<?php if( in_array( 'icons', $includes ) ) { ?>
			<div class="uk-panel uk-panel-box uk-margin-top">
				<fieldset>
					<legend class="uk-panel-title"><?php _e( 'Icons' , 'cyon' ); ?></legend>
					<select id="icons" name="icons">
						<option value="">- <?php _e( 'Select icon' , 'cyon' ); ?> -</option>
						<optgroup label="<?php _e( 'Web Applications' , 'cyon' ); ?>">
							<?php foreach( $ico_web as $value => $label ) { ?>
							<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
							<?php } ?>
						</optgroup>
						<optgroup label="<?php _e( 'Form Control' , 'cyon' ); ?>">
							<?php foreach( $ico_form as $value => $label ) { ?>
							<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
							<?php } ?>
						</optgroup>
						<optgroup label="<?php _e( 'Currencies' , 'cyon' ); ?>">
							<?php foreach( $ico_currency as $value => $label ) { ?>
							<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
							<?php } ?>
						</optgroup>
						<optgroup label="<?php _e( 'Text Editor' , 'cyon' ); ?>">
							<?php foreach( $ico_editor as $value => $label ) { ?>
							<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
							<?php } ?>
						</optgroup>
						<optgroup label="<?php _e( 'Directional' , 'cyon' ); ?>">
							<?php foreach( $ico_direct as $value => $label ) { ?>
							<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
							<?php } ?>
						</optgroup>
						<optgroup label="<?php _e( 'Video Player' , 'cyon' ); ?>">
							<?php foreach( $ico_player as $value => $label ) { ?>
							<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
							<?php } ?>
						</optgroup>
						<optgroup label="<?php _e( 'Brands' , 'cyon' ); ?>">
							<?php foreach( $ico_brands as $value => $label ) { ?>
							<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
							<?php } ?>
						</optgroup>
						<optgroup label="<?php _e( 'Medical' , 'cyon' ); ?>">
							<?php foreach( $ico_medical as $value => $label ) { ?>
							<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
							<?php } ?>
						</optgroup>
					</select>
					<i id="icon-view"></i>
				</fieldset>
			</div>
		<?php } ?>
			<div class="uk-align-right uk-margin-top">
				<button class="uk-button" type="button"><?php _e( 'Insert' , 'cyon' ); ?></button>
			</div>
		</form>
	</div>
</body>
</html>
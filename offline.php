<?php global $smof_data;  ?>
<!DOCTYPE html>
<!--[if IE 6]><html id="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />

	<title><?php wp_title(''); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

</head>

<body class="offline">
	<div id="page-wrapper">
		<article id="page-block" class="uk-container-center uk-container uk-text-center">
			<header class="entry-header">
				<div class="brand-logo uk-vertical-align">
					<?php if( $smof_data['header_logo'] != '' ){ ?>
						<img src="<?php echo $smof_data['header_logo']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> logo" class="uk-vertical-align-middle" />
					<?php }else{ ?>
						<h1 class="uk-vertical-align-middle"><?php bloginfo( 'name' ); ?></h1>
					<?php } ?>
				</div>
				<h2 class="uk-h2"><?php echo $smof_data['offline_title']; ?></h2>
			</header>
			<div class="entry-content">
				<?php echo do_shortcode( $smof_data['offline_text'] ); ?>
			</div>
			<?php if ( $smof_data['offline_newsletter'] == 1 ) { ?>
			<footer>
				<form class="uk-form" method="post" action="">
					<fieldset>
						<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'cyon_form_nonce' ); ?>" />
						<input type="hidden" name="subject" value="<?php _e( 'Newsletter subscription from ' . get_bloginfo('name'), 'cyon' ) ?>" />
						<input type="email" placeholder="<?php _e( 'Your email address' , 'cyon' ); ?>" class="uk-form-large" />
						<button type="submit" class="uk-button uk-button-large uk-button-primary"><?php _e( 'Sign Up' , 'cyon' ); ?></button>
					</fieldset>
				</form>
			</footer>
			<?php } ?>
		</article>
	</div>
	<?php wp_footer(); ?>
</body>
</html>
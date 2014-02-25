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

<body <?php body_class(); ?>>
	<!-- Page wrapper -->
	<div id="page-wrapper">
	
		<?php if( $smof_data['header_search'] == 1 && !is_404() ){ ?>
		<!-- Search -->
		<div class="uk-container uk-container-center uk-text-center uk-visible-large search-form-header">
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="uk-search<?php echo isset($_GET['s']) ? ' search-open' : ''; ?>" role="search">
				<fieldset>
					<label for="s" class="assistive-text uk-hidden"><?php _e( 'Search' , 'cyon' ); ?></label>
					<input type="text" class="uk-search-field" name="s" autocomplete="off" placeholder="..." value="<?php echo isset( $_GET['s'] ) ? $_GET['s'] : ''; ?>" />
				</fieldset>
			</form>
		</div>
		<script type="application/javascript">
			jQuery(document).ready(function() {
				jQuery('.uk-search input[type=text]').focus(function() {
					jQuery(this).parents('form').addClass('search-open');
				});
				jQuery('.uk-search input[type=text]').blur(function() {
					if( jQuery(this).val() == '' ) {
						jQuery(this).parents('form').removeClass('search-open');
					}
				});
			});
		</script>
		<?php } ?>
		
		<!-- Page block -->
		<div id="page-block" class="uk-container-center page-layout-<?php echo $smof_data['page_width_stretch'] ?>">
		
			<!-- Header -->
			<header id="branding" role="banner">
	
				<!-- Screen Readers -->
				<ul class="skip-link uk-hidden">
					<li><a href="#primary" title="<?php _e( 'Skip to primary content', 'cyon' ); ?>"><?php _e( 'Skip to primary content', 'cyon' ); ?></a></li>
					<li><a href="#secondary" title="<?php _e( 'Skip to secondary content', 'cyon' ); ?>"><?php _e( 'Skip to secondary content', 'cyon' ); ?></a></li>
				</ul>
				
				<!-- Main Navigation -->
				<div class="<?php if( $smof_data['page_width_stretch'] == 1 ){ ?>uk-container <?php } ?>uk-container-center">

					<!-- Main Menu -->
					<nav id="access" class="uk-navbar" role="navigation">
						<h3 class="assistive-text uk-hidden"><?php _e( 'Main menu', 'cyon' ); ?></h3>
						
						<?php if( $smof_data['responsive'] == 1 ){ ?>
						<a href="#cyon-offcanvas" class="uk-navbar-toggle uk-hidden-large" data-uk-offcanvas=""></a>
						<?php } ?>
						
						<?php if( $smof_data['header_social'] == 1 ) { ?>
						<!-- Social -->
						<div id="social" class="uk-navbar-flip uk-hidden-small">
							<?php if( !empty( $smof_data['header_facebook'] ) ) { ?><a href="<?php echo esc_attr( $smof_data['header_facebook'] ); ?>" class="uk-icon-button uk-icon-facebook" title="<?php _e( 'Facebook', 'cyon' ) ?>" data-uk-tooltip></a><?php } ?>
							<?php if( !empty( $smof_data['header_twitter'] ) ) { ?><a href="<?php echo esc_attr( $smof_data['header_twitter'] ); ?>" class="uk-icon-button uk-icon-twitter" title="<?php _e( 'Twitter', 'cyon' ) ?>" data-uk-tooltip></a><?php } ?>
							<?php if( !empty( $smof_data['header_gplus'] ) ) { ?><a href="<?php echo esc_attr( $smof_data['header_gplus'] ); ?>" class="uk-icon-button uk-icon-google-plus" title="<?php _e( 'Google Plus', 'cyon' ) ?>" data-uk-tooltip></a><?php } ?>
							<?php if( !empty( $smof_data['header_email'] ) ) { ?><a href="mailto:<?php echo esc_attr( $smof_data['header_email'] ); ?>" class="uk-icon-button uk-icon-envelope" title="<?php _e( 'Email', 'cyon' ) ?>" data-uk-tooltip></a><?php } ?>
						</div>
						<?php } ?>
						
						<!-- Logo / Site Name -->
						<a class="uk-navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php if($smof_data['header_logo']!=''){ ?>
								<img src="<?php echo $smof_data['header_logo']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> logo" />
							<?php }else{ ?>
								<?php bloginfo( 'name' ); ?>
							<?php } ?>
						</a>
						
						<?php
						$locations = get_nav_menu_locations();
						$header_id = wp_get_nav_menu_object( $locations['main-nav'] );
						if( $header_id->term_id != '' ){
							wp_nav_menu( 
								array(
									'menu'			=> $header_id->term_id,
									'menu_class'	=> 'uk-navbar-nav uk-navbar-flip uk-visible-large'
								)
							); ?>
							<script type="application/javascript">
								jQuery(document).ready(function() {
									jQuery('#access .uk-navbar-nav > li.menu-item-has-children').attr('data-uk-dropdown','{}').find('> .sub-menu').wrap('<div class="uk-dropdown uk-dropdown-navbar"></div>').addClass('uk-nav uk-nav-navbar');
									jQuery('#access .uk-navbar-nav > li.current-menu-item, #access .uk-navbar-nav > li.current-menu-ancestor').addClass('uk-active');
								});
							</script>
						<?php }else{ ?>
							<ul class="uk-navbar-nav uk-navbar-flip uk-visible-large">
								<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
							</ul>
							<script type="application/javascript">
								jQuery(document).ready(function() {
									jQuery('#access .uk-navbar-nav > li.page_item_has_children').addClass('uk-parent').attr('data-uk-dropdown','{}').find('> .children').wrap('<div class="uk-dropdown uk-dropdown-navbar"></div>').addClass('uk-nav uk-nav-navbar');
									jQuery('#access .uk-navbar-nav > li.current-menu-item, #access .uk-navbar-nav > li.current-menu-ancestor').addClass('uk-active');
								});
							</script>
						<?php }	?>
					</nav>
					
				</div>
				
			</header>
			
			<?php cyon_breadcrumb(); ?>
	
			<!-- Body -->
			<div id="main">
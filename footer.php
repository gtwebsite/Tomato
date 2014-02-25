<?php global $smof_data;  ?>

				<?php if( $smof_data['footer_newsletter'] == 1 && !is_404() ) { ?>
				<!-- Newsletter -->
				<div class="uk-container uk-container-center" data-uk-scrollspy="{cls:'uk-animation-slide-bottom'}">
					<div id="newsletter">
						<section class="uk-grid" data-uk-grid-margin>
							<div class="uk-width-medium-1-2 uk-grid-margin description">
								<h2 class="uk-h2"><?php echo $smof_data['footer_newsletter_title']; ?></h2>
								<p><?php echo $smof_data['footer_newsletter_description']; ?></p>
							</div>
							<form class="uk-width-medium-1-2 uk-grid-margin uk-form uk-text-right" method="post" action="">
								<fieldset>
									<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'cyon_form_nonce' ); ?>" />
									<input type="hidden" name="subject" value="<?php _e( 'Newsletter subscription from ' . get_bloginfo('name'), 'cyon' ) ?>" />
									<input type="email" placeholder="<?php _e( 'Your email address' , 'cyon' ); ?>" class="uk-form-large" />
									<button type="submit" class="uk-button uk-button-large uk-button-primary"><?php _e( 'Sign Up' , 'cyon' ); ?></button>
								</fieldset>
							</form>
						</section>
					</div>
				</div>
				<?php } ?>

			</div><!-- #main -->
			
			<!-- Footer -->
			<footer id="colophon" role="contentinfo">
				
				<?php if ( is_active_sidebar( 'footer-columns' ) && !is_404() ) { ?>
				<!-- Footer Buckets -->
				<div id="footer-buckets" role="complementary">
					<div class="uk-container uk-container-center">
						<section class="uk-grid" data-uk-grid-margin data-uk-grid-match>
							<?php dynamic_sidebar( 'footer-columns' ); ?>
						</section>
					</div>
				</div>
				<?php } ?>

				<!-- Footer Navigation -->
				<div id="footer-nav">
					<div class="uk-container uk-container-center">
						<section class="uk-grid">
					
							<!-- Copyright -->
							<div id="copyright" class="uk-width-medium-1-2">
								<?php echo $smof_data['footer_copyright']; ?>
							</div>
							
							<!-- Footer Navigation -->
							<?php wp_nav_menu( array( 'theme_location' => 'footer-nav', 'depth' => '1', 'container_id' => 'access2', 'container_class' => 'uk-width-medium-1-2', 'menu_class' => 'uk-subnav uk-navbar-flip', 'link_before' => '<i class="uk-icon-stop"></i>', 'fallback_cb' => false ) ); ?>
						
						</section>
					</div>
				</div>
			
			</footer>
	
		</div><!-- .page-block -->
		
		<?php if( $smof_data['footer_backtotop'] == 1 && !is_404() ){ ?>
		<div class="uk-container uk-container-center uk-text-center" id="backtotop">
			<a href="#page-wrapper" class="uk-icon-angle-double-up" data-uk-smooth-scroll data-uk-tooltip title="<?php _e( 'Back to top' , 'cyon' ); ?>"></a>
		</div>
		<?php } ?>
		
	</div><!-- #page-wrapper -->
	
	<?php if( $smof_data['responsive'] == 1 ){ ?>
	<div id="cyon-offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar">
			<div class="search-form-footer">
				<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="uk-search<?php echo isset($_GET['s']) ? ' search-open' : ''; ?>" role="search">
					<fieldset>
						<label for="s" class="assistive-text uk-hidden"><?php _e( 'Search' , 'cyon' ); ?></label>
						<input type="text" class="uk-search-field" name="s" autocomplete="off" placeholder="..." value="<?php echo isset( $_GET['s'] ) ? $_GET['s'] : ''; ?>" />
					</fieldset>
				</form>
			</div>
		<?php
		$locations = get_nav_menu_locations();
		$header_id = wp_get_nav_menu_object( $locations['main-nav'] );
		if( $header_id->term_id != '' ){
			wp_nav_menu( 
				array(
					'menu'				=> $header_id->term_id,
					'menu_class'		=> 'uk-nav uk-nav-offcanvas'
				)
			); ?>
			<script type="application/javascript">
				jQuery(document).ready(function() {
					jQuery('#cyon-offcanvas > div > .uk-nav > li.menu-item-has-children').attr('data-uk-nav','{multiple:true}').find('> .sub-menu').addClass('uk-nav-navbar');
					jQuery('#cyon-offcanvas > div > .uk-nav li.current-menu-item, #cyon-offcanvas > div > .uk-nav > li.current-menu-ancestor').addClass('uk-active');
				});
			</script>
		<?php }else{ ?>

			<ul class="uk-nav uk-nav-offcanvas" data-uk-nav="{multiple:true}">
				<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
			</ul>
			<script type="application/javascript">
				jQuery(document).ready(function() {
					jQuery('#cyon-offcanvas > div > .uk-nav > li.page_item_has_children').addClass('uk-parent').attr('data-uk-nav','{multiple:true}').find('> .children').addClass('uk-nav-navbar');
					jQuery('#cyon-offcanvas > div > .uk-nav li.current-menu-item, #cyon-offcanvas > div > .uk-nav > li.current-menu-ancestor').addClass('uk-active');
				});
			</script>
			
		<?php }	?>

			<?php if( $smof_data['header_social'] == 1 ) { ?>
			<!-- Social -->
			<hr class="uk-article-divider" />
			<div id="social" class="uk-text-center uk-visible-small">
				<?php if( !empty( $smof_data['header_facebook'] ) ) { ?><a href="<?php echo esc_attr( $smof_data['header_facebook'] ); ?>" class="uk-icon-button uk-icon-facebook"></a><?php } ?>
				<?php if( !empty( $smof_data['header_twitter'] ) ) { ?><a href="<?php echo esc_attr( $smof_data['header_twitter'] ); ?>" class="uk-icon-button uk-icon-twitter"></a><?php } ?>
				<?php if( !empty( $smof_data['header_gplus'] ) ) { ?><a href="<?php echo esc_attr( $smof_data['header_gplus'] ); ?>" class="uk-icon-button uk-icon-google-plus"></a><?php } ?>
				<?php if( !empty( $smof_data['header_email'] ) ) { ?><a href="<?php echo esc_attr( $smof_data['header_email'] ); ?>" class="uk-icon-button uk-icon-envelope"></a><?php } ?>
			</div>
			<?php } ?>

		</div>
	</div>
	<?php } ?>
	
<?php wp_footer(); ?>

</body>
</html>
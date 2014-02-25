<?php
if ( !defined('ABSPATH') )
	die('-1');

if ( is_active_sidebar( 'sidebar-widgets' ) && SHOW_SIDEBAR ) { ?>
	<!-- Sidebar widgets -->
	<div id="secondary" class="sidebar-container <?php echo SECONDARY_CLASS; ?>" role="complementary">
		<div class="widget-area uk-grid" data-uk-grid-margin>
			<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
		</div>
	</div>
<?php } ?>
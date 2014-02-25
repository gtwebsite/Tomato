<?php
if ( !defined('ABSPATH') )
	die('-1');

get_header(); ?>

<div class="cyon-block">
	<section class="uk-grid" data-uk-grid-margin>

		<!-- Primary content -->
		<div id="primary" class="uk-width-medium-1-1">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<div class="uk-container uk-container-center uk-text-center uk-margin-top uk-margin-bottom">
							<div class="cyon-text">
								<div class="icon-header">
									<i class="uk-icon-exclamation-triangle"></i>
								</div>
								<h1 class="uk-article-title uk-heading-large"><?php _e( 'Nothing Found', 'cyon' ); ?></h1>
							</div>
						</div>
					</header>
				
					<div class="entry-content">
						<div class="uk-container uk-container-center uk-text-center">
						<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
							<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cyon' ), admin_url( 'post-new.php' ) ); ?></p>
						<?php } elseif ( is_search() ) { ?>
							<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'cyon' ); ?></p>
						<?php } else { ?>
							<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cyon' ); ?></p>
							<?php echo get_search_form(); ?>
						<?php } ?>
						</div>
					</div>
				
				</article>
			</div>
		</div>

	</section>
</div>

<?php get_footer(); ?>
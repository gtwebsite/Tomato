<?php
if ( !defined('ABSPATH') )
	die('-1');

global $smof_data;

get_header(); ?>

<div class="cyon-block"><?php echo BLOCK_BEGIN; ?>
	<section class="<?php echo SECTION_CLASS; ?>" data-uk-grid-margin data-uk-grid-match>

		<!-- Primary content -->
		<div id="primary" class="<?php echo PRIMARY_CLASS; ?>">
			<div id="content" role="main">
				
				<?php if ( have_posts() ) { ?>
	
					<!-- Category header -->
					<header class="blog-header">
						<?php echo PRIMARY_BEGIN; ?>
						<?php if( $smof_data['blog_layout'] != 1 && $smof_data['general_layout'] == 'general-1column' ) { ?>
						<div class="uk-container uk-container-center">
						<?php } ?>
						<h1 class="blog-title uk-h3">
							<?php printf( __( 'Search Results for: %s', 'cyon' ), '<span>' . get_search_query() . '</span>' ); ?>
						</h1>
						<?php if( $smof_data['blog_layout'] != 1 && $smof_data['general_layout'] == 'general-1column' ) { ?>
						</div>
						<?php } ?>
						<?php echo PRIMARY_END; ?>
					</header>
					<hr class="uk-article-divider" />
				
					<?php $row = 1; $items = 0;	?>
				
					<?php while ( have_posts() ) : the_post();  $items++; ?>
					
						<?php if( $row == 1 && $smof_data['blog_layout'] != 1 ){ ?>
							<?php if($smof_data['general_layout'] == 'general-1column'){ ?>
							<div class="uk-container uk-container-center">
							<?php } ?>
								<div class="uk-grid">
						<?php } ?>

						<?php if( $smof_data['blog_layout'] != 1 ) { ?>
							<div class="uk-width-medium-1-<?php echo $smof_data['blog_layout']; ?> uk-grid-margin">
						<?php } ?>

						<?php get_template_part( 'content', 'search' ); ?>

						<?php if( $smof_data['blog_layout'] != 1 ) { ?>
								<hr class="uk-article-divider uk-visible-small" />
							</div>
						<?php } ?>

						<?php if( $smof_data['blog_layout'] == 1 ){ ?>
							<hr class="uk-article-divider" />
						<?php } ?>
						
						<?php if( ( $row >= $smof_data['blog_layout'] || $items >= count($posts) ) && $smof_data['blog_layout'] != 1 ){ ?>
								</div>
							<?php if($smof_data['general_layout'] == 'general-1column'){ ?>
							</div>
							<?php } ?>
							<hr class="uk-article-divider uk-hidden-small" />
						<?php $row = 0; } ?>
						<?php $row++; ?>
		
					<?php endwhile; ?>

					<?php cyon_pagination(); ?>

				<?php } else { ?>
				
					<?php get_template_part( 'content', 'none' ); ?>
					
				<?php } ?>
			</div>
		</div>

<?php get_sidebar(); ?>

	</section><?php echo BLOCK_END; ?>
</div>

<?php get_footer(); ?>
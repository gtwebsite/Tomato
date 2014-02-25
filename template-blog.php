<?php
/**
 * Template Name: Blog Template
 * Description: A blog listing template
 *
 * @package WordPress
 * @subpackage Tamato
 */

if ( !defined('ABSPATH') )
	die('-1');

get_header();

global $smof_data;

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
if( $paged > 1 ) {
	$blogposts = new WP_Query( array( 'posts_per_page' => get_option('posts_per_page', true)-1, 'paged' => $paged, 'ignore_sticky_posts' => 1, 'post__not_in' => get_option('sticky_posts') ) ); 
}else{
	$blogposts = new WP_Query( array( 'posts_per_page' => get_option('posts_per_page', true)-1, 'paged' => $paged ) ); 
}

if( get_post_meta( $post->ID, 'cyon_layout' ,true ) == 'default' || !get_post_meta( $post->ID, 'cyon_layout', true ) ) {
	$layout = $smof_data['general_layout'];
}else{
	$layout = get_post_meta( $post->ID, 'cyon_layout' ,true );
}

?>

<div class="cyon-block"><?php echo BLOCK_BEGIN; ?>
	<section class="<?php echo SECTION_CLASS; ?>" data-uk-grid-margin data-uk-grid-match>

		<!-- Primary content -->
		<div id="primary" class="<?php echo PRIMARY_CLASS; ?>">
			<div id="content" role="main">
			
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<!-- Category header -->
						<header class="blog-header">
							<?php echo PRIMARY_BEGIN; ?>
							<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
							<div class="uk-container uk-container-center">
							<?php } ?>
							<h1 class="blog-title uk-h3"><?php the_title(); ?></h1>
							<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
							</div>
							<?php } ?>
							<?php echo PRIMARY_END; ?>
						</header>
						<?php if ( $paged == 1 ){ ?>
						<div class="blog-content uk-clearfix">
							<?php echo PRIMARY_BEGIN; ?>
							<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
							<div class="uk-container uk-container-center">
							<?php } ?>
							<?php the_content(); ?>
							<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
							</div>
							<?php } ?>
							<?php echo PRIMARY_END; ?>
						</div>
						<?php } ?>
						
						<hr class="uk-article-divider" />

						<?php if ( $blogposts->have_posts() ) : ?>
						
							<?php $row = 1; $items = 0;	?>
							
							<?php while ( $blogposts->have_posts() ) : $blogposts->the_post(); $items++; ?>
							
								<?php if( $row == 1 && cyon_get_list_layout() != 1 ){ ?>
									<?php if( $layout == 'general-1column' ){ ?>
									<div class="uk-container uk-container-center">
									<?php } ?>
										<div class="uk-grid">
								<?php } ?>
								
								<?php if( cyon_get_list_layout() != 1 ) { ?>
									<div class="uk-width-medium-1-<?php echo cyon_get_list_layout(); ?> uk-grid-margin">
								<?php } ?>

								<?php get_template_part( 'content', get_post_format() ); ?>

								<?php if( cyon_get_list_layout() != 1 ) { ?>
										<hr class="uk-article-divider uk-visible-small" />
									</div>
								<?php } ?>

								<?php if( cyon_get_list_layout() == 1 ){ ?>
									<hr class="uk-article-divider" />
								<?php } ?>
								
								<?php if( ( $row >= cyon_get_list_layout() || $items >= $blogposts->post_count ) && cyon_get_list_layout() != 1 ){ ?>
										</div>
									<?php if( $layout == 'general-1column' ){ ?>
									</div>
									<?php } ?>
									<hr class="uk-article-divider uk-hidden-small" />
								<?php $row = 0; } ?>
								<?php $row++; ?>

							<?php endwhile; ?>
							<?php if(function_exists( 'wp_pagenavi' )){	wp_pagenavi();	}else{ if ( $blogposts->max_num_pages > 1 ) { ?>
							<!-- Pagination -->
								<nav class="pagination uk-clearfix">
									<?php echo PRIMARY_BEGIN; ?>
									<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
									<div class="uk-container uk-container-center">
									<?php } ?>
									<h3 class="uk-hidden"><?php _e( 'Post navigation', 'cyon' ); ?></h3>
									<ul class="uk-pagination">
										<li class="uk-pagination-previous"><?php next_posts_link( __( '<span class="uk-icon-angle-double-left"></span> Older Posts', 'cyon' ), $blogposts->max_num_pages ); ?></li>
										<li class="uk-pagination-next"><?php previous_posts_link( __( 'Newer Posts <span class="uk-icon-angle-double-right"></span>', 'cyon' ) ); ?></li>
									</ul>
									<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
									</div>
									<?php } ?>
									<?php echo PRIMARY_END; ?>
								</nav>
							
							<?php } } ?>
							
						<?php else :  ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
						
						<?php wp_reset_postdata(); ?>
					<?php endwhile; ?>
				<?php } else { ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php } ?>
				
			</div>
		</div>

<?php get_sidebar(); ?>

	</section><?php echo BLOCK_END; ?>
</div>

<?php get_footer(); ?>
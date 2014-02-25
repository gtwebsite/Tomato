<?php
if ( !defined('ABSPATH') )
	die('-1');

global $smof_data;

$width = '488';
$height = '275';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_single() ) : ?>
	<div class="entry-thumbnail">
		<?php echo PRIMARY_BEGIN; ?>
		<?php
			$featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' ); 
			if( $featured_image_url[1] >= 488 ) {
				if ( $featured_image_url[2] >= 275 ) {
					$featured_final_url = aq_resize( $featured_image_url[0], $width, $height, true );
				}else{
					$featured_final_url = aq_resize( $featured_image_url[0], $width, '', true );
				}
			}else{
				$featured_final_url = $featured_image_url[0];
			}
			?>
			<a href="<?php echo $featured_image_url[0]; ?>" class="uk-thumbnail uk-overlay-toggle fancybox" rel="portfolio[]" title="<?php the_title(); ?>">
				<div class="uk-overlay">
					<img src="<?php echo CYON_IMAGES_DIR ?>blank.png" data-original="<?php echo $featured_final_url; ?>" class="lazyload" alt="<?php the_title(); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
					<noscript><img src="<?php echo $featured_final_url; ?>" alt="<?php the_title(); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></noscript>
					<div class="uk-overlay-area"></div>
				</div>
			</a>
		<?php echo PRIMARY_END; ?>
	</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php echo PRIMARY_BEGIN; ?>
		<?php if ( is_single() ) { ?>
			<?php the_title( '<h1 class="uk-article-title uk-heading-large">', '</h1>' ); ?>
		<?php }else{ ?>
			<?php the_title( '<h1 class="uk-article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
		<?php } ?>
		<?php echo PRIMARY_END; ?>
	</header>

	<div class="entry-content uk-clearfix">
		<?php echo PRIMARY_BEGIN; ?>
		<?php if ( is_single() ) { ?>
			<?php the_content(); ?>
			
			<?php wp_link_pages( array( 
						'before' 			=> '<ul class="uk-pagination"><li><span>' . __( 'Pages:', 'cyon' ) . '</span></li><li class="uk-hidden">',
						'after' 			=> '</li></ul>',
						'separator'			=> '</li><li>',
						'next_or_number' 	=> 'number'
					)); ?>
		
		<?php }else{ ?>
			<?php the_excerpt(); ?>
		<?php } ?>
		<?php echo PRIMARY_END; ?>
	</div>

	<footer class="entry-meta">
		<?php echo PRIMARY_BEGIN; ?>

		<?php if ( $smof_data['portfolio_readmore'] != '' && ! is_single() ) { ?>
		<p><a href="<?php the_permalink(); ?>" class="uk-button uk-button-primary readmore"><?php echo $smof_data['portfolio_readmore']; ?></a></p>
		<?php } ?>

		<?php edit_post_link( __( 'Edit', 'cyon' ), '<p class="edit-link">', '</p>' ); ?>
		<?php echo PRIMARY_END; ?>
	</footer>

</article>

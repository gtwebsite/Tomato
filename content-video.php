<?php
if ( !defined('ABSPATH') )
	die('-1');

global $smof_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php echo PRIMARY_BEGIN; ?>
		<?php if ( is_single() ) { ?>
			<?php the_title( '<h1 class="uk-article-title uk-heading-large">', '</h1>' ); ?>
			<?php if( rwmb_meta( 'cyon_headline' ) != '' ){ ?>
			<p class="uk-article-lead"><?php echo rwmb_meta( 'cyon_headline' ); ?></p>
			<hr class="uk-article-divider">
			<?php } ?>
		<?php }else{ ?>
			<?php the_title( '<h1 class="uk-article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
		<?php } ?>
		<?php echo PRIMARY_END; ?>
	</header>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
	<div class="entry-thumbnail">
		<?php echo PRIMARY_BEGIN; ?>
		<?php if ( is_single() ) { ?>
			<?php the_post_thumbnail( 'large', array( 'class' => 'uk-thumbnail' ) ); ?>
		<?php }else{ ?>
			<?php $featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' );
			?>
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<img src="<?php echo CYON_IMAGES_DIR ?>blank.png" data-original="<?php echo $featured_image_url[0]; ?>" class="lazyload uk-thumbnail" alt="<?php the_title(); ?>" />
				<noscript><img src="<?php echo $featured_image_url[0]; ?>" alt="<?php the_title(); ?>"></noscript>
			</a>
		<?php } ?>
		<?php echo PRIMARY_END; ?>
	</div>
	<?php endif; ?>

	<div class="entry-content uk-clearfix">
		<?php echo PRIMARY_BEGIN; ?>
		<?php the_content(); ?>
		<?php if ( is_single() ) { ?>
			
			<?php wp_link_pages( array( 
						'before' 			=> '<ul class="uk-pagination"><li><span>' . __( 'Pages:', 'cyon' ) . '</span></li><li class="uk-hidden">',
						'after' 			=> '</li></ul>',
						'separator'			=> '</li><li>',
						'next_or_number' 	=> 'number'
					)); ?>
		
		<?php } ?>
		<?php echo PRIMARY_END; ?>
	</div>

	<footer class="entry-meta">
		<?php echo PRIMARY_BEGIN; ?>

		<?php cyon_post_header_meta(); ?>
		
		<?php if ( ( is_archive() || is_page_template() == 'template-blog.php' || is_search() ) && $smof_data['blog_excerpt_count'] > 0 && $smof_data['blog_readmore'] != '' ) { ?>
		<p><a href="<?php the_permalink(); ?>" class="uk-button uk-button-primary readmore"><?php echo $smof_data['blog_readmore']; ?></a></p>
		<?php } ?>

		<?php if( $smof_data['blog_meta'][1] == 1 && is_single() ) { ?>
		<!-- Author info -->
		<div class="entry-author">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), '68' ); ?>
			<div class="author-description">
				<h4 class="uk-h4"><?php printf( __( 'About %s', 'cyon' ), get_the_author() ); ?></h4>
				<p><?php the_author_meta( 'description' ); ?></p>
				<p><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php printf( __( 'View all posts by %s', 'cyon' ), get_the_author() ); ?>
				</a></p>
			</div>
		</div>
		<?php } ?>
		<?php edit_post_link( __( 'Edit', 'cyon' ), '<p class="edit-link">', '</p>' ); ?>
		<?php echo PRIMARY_END; ?>
	</footer>

</article>

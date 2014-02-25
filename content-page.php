<?php
if ( !defined('ABSPATH') )
	die('-1');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! has_post_thumbnail() ) : ?>
	<header class="entry-header">
		<?php echo PRIMARY_BEGIN; ?>
		<?php the_title( '<h1 class="uk-article-title uk-heading-large">', '</h1>' ); ?>

		<?php if( rwmb_meta( 'cyon_headline' ) != '' ){ ?>
		<p class="uk-article-lead"><?php echo rwmb_meta( 'cyon_headline' ); ?></p>
		<?php } ?>

		<?php echo PRIMARY_END; ?>
	</header>
	<?php endif; ?>

	<div class="entry-content uk-clearfix">
		<?php echo PRIMARY_BEGIN; ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 
					'before' 			=> '<ul class="uk-pagination"><li><span>' . __( 'Pages:', 'cyon' ) . '</span></li><li class="uk-hidden">',
					'after' 			=> '</li></ul>',
					'separator'			=> '</li><li>',
					'next_or_number' 	=> 'number'
				)); ?>

		<?php echo PRIMARY_END; ?>
	</div>

	<footer class="entry-meta">
		<?php echo PRIMARY_BEGIN; ?>
		<?php edit_post_link( __( 'Edit', 'cyon' ), '<span class="edit-link">', '</span>' ); ?>
		<?php echo PRIMARY_END; ?>
	</footer>
</article>

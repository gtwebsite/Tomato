<?php
if ( !defined('ABSPATH') )
	die('-1');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php echo PRIMARY_BEGIN; ?>
		<?php the_title( '<h1 class="uk-article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
		<?php echo PRIMARY_END; ?>
	</header>

	<div class="entry-content uk-clearfix">
		<?php echo PRIMARY_BEGIN; ?>
		<?php the_excerpt(); ?>
		<?php echo PRIMARY_END; ?>
	</div>

	<footer class="entry-meta">
		<?php echo PRIMARY_BEGIN; ?>
		<?php edit_post_link( __( 'Edit', 'cyon' ), '<p class="edit-link">', '</p>' ); ?>
		<?php echo PRIMARY_END; ?>
	</footer>

</article>
<?php
if ( !defined('ABSPATH') )
	die('-1');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php echo PRIMARY_BEGIN; ?>
		<h1 class="uk-article-title uk-heading-large"><?php _e( 'Nothing Found', 'cyon' ); ?></h1>
		<?php echo PRIMARY_END; ?>
	</header>

	<div class="entry-content">
		<?php echo PRIMARY_BEGIN; ?>
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cyon' ), admin_url( 'post-new.php' ) ); ?></p>
		<?php } elseif ( is_search() ) { ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'cyon' ); ?></p>
		<?php } else { ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cyon' ); ?></p>
		<?php } ?>
		<?php echo PRIMARY_END; ?>
	</div>

</article>

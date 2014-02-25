<?php
if ( !defined('ABSPATH') )
	die('-1');

get_header();
global $smof_data;

?>

<div class="cyon-block"><?php echo BLOCK_BEGIN; ?>
	<section class="<?php echo SECTION_CLASS; ?>" data-uk-grid-margin data-uk-grid-match>

		<!-- Primary content -->
		<div id="primary" class="<?php echo PRIMARY_CLASS; ?>">
			<div id="content" role="main">
			
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
							<?php if( $smof_data['blog_meta'][4] == 1 && ( comments_open() || get_comments_number() ) ) { ?>
								<?php comments_template( '', true ); ?>
							<?php } ?>
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
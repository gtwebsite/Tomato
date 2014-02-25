<?php
if ( !defined('ABSPATH') )
	die('-1');

get_header(); 

global $smof_data;

?>

<?php if ( have_posts() ) { ?>
	<?php while ( have_posts() ) : the_post(); ?>
			<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				<div class="page-thumbnail">
					<div class="headline"><?php echo BLOCK_BEGIN; ?>
						<h1 class="uk-article-title uk-heading-large"><?php the_title(); ?></h1>
						<?php if( rwmb_meta( 'cyon_headline' ) != '' ){ ?>
						<p class="uk-article-lead"><?php echo rwmb_meta( 'cyon_headline' ); ?></p>
						<?php } ?>
					<?php echo BLOCK_END; ?></div>
					<?php
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id() , 'large' );
						$large_image = aq_resize( $large_image_url[0], '1130', '350', true );
					?>
					<img src="<?php echo $large_image_url[0]; ?>" alt="" class="uk-hidden-small" />
					<?php if( $smof_data['responsive'] == 1 ){ ?>
						<?php
							$medium_image = aq_resize( $large_image_url[0], '768', '350', true );
							$small_image = aq_resize( $large_image_url[0], '480', '350', true );
						?>
					<img src="<?php echo $medium_image; ?>" alt="" class="uk-visible-small uk-hidden-mini" />
					<img src="<?php echo $small_image; ?>" alt="" class="uk-visible-mini" />
					<?php } ?>
				</div>
			<?php endif; ?>
	<?php endwhile; ?>
<?php } ?>

<div class="cyon-block"><?php echo BLOCK_BEGIN; ?>
	<section class="<?php echo SECTION_CLASS; ?>" data-uk-grid-margin data-uk-grid-match>

		<!-- Primary content -->
		<div id="primary" class="<?php echo PRIMARY_CLASS; ?>">
			<div id="content" role="main">
			
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'page' ); ?>
							<?php if( comments_open() || get_comments_number() ) { ?>
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
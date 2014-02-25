<?php
if ( !defined('ABSPATH') )
	die('-1');

global $smof_data;

get_header();

$layout = $smof_data['general_layout'];

if( is_category() ){
	$cat_layout = get_tax_meta( cyon_get_term_id(), 'cyon_cat_page_layout' );
	if( $cat_layout != 'default' || $cat_layout != '' ) {
		$layout = $cat_layout;
	}
}

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

?>
<div class="cyon-block"><?php echo BLOCK_BEGIN; ?>
	<section class="<?php echo SECTION_CLASS; ?>" data-uk-grid-margin data-uk-grid-match>

		<!-- Primary content -->
		<div id="primary" class="<?php echo PRIMARY_CLASS; ?>">
			<div id="content" role="main">
				
				<?php if ( have_posts() ) { ?>
	
					<!-- Category header -->
					<header class="blog-header">
						<?php echo PRIMARY_BEGIN; ?>
						<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
						<div class="uk-container uk-container-center">
						<?php } ?>
						<h1 class="blog-title uk-h3">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'cyon' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'cyon' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'cyon' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'cyon' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'cyon' ) ) . '</span>' ); ?>
						<?php elseif ( is_author() ) : ?>
							<?php printf( __( 'Author Archives: %s', 'cyon' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?>
						<?php elseif ( is_tag() ) : ?>
							<?php printf( __( 'Posts Tagged: %s', 'cyon' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'cyon' ) ) . '</span>' ); ?>
						<?php elseif ( is_category() ) : ?>
							<?php printf( __( 'Category Archives: %s', 'cyon' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
						<?php elseif ( is_post_type_archive() ) : ?>
							<?php echo esc_html( post_type_archive_title( '', false ) ); ?>
						<?php else : ?>
							<?php echo single_cat_title( '', false ); ?>
						<?php endif; ?>
						</h1>
						<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
						</div>
						<?php } ?>
						<?php echo PRIMARY_END; ?>
					</header>
					<?php if ( category_description() && $paged == 1 ){ ?>
					<div class="blog-content uk-clearfix">
						<?php echo PRIMARY_BEGIN; ?>
						<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
						<div class="uk-container uk-container-center">
						<?php } ?>
						<?php echo do_shortcode( category_description() ); ?>
						<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
						</div>
						<?php } ?>
						<?php echo PRIMARY_END; ?>
					</div>
					<?php } ?>
					<hr class="uk-article-divider" />
				
					<?php $row = 1; $items = 0;	?>
				
					<?php while ( have_posts() ) : the_post(); $items++; ?>
					
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
						
						<?php if( ( $row >= cyon_get_list_layout() || $items >= count($posts) ) && cyon_get_list_layout() != 1 ){ ?>
								</div>
							<?php if( $layout == 'general-1column' ){ ?>
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
<?php
if ( !defined('ABSPATH') )
	die('-1');


/* =Load scripts and styles
----------------------------------------------- */
if( !function_exists( 'cyon_scripts' ) ) {
function cyon_scripts(){
	global $smof_data;
	
	// jQuery
	wp_enqueue_script( 'jquery' );

	// Comment Script
	if(is_singular() && comments_open()){
		wp_enqueue_script( 'comment-reply' ); 
	}

	// Swiper on home
	wp_enqueue_script( 'swiper' );
	wp_enqueue_style( 'swiper_style' );
	
	// Lazyload
	wp_enqueue_script( 'lazyload' );

	// Fancybox
	if( $smof_data['fancybox'] == 1 ){
		wp_enqueue_script( 'fancybox' );
		wp_enqueue_style( 'fancybox_style' ); 
		wp_enqueue_script( 'mousewheel' );
	}

	// Supersized
	if( $smof_data['background_style_pattern_repeat'] == 'full' && $smof_data['background_style_image'] != '' ){
		wp_enqueue_script( 'supersized' );
		wp_enqueue_style( 'supersized_style' );
	}

} }
add_action( 'wp_enqueue_scripts' , 'cyon_scripts' );


/* =Check if online
----------------------------------------------- */
if( !function_exists( 'cyon_check_offline' ) ) {
function cyon_check_offline( $template ){
	global $smof_data;
	if( $smof_data['offline'] == 1 && !is_user_logged_in() ){
		include( get_template_directory() . '/offline.php');
		exit();
	}
} }
add_action( 'template_redirect', 'cyon_check_offline' );


/* =Google fonts
----------------------------------------------- */
if( !function_exists( 'cyon_google_fonts' ) ) {
function cyon_google_fonts() {
	global $smof_data, $primary_font_face;

	/* Getting fonts we want */
	$google_fonts = array();
	
	/* Getting Primary font */
	if($smof_data['primary_font']['face']=='google_font'){
		$google_fonts[] = $smof_data['primary_font']['google'].':'.$smof_data['primary_font']['googlew'];
	}
	
	/* Getting Secondary font */
	if($smof_data['secondary_font']['face']=='google_font'){
		$google_fonts[] = $smof_data['secondary_font']['google'].':'.$smof_data['secondary_font']['googlew'];
	}

	/* Getting Main Navigation font */
	if($smof_data['menu_font']['face']=='google_font'){
		$google_fonts[] = $smof_data['menu_font']['google'].':'.$smof_data['menu_font']['googlew'];
	}
	
	/* Fetching Google Fonts */
	$google_fonts = array_unique($google_fonts);
	if( count( $google_fonts )>0 ){
		echo "\n\t".'<!-- Getting Google Fonts -->'."\n\t";
		echo '<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=';
		foreach($google_fonts as $google_font){
			echo str_replace(' ','+',$google_font).'|';
		}
		echo '" />'."\n";
	}
}}
add_action( 'wp_head', 'cyon_google_fonts', 100 );


/* =Header Scripts
----------------------------------------------- */
if( !function_exists( 'cyon_header_scripts' ) ) {
function cyon_header_scripts() { 
	global $smof_data; ?>

	<!-- Icons -->
	<?php if( $smof_data['iosicon'] != '' ){ ?><link rel="apple-touch-icon" href="<?php echo $smof_data['iosicon']; ?>" /><?php echo "\n"; } ?>
	<?php if( $smof_data['favicon'] != '' ){ ?><link rel="shortcut icon" href="<?php echo $smof_data['favicon']; ?>" /><?php } ?>

	<?php if( $smof_data['responsive'] == 1 ){ ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo CYON_CSS ?>style-uikit-responsive.css" />
	<?php }else{ ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo CYON_CSS ?>style-uikit.css" />
	<?php } ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo CYON_PATH ?>add-styles.php" />
	<?php if( $smof_data['responsive'] == 1 ){ ?><link rel="stylesheet" type="text/css" media="all" href="<?php echo CYON_CSS ?>style-responsive.css" /><?php echo "\n"; } ?>

	<script type="text/javascript" src="<?php echo CYON_JS; ?>jquery.uikit.min.js"></script>
	
	<!-- Support for IE 8 -->
	<!--[if lt IE 10]>
		<script type="text/javascript" src="<?php echo CYON_JS; ?>jquery.placeholders.min.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo CYON_CSS ?>style-ie8.css" />
		<script type="text/javascript" src="<?php echo CYON_JS; ?>html5.js"></script>
		<script type="text/javascript" src="<?php echo CYON_JS; ?>respond.min.js"></script>
	<![endif]-->

	<!-- Theme header script -->
	<?php echo $smof_data['header_scripts']; ?>
	
<?php }}
add_action( 'wp_head', 'cyon_header_scripts', 110 );


/* =Footer Scripts
----------------------------------------------- */
if( !function_exists( 'cyon_footer_scripts' ) ) {
function cyon_footer_scripts() { 
	global $smof_data; ?>

	<!-- Theme additional script -->
	<script type="text/javascript" src="<?php echo CYON_PATH; ?>add-scripts.php"></script>

	<?php if( $smof_data['seo_google'] != '' ){ ?>
	<!-- Google Analytics -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		ga('create', '<?php echo $smof_data['seo_google']; ?>');
		ga('send', 'pageview');
	</script>
	<?php } ?>

<?php }}
add_action( 'wp_footer', 'cyon_footer_scripts', 100 );

/* =Add menu parent class
----------------------------------------------- */
if( !function_exists(' add_menu_parent_class' ) ) {
function add_menu_parent_class( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'uk-parent'; 
		}
	}
	
	return $items;    
} }
add_filter( 'wp_nav_menu_objects' , 'add_menu_parent_class' );


/* =SEO Page Title
----------------------------------------------- */
if( !function_exists( 'cyon_wp_title' ) ) {
function cyon_wp_title( $title ){
	global $post, $paged, $page, $smof_data;

	$BLOGTITLE = get_bloginfo( 'name' );
	$BLOGTAGLINE = get_bloginfo( 'description' );
	if( $smof_data['meta_headers'] == 1 ){
		if( is_page() || is_single() ){
			if( rwmb_meta( 'cyon_meta_title' ) != '' ){
				$PAGETITLE = rwmb_meta( 'cyon_meta_title' );
			}else{
				$PAGETITLE = get_the_title( $post->ID );
			}
		}else{
			$PAGETITLE = $title;
		}
		if( is_home() ){
			$filtered_title = $smof_data['meta_home_title'];
		}else{
			$filtered_title = preg_replace( '/\{([A-Z]+)\}/e', '$$1' , $smof_data['meta_title_format'] );
		}
	}else{
		if( is_home() || is_front_page() ){
			$filtered_title = $BLOGTITLE . ' | ' . $BLOGTAGLINE;
		}else{
			$filtered_title = $title . ' | ' . $BLOGTITLE;
		}
	}
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'cyon' ), max( $paged, $page ) ) : '';
	return strip_tags ( $filtered_title );
} }
add_filter( 'wp_title' , 'cyon_wp_title' );


/* =SEO Meta Info
----------------------------------------------- */
if( !function_exists( 'cyon_header_meta' ) ) {
function cyon_header_meta(){
	global $post, $smof_data;
	if( $smof_data['meta_headers'] == 1 && ( is_page() || is_single() ) ){
		echo rwmb_meta( 'cyon_meta_desc' ) != '' ? '<meta name="description" content="' . strip_tags ( rwmb_meta( 'cyon_meta_desc' ) ) . '" />'."\n" : '<meta name="description" content="' . strip_tags ( get_the_excerpt() ) . '" />'."\n";
		echo rwmb_meta( 'cyon_meta_keywords' ) != '' ? '<meta name="keywords" content="' . strip_tags ( rwmb_meta( 'cyon_meta_keywords' ) ) . '" />'."\n" : '';
		if( rwmb_meta( 'cyon_robot' ) ){
			add_action( 'wp_head' , 'wp_no_robots' );
		}
	}
	if( is_home() ){
		if( $smof_data['meta_home_description'] )
			echo '<meta name="description" content="' . $smof_data['meta_home_description'] . '" />'."\n";
		if( $smof_data['meta_home_keywords'] )
			echo '<meta name="keywords" content="' . $smof_data['meta_home_keywords'] . '" />'."\n";
	}
} }
add_action( 'wp_head' ,	'cyon_header_meta' , 5 );


/* =Homepage Block
----------------------------------------------- */
if( !function_exists( 'cyon_homepage_blocks' ) ) {
function cyon_homepage_blocks(){
	global $smof_data;
	$layout = $smof_data['homepage_blocks']['enabled'];
	if ( $layout ){
		foreach( $layout as $key => $value ) {
			switch( $key ) {
				case 'home_block_slider':
					cyon_home_block_slider();
					break;
				case 'home_block_bucket':
					cyon_home_block_bucket();
					break;
				case 'home_block_static':
					cyon_home_block_static();
					break;
				case 'home_block_portfolio':
					cyon_home_block_portfolio();
					break;
			}
		}
	}
} }

/* =Homepage Block Slider
----------------------------------------------- */
if( !function_exists( 'cyon_home_block_slider' ) ) {
function cyon_home_block_slider(){
	global $smof_data;

	$slides = $smof_data['homepage_slider'];
	if( count( $slides ) > 1 ){ ?>
		<!-- Slider -->
		<div id="slider-block" class="cyon-block">
			<div class="uk-container-center">
				<a class="swiper-left uk-visible-large" href="#"><i class="uk-icon-chevron-left"></i></a>
				<a class="swiper-right uk-visible-large" href="#"><i class="uk-icon-chevron-right"></i></a>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php foreach ($slides as $slide) { ?>
							<div class="swiper-slide uk-text-center">
								<?php $sliderimage_large = aq_resize( $slide['url'], '1130' ); ?>
								<img src="<?php echo $sliderimage_large!== false ? $sliderimage_large : $slide['url'] ; ?>" class="uk-hidden-small" alt="<?php echo $slide['title']; ?>" />

								<?php if( $smof_data['responsive'] == 1 ){ ?>
								<?php $sliderimage_small = aq_resize( $slide['url'], '768', '400', true ); ?>
								<?php $sliderimage_mini = aq_resize( $slide['url'], '480', '350', true ); ?>
								<img src="<?php echo $sliderimage_small!== false ? $sliderimage_small : $slide['url'] ; ?>" class="uk-visible-small uk-hidden-mini" alt="<?php echo $slide['title']; ?>" />
								<img src="<?php echo $sliderimage_mini!== false ? $sliderimage_mini : $slide['url'] ; ?>" class="uk-visible-mini" alt="<?php echo $slide['title']; ?>" />
								<?php echo "\n"; } ?>
								
								<div class="swiper-caption">
									<?php echo $slide['description'] != '' ? '<h1 class="uk-h1">' . $slide['title'] . '</h1>' : ''; ?>
									<div class="swiper-content">
										<?php echo $slide['description'] != '' ? '<p><span>' . $slide['description'] . '</span></p>' : ''; ?>
										<?php echo $slide['link'] != '' ? '<a href="' . $slide['link'] . '" class="uk-button">' . __( 'Read more' , 'cyon' ) . '</a>' : ''; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				var cyonSlider = jQuery('#slider-block .swiper-container').swiper({
					autoplay:6000,
					loop: true,
					calculateHeight: true,
					paginationClickable: true
				});
				jQuery('#slider-block .swiper-left').on('click', function(e){
					e.preventDefault();
					cyonSlider.swipePrev();
				})
				jQuery('#slider-block .swiper-right').on('click', function(e){
					e.preventDefault();
					cyonSlider.swipeNext();
				})
			});
		</script>
	<?php }
} }

/* =Homepage Block Bucket
----------------------------------------------- */
if( !function_exists( 'cyon_home_block_bucket' ) ) {
function cyon_home_block_bucket(){
	if( is_active_sidebar( 'home-columns' ) ){ ?>
		<!-- Home Widgets -->
		<div id="bucket-block" class="cyon-block">
			<div class="uk-container uk-container-center">
				<section class="uk-grid" data-uk-grid-margin data-uk-grid-match>
					<?php dynamic_sidebar( 'home-columns' ); ?>
				</section>
			</div>
		</div>
	<?php }
} }

/* =Homepage Block Static
----------------------------------------------- */
if( !function_exists( 'cyon_home_block_static' ) ) {
function cyon_home_block_static(){
	global $smof_data; ?>
	<!-- Home Static -->
	<div id="static-block" class="cyon-block">
		<div class="uk-container uk-container-center">
			<section class="uk-grid" data-uk-grid-match="{target:\'.uk-panel\'}">
				<?php if( $smof_data['homepage_static_bg'] != '' ){ ?>
				<div class="uk-width-medium-1-2 uk-hidden-small">
					<div class="uk-panel">
						<?php $staticimage = aq_resize( $smof_data['homepage_static_bg'], '580' ); ?>
						<img src="<?php echo CYON_IMAGES_DIR ?>blank.png" data-original="<?php echo $staticimage!== false ? $staticimage : $smof_data['homepage_static_bg'] ; ?>" class="lazyload" alt="<?php echo $smof_data['homepage_static_title']; ?>" />
						<noscript><img src="<?php echo $staticimage!== false ? $staticimage : $smof_data['homepage_static_bg'] ; ?>" alt="<?php echo $smof_data['homepage_static_title']; ?>"></noscript>
					</div>
				</div>
				<?php } ?>
				<div class="<?php echo $smof_data['homepage_static_bg'] != '' ? 'uk-width-medium-1-2' : 'uk-width-1-1' ; ?> text-main">
					<h1 class="uk-h1 uk-heading-large" data-uk-scrollspy="{cls:'uk-animation-slide-right'}"><?php echo $smof_data['homepage_static_title']; ?></h1>
					<?php echo $smof_data['homepage_static_subtitle'] != '' ? '<h2 class="uk-h2" data-uk-scrollspy="{cls:\'uk-animation-slide-left\', delay:500}">' . $smof_data['homepage_static_subtitle'] . '</h2>' : '' ; ?>
					<?php echo wpautop( $smof_data['homepage_static_text'] ); ?>
				</div>
			</section>
		</div>
	</div>
<?php } }


/* =Homepage Portfolio
----------------------------------------------- */
if( !function_exists( 'cyon_home_block_portfolio' ) ) {
function cyon_home_block_portfolio(){
	global $smof_data; ?>
	<!-- Portfolio / Feedback -->
	<div id="portfolio-block" class="cyon-block">
		<div class="uk-container uk-container-center">
			<?php $feedbacks = $smof_data['feedback']; ?>
			<section class="uk-grid" data-uk-grid-margin>
				<div class="<?php echo count( $feedbacks ) > 1 ? 'uk-width-medium-3-4' : 'uk-width-1-1'; ?> uk-grid-margin uk-hidden-mini portfolio portfolio-large">
					<header class="uk-grid">
						<h2 class="uk-h2 uk-width-4-6" data-uk-scrollspy="{cls:'uk-animation-slide-top'}"><?php echo $smof_data['homepage_portfolio_title']; ?></h2>
						<div class="uk-width-2-6 uk-text-right action"><a class="swiper-left" href="#"><i class="uk-icon-chevron-left"></i></a><a class="swiper-right" href="#"><i class="uk-icon-chevron-right"></i></a></div>
					</header>
					<div class="swiper-container">
						<div class="swiper-wrapper">
						<?php 
						$args = array( 'post_type' => 'portfolio', 'meta_key' => 'cyon_portfolio_homepage', 'meta_value' => 1 ); 
						$loop = new WP_Query( $args ); 
						$count = 0;
						$total = 0;
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post(); 
								$count++; $total++; ?>
								<?php if( $count==1 ){ echo '<div class="swiper-slide"><div class="uk-grid" data-uk-grid-match="{target:\'.uk-panel\'}">'; } ?>
								<div class="uk-width-1-3">
									<div class="uk-panel">
										<a href="<?php the_permalink() ?>" class="uk-thumbnail uk-overlay-toggle">
											<div class="uk-overlay">
												<div class="panel-img">
													<?php if ( has_post_thumbnail() && ! post_password_required() ) : 
														$thumbfile = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
														<img src="<?php echo aq_resize( $thumbfile[0], '225', '127', true ); ?>" alt="<?php the_title(); ?>" />
													<?php else: ?>
														<div class="uk-vertical-align uk-text-center" style="height:127px">
															<div class="uk-vertical-align-middle">
																<p><?php _e( 'No thumbnail available', 'cyon' ); ?></p>
															</div>
														</div>
													<?php endif; ?>
												</div>
												<div class="uk-overlay-area"></div>
											</div>
											<div class="panel-wrap">
												<h3 class="uk-panel-title"><?php the_title(); ?></h3>
												<?php the_excerpt(); ?>
											</div>
										</a>
									</div>
								</div>
								<?php if( $count == 3 || $loop->found_posts == $total ){ echo '</div></div>'; $count=0; } ?>
							<?php endwhile; ?>
							<script type="text/javascript">
								jQuery(document).ready(function() {
									var cyonPortfolioLarge = jQuery('.portfolio-large .swiper-container').swiper({
										calculateHeight: true,
										paginationClickable: true
									});
									jQuery('.portfolio-large .swiper-left').on('click', function(e){
										e.preventDefault();
										cyonPortfolioLarge.swipePrev();
									})
									jQuery('.portfolio-large .swiper-right').on('click', function(e){
										e.preventDefault();
										cyonPortfolioLarge.swipeNext();
									})
								});
							</script>
						<?php }else{ ?>
							<p><?php _e( 'Sorry, no portfolio item was set to show on homepage.', 'cyon' ); ?></p>
						<?php } ?>
						</div>
					</div>
				</div>
				<?php if( $smof_data['responsive'] == 1 ){ ?>
				<div class="<?php echo count( $feedbacks ) > 1 ? 'uk-width-medium-3-4' : 'uk-width-1-1'; ?> uk-grid-margin uk-visible-mini portfolio portfolio-mini">
					<header class="uk-grid">
						<h2 class="uk-h2 uk-width-4-6" data-uk-scrollspy="{cls:'uk-animation-slide-top'}"><?php echo $smof_data['homepage_portfolio_title']; ?></h2>
						<div class="uk-width-2-6 uk-text-right action"><a class="swiper-left" href="#"><i class="uk-icon-chevron-left"></i></a><a class="swiper-right" href="#"><i class="uk-icon-chevron-right"></i></a></div>
					</header>
					<div class="swiper-container">
						<div class="swiper-wrapper">
						<?php 
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<div class="swiper-slide">
									<div class="uk-panel">
										<a href="<?php the_permalink() ?>" class="uk-thumbnail uk-overlay-toggle">
											<div class="uk-overlay">
												<div class="panel-img">
													<?php if ( has_post_thumbnail() && ! post_password_required() ) : 
														$thumbfile = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
														<img src="<?php echo aq_resize( $thumbfile[0], '270', '152', true ); ?>" alt="<?php the_title(); ?>" />
													<?php else: ?>
														<div class="uk-vertical-align uk-text-center" style="height:152px">
															<div class="uk-vertical-align-middle">
																<p><?php _e( 'No thumbnail available', 'cyon' ); ?></p>
															</div>
														</div>
													<?php endif; ?>
												</div>
												<div class="uk-overlay-area"></div>
											</div>
											<div class="panel-wrap">
												<h3 class="uk-panel-title"><?php the_title(); ?></h3>
												<?php the_excerpt(); ?>
											</div>
										</a>
									</div>
								</div>
							<?php endwhile; ?>
							<script type="text/javascript">
								jQuery(document).ready(function() {
									var cyonPortfolioMini = jQuery('.portfolio-mini .swiper-container').swiper({
										calculateHeight: true,
										paginationClickable: true
									});
									jQuery('.portfolio-mini .swiper-left').on('click', function(e){
										e.preventDefault();
										cyonPortfolioMini.swipePrev();
									})
									jQuery('.portfolio-mini .swiper-right').on('click', function(e){
										e.preventDefault();
										cyonPortfolioMini.swipeNext();
									})
								});
							</script>
						<?php }else{ ?>
							<p><?php _e( 'Sorry, no portfolio item was set to show on homepage.', 'cyon' ); ?></p>
						<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php wp_reset_postdata(); ?>
				<?php if( count( $feedbacks ) > 1 ){ ?>
				<div class="uk-width-medium-1-4 uk-grid-margin feedback">
					<header class="uk-grid">
						<h2 class="uk-h2 uk-width-4-6" data-uk-scrollspy="{cls:'uk-animation-slide-top', delay:500}"><?php echo $smof_data['homepage_feedback_title']; ?></h2>
						<div class="uk-width-2-6 uk-text-right action"><a class="swiper-left" href="#"><i class="uk-icon-chevron-left"></i></a><a class="swiper-right" href="#"><i class="uk-icon-chevron-right"></i></a></div>
					</header>
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach ($feedbacks as $feedback) { ?>
								<div class="swiper-slide">
									<blockquote class="style1">
										<p><?php echo $feedback['description'] ?></p>
										<small class="name uk-text-right"><?php echo $feedback['url'] ? '<img src="' . aq_resize( $feedback['url'], '50', '50', true ) . '" alt="' . $feedback['title'] . '" width="50" height="50" class="uk-float-right" />' : ''; ?><?php echo $feedback['title'] ?><?php echo $feedback['job'] ? ' <span>' . $feedback['job'] . '</span>' : ''; ?></small>
									</blockquote>
								</div>
							<?php } ?>
						</div>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							var cyonFeedback = jQuery('.feedback .swiper-container').swiper({
								autoplay:6000,
								calculateHeight: true,
								paginationClickable: true
							});
							jQuery('.feedback .swiper-left').on('click', function(e){
								e.preventDefault();
								cyonFeedback.swipePrev();
							})
							jQuery('.feedback .swiper-right').on('click', function(e){
								e.preventDefault();
								cyonFeedback.swipeNext();
							})
						});
					</script>
				</div>
				<?php } ?>
			</section>
		</div>
	</div>
<?php } }


/* =Post/Page classes
----------------------------------------------- */
function cyon_post_class( $classes ) {
	global $post, $smof_data;
	$classes[] = 'uk-article';
	
	// sticky class
	if( is_sticky( $post->ID ) && is_page() ){
		$classes[] = 'sticky';
	}

	// portfolio column class
	if( !is_single() && get_post_type( $post->ID ) == 'portfolio' ) {
		$classes[] = 'portfolio-col-' . cyon_get_list_layout();
	}
	
	return $classes;
}
add_filter( 'post_class', 'cyon_post_class' );


/* =Post excerpt
----------------------------------------------- */
function cyon_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'cyon_excerpt_more' );

function cyon_excerpt_length( $length ) {
	global $smof_data;
	return $smof_data[ 'blog_excerpt_count']!='' ? $smof_data[ 'blog_excerpt_count'] : 30;
}
add_filter( 'excerpt_length', 'cyon_excerpt_length', 999 );


/* =Post Header Meta
----------------------------------------------- */
if( !function_exists( 'cyon_post_header_meta' ) ) {
function cyon_post_header_meta(){
	global $smof_data;

	if( $smof_data['blog_meta'][0] == 1 || $smof_data['blog_meta'][1] == 1 || $smof_data['blog_meta'][2] == 1 || $smof_data['blog_meta'][3] == 1 || $smof_data['blog_meta'][4] == 1 || $smof_data['blog_meta'][5] == 1 ) {
		echo '<p class="uk-article-meta">';
			if( $smof_data['blog_meta'][0] == 1 ) {
				echo '<span class="posted-date"><span class="uk-icon-calendar"></span>' . __( 'Posted', 'cyon' ) . ' ' . human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . __( 'ago', 'cyon' ) . '</span> ';
			}
			if( $smof_data['blog_meta'][1] == 1 ) {
				echo '<span class="posted-by"><span class="uk-icon-user"></span> <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span> ';
			}
			if( $smof_data['blog_meta'][2] == 1 ) {
				echo '<span class="categories-links"><span class="uk-icon-folder-open"></span> '.get_the_category_list( __( ', ', 'cyon' ) ).'</span> ';
			}
			if( get_the_tag_list() && $smof_data['blog_meta'][3] == 1 ){
				echo '<span class="tag-links"><span class="uk-icon-tag"></span> '.get_the_tag_list( '', __( ', ', 'cyon' ) ).'</span> ';
			}
			if( $smof_data['blog_meta'][4] == 1 ) {
				echo '<span class="post-format"><span class="uk-icon-play-circle-o"></span> <a class="entry-format" href="' . esc_url( get_post_format_link( get_post_format() ) ) . '">' . get_post_format_string( get_post_format() ) . '</a></span> ';
			}
			if( $smof_data['blog_meta'][5] == 1 && ( comments_open() || get_comments_number() ) ) {
				$comments = wp_count_comments( get_the_ID() );
				if($comments->approved==0){
					echo '<span class="comments"><span class="uk-icon-comment"></span> '.__( 'Be the first to' , 'cyon' ).' <a href="'.get_permalink().'#respond">'.__( 'comment here' , 'cyon' ).'</a>.</span>';
				}elseif($comments->approved==1){
					echo '<span class="comments"><span class="uk-icon-comment"></span> <a href="'.get_permalink().'#comments">'.$comments->approved.' '.__( 'comment' , 'cyon' ).'</a></span>';
				}else{
					echo '<span class="comments"><span class="uk-icon-comment"></span> <a href="'.get_permalink().'#comments">'.$comments->approved.' '.__( 'comments' , 'cyon' ).'</a></span>';
				}
			}
		echo '</p>';
	}
} }


/* =Post/Page image class
----------------------------------------------- */
function image_tag_class( $class, $id, $align, $size ) {
	$class[] = ' uk-thumbnail';
	return $class;
}
add_filter('get_image_tag_class', 'image_tag_class', 0, 4);


/* =Post/Page Comments
----------------------------------------------- */
if( !function_exists( 'cyon_comment' ) ) {
function cyon_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'cyon' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'cyon' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="uk-comment">
			<header class="uk-comment-header">
				<?php
					$avatar_size = 68;
					if ( '0' != $comment->comment_parent )
						$avatar_size = 39;

					echo get_avatar( $comment, $avatar_size );
				?>
				<h4 class="uk-comment-title"><?php echo get_comment_author_link(); ?></h4>
				<div class="uk-comment-meta">
					<?php printf( __( 'Said %s ago', 'cyon' ), human_time_diff( get_comment_time('U'), current_time('timestamp') ) ); ?>
					<?php edit_comment_link( __( 'Edit', 'cyon' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</header>

			<div class="uk-comment-body">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p><em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cyon' ); ?></em></p>
				<?php endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'cyon' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			</div>
		</article>

	<?php
			break;
	endswitch;
} }


/* =Form submission
----------------------------------------------- */
if( !function_exists( 'cyon_form_submit' ) ) {
function cyon_form_submit() {
	if(! wp_verify_nonce( $_REQUEST['nonce'], 'cyon_form_nonce' ) ) die( __( 'Security check', 'cyon' ) ); 
	if( isset( $_REQUEST['nonce'] ) && isset( $_REQUEST['email'] ) ) {

		$subject 	= $_REQUEST['subject'];
		$headers  	= 'MIME-Version: 1.0' . "\r\n";
		$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers 	.= 'From: ' . $_REQUEST['name'] . ' <' . $_REQUEST['email'] . '>' . "\r\n";

		$body 		= _e( 'Name', 'cyon' ) . ': <b>' . $_REQUEST['name'] . '</b><br>';

		$content['comment_author'] = $_REQUEST['name'];
		$content['comment_author_email'] = $_REQUEST['email'];
		$content['comment_author_url'] = '';
		$content['comment_content'] = $_REQUEST['message'];
	
		/* Check spam */
		if ( cyon_checkspam( $content ) ) {
			echo 0;
			die();
		}

		/* Send mail */
		if( mail( get_bloginfo( 'admin_email' ), $subject, $body, $headers ) ) {
			echo 1;
		} else {
			echo 0;
		}
	}
	die();
} }
add_action( 'wp_ajax_cyon_form_submit', 'cyon_form_submit' );
add_action( 'wp_ajax_nopriv_cyon_form_submit', 'cyon_form_submit' );


/* =Breadcrumbs
----------------------------------------------- */
if( !function_exists( 'cyon_breadcrumb' ) ) {
function cyon_breadcrumb() {
	global $smof_data, $paged;
	if (!is_front_page() && !is_404() && $smof_data['breadcrumbs']==1 ) { ?>
		<!-- Breadcrumb -->
		<div id="breadcrumb" itemprop="breadcrumb">
			<div class="uk-container uk-container-center">
				<?php if( function_exists( 'bcn_display' ) ){ ?>
					<?php bcn_display(); ?>
				<?php }else{ ?>
					<ul class="uk-breadcrumb">
						<li><a href="<?php echo home_url(); ?>"><?php _e( 'Home', 'cyon' ); ?></a></li>
						<?php
						if ( is_category() || is_single() ) {
							$cat_title = get_the_category();
							$post_type = get_post_type_object( get_post_type() );
							
							if( is_attachment() ){ ?>
								<li><?php _e( 'Attachment', 'cyon' ); ?></li>
							<?php }elseif( is_singular() && !is_singular( 'post' ) ){ ?>
								<li><a href="<?php echo get_post_type_archive_link( $post_type->name ); ?>"><?php echo esc_html( $post_type->labels->name ); ?></a></li>
							<?php }elseif( is_category() ){ ?>
								<li class="uk-active"><span><?php echo $cat_title[0]->cat_name; ?><?php echo $paged > 1 ? ' - ' . __( 'Page ', 'cyon' ) . $paged : ''; ?></span></li>
							<?php }elseif( $cat_title[0]->cat_name=='' ) { ?>
								<li><a href="<?php echo get_post_type_archive_link( $post_type->name ); ?>"><?php echo esc_html( $post_type->labels->name ); ?></a></li>
							<?php }else{ ?>
								<li><a href="<?php echo get_category_link( $cat_title[0]->cat_ID ); ?>"><?php echo esc_html( $cat_title[0]->cat_name ); ?></a></li>
							<?php } ?>
							
							<?php if ( is_single() ) { ?>
								<li class="uk-active"><span><?php echo esc_html( strip_tags( get_the_title() ) ); ?></span></li>
							<?php } ?>
						
						<?php } elseif ( is_post_type_archive() ) { ?>
						
							<li class="uk-active"><span><?php echo esc_html( post_type_archive_title( '', false ) ); ?><?php echo $paged > 1 ? ' - ' . __( 'Page ', 'cyon' ) . $paged : ''; ?></span></li>
							
						<?php } elseif ( is_page() ) {
							
								$page = get_page_by_title( get_the_title() );
								if( !empty( $page->post_parent ) ){
									$parent_id  = $page->post_parent;
									$breadcrumbs = array();
									while ( $parent_id ) {
										$spage = get_page( $parent_id );
										$breadcrumbs[] = '<a href="' . get_permalink( $spage->ID ) . '">' . esc_html( strip_tags( get_the_title( $spage->ID ) ) ) . '</a>';
										$parent_id  = $spage->post_parent;
									}
									$breadcrumbs = array_reverse($breadcrumbs);
									for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) { ?>
										<li><?php echo $breadcrumbs[$i]; ?></li>
								<?php }
								} ?>
								<li class="uk-active"><span><?php echo esc_html( strip_tags( get_the_title() ) ); ?><?php echo $paged > 1 ? ' - ' . __( 'Page ', 'cyon' ) . $paged : ''; ?></span></li>
						<?php }elseif ( is_home() ){ ?>
							<li class="uk-active"><span><?php echo esc_html( strip_tags( get_the_title( get_option( 'page_for_posts', true ) ) ) ); ?></span></li>
						<?php }elseif ( is_search() ){ ?>
							<li class="uk-active"><span><?php echo _e( 'Search results for' , 'cyon' ); ?>: <?php echo esc_html( get_search_query() ); ?></span></li>
						<?php }elseif ( is_day() ){ ?>
							<li><a href="<?php echo get_year_link( get_the_time( 'Y' ) ); ?>"><?php echo get_the_time( 'Y' ); ?></a></li>
							<li><a href="<?php echo get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ); ?>"><?php echo get_the_time( 'F' ); ?></a></li>
							<li class="uk-active"><span><?php echo get_the_time( 'd' ); ?></span></li>
						<?php }elseif ( is_month() ){ ?>
							<li><a href="<?php echo get_year_link( get_the_time( 'Y' ) ); ?>"><?php echo get_the_time( 'Y' ); ?></a></li>
							<li class="uk-active"><span><?php echo get_the_time( 'F' ); ?></span></li>
						<?php }elseif ( is_year() ){ ?>
							<li class="uk-active"><span><?php echo get_the_time( 'Y' ); ?></span></li>
						<?php }elseif ( is_author() ){ 
							global $author;
							$userdata = get_userdata( $author ); ?>
							<li class="uk-active"><span><?php echo _e( 'Articles posted by' , 'cyon' ); ?>: <?php echo esc_html( $userdata->display_name ); ?></span></li>
						<?php }elseif ( is_tag() ){ ?>
							<li class="uk-active"><span><?php echo _e( 'Posts tagged' , 'cyon' ); ?>: <?php echo esc_html( single_tag_title( '', false ) ); ?></span></li>
						<?php }elseif ( is_tax() ){ 
							$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							$ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );
							foreach ( $ancestors as $ancestor ) { 
								$ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) ); ?>
								<li><a href="<?php echo get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ); ?>"><?php echo esc_html( strip_tags( $ancestor->name ) ); ?></a></li>
							<?php } ?>
							<li class="uk-active"><span><?php echo esc_html( strip_tags( $current_term->name ) ); ?></span></li>
						<?php } ?>
						
					</ul>
				<?php } ?>
			</div>
		</div>
	<?php }
} }


/* =Category Pagination
----------------------------------------------- */
if( !function_exists( 'cyon_pagination' ) ) {
function cyon_pagination() {
	global $smof_data, $wp_query;
	if( function_exists( 'wp_pagenavi' ) ){
		wp_pagenavi();
	}else{
		
		$layout = $smof_data['general_layout'];
		
		if( is_category() ){
			$cat_layout = get_tax_meta( cyon_get_term_id(), 'cyon_cat_page_layout' );
			if( $cat_layout != 'default' || $cat_layout != '' ) {
				$layout = $cat_layout;
			}
		}elseif( is_post_type_archive( 'portfolio' ) ) {
			$layout = $smof_data['portfolio_page_layout'];
		}

		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav class="pagination uk-clearfix">
				<?php echo PRIMARY_BEGIN; ?>
				<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
				<div class="uk-container uk-container-center">
				<?php } ?>
				<h3 class="uk-hidden"><?php _e( 'Post navigation', 'cyon' ); ?></h3>
				<ul class="uk-pagination">
					<li class="uk-pagination-previous"><?php next_posts_link( __( '<i class="uk-icon-angle-double-left"></i> Older Posts', 'cyon' ) ); ?></li>
					<li class="uk-pagination-next"><?php previous_posts_link( __( 'Newer Posts <i class="uk-icon-angle-double-right"></i>', 'cyon' ) ); ?></li>
				</ul>
				<?php if( cyon_get_list_layout() != 1 && $layout == 'general-1column' ) { ?>
				</div>
				<?php } ?>
				<?php echo PRIMARY_END; ?>
			</nav>
		<?php endif;
	}
} }


/* =Password Protection
----------------------------------------------- */
if( !function_exists( 'cyon_password_form' ) ) {
function cyon_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="uk-form">
    <p>' . __( 'To view this page, please enter the password:', 'cyon' ) . ' <input name="post_password" id="' . $label . '" type="password" size="20" placeholder="..." maxlength="20" /> <button type="submit" name="Submit" class="uk-button uk-button-primary">' . esc_attr__( 'Submit', 'cyon' ) . '</button></p>
	</form>
    ';
    return $o;
} }
add_filter( 'the_password_form', 'cyon_password_form' );


if( !function_exists( 'cyon_excerpt_protected' ) ) {
function cyon_excerpt_protected( $excerpt ) {
    if ( post_password_required() )
        $excerpt = __( '<em>Sorry but this page cannot be viewed in public.</em>', 'cyon' );
    return $excerpt;
} }
add_filter( 'the_excerpt', 'cyon_excerpt_protected' );

/* =Checkspam
----------------------------------------------- */
if( !function_exists( 'cyon_checkspam' ) ) {
function cyon_checkspam ( $content ) {
	$isSpam = FALSE;
	$content = (array) $content;
	
	if (function_exists('akismet_init')) {
		$wpcom_api_key = get_option('wordpress_api_key');
		if (!empty($wpcom_api_key)) {
			global $akismet_api_host, $akismet_api_port;
			// set remaining required values for akismet api
			$content['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
			$content['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$content['referrer'] = $_SERVER['HTTP_REFERER'];
			$content['blog'] = home_url();
			
			if (empty($content['referrer'])) {
				$content['referrer'] = get_permalink();
			}
			
			$queryString = '';
			
			foreach ($content as $key => $data) {
				if (!empty($data)) {
					$queryString .= $key . '=' . urlencode(stripslashes($data)) . '&';
				}
			}
			
			$response = akismet_http_post($queryString, $akismet_api_host, '/1.1/comment-check', $akismet_api_port);
			
			if ($response[1] == 'true') {
				update_option('akismet_spam_count', get_option('akismet_spam_count') + 1);
				$isSpam = TRUE;
			}
			
		}
		
	}
	return $isSpam;
} }


/* =General Layout classes and extra divs
----------------------------------------------- */
if( !function_exists( 'cyon_general_layout' ) ) {
function cyon_general_layout() {
	global $post, $smof_data;

	$block_begin = '';
	$block_end = '';
	$section_class = '';
	$pri_layout_class = '';
	$sec_layout_class = '';
	$pri_wrapper_begin = '';
	$pri_wrapper_end = '';
	$show_sidebar = false;
	
	if( is_page() || is_single() ){
		$postID = $post->ID;
	}else{
		$postID = '';
	}

	if( get_post_meta( $postID, 'cyon_layout' ,true ) == 'default' || !get_post_meta( $postID, 'cyon_layout', true ) || is_archive() || is_category() || is_search() ){

		if( is_post_type_archive( 'portfolio' ) || is_singular( 'portfolio' ) ) {
			$layout = $smof_data['portfolio_page_layout'];
		}else{
			$layout = $smof_data['general_layout'];
		}

		if( is_category() ){
			$cat_layout = get_tax_meta( cyon_get_term_id(), 'cyon_cat_page_layout' );
			if( $cat_layout != 'default' || $cat_layout != '' ) {
				$layout = $cat_layout;
			}
		}

		if( $layout != 'general-1column' ) {
			$block_begin = '<div class="uk-container uk-container-center">';
			$block_end = '</div>';
			$section_class = 'uk-grid uk-grid-divider';
			$pri_layout_class = 'uk-width-medium-7-10';
			$sec_layout_class = 'uk-width-medium-3-10';
			$show_sidebar = true;
			if( $layout == 'general-2left' ) {
				$pri_layout_class .= ' uk-push-3-10';
				$sec_layout_class .= ' uk-pull-7-10 pull-border-right';
			}
		}elseif( $layout == 'general-1column' && ( cyon_get_list_layout() == 1 || is_single() || is_page() ) ){
			$pri_wrapper_begin = '<div class="uk-container uk-container-center">';
			$pri_wrapper_end = '</div>';
		}
	}elseif( get_post_meta( $postID, 'cyon_layout' ,true ) == 'general-1column' ){
		if( !is_page_template( 'template-blog.php' ) ) {
			$pri_wrapper_begin = '<div class="uk-container uk-container-center">';
			$pri_wrapper_end = '</div>';
		}else{
			if( cyon_get_list_layout() == 1 ) {
				$pri_wrapper_begin = '<div class="uk-container uk-container-center">';
				$pri_wrapper_end = '</div>';
			}
			$block_begin = '<div class="uk-container uk-container-center">';
			$block_end = '</div>';
			$section_class = 'uk-grid uk-grid-divider';
		}
	}else{
		$block_begin = '<div class="uk-container uk-container-center">';
		$block_end = '</div>';
		$section_class = 'uk-grid uk-grid-divider';
		$pri_layout_class = 'uk-width-medium-7-10';
		$sec_layout_class = 'uk-width-medium-3-10';
		$show_sidebar = true;
		if( get_post_meta( $postID, 'cyon_layout' ,true ) == 'general-2left' ) {
			$pri_layout_class .= ' uk-push-3-10';
			$sec_layout_class .= ' uk-pull-7-10 pull-border-right';
		}
	}
	
	define( 'BLOCK_BEGIN', $block_begin );
	define( 'BLOCK_END', $block_end );
	define( 'SECTION_CLASS', $section_class );
	define( 'PRIMARY_CLASS', $pri_layout_class );
	define( 'SECONDARY_CLASS', $sec_layout_class );
	define( 'PRIMARY_BEGIN', $pri_wrapper_begin );
	define( 'PRIMARY_END', $pri_wrapper_end );		
	define( 'SHOW_SIDEBAR', $show_sidebar );		

} }
add_action( 'wp_head', 'cyon_general_layout' );

/* =Get Term ID
----------------------------------------------- */
if( !function_exists( 'cyon_get_term_id' ) ) {
function cyon_get_term_id(){
	if( is_category() ) {
		$current_cat = get_query_var( 'cat' );
		$term_slug = get_category( $current_cat );
		$current_term = get_term_by( 'slug', $term_slug->slug, 'category' );
		return $current_term->term_id;
	}else{
		return '';
	}
} }

/* =Get Post Listing Layout
----------------------------------------------- */
if( !function_exists( 'cyon_get_list_layout' ) ) {
function cyon_get_list_layout(){
	global $post, $smof_data;
	$cols = 1;
	$cat_cols = get_tax_meta( cyon_get_term_id(), 'cyon_cat_layout_listing' );
	if( is_category() ){
		if( $cat_cols == 1 || $cat_cols == 2 || $cat_cols == 3 || $cat_cols == 4 ){
			$cols = $cat_cols;
		}else{
			$cols = $smof_data['blog_layout'];
		}
	}elseif( is_post_type_archive( 'portfolio' ) ) {
		$cols = $smof_data['portfolio_layout'];
	}elseif( $smof_data['blog_layout'] ) {
		$cols = $smof_data['blog_layout'];
	}
	if( isset( $_GET['cols'] ) ) {
		$cols = $_GET['cols'];
	}
	return apply_filters( 'cyon_the_list_layout', $cols );
} }


/* =Portfolio items per page
----------------------------------------------- */
if( !function_exists( 'cyon_portfolio_archive' ) ) {
function cyon_portfolio_archive( $query ){
	global $smof_data;
	if ( is_post_type_archive( 'portfolio' ) && $query->is_main_query() && !is_admin() ) {
		$query->set( 'posts_per_page', $smof_data['portfolio_perpage'] );
		return;
	}
} }
add_action( 'pre_get_posts', 'cyon_portfolio_archive', 1 );


/* =Embed videos adds responsive
----------------------------------------------- */
if( !function_exists( 'cyon_embed_html' ) ) {
function cyon_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
} }
add_filter( 'embed_oembed_html', 'cyon_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'cyon_embed_html' );

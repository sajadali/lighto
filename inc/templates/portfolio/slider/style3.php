<?php
	$id = get_the_ID();
	
	// Categories
	$categories = get_the_term_list( $id, 'portfolio-category', '', ', ', '' ); 
	if ($categories !== '' && !empty($categories)) {
		$categories = strip_tags($categories);
	}
	
	$terms = get_the_terms( $id, 'portfolio-category' );
	
	$cats = '';	
	if (!empty($terms)) {
		foreach ($terms as $term) { $cats .= ' thb-cat-'.strtolower($term->slug); }
	}
	
	// Listing Type
	$main_listing_type = get_post_meta($id, 'main_listing_type', true);
	$permalink = '';
	if ($main_listing_type == 'lightbox') {
		$permalink = $image_url[0];
	} else if ($main_listing_type == 'link') {
		$permalink = get_post_meta($id, 'main_listing_link', true);	
	} else {
		$permalink = get_the_permalink();	
	}
?>
<div class="portfolio-slide portfolio-slide-style3 cover-bg">
	<div class="row max_width align-middle">
		<div class="small-12 medium-6 small-order-2 medium-order-1 columns content-side">
				<aside class="thb-categories animation fade-in">
					<?php 
						if ( is_singular('portfolio') ) { 
							echo esc_html($categories); 
						} else {
							the_category(', ');
						}
					?>
				</aside>
			<h2 class="animation fade-in"><a href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a></h2>
			<a href="<?php echo esc_url($permalink); ?>" class="btn-text style1 animation fade-in"><?php esc_html_e('Learn More', 'revolution'); ?></a>
		</div>
		<div class="small-12 medium-6 small-order-1 medium-order-2 columns image-side">
			<a href="<?php echo esc_url($permalink); ?>">
			<?php the_post_thumbnail('revolution-square-x2', array('class' => 'portfolio-slider-image animation fade-in')); ?>
			</a>
		</div>
	</div>
</div>

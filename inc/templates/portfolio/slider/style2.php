<?php
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
	$id = get_the_ID();
	$image_id = get_post_thumbnail_id($id);
	$image_url = wp_get_attachment_image_src($image_id, 'full');
	
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
<div class="portfolio-slide portfolio-slide-style2 cover-bg" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);">
	<div class="row max_width">
		<div class="small-12 medium-10 large-7 columns">
			<h1 class="animation fade-in"><a href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a></h1>
			<div class="animation fade-in excerpt"><p><?php echo esc_html(get_the_excerpt()); ?></p></div>
			<?php do_action( 'thb_portfolio_attributes', 'style2', 'medium-3', 'animation fade-in'); ?>
			<a href="<?php echo esc_url($permalink); ?>" class="btn style4 small white animation fade-in"><span><?php esc_html_e('Learn More', 'revolution'); ?></span></a>
		</div>
	</div>
</div>

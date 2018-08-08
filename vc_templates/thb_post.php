<?php function thb_post( $atts, $content = null ) {
	$style = '';
	$atts = vc_map_get_attributes( 'thb_post', $atts );
	extract( $atts );
	
	$thb_excerpt = $thb_excerpt === 'true' ? true : false;
	$thb_date = $thb_date === 'true' ? true : false;
	
 	$posts = vc_build_loop_query($source);
 	$posts = $posts[1];
 	$style = $style;
 	
 	$classes[] = 'row posts-shortcode';
 	$classes[] = 'posts-'.$style;
 	$classes[] = $style === 'style4' && $thb_carousel !== 'true' ? 'masonry' : '';
 	$classes[] = $thb_carousel === 'true' ? 'thb-carousel overflow-visible' : '';
 	$thb_columns = thb_translate_columns($columns);
 	set_query_var('columns', $thb_columns);
 	ob_start();
 	?>
 	
 	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>" data-pagination="true">
		<?php if ($posts->have_posts()) :  while ($posts->have_posts()) : $posts->the_post(); ?>
			<?php 
				set_query_var( 'thb_i', false );
				set_query_var( 'thb_date', $thb_date );
				set_query_var( 'thb_cat', $thb_cat );
				set_query_var( 'thb_excerpt', $thb_excerpt );
				set_query_var( 'thb_animation', $animation );
				get_template_part( 'inc/templates/postbit/'.$style); 
			?>
		<?php endwhile; else : endif; ?>
	</div>
	<?php
	$out = ob_get_clean();
	
	wp_reset_query();
	wp_reset_postdata();
	 
	return $out;
}
thb_add_short('thb_post', 'thb_post');
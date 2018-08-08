<?php function thb_portfolio_slider( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_portfolio_slider', $atts );
  extract( $atts );

  $source_data = VcLoopSettings::parseData( $source );
  $query_builder = new ThbLoopQueryBuilder( $source_data );
  $slider_posts = $query_builder->build();
  $slider_posts = $slider_posts[1];	
  $rand = rand(0,1000);
  
 	ob_start();
 	
 	$classes[] = 'thb-portfolio-slider';
 	$classes[] = 'thb-carousel';
 	$classes[] = $full_height;
 	$classes[] = 'thb-portfolio-slider-'.$style;
 	$classes[] = $style === 'style4' ? 'overflow-visible center-arrows' : '';
 	$classes[] = $style !== 'style4' ? 'position-arrows' : '';
 	$classes[] = $style === 'style3' ? 'thb-carousel-dark' : '';
 	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="portfolio-carousel-<?php echo esc_attr($rand); ?>" data-columns="1" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>" data-navigation="true">
			<?php if ($slider_posts->have_posts()) :  while ($slider_posts->have_posts()) : $slider_posts->the_post(); ?>
				<?php
					get_template_part( 'inc/templates/portfolio/slider/'.$style); 
				?>
			<?php endwhile; else : endif; ?>
	</div>
	 
	<?php 
   $out = ob_get_clean();
   
   wp_reset_postdata();
     
  return $out;
}
thb_add_short('thb_portfolio_slider', 'thb_portfolio_slider');
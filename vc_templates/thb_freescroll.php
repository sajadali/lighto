<?php function thb_freescroll( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_freescroll', $atts );
  extract( $atts );

  $element_id = 'thb-freescroll-' . mt_rand(10, 999);
  $el_class[] = 'thb-freescroll';
  $el_class[] = $extra_class;
  $el_class[] = $type === 'instagram' ? 'instagram-row' : '';
  $el_class[] = $type === 'portfolios' ? 'thb-portfolio' : '';
 	$out ='';
	ob_start();
	$images = explode(',',$images);
	
	$free_posts = vc_build_loop_query($source);
	$free_posts = $free_posts[1];
	?>
	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $el_class)); ?>">
		<?php
			if ($type === 'text') {
				$content = force_balance_tags($atts['text_content']);
				$content_safe = preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
				?>
				<div class="small-12 columns text-content">
					<?php echo wp_kses_post($content_safe); ?>
				</div>
				<?php
			} else if ($type === 'images') {
				foreach ($images as $image) {
					$image_link = wp_get_attachment_image_src($image, 'full');
					?>
					<figure class="<?php echo esc_attr($thb_columns); ?> columns">
						<?php echo wp_get_attachment_image($image, 'full'); ?>
					</figure>
					<?php
				}
			} else if ($type === 'instagram') {
				$instagram = thb_getInstagramPhotos($number);
				
				if ($instagram) {
					foreach ($instagram as $item) {
						?>
						<div class="<?php echo esc_attr($thb_columns); ?> columns">
							<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
								<a href="<?php echo esc_attr($item['link']); ?>" target="_blank" class="instagram-link"></a>
							<span><?php get_template_part('assets/img/svg/like.svg'); ?><em><?php echo esc_attr($item['likes']); ?></em> <?php get_template_part('assets/img/svg/comment.svg'); ?><em><?php echo esc_attr($item['comments']); ?></em></span>
							</figure>
							<figcaption><?php echo esc_html($item['caption']); ?></figcaption>
						</div>
						<?php	
					}
				}
			} else if ($type === 'blog-posts') {
				if ($free_posts->have_posts()) :  while ($free_posts->have_posts()) : $free_posts->the_post();
						set_query_var( 'columns', $thb_columns );
						set_query_var( 'thb_cat', false );
						set_query_var( 'thb_date', true );
						set_query_var( 'thb_excerpt', false );
						get_template_part( 'inc/templates/postbit/style1'); 
				endwhile; else : endif;
				wp_reset_query();
				wp_reset_postdata();
			} else if ($type === 'portfolios') {
				if ($free_posts->have_posts()) :  while ($free_posts->have_posts()) : $free_posts->the_post();
						set_query_var( 'thb_size', $thb_columns );
						get_template_part( 'inc/templates/portfolio/'.$portfolio_style); 
				endwhile; else : endif;
				wp_reset_query();
				wp_reset_postdata();
			}
		?>
	</div>
	<?php
	$out = ob_get_clean();
	return $out;
}
thb_add_short('thb_freescroll', 'thb_freescroll');
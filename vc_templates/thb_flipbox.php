<?php function thb_flipbox( $atts, $content = null ) {
	$thb_margins = $thb_arrow_color = '';
	$thb_pagination = 'true';
  $atts = vc_map_get_attributes( 'thb_flipbox', $atts );
  extract( $atts );

  $element_id = uniqid('thb-flip-box-');
  $el_class[] = 'thb-flip-box';
  $el_class[] = 'thb-flip-box-front-'.$front_text_color;
  $el_class[] = 'thb-flip-box-back-'.$back_text_color;
  $el_class[] = $extra_class;
  $front_bg_image = wpb_getImageBySize( array( 'attach_id' => $front_bg_image, 'thumb_size' => 'full' ) );
  $back_bg_image  = wpb_getImageBySize( array( 'attach_id' => $back_bg_image, 'thumb_size' => 'full' ) );
  
 	$out ='';
	ob_start();
	
	?>
	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $el_class)); ?>">
		<div class="thb-flip-box-front thb-flip-box-side">
			<div class="thb-flip-box-inner">
				<?php if ($icon_front) { get_template_part( 'assets/svg/'.$icon_front ); } ?>
				<div>
					<?php echo wp_kses_post(thb_remove_p($front_content)); ?>
				</div>
			</div>
		</div>
		<div class="thb-flip-box-back thb-flip-box-side">
			<div class="thb-flip-box-inner">
				<div>
					<?php echo wp_kses_post(thb_remove_p($back_content)); ?>
				</div>
			</div>
		</div>
		<style>
			#<?php echo esc_attr($element_id); ?> {
				min-height: <?php echo esc_html($min_height); ?>px;
			}
			#<?php echo esc_attr($element_id); ?> .thb-flip-box-front {
				background-image: url(<?php echo esc_html($front_bg_image['p_img_large'][0]); ?>);
			}
			#<?php echo esc_attr($element_id); ?> .thb-flip-box-back {
				background-image: url(<?php echo esc_html($back_bg_image['p_img_large'][0]); ?>);
			}
			<?php if ($bg_gradient1 && $bg_gradient2) { ?>
				#<?php echo esc_attr($element_id); ?> .thb-flip-box-front {
					<?php echo thb_css_gradient($bg_gradient1, $bg_gradient2, "-135", true); ?>
				}
			<?php } ?>
			<?php if ($bg_gradient3 && $bg_gradient4) { ?>
				#<?php echo esc_attr($element_id); ?> .thb-flip-box-back {
					<?php echo thb_css_gradient($bg_gradient3, $bg_gradient4, "-135", true); ?>
				}
			<?php } ?>
		</style>
	</div>
	<?php
	$out = ob_get_clean();
	return $out;
}
thb_add_short('thb_flipbox', 'thb_flipbox');
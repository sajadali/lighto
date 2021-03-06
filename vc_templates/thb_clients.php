<?php function thb_clients( $atts, $content = null ) {
	global $thb_columns, $thb_border_color, $thb_style, $thb_clients_animation;
	$atts = vc_map_get_attributes( 'thb_clients', $atts );
	extract( $atts );
	
	
	if( ! $image){
		return;
	}
	$image = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => 'full' ) );
	
	$link = vc_build_link($link);
	$link_to = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'] ? $link['target'] : '_self';	
	
	if($link['url']) {
		$el_class[] = 'has-link';
	}
	
	$el_class[] = 'thb-client';
	if ($thb_style !== 'slick') {
	$el_class[] = $thb_columns;
	}
	$el_class[] = 'columns';
	$el_class[] = $thb_clients_animation;
	$out ='';
	ob_start();
	
	
	?>
	<div class="<?php echo esc_attr(implode(' ', $el_class)); ?>" style="border-color: <?php echo esc_attr($thb_border_color); ?>">
		<?php if ($thb_style == 'style3') { ?>
			<?php if($link_to) { ?>
				<a href="<?php echo esc_url($link_to); ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo $image['thumbnail']; ?></a>
			<?php } else { ?>
				<?php echo $image['thumbnail']; ?>
			<?php } ?>
			<?php if($a_title) { ?><span class="client-title"><?php echo esc_html($a_title); ?></span><?php } ?>
		<?php } else { ?>
			<?php if($link_to) { ?>
				<a href="<?php echo esc_url($link_to); ?>" target="<?php echo esc_attr($a_target); ?>"><?php echo $image['thumbnail']; ?></a>
			<?php } else { ?>
				<?php echo $image['thumbnail']; ?>
			<?php } ?>
		<?php } ?>
	</div>
	<?php
	$out = ob_get_clean();
	return $out;
}
thb_add_short('thb_clients', 'thb_clients');
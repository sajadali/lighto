<?php
	$subfooter_classes[] = 'subfooter';
	$subfooter_classes[] = 'style2';
	$subfooter_classes[] = ot_get_option('footer_color', 'light');
	
	$full_menu_hover_style = ot_get_option('full_menu_hover_style', 'thb-standard');
	$subfooter_social_link = ot_get_option('subfooter_social_link');
	$subfooter_menu = ot_get_option('subfooter_menu');
?>
<!-- Start subfooter -->
<div class="<?php echo esc_attr(implode(' ', $subfooter_classes)); ?>">
	<div class="row align-center">
		<div class="small-12 medium-10 large-6 text-center">
			<?php do_action('thb_footer_logo', true); ?>
			<?php if ($subfooter_menu) { wp_nav_menu( array( 'menu' => $subfooter_menu, 'depth' => 1, 'menu_class' => 'thb-full-menu '. $full_menu_hover_style ) ); } ?>
			<?php echo wp_kses_post(ot_get_option('subfooter_text')); ?>
			<?php do_action('thb_social_links', $subfooter_social_link); ?>
			<?php do_action('thb_footer_payment'); ?>
		</div>
	</div>
</div>
<!-- End Subfooter -->
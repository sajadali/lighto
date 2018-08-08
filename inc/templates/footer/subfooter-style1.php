<?php
	$subfooter_classes[] = 'subfooter';
	$subfooter_classes[] = 'style1';
	$subfooter_classes[] = ot_get_option('footer_color', 'light');
	
	$subfooter_social_link = ot_get_option('subfooter_social_link');
?>
<!-- Start subfooter -->
<div class="<?php echo esc_attr(implode(' ', $subfooter_classes)); ?>">
	<div class="row">
		<div class="small-12 medium-6 columns text-center medium-text-left">
			<?php echo wp_kses_post(ot_get_option('subfooter_text')); ?>
		</div>
		<div class="small-12 medium-6 columns text-center medium-text-right">
			<?php do_action('thb_social_links', $subfooter_social_link); ?>
			<?php do_action('thb_footer_payment'); ?>
		</div>
	</div>
</div>
<!-- End Subfooter -->
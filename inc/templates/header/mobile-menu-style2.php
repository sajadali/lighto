<?php 
	$logo = ot_get_option('logo', Thb_Theme_Admin::$thb_theme_directory_uri. 'assets/img/logo.png');
	$logo_light = ot_get_option('logo_light', Thb_Theme_Admin::$thb_theme_directory_uri. 'assets/img/logo-light.png');
	
	$header_style = ot_get_option('header_style', 'light');
	$class[] = 'style2';
	$class[] = ot_get_option('mobile_menu_color', 'light');
?>
<!-- Start Content Click Capture -->
<div class="click-capture"></div>
<!-- End Content Click Capture -->
<!-- Start Mobile Menu -->
<nav id="mobile-menu" class="<?php echo esc_attr(implode(' ', $class)); ?>" data-behaviour="<?php echo esc_attr(ot_get_option('submenu_behaviour', 'thb-submenu')); ?>">
	<a class="thb-mobile-close"><div><span></span><span></span></div></a>
	<div class="custom_scroll" id="menu-scroll">
			<div class="mobile-menu-top">
				<?php do_action( 'thb_language_switcher_mobile' ); ?>
				<?php 
					if (has_nav_menu('nav-menu')) {
						wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'thb-mobile-menu', 'walker' => new thb_mobileDropdown ) ); 
					}
				?>
			</div>
			<div class="mobile-menu-bottom">
				<?php 
					if (has_nav_menu('secondary-menu')) { 
						wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'thb-secondary-menu'  ) ); 
					} 
				?>
				<?php if ($mobile_menu_footer = ot_get_option('mobile_menu_footer')) { ?>
					<div class="menu-footer">
						<?php echo do_shortcode($mobile_menu_footer); ?>
					</div>
				<?php } ?>
				<?php do_action( 'thb_social_links', ot_get_option('mobile_menu_social_link') ); ?>
			</div>
		</div>
</nav>
<!-- End Mobile Menu -->
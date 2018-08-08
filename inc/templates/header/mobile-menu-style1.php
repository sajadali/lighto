<?php 
	$logo = ot_get_option('logo', Thb_Theme_Admin::$thb_theme_directory_uri. 'assets/img/logo.png');
	$logo_light = ot_get_option('logo_light', Thb_Theme_Admin::$thb_theme_directory_uri. 'assets/img/logo-light.png');
	
	$header_style = ot_get_option('header_style', 'light');
	$class[] = 'style1';
	$class[] = ot_get_option('mobile_menu_color', 'light');
	$class[] = 'style8' === $header_style ? 'header-style8-menu custom_scroll' : '';
?>
<!-- Start Content Click Capture -->
<div class="click-capture"></div>
<!-- End Content Click Capture -->
<!-- Start Mobile Menu -->
<nav id="mobile-menu" class="<?php echo esc_attr(implode(' ', $class)); ?>" data-behaviour="<?php echo esc_attr(ot_get_option('submenu_behaviour', 'thb-submenu')); ?>">
	<a class="thb-mobile-close"><div><span></span><span></span></div></a>
	<?php if ( 'style8' === $header_style ) { ?>
		<div class="header-style-8-content">
			<div class="logo-holder">
				<a href="<?php echo esc_url(home_url()); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url($logo); ?>" class="logoimg logo-dark" alt="<?php bloginfo('name'); ?>"/>
				</a>
			</div>
			<div class="row">
				<div class="small-12 medium-6 large-3 columns">
					<?php dynamic_sidebar('header-style8-1'); ?>
				</div>
				<div class="small-12 medium-6 large-3 columns">
					<?php dynamic_sidebar('header-style8-2'); ?>
				</div>
				<div class="small-12 medium-6 large-3 columns">
				  <?php dynamic_sidebar('header-style8-3'); ?>
				</div>
			</div>
			<div class="mobile-menu-bottom">
				<?php if ($mobile_menu_footer = ot_get_option('mobile_menu_footer')) { ?>
					<div class="menu-footer">
						<?php echo do_shortcode($mobile_menu_footer); ?>
					</div>
				<?php } ?>
				<?php do_action( 'thb_social_links', ot_get_option('mobile_menu_social_link') ); ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="custom_scroll" id="menu-scroll">
			<div class="mobile-menu-top">
				<?php do_action( 'thb_language_switcher_mobile' ); ?>
				<?php 
					if (has_nav_menu('nav-menu')) {
						wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'thb-mobile-menu', 'walker' => new thb_mobileDropdown ) ); 
					}
				?>
				<?php if (has_nav_menu('secondary-menu')) {  ?>
				<span class="thb-secondary-bar"></span>
				<?php 
						wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'thb-secondary-menu'  ) ); 
					} 
				?>
			</div>
			<div class="mobile-menu-bottom">
				<?php if ($mobile_menu_footer = ot_get_option('mobile_menu_footer')) { ?>
					<div class="menu-footer">
						<?php echo do_shortcode($mobile_menu_footer); ?>
					</div>
				<?php } ?>
				<?php do_action( 'thb_social_links', ot_get_option('mobile_menu_social_link') ); ?>
			</div>
		</div>
		<?php 
			if ( 'style7' === $header_style ) {
				do_action( 'thb_mobile_toggle', false); 
			}
		?>
	<?php } ?>
</nav>
<!-- End Mobile Menu -->
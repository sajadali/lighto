<?php
if(!thb_wc_supported()) {
	return;	
}
/* Product Masonry Sizes */
function thb_get_product_size($style = 'style2', $i = 0) {
	$size = '';
	if ($style == 'style2') {
		$i = in_array($i, array('3','4','5','6','10','11','12','13','17','18','19','20')) ? 1 : 2;
		switch($i) {
			case 1:
				$size = 'large-3';
				break;
			case 2:
				$size = 'large-4';
				break;
		}
	} else if ($style == 'style3') {
		$i = in_array($i, array('4','5','6','7','8','13','14','15','16','17','22','23','24','25','26','27')) ? 1 : 2;
		switch($i) {
			case 1:
				$size = 'thb-5';
				break;
			case 2:
				$size = 'large-3';
				break;
		}
	} else if ($style == 'style4') {
		$i = in_array($i, array('5','6','7','8','9','10','16','17','18','19','20','26','27','28','29','30','31')) ? 1 : 2;
		switch($i) {
			case 1:
				$size = 'large-2';
				break;
			case 2:
				$size = 'thb-5';
				break;
		}
	} else if ($style == 'style5') {
		$i = in_array($i, array('3','4','5','6','10','11','12','13','17','18','19','20')) ? 1 : 2;
		switch($i) {
			case 2:
				$size = 'large-3';
				break;
			case 1:
				$size = 'large-4';
				break;
		}
	} else if ($style == 'style6') {
		$i = in_array($i, array('4','5','6','7','8','13','14','15','16','17','22','23','24','25','26','27')) ? 1 : 2;
		switch($i) {
			case 2:
				$size = 'thb-5';
				break;
			case 1:
				$size = 'large-3';
				break;
		}
	} else if ($style == 'style7') {
		$i = in_array($i, array('5','6','7','8','9','10','16','17','18','19','20','26','27','28','29','30','31')) ? 1 : 2;
		switch($i) {
			case 2:
				$size = 'large-2';
				break;
			case 1:
				$size = 'thb-5';
				break;
		}
	} else if ($style == 'style8') {
		$i = in_array($i, array('8', '9', '10', '19', '20', '21', '30', '31', '32')) ? 1 : 2;
		switch($i) {
			case 1:
				$size = 'large-4';
				break;
			case 2:
				$size = 'large-3';
				break;
		}
	}
	return $size;
}
/* Breadcrumbs */
function thb_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' <i>/</i> ';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'thb_change_breadcrumb_delimiter' );

/* Pagination */
function thb_woocommerce_pagination_args( $defaults ) {
	$defaults['prev_text'] = '&larr; '.esc_html__( "Prev", 'revolution' );
	$defaults['next_text'] = esc_html__( "Next", 'revolution' ).' &rarr;';
	
	return $defaults;
}
add_filter( 'woocommerce_pagination_args', 'thb_woocommerce_pagination_args' );

/* Shop Filters */
function thb_shop_filters() {
	if (is_shop() || is_product_category() || is_product_tag() ) {
	 	?>
	 	<div id="side-filters" class="side-panel">
			<header>
				<h6><?php esc_html_e('Filter','revolution'); ?></h6>
				<a href="#" class="thb-close" title="<?php esc_attr_e('Close', 'revolution'); ?>"><?php get_template_part('assets/img/svg/close.svg'); ?></a>
			</header>
			<div class="side-panel-content custom_scroll">
				<?php if ( is_active_sidebar( 'thb-shop-filters' ) ) { dynamic_sidebar( 'thb-shop-filters' ); }?>
			</div>
		</div>
		<?php
	}
}
add_action( 'thb_shop_filters', 'thb_shop_filters' );

/* Side Cart */
function thb_side_cart() {
	if ( !is_cart() && !is_checkout() ) {
	?>
	 	<nav id="side-cart" class="side-panel">
	 		<header>
				<h6><?php esc_html_e('Shopping Bag','revolution'); ?></h6>
				<a href="#" class="thb-close" title="<?php esc_attr_e('Close', 'revolution'); ?>"><?php get_template_part('assets/img/svg/close.svg'); ?></a>
			</header>
			<div class="side-panel-content">
	 			<?php if ( class_exists( 'WC_Widget_Cart' ) ) { the_widget( 'WC_Widget_Cart' ); } ?>
	 		</div>
	 	</nav>
	<?php
	}
}
add_action( 'thb_side_cart', 'thb_side_cart',3 );

/* Quick Shop */
function thb_quick_shop() {
	
	if (ot_get_option('quick_shop', 'on') === 'on') {
		$quick_shop_categories = ot_get_option('quick_shop_categories', 'on');
		$quick_shop_count = ot_get_option('quick_shop_count', 8);
		
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $quick_shop_count,
			'orderby' => 'date',
			'order' => 'desc',
			'paged' => 1
		);
		
		$quick_products = new WP_Query( $args );
		
		?>
		<a href="#" class="quick-shop"><?php esc_html_e('Quick Shop', 'revolution'); ?></a>
	 	<nav id="quick-shop" class="side-panel">
	 		<header>
				<h6><?php esc_html_e('Quick Shop','revolution'); ?></h6>
				<a href="#" class="thb-close" title="<?php esc_attr_e('Close', 'revolution'); ?>"><?php get_template_part('assets/img/svg/close.svg'); ?></a>
			</header>
			<div class="side-panel-content">
				<?php if ($quick_shop_categories === 'on') { ?>
					<select id="thb-quick-shop-categories">
						<option value=""><?php echo esc_html_e('Categories', 'revolution'); ?></option>
						<?php
							$categories = thb_productCategories();
							foreach ($categories as $category => $slug) {
								?>
								<option value="<?php echo esc_attr($slug); ?>"><?php echo esc_html($category); ?></option>
								<?php
							}
						?>
					</select>
				<?php } ?>
				<div class="product_container custom_scroll">
					<ul class="products row">
					<?php 
						set_query_var( 'thb_columns', 'medium-6');
		 				if ($quick_products->have_posts()) :  while ($quick_products->have_posts()) : $quick_products->the_post();
		 					wc_get_template_part( 'content', 'product' );
		 				endwhile; else : endif; 
		 				set_query_var( 'thb_columns', false);
		 			?>
		 			</ul>
	 			</div>
	 		</div>
	 	</nav>
		<?php
	}
}
add_action( 'thb_quick_shop', 'thb_quick_shop', 10 );

/* Header Cart */
function thb_quick_cart() {
	if ('on' === ot_get_option('header_cart', 'on') ) {
	?>
		<div id="quick_cart" data-target="open-cart" title="<?php esc_attr_e('Cart','revolution'); ?>">
			<?php get_template_part('assets/svg/ecommerce_bag.svg'); ?> <span class="float_count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
		</div>
	<?php
	}
}
add_action( 'thb_quick_cart', 'thb_quick_cart',3 );

/* Out of Stock Check */
function thb_out_of_stock() {
  global $post;
  $id = $post->ID;
  $status = get_post_meta($id, '_stock_status',true);
  
  if ($status == 'outofstock') {
  	return true;
  } else {
  	return false;
  }
}

/* Product Badges */
function thb_product_badge() {
 global $post, $product;
 	if (thb_out_of_stock()) {
		echo '<span class="badge out-of-stock">' . esc_html__( 'Out of Stock', 'revolution' ) . '</span>';
	} else if ( $product->is_on_sale() ) {
		if (ot_get_option('shop_sale_badge', 'text') == 'discount') {
			if ($product->product_type == 'variable') {
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1 ->regular_price;
					$sales_price = $variable_product1 ->sale_price;
					$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);
			} else if ($product->product_type == 'simple'){
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			} else if ($product->product_type == 'external'){
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			}
		} else {
			echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'. esc_html__( 'Sale','revolution' ).'</span>', $post, $product);
		}
	} else {
		$postdate 		= get_the_time( 'Y-m-d' );			// Post date
		$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
		$newness = ot_get_option('shop_newness', 7);
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
			echo '<span class="badge new">' . esc_html__( 'Just Arrived', 'revolution' ) . '</span>';
		}
		
	}
}
add_action( 'thb_product_badge', 'thb_product_badge',3 );

/* WOOCOMMERCE CART LINK */
function thb_woocomerce_ajax_cart_update($fragments) {
	ob_start();
	?>
		<span class="float_count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
	<?php
	$fragments['.float_count'] = ob_get_clean();
	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update');

/* Image Dimensions */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'thb_woocommerce_image_dimensions', 1 );

function thb_woocommerce_image_dimensions() {
  $catalog = array(
		'width' 	=> '600',	// px
		'height'	=> '750',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '1000',	// px
		'height'	=> '1250',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '150',	// px
		'height'	=> '150',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
/* WishList Button*/
function thb_wishlist_button() {
	if ( class_exists( 'YITH_WCWL_UI' ) )  {
		global $product; 
		$url = YITH_WCWL()->get_wishlist_url();
		$product_type = $product->get_type();
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;
		
		if( ! empty( $default_wishlists ) ){
			$default_wishlist = $default_wishlists[0]['ID'];
		}
		else{
			$default_wishlist = false;
		}

		$exists = YITH_WCWL()->is_product_in_wishlist( $product->get_id(), $default_wishlist );
		
		
		$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'add_to_wishlist single_add_to_wishlist button alt' : 'add_to_wishlist';
		
		$html  = '<div class="yith-wcwl-add-to-wishlist add-to-wishlist-'.$product->get_id().'">'; 
    $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row
    
    $html .= $exists ? ' hide" style="display:none;"' : ' show"';
    
    $html .= '><a href="' . esc_url( add_query_arg( 'add_to_wishlist', $product->get_id() ) ) . '" data-product-id="' . esc_attr($product->get_id()) . '" data-product-type="' . esc_attr($product_type) . '" class="' . esc_attr($classes) . '"><span class="text">'.esc_html__( "Add To Wishlist", 'revolution' ).'</span>'.thb_load_template_part('assets/img/svg/wishlist.svg').'</a>';
    $html .= '</div>';
		
		$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url(esc_url($url)) . '"><span class="text">'.esc_html__( "Added to Wishlist", 'revolution' ).'</span>'.thb_load_template_part('assets/img/svg/wishlist.svg').'</a></div>';
		
		$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url($url) . '"><span class="text">'.esc_html__( "View Wishlist", 'revolution' ).'</span>'.thb_load_template_part('assets/img/svg/wishlist.svg').'</a></div>';
		
		$html .= '</div>';
		
		echo $html;
		
	}

}
/* Wishlist */
add_action('woocommerce_single_product_summary', 'thb_wishlist_button', 38);

/* Sharing */
add_action('woocommerce_single_product_summary', 'thb_social_article_detail', 39);

/* Sizing Guide */
function thb_sizing_guide() {
	$sizing_guide = get_post_meta(get_the_ID(), 'sizing_guide', true);
	$sizing_guide_content = get_post_meta(get_the_ID(), 'sizing_guide_content', true);
	
	if ($sizing_guide == 'on') {
		?>
		<a href="#sizing-popup" class="sizing_guide mfp-inline">
			<?php get_template_part('assets/img/svg/sizing_guide.svg'); ?>
			<?php esc_html_e("Sizing Guide", 'revolution'); ?>
		</a>
		<aside id="sizing-popup" class="mfp-hide theme-popup text-left">
			<div class="theme-popup-content">
				<?php echo do_shortcode($sizing_guide_content); ?>
			</div>
		</aside>
		<?php
	}
}
add_action('woocommerce_single_product_summary', 'thb_sizing_guide', 37);

/* Menu Icon Modification */
function thb_new_menu_items( $items ) {
		unset($items['dashboard']);
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'thb_new_menu_items' );

/* Shop Headers */
add_action( 'woocommerce_before_main_content', function() { 
	if (is_shop() || is_archive()) { 
		return get_template_part( 'inc/templates/header/header-shop-filters' ); 
	} 
}, 5 );

/* Shop Page - Remove orderby & breadcrumb */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'thb_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

/* Shop Page - Remove Breadcrumb */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action( 'thb_breadcrumbs', 'woocommerce_breadcrumb', 20);

/* Category Text */
function thb_before_subcategory_title() {
	echo '<div>';
}
add_action( 'woocommerce_before_subcategory_title', 'thb_before_subcategory_title', 15 );
function thb_subcategory_title() {
	echo '<span>'.esc_html__('Explore Now','revolution').'</span>';
}
add_action( 'woocommerce_shop_loop_subcategory_title', 'thb_subcategory_title', 15 );
function thb_after_subcategory_title() {
	echo '</div>';
}
add_action( 'woocommerce_after_subcategory_title', 'thb_after_subcategory_title', 15 );
function thb_subcategory_count_html($markup, $category) {
	return '<mark class="count">' . $category->count . '</mark>';
}
add_filter( 'woocommerce_subcategory_count_html', 'thb_subcategory_count_html', 10, 2 );

/* Change Category Thumbnail Size */
function thb_template_loop_category_link_open($category) {
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, 'full'  );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}
	echo '<a href="' . get_term_link( $category, 'product_cat' ) . '" style="background-image:url('.esc_url($image).')">';
}
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
add_action( 'woocommerce_before_subcategory', 'thb_template_loop_category_link_open', 10);

/* Cart Page - Move Crosssells */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

/* Checkout */
add_action('woocommerce_checkout_before_customer_details', function() {
	echo '<div class="row"><div class="small-12 large-8 columns">';
}, 5);

add_action('woocommerce_checkout_after_customer_details', function() {
	echo '</div><div class="small-12 large-4 columns">';
}, 30);

add_action('woocommerce_checkout_after_order_review', function() {
	echo '</div></div>';
}, 30);

/* Product Page */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
//woocommerce_before_shop_loop_item
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

//woocommerce_after_shop_loop_item
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

//woocommerce_after_shop_loop_item_title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop_item_title_loop_price', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title_loop_rating', 'woocommerce_template_loop_rating', 5 );

// Add Breadcrumb
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 0 );

// Remove Sidebar
add_action('template_redirect', function() {
  if ( is_product() ) {
      remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
  }
}, 0 );

// Product gallery/information layout
add_action( 'woocommerce_before_single_product_summary', function() {
	
	$shop_product_style = isset($_GET['shop_product_style']) ? wp_unslash($_GET['shop_product_style']) : ot_get_option('shop_product_style', 'style1');
	
	$class = $shop_product_style === 'style4' ? 'large-7' : 'large-6';
	
	?>
	<div class="row align-center">
		<div class="small-12 <?php echo esc_attr($class); ?> columns">
	<?php
}, 0 );
add_action( 'woocommerce_before_single_product_summary', function() {
	
	$shop_product_style = isset($_GET['shop_product_style']) ? wp_unslash($_GET['shop_product_style']) : ot_get_option('shop_product_style', 'style1');

	switch($shop_product_style) {
		case 'style1':
			$class = 'large-4';
			break;
		case 'style4':
		case 'style3':
			$class = 'large-5';
			break;
		default:
			$class = 'large-6';
	}
	?>
		</div>
		<div class="small-12 <?php echo esc_attr($class); ?> columns product-information">
	<?php
}, 100 );
add_action( 'woocommerce_after_single_product_summary', function() {
	?>
		</div>
	</div>
	<?php
}, 0 );

/* My Account Content */
add_action( 'woocommerce_account_content', function() {
	?>
	<div class="row align-center">
		<div class="small-12 large-10 columns">
	<?php
}, 0 );
add_action( 'woocommerce_account_content', function() {
	?>
		</div>
	</div>
	<?php
}, 100 );

/* Wishlist */
add_action( 'yith_wcwl_before_wishlist_form', function() {
	?>
	<div class="page-padding">
		<div class="row">
			<div class="small-12 columns">
				<div class="post-content no-vc">
	<?php
}, 0 );
add_action( 'yith_wcwl_after_wishlist_form', function() {
	?>
				</div>
			</div>
		</div>
	</div>
	<?php
}, 0 );
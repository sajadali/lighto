<?php
function thb_get_masonry_size($size = '') {
	$class_image = array();
	switch($size) {
		case 'large':
			$class_image['class'] = 'small-12 medium-6 large-6 masonry-large';
			$class_image['image_size'] = 'revolution-square-x3';
			break;
		case 'wide':
			$class_image['class'] = 'small-12 medium-6 large-6 masonry-wide';
			$class_image['image_size'] = 'revolution-wide-x2';
			break;
		case 'tall':
			$class_image['class'] = 'small-12 medium-6 large-3 masonry-tall';
			$class_image['image_size'] = 'revolution-tall-x2';
			break;
		case 'small':
		default:
			$class_image['class'] = 'small-12 medium-6 large-3 masonry-small';
			$class_image['image_size'] = 'revolution-square-x2';
			break;
	}
	return $class_image;
}

/* Portfolio Categories Array */
function thb_portfolioCategories(){
	$portfolio_categories = get_terms('portfolio-category', array('hide_empty' => false));
	$out = array();
	if (empty($portfolio_categories->errors)) {
		foreach($portfolio_categories as $portfolio_category) {
			$out[$portfolio_category->name] = $portfolio_category->term_id;
		}
	}
	return $out;
}

/* Header Filter */
function thb_portfolio_categories($categories, $id, $style, $portfolio_id_array = false) {
	
	if (!empty($categories) || $categories) { 
		$portfolio_id_array = $portfolio_id_array ? $portfolio_id_array : array();
		
		?>
		<nav class="thb-portfolio-filter <?php echo esc_attr($style); ?>" id="thb-filter-<?php echo esc_attr($id); ?>">
			<?php if ($style === 'style1') { ?>
			<ul>
				<li><a data-filter="*" class="active"><?php esc_html_e('All', 'revolution'); ?></a></li>
				<?php 
					 foreach ($categories as $cat) {
					 	$term = get_term($cat);
	
					 	$args = array(
					 		'include' => implode(",", $portfolio_id_array),
					 		'post_type' => 'portfolio',
					 		'tax_query' => array(
					 				array(
					 					'taxonomy' => 'portfolio-category',
					 					'field' => 'slug',
					 					'terms' => array($term->slug),
					 					        'operator' => 'IN'
					 				)
					 			)
					 	);
					 	echo '<li><a data-filter=".thb-cat-' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</a></li>';
					 }
				?>
			</ul>
			<?php } else if ($style === 'style2') { ?>
			<span class="thb-filter-by"><?php esc_html_e('Filter by', 'revolution'); ?></span>
			<select class="thb-select2">
				<option value="*" selected><?php esc_html_e('All', 'revolution'); ?></option>
				<?php 
					 foreach ($categories as $cat) {
					 	$term = get_term($cat);
	
					 	$args = array(
					 		'include' => implode(",", $portfolio_id_array),
					 		'post_type' => 'portfolio',
					 		'tax_query' => array(
					 				array(
					 					'taxonomy' => 'portfolio-category',
					 					'field' => 'slug',
					 					'terms' => array($term->slug),
					 					        'operator' => 'IN'
					 				)
					 			)
					 	);
					 	echo '<option value=".thb-cat-' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
					 }
				?>
			</select>
			<?php } ?>
		</nav>
		<?php
	}
}
add_action( 'thb-render-filter', 'thb_portfolio_categories', 1, 4 );


/* Portfolio Attributes */
function thb_portfolio_attributes($style, $columns, $animation) {
	$id = get_the_ID();
	$client_more = get_post_meta($id, 'client_more', true);
	
	$classes[] = 'portfolio-attributes';
	$classes[] = $style;
	$classes[] = 'row';
	
	$attr_classes[] = 'attribute';
	$attr_classes[] = isset($columns) ? 'small-12 '.$columns : 'small-12';
	$attr_classes[] = 'columns';
	$attr_classes[] = $animation;
	?>
	<?php if ( !empty( $client_more ) ) { ?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
			<?php foreach ($client_more as $more ) { ?>
				<div class="<?php echo esc_attr(implode(' ', $attr_classes)); ?>">
					<h6><?php echo esc_attr($more['title']); ?>: </h6>
					<?php if ($more['client_custom_link'] !=='') { ?>
						<a href="<?php echo esc_html($more['client_custom_link']); ?>" target="_blank">
					<?php } ?>
						<?php echo wp_kses_post(apply_filters('the_content',$more['client_custom_value'])); ?>
					<?php if ($more['client_custom_link'] !=='') { ?>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php
	}
}
add_action( 'thb_portfolio_attributes', 'thb_portfolio_attributes', 3, 3 );

/* Social Sharing */
function thb_social_article_detail() {
	$id = get_the_ID();
	$sharing_type = ot_get_option('sharing_buttons', array());
?>
<?php if (!empty($sharing_type)) { ?>
<aside class="share_wrapper">
	<a href="#" class="share-post-link"><?php get_template_part('assets/img/svg/share.svg'); ?><span><?php esc_html_e('Share', 'revolution'); ?></span></a>
	<?php
	function thb_add_shareform($id) { 
		$permalink = get_permalink($id);
		$title = the_title_attribute(array('echo' => 0, 'post' => $id) );
		$image_id = get_post_thumbnail_id($id);
		$image = wp_get_attachment_image_src($image_id, 'full');
		$twitter_user = ot_get_option('twitter_bar_username', 'anteksiler');
		$sharing_type = ot_get_option('sharing_buttons', array());
	?>
		<div class="share_container">
			<div class="spacer"></div>
			<div class="vcenter">
				<div class="product_share">
					<h4><?php esc_html_e('Share This', 'revolution'); ?></h4>
					<?php if (in_array('facebook',$sharing_type)) { ?>
					<a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="social facebook boxed-icon white-fill"><i class="fa fa-facebook"></i></a>
					<?php } ?>
					<?php if (in_array('twitter',$sharing_type)) { ?>
					<a href="<?php echo esc_url('https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . urlencode( get_bloginfo( 'name' ) ) . ''); ?>" class="social twitter boxed-icon white-fill"><i class="fa fa-twitter"></i></a>
					<?php } ?>
					<?php if (in_array('pinterest',$sharing_type)) { ?>
					<a href="<?php echo esc_url('http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '&description='.htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8')); ?>" class="social pinterest boxed-icon white-fill" nopin="nopin" data-pin-no-hover="true"><i class="fa fa-pinterest"></i></a>
					<?php } ?>
					<?php if (in_array('google-plus',$sharing_type)) { ?>
					<a href="<?php echo esc_url('http://plus.google.com/share?url=' . esc_url( $permalink ) . ''); ?>" class="social google-plus boxed-icon white-fill"><i class="fa fa-google-plus"></i></a>
					<?php } ?>
					<?php if (in_array('linkedin',$sharing_type)) { ?>
					<a href="<?php echo esc_url('https://www.linkedin.com/cws/share?url=' . esc_url( $permalink ) . ''); ?>" class="social linkedin boxed-icon white-fill"><i class="fa fa-linkedin"></i></a>
					<?php } ?>
					<?php if (in_array('whatsapp',$sharing_type)) { ?>
					<a href="<?php echo esc_url('whatsapp://send?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . ''); ?>" class="whatsapp social boxed-icon white-fill" data-href="<?php echo esc_url( $permalink ); ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
					<?php } ?>
					<?php if (in_array('facebook-messenger',$sharing_type)) { ?>
						<?php $fb_app_id = ot_get_option('facebook_app_id'); ?>
					<a href="<?php echo 'fb-messenger://share/?link=' . esc_url( $permalink ) . '&app_id='.esc_url($fb_app_id); ?>" class="facebook-messenger social boxed-icon white-fill"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="96 93 322 324"><path d="M257 93c-88.918 0-161 67.157-161 150 0 47.205 23.412 89.311 60 116.807V417l54.819-30.273C225.449 390.801 240.948 393 257 393c88.918 0 161-67.157 161-150S345.918 93 257 93zm16 202l-41-44-80 44 88-94 42 44 79-44-88 94z" /></svg></a>
					<?php } ?>
					<?php if (in_array('vkontakte',$sharing_type)) { ?>
					<a href="<?php echo esc_url('http://vk.com/share.php?url=' . esc_url( $permalink ) . ''); ?>" class="social vk boxed-icon white-fill"><i class="fa fa-vk"></i></a>
					<?php } ?>
					<?php if (in_array('email',$sharing_type)) { ?>
					<a href="<?php echo esc_url('mailto:?Subject=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . ''); ?>" class="email social boxed-icon white-fill"><i class="fa fa-envelope"></i></a>
					<?php } ?>
				</div>
				<div class="product_copy">
					<h4><?php esc_html_e('Copy Link to Clipboard', 'revolution'); ?></h4>
					<form>
						<input type="text" class="copy-value" value="<?php the_permalink(); ?>" readonly/>
						<a class="btn"><?php esc_html_e('Copy', 'revolution'); ?></a>
					</form>
				</div>
			</div>
		</div>
	<?php
	}
	add_action( 'wp_footer', 'thb_add_shareform', 100, 1 );
	?>
</aside>
<?php } ?>
<?php
}
add_action( 'thb_social_article_detail', 'thb_social_article_detail', 3, 3 );

/* Portfolio Share */
function thb_portfolio_share($widget_title,$sharing_type, $thb_alignment) {
	$id = get_the_ID();
	$permalink = get_permalink($id);
	$title = the_title_attribute(array('echo' => 0, 'post' => $id) );
	$image_id = get_post_thumbnail_id($id);
	$image = wp_get_attachment_image_src($image_id,'full');
	$twitter_user = ot_get_option('twitter_bar_username', 'anteksiler');
	?>
	<div class="thb-share-icons <?php echo esc_attr($thb_alignment); ?>">
		<?php if ($widget_title) { ?><h6><?php echo esc_html($widget_title); ?></h6><?php } ?>
		<ul>
			<?php if (in_array('facebook',$sharing_type)) { ?>
			<li><a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="boxed-icon social facebook"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
			<?php if (in_array('twitter',$sharing_type)) { ?>
			<li><a href="<?php echo 'https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . ''; ?>" class="boxed-icon social twitter"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>
			<?php if (in_array('pinterest',$sharing_type)) { ?>
			<li><a href="<?php echo 'http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '&description='.htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" class="boxed-icon social pinterest" nopin="nopin" data-pin-no-hover="true"><i class="fa fa-pinterest"></i></a></li>
			<?php } ?>
			<?php if (in_array('google-plus',$sharing_type)) { ?>
			<li><a href="<?php echo 'http://plus.google.com/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon social google-plus"><i class="fa fa-google-plus"></i></a></li>
			<?php } ?>
			<?php if (in_array('linkedin',$sharing_type)) { ?>
			<li><a href="<?php echo 'https://www.linkedin.com/cws/share?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon social linkedin"><i class="fa fa-linkedin"></i></a></li>
			<?php } ?>
			<?php if (in_array('whatsapp',$sharing_type)) { ?>
			<li><a href="<?php echo 'whatsapp://send?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . ''; ?>" class="boxed-icon whatsapp social" data-href="<?php echo esc_url( $permalink ); ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a></li>
			<?php } ?>
			<?php if (in_array('facebook-messenger',$sharing_type)) { ?>
				<?php $fb_app_id = ot_get_option('facebook_app_id'); ?>
			<li><a href="<?php echo 'fb-messenger://share/?link=' . esc_url( $permalink ) . '&app_id='.esc_url($fb_app_id); ?>" class="boxed-icon facebook-messenger social"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="96 93 322 324"><path d="M257 93c-88.918 0-161 67.157-161 150 0 47.205 23.412 89.311 60 116.807V417l54.819-30.273C225.449 390.801 240.948 393 257 393c88.918 0 161-67.157 161-150S345.918 93 257 93zm16 202l-41-44-80 44 88-94 42 44 79-44-88 94z" /></svg></a></li>
			<?php } ?>
			<?php if (in_array('vkontakte',$sharing_type)) { ?>
			<li><a href="<?php echo 'http://vk.com/share.php?url=' . esc_url( $permalink ) . ''; ?>" class="boxed-icon social vk"><i class="fa fa-vk"></i></a></li>
			<?php } ?>
			<?php if (in_array('email',$sharing_type)) { ?>
			<li><a href="<?php echo 'mailto:?subject=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&body='.urlencode( esc_url( $permalink ) ); ?>" class="boxed-icon email social"><i class="fa fa-envelope"></i></a></li>
			<?php } ?>
		</ul>
	</div>
	<?php
}
add_action( 'thb_portfolio_share', 'thb_portfolio_share', 3, 3 );

/* Article Prev/Next */
function thb_portfolio_nav() {

	if ('on' !== ot_get_option('portfolio_nav', 'on')) { return; }
	
	$portfolio_nav_style = ot_get_option('portfolio_nav_style', 'style3');
	$in_same_term = false;
	$prev = get_adjacent_post( $in_same_term, false, true, 'portfolio-category' );
	$next = get_adjacent_post( $in_same_term, false, false, 'portfolio-category' );	
	?>
	<div class="thb_portfolio_nav <?php echo esc_attr($portfolio_nav_style); ?>">
		<?php if ('style1' === $portfolio_nav_style) { ?>
			<div class="row full-width-row no-row-padding no-padding">
				<div class="small-12 columns">
					<?php
						if ($prev) { 
						$image_id = get_post_thumbnail_id($prev->ID);
					?>
						<a href="<?php echo esc_url(get_permalink($prev->ID)); ?>" class="post_nav_link prev">
							<strong>
								<span class="next">
									<?php esc_html_e('Next Project', 'revolution'); ?>
									<span class="title"><?php echo esc_html($prev->post_title); ?></span>
								</span>
							</strong>
							<?php if ($image_id) { ?><div class="inner"><?php echo wp_get_attachment_image($image_id, 'revolution-bloglarge-x2')?></div><?php } ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } else if ('style2' === $portfolio_nav_style) { ?>
			<div class="row full-width-row no-row-padding no-padding">
				<div class="small-12 medium-6 columns">
					<?php
						if ($prev) {
							$image_id = get_post_thumbnail_id($prev->ID);
						?>
						<a href="<?php echo esc_url(get_permalink($prev->ID)); ?>" class="post_nav_link prev">
							<strong>
								<?php esc_html_e('(p) Previous', 'revolution'); ?>
							</strong>
							<div>
								<span><?php echo esc_html($prev->post_title); ?></span>
								<em><?php esc_html_e('View Portfolio', 'revolution'); ?></em>
							</div>
							<?php if ($image_id) { ?><div class="inner"><?php echo wp_get_attachment_image($image_id, 'revolution-bloglarge-x2')?></div><?php } ?>
						</a>
					<?php } ?>
				</div>
				<div class="small-12 medium-6 columns">
					<?php
						if ($next) {
							$image_id = get_post_thumbnail_id($next->ID);
						?>
						<a href="<?php echo esc_url(get_permalink($next->ID)); ?>" class="post_nav_link next">
							<strong>
								<?php esc_html_e('Next (n)', 'revolution'); ?>
							</strong>
							<div>
								<span><?php echo esc_html($next->post_title); ?></span>
								<em><?php esc_html_e('View Portfolio', 'revolution'); ?></em>
							</div>
							<?php if ($image_id) { ?><div class="inner"><?php echo wp_get_attachment_image($image_id, 'revolution-bloglarge-x2')?></div><?php } ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } else if ('style3' === $portfolio_nav_style) { ?>
			<div class="row">
				<div class="small-12 columns">
					<p><?php esc_html_e('More Works', 'revolution'); ?></p>
					<ul>
					<?php 
						$count = ot_get_option('portfolio_nav_count', '10');
						$post_id = get_the_ID();
						$args = array(
							'posts_per_page' => $count,
							'post__not_in' => array($post_id),
							'post_type' => 'portfolio',
							'post_status' => 'publish'
						);
						$more_posts = new WP_Query($args);
						
						if ($more_posts->have_posts()) :  while ($more_posts->have_posts()) : $more_posts->the_post();
							$image_id = get_post_thumbnail_id();
							$image_link = wp_get_attachment_image_src($image_id, 'revolution-bloglarge-x2');
							?>
								<li>
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<?php $images[] = $image_id ? $image_id : ''; ?>
								</li>
								
							<?php
						endwhile; else : endif;	
						
					?>
					</ul>
				</div>
			</div>
			<?php $i = 0; foreach ($images as $image) { ?>
				<div class="inner <?php if (!$i) { ?>active<?php } ?>"><?php echo wp_get_attachment_image($image, 'revolution-bloglarge-x2')?></div>
			<?php $i++; } ?>
		<?php } else if ('style4' === $portfolio_nav_style) { ?>
			<div class="row">
				<div class="small-6 columns">
					<?php
						if ($prev) {
						?>
						<a href="<?php echo esc_url(get_permalink($prev->ID)); ?>" class="post_nav_link prev">
							<?php get_template_part( 'assets/img/svg/prev_arrow.svg' ); ?>
							<span><?php echo esc_html($prev->post_title); ?></span>
						</a>
					<?php
					}
					?>
				</div>
				<div class="small-6 columns">
					<?php
					if ($next) {
					?>
						<a href="<?php echo esc_url(get_permalink($next->ID)); ?>" class="post_nav_link next">
							<span><?php echo esc_html($next->post_title); ?></span>
							<?php get_template_part( 'assets/img/svg/next_arrow.svg' ); ?>
						</a>
					<?php
					}
					?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_portfolio_nav', 'thb_portfolio_nav' );

/* Portfolio Video Header */
function thb_portfolio_video() {
	$id = get_the_ID();
	$portfolio_header_video = get_post_meta($id, 'portfolio_header_video', true);
	$portfolio_header_video_url = wp_get_attachment_url($portfolio_header_video);
	if ($portfolio_header_video_url) {
		$portfolio_header_video_poster = get_post_meta($id, 'portfolio_header_video_poster', true);
		$portfolio_header_video_poster_url = wp_get_attachment_url($portfolio_header_video_poster);
		$video_type = wp_check_filetype( $portfolio_header_video_url, wp_get_mime_types() );
		$poster_type = wp_check_filetype( $portfolio_header_video_poster_url, wp_get_mime_types() );
		$portfolio_header_video_loop = get_post_meta($id, 'portfolio_header_video_loop', true) !== 'off' ? 'true' : 'false';
	
		$attributes[] = 'data-vide-bg="'.$video_type['ext'].': '. esc_attr($portfolio_header_video_url) . ($portfolio_header_video_poster_url ? ', poster: '.esc_attr($portfolio_header_video_poster_url) : '').'"';
		
		$attributes[] = 'data-vide-options="posterType: ' . ( $poster_type['ext'] ? esc_attr($poster_type['ext']) : 'none' ) . ', loop: '.$portfolio_header_video_loop.', muted: true, position: 50% 50%, resizing: true"';
	} else {
		$attributes[] = '';
	}
	return $attributes;
}

/* Disable GIF Sizes */
function thb_disable_gif_sizes( $sizes, $metadata ) {

    // Get filetype data.
    $filetype = wp_check_filetype($metadata['file']);

    // Check if is gif. 
    if($filetype['type'] == 'image/gif') {
        // Unset sizes if file is gif.
        $sizes = array();
    }

    // Return sizes you want to create from image (None if image is gif.)
    return $sizes;
}   
add_filter('intermediate_image_sizes_advanced', 'thb_disable_gif_sizes', 10, 2); 
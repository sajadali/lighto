<?php
	$thb_id = get_the_ID();
	$post_header_bg = get_post_meta($thb_id, 'post_header_bg', true);
?>
<figure class="post-gallery parallax post-gallery-detail">
	<div class="parallax_bg">
		<?php if ($post_header_bg) { ?>
			<style>
				.post-<?php echo esc_attr($thb_id); ?> .parallax_bg {
					<?php thb_bgecho($post_header_bg); ?>
				}
			</style>
		<?php } else { the_post_thumbnail('revolution-wide-3x'); }?>
	</div>
	<div class="header-spacer-force"></div>
	<header class="post-title entry-header animation bottom-to-top-3d">
		<div class="row align-center">
			<div class="small-12 medium-10 large-7 columns">
				<aside class="post-category">
					<?php the_category(', '); ?>
				</aside>
				<?php the_title('<h1 class="entry-title" itemprop="name headline">', '</h1>'); ?>
				<aside class="post-meta">
					<?php the_author_posts_link(); ?> <?php esc_html_e('on', 'revolution'); ?> <?php echo get_the_date(); ?>
				</aside>
			</div>
		</div>
	</header>
</figure>
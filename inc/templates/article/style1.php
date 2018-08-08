<?php
	$article_sidebar = ot_get_option('article_sidebar', 'on');
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-detail style1-detail'); ?>>
	<?php
	  // The following determines what the post format is and shows the correct file accordingly
	  $format = get_post_format();
	  if (in_array($format, array('gallery', 'video'))) {
	  	get_template_part( 'inc/templates/postformats/'.$format );
	  } else {
	  	get_template_part( 'inc/templates/postformats/standard' );
	  }
	?>
	<div class="row align-center">
		<div class="small-12 medium-10 large-7 columns">
			<div class="post-content">
				<?php if (in_array($format, array('gallery', 'video'))) { ?>
				<header class="post-title entry-header animation bottom-to-top-3d">
					<aside class="post-category">
						<?php the_category(', '); ?>
					</aside>
					<?php the_title('<h1 class="entry-title" itemprop="name headline">', '</h1>'); ?>
					<aside class="post-meta">
						<?php the_author_posts_link(); ?> <?php esc_html_e('on', 'revolution'); ?> <?php echo get_the_date(); ?>
					</aside>
				</header>
				<?php } ?>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?> 
			</div>
			<?php get_template_part( 'inc/templates/blog/post-tags'); ?>
		</div>
		<?php if ($article_sidebar === 'on') { get_sidebar('single'); } ?>
	</div>
	<?php get_template_part( 'inc/templates/blog/post-end'); ?>
	<?php do_action( 'thb_PostMeta' ); ?>
</article>
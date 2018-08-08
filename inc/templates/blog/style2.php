<div class="blog-container page-padding">
	<?php 
		$blog_pagination_style = is_home() ? ot_get_option('blog_pagination_style', 'style1') : 'style1'; 
		$blog_animation = ot_get_option('blog_animation', '');	
		set_query_var( 'thb_animation', $blog_animation );
	?>
	<div class="row align-center <?php echo esc_attr('pagination-'.$blog_pagination_style); ?>">
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
			<?php 
				get_template_part( 'inc/templates/postbit/style2'); 
			?>
		<?php endwhile; else : ?>
		  <?php get_template_part( 'inc/templates/not-found' ); ?>
		<?php endif; ?>
	</div>
	<?php do_action('thb_blog_pagination'); ?>
</div>
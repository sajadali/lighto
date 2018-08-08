<div class="thb-page-header">
	<h1><?php 
			if (is_archive()) {
				echo single_term_title();
			} else if (is_search()) {
				esc_html_e('Search Results for: ', 'revolution');
				the_search_query();
			} else {
				single_post_title();
			}
		?></h1>
	<?php
		$blog_header_categories = ot_get_option('blog_header_categories');
		
		if ($blog_header_categories) {
			?>
			<ul class="thb-blog-categories">
			<?php
			foreach ($blog_header_categories as $cat) {
				$category = get_term_by('id', $cat, 'category');
				?>
					<li><a href="<?php echo esc_url(get_category_link($cat)); ?>"><?php echo esc_html($category->name); ?></a></li> 
				<?php
			}	
			?>
			</ul>
			<?php
		}
	?>
</div>
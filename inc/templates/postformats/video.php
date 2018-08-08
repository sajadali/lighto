<figure class="post-gallery post-gallery-detail">
	<?php 
		global $wp_embed;
		$id = get_the_ID();
		$embed = get_post_meta($id , 'post_video', TRUE); 
	
	?>
	<?php if ($embed !='') { ?>
	  <?php echo $wp_embed->run_shortcode('[embed]'.$embed.'[/embed]'); ?>
	<?php } ?>
</figure>
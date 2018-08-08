<?php get_header(); ?>
<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
<?php
	get_template_part( 'inc/templates/article/style1');
?>
<?php if ( comments_open() || get_comments_number() ) : ?>
<!-- Start #comments -->
<?php comments_template('', true); ?>
<!-- End #comments -->
<?php endif; ?>
<?php endwhile; else : endif; ?>
<?php get_footer(); ?>

<?php get_header(); ?>

<section id="main" role="main">
	
	<div class="wrapper">

		<!-- Page title (if applicable) -->	
		<?php if(is_search()): ?>
			<h2 class="page-title">Search results for &ldquo;<?php the_search_query(); ?>:&rdquo;</h2>
		<?php elseif(is_404()): ?>
			<h2 class="page-title">Sorry, this page doesn't exist.</h2>
		<?php elseif(is_category()): ?>
			<h2 class="page-title">Categorized &ldquo;<?php echo single_cat_title( '', false ); ?>:&rdquo;</h2>
		<?php elseif(is_tag()): ?>
			<h2 class="page-title">Tagged &ldquo;<?php echo single_tag_title( '', false ); ?>:&rdquo;</h2>
		<?php endif; ?>
	
		<!-- Loop -->
		<?php get_template_part('loop','portfolio'); ?>
		
	</div><!-- end .wrapper -->
	
</section><!--#main-->

<?php get_Footer(); ?>
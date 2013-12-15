<?php get_header(); ?>

<section id="main" role="main">
	
	<div class="wrapper">

		<!-- feature image (if homepage) -->
		<?php 
		/*
			$pageNum = (get_query_var('paged')) ? get_query_var('paged') : 1;
			if(is_home() && $pageNum == 1){
				jr_load_featured_image();
			} elseif((is_single() || is_page()) && has_post_thumbnail()){
				get_template_part('loop','featimage'); 
			}
		*/
		?>
	
		<!-- Loop -->	
		<?php 
			if(is_page() || is_single()){
				get_template_part('loop','posts'); 
			} else{
				get_template_part('loop','postexcerpt'); 
			}
		
		?>
	
	</div><!-- end .wrapper -->
	
</section><!--#main-->

<?php get_Footer(); ?>
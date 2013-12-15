<article class="article">
	
	<h2 class="article-heading">The Portfolio<?php
	
		if(is_tax()){
			echo ": ";
		
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
			echo $term->name; 
		}
			
	?></h2>

	<?php if ( have_posts() ): $i = 0;  ?>
		
		<ul class="float-list">
	
		<?php while ( have_posts() ) : the_post(); $i++; ?>
			
			<?php
			
				$imageID = get_field('thumb');
				$imageURLThumb = $imageID['sizes']['large'];
			
			?>
	
			<li<?php if(($i%3) == 0){ echo " class=\"last\""; } else if(($i%3) == 1){ echo " class=\"first\""; } ?>>
				<h3>
					<a href="<?php echo get_permalink(); ?>">
						<img src="<?php echo $imageURLThumb; ?>"
						 	alt="NC State University" />
						<span class="float-list-title"><?php the_title(); ?></span>
					</a>
				</h3>
			</li>
		
		<?php endwhile; ?>

		</ul><!-- end .float-list -->

		<div class="pagination">
			<?php posts_nav_link('&nbsp; &nbsp;', ' &larr; Newer Entries', 'Older Entries &rarr;'); ?>
		</div>

	<?php else: ?>
	
		<p class="no-posts"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
	<?php endif; ?>
	
</article>
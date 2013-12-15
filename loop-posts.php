<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
	
	<article class="article">
		
		<h2 class="article-heading">
			<?php the_title(); ?>
		</h2>

		<?php if(!is_page()): ?>

			<?php
				
				if ( 'portfolio' == get_post_type() ){ 
				
					$launchDate = get_field('launch');
					$url = get_field('url');
					$awards = get_field('awards');
					
			?>
			
			<p class="article-date">
				Launched on <time datetime="<?php echo date("Y-m-d",strtotime($launchDate)); ?>">
					<?php echo date("l, F j, Y", strtotime($launchDate)); ?></time>
			</p>
			
			<?php 
				
				} else {
			
					$postDate = get_the_date();
					$timestamp = strtotime($postDate);
			
			?>
			
			<p class="article-date">
				Published on <time datetime="<?php echo date("Y-m-d",$timestamp); ?>">
					<?php echo date("l, F j, Y", $timestamp); ?></time>
			</p>
			
			<?php
					
				}

			?>

			<?php get_template_part('loop','featimage'); ?>
			
			<?php the_content(); ?>

			<?php if ( 'portfolio' == get_post_type() ){ 
				
				$terms = get_terms("responsibilities");
				$count = count($terms);
				
				if ( $count > 0 ){
					
					echo "<p><strong>Responsibilities:</strong> ";
					$i = 0;
					
				    foreach ( $terms as $term ) {
						
						if($i++ > 0){
							echo ", ";
						}
				    	
						echo "<a href=\"" . get_term_link( $term ) . "\">" . $term->name . "</a>";
				    
					}
				    
					echo "</p>";
				 
				}
					
				if(!empty($awards)){
					echo "<p><strong>Awards:</strong> $awards</p>";
				}
				
				if(!empty($url)){
					echo "<p><strong>Visit Site:</strong> <a href=\"$url\">$url</a></p>";
				}
			
			?>
			
			<div class="pagination">
				<p><a href="<?php echo bloginfo('url'); ?>/portfolio/">&larr; Back to the Portfolio</a></p>
			</div>
				
			<?php } else {
				
				the_tags( "<p><b>Tagged:</b> ", ", ","</p>");
			
			} ?>
			
		<?php else: ?>
			
			<?php the_content(); ?>
			
		<?php endif; ?>

	</article>
		
<?php endwhile; ?>

<div class="pagination">
	<?php posts_nav_link('&nbsp; &nbsp;', ' &larr; Newer Entries', 'Older Entries &rarr;'); ?>
</div>

<?php else: ?>

<article class="article">	
	<p class="no-posts"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
</article>

<?php endif; ?>
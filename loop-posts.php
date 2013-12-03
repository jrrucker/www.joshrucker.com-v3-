<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
	
	<article class="article">
		
		<h2 class="article-heading">
			<?php the_title(); ?>
		</h2>

		<?php if(!is_page()): ?>

			<?php
				$postDate = get_the_date();
				$timestamp = strtotime($postDate);
			?>

			<p class="article-date">
				Published on <time datetime="<?php echo date("Y-m-d",$timestamp); ?>">
					<?php echo date("l, F j, Y", $timestamp); ?></time>
			</p>

			<?php get_template_part('loop','featimage'); ?>
			
			<?php the_content(); ?>

			<?php the_tags( "<p><b>Tagged:</b> ", ", ","</p>"); ?>

		<?php else: ?>
			
			<?php the_content(); ?>
			
		<?php endif; ?>

	</article>
		
<?php endwhile; ?>

<div class="pagination">
	<?php posts_nav_link('&nbsp; &nbsp;', ' &larr; Newer Entries', 'Older Entries &rarr;'); ?>
</div>

<?php else: ?>
	
	<p class="no-posts"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
<?php endif; ?>
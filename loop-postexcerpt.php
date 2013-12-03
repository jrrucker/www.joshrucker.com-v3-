<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
	
	<article class="article">

		<h2 class="article-heading">
			<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<?php
			$postDate = get_the_date();
			$timestamp = strtotime($postDate);
		?>

		<p class="article-date">
			Published on <time datetime="<?php echo date("Y-m-d",$timestamp); ?>">
				<?php echo date("l, F j, Y", $timestamp); ?></time>
		</p>
		
		<?php get_template_part('loop','featimage'); ?>

		<?php the_excerpt(); ?>
		
		<p class="more"><a href="<?php echo get_permalink(); ?>">Continue reading this entry &rarr;</a></p>

	</article>
		
<?php endwhile; ?>

<div class="pagination">
	<?php posts_nav_link('&nbsp; &nbsp;', ' &larr; Newer Entries', 'Older Entries &rarr;'); ?>
</div>

<?php else: ?>
	
	<p class="no-posts"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
<?php endif; ?>
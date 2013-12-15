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
	
	<div class="article">
	
		<!-- Page title (if applicable) -->	
		<?php if(is_search()): ?>
			<h2 class="article-heading">Search results for &ldquo;<?php the_search_query(); ?>:&rdquo;</h2>
		<?php elseif(is_404()): ?>
			<h2 class="article-heading">Sorry, this page doesn't exist.</h2>
		<?php elseif(is_category()): ?>
			<h2 class="article-heading">Categorized &ldquo;<?php echo single_cat_title( '', false ); ?>:&rdquo;</h2>
		<?php elseif(is_tag()): ?>
			<h2 class="article-heading">Tagged &ldquo;<?php echo single_tag_title( '', false ); ?>:&rdquo;</h2>
		<?php endif; ?>
	
		<p class="no-posts"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		
	</div>
	
<?php endif; ?>
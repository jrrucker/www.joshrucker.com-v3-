<aside class="section portfolio">
	
	<div class="wrapper">
		
		<?php if( is_post_type_archive( "portfolio" )): ?>
			
			<h2>Notes on the Portfolio:</h2>
			
			<p class="explainer-text">
				This portfolio represents a collection of recent projects I've contributed too. It is not an exhaustive lists, but I think its a good representation of my work.  The scope of contribution on each project will vary (but should be noted) and others may have contributed to these projects during or after the initial build. Also, once a client takes over a project, the design and code are subject to change.
			</p>
			
			<div class="pagination">
				<p><a href="<?php echo bloginfo('url'); ?>/">&larr; Back to the Blog </a></p>
			</div>
			
		<?php else: ?> 
	
			<h2>Recent Work</h2>
	
			<p class="explainer-text">The following is a selection of projects I've recently contributed too.  This section of the site is still a work in process, but you can expect more entries shortly.</p>
	
			<?php
		
				$args = array(
					"post_type" => "portfolio",
					"posts_per_page" => 3
				);
		
				$portQuery = new WP_Query($args);
		
			?>
		
			<?php if ( $portQuery->have_posts() ): $i = 0;  ?>

				<ul class="float-list">

				<?php while ( $portQuery->have_posts() ) : $portQuery->the_post(); $i++; ?>

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

			<?php endif; ?>
	
			<div class="pagination">
				<p><a href="<?php echo bloginfo('url'); ?>/portfolio/">More Work &rarr;</a></p>
			</div>
		
		<?php endif;?>
	
	</div><!-- end .wrapper -->
	
</aside><!-- end .section -->
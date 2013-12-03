<?php
	
	
	$permalink = get_permalink();
	$postid = get_the_ID();
	$thumbnail = get_the_post_thumbnail( $postid, 'featured-image');
	
	if(!empty($thumbnail)){

		echo '<figure class="feature-image">';
		//echo '<a href="' . $permalink . '">' . $thumbnail . '</a>';
		echo $thumbnail;
		
		// look up post caption for featured image
		global $post;
		$id = $post->ID;
		$thumb_id = get_post_thumbnail_id($id);
		$thumb_query = new WP_Query(array(
			'p' => $thumb_id,
			'post_type' => 'attachment'
		));
	
		$excerpt = "";
	
		if($thumb_query->have_posts()){
			$thumb_query->the_post();
			$excerpt = get_the_excerpt();
		}
	
		echo '<figcaption>' . $excerpt . '</figcaption>';
	
		echo '</figure>';
		
	} 
	
	wp_reset_query();

?>
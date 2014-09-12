<?php
		
	$permalink = get_permalink();
	$postid = get_the_ID();
	$thumbnail = get_the_post_thumbnail( $postid, 'featured-image');
	
	if(!empty($thumbnail)){

		//echo '<figure class="feature-image">';
		//echo '<a href="' . $permalink . '">' . $thumbnail . '</a>';
		//echo $thumbnail;
		
		// look up post caption for featured image
		
		global $post;
		
		$thumb_id = get_post_thumbnail_id($post->ID);

		// get the image source

		$image_alt_text = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
		$image_featured = wp_get_attachment_image_src($thumb_id, 'featured-image');
		$image_featured_1_5x = wp_get_attachment_image_src($thumb_id, 'featured-image-1-5x');
		$image_featured_2x = wp_get_attachment_image_src($thumb_id, 'featured-image-2x');

		// get the excerpt

		$thumb_query = new WP_Query(array(
			'p' => $thumb_id,
			'post_type' => 'attachment'
		));
	
		$excerpt = "";
	
		if($thumb_query->have_posts()){
			$thumb_query->the_post();
			$excerpt = get_the_excerpt();
		}

		echo '<figure class="feature-image">';

		echo '<img src="' . $image_featured[0] . '" srcset="' . $image_featured[0] . ' 1x';

		if($image_featured_1_5x[1] == 975){
			echo ", " . $image_featured_1_5x[0] . ' 1.5x';
		}

		if($image_featured_2x[1] == 1300){
			echo ", " . $image_featured_2x[0] . ' 2x';
		}
			
		echo '" alt="' . $image_alt_text . '" />';

		echo '<figcaption>' . $excerpt . '</figcaption>';
	
		echo '</figure>';
		
	} 
	
	wp_reset_query();

?>
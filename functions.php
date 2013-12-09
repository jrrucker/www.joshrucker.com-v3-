<?php

    /** 
     **  This file is organized in 5 main components:
     ** 
     **  i.   Wordpress Resets
     **  ii.  Custom Post Types
     **  iii. Custom Taxonomies
     **  iv.  Theme Functions
     **  v.   Short Codes
     ** 
     **/

    /*****************************************************************************
     ** i.   Wordpress Resets 
     *****************************************************************************/

    ## Resource: http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
	add_theme_support( 'post-thumbnails' );
	
	// Add specific CSS class by filter
	add_filter('body_class','jr_class_names');
	function jr_class_names($classes) {
		
		if(is_single() && has_post_thumbnail()){
			$classes[] = 'single-featured-image';
			return $classes;
		} elseif(is_page() && has_post_thumbnail()){
			$classes[] = 'page-featured-image';
			return $classes;
		}
		
		return $classes;
		
	}
	
	// Add Open Graph meta properties for facebook
	
	add_action('wp_head','jr_open_graph');
	function jr_open_graph(){
	
		$site_name = get_bloginfo('name');
		echo '<meta property="og:site_name" content="'.$site_name.'"/>'.PHP_EOL;
		
		if (is_singular()){
			echo '<meta property="og:title" content="'.get_the_title().'" />'.PHP_EOL;
			echo '<meta property="og:type" content="article" />'.PHP_EOL;
			echo '<meta property="og:description" content="' . get_the_excerpt() . '" />'.PHP_EOL;
			
			if(has_post_thumbnail()){
				
				$src = wp_get_attachment_image_src( 
					get_post_thumbnail_id(), 
					array( 720,405 ), false, '' 
				);
				echo '<meta property="og:image" content="'. $src[0] .' "/>'.PHP_EOL;
			
			}
			
		} else {
			echo '<meta property="og:description" content="Josh Rucker writes on web development, life, and things that happen in between." />'.PHP_EOL;
			echo '<meta property="og:type" content="website" />'.PHP_EOL;
		}
		echo '<meta property="og:url" content="'. get_permalink() .'" />'.PHP_EOL;
		
	}
	
	// add page excerpt support pages
    
	add_action( 'init', function(){
		add_post_type_support( 'page', 'excerpt' );
	});
	
	// set image compression quality at 100%
	
	add_filter( 'jpeg_quality', function($arg){
		return 100;
	});
	
	add_image_size( 'featured-image', 800, 9999 ); //300 pixels wide (and unlimited height)

    /*****************************************************************************
     ** ii.   Custom Post Types
     *****************************************************************************/
     
    ## Documentation: http://codex.wordpress.org/Post_Types

	function jr_featured_image_post_type(){
		
		$labels = array(
			'name' => 'Featured Images',
		    'singular_name' => 'Featured Image',
		    'add_new' => 'Add New',
		    'add_new_item' => 'Add New Featured Image',
		    'edit_item' => 'Edit Featured Image',
		    'new_item' => 'New Featured Image',
		    'all_items' => 'All Featured Image',
		    'view_item' => 'View Featured Image',
		    'search_items' => 'Search Featured Images',
		    'not_found' =>  'No Featured Image found',
		    'not_found_in_trash' => 'No Featured Images found in Trash', 
		    'parent_item_colon' => '',
		    'menu_name' => 'Featured Images'
		);

		$args = array(
		    'labels' => $labels,
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'featured-image' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => null,
		    'supports' => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail', 'comments' )
		); 

		register_post_type( 'featured-image', $args );
		
	}
	
	add_action('init','jr_featured_image_post_type');
	
	function jr_portfolio_post_type(){
		
		$labels = array(
			'name' => 'Portfolio',
		    'singular_name' => 'Portfolio Entry',
		    'add_new' => 'Add New',
		    'add_new_item' => 'Add New Portfolio Entry',
		    'edit_item' => 'Edit Portfolio Entry',
		    'new_item' => 'New Portfolio Entry',
		    'all_items' => 'All Portfolio Entries',
		    'view_item' => 'View Portfolio Entry',
		    'search_items' => 'Search Portfolio Entries',
		    'not_found' =>  'No Portfolio Entries',
		    'not_found_in_trash' => 'No Portfolio Entries found in Trash', 
		    'parent_item_colon' => '',
		    'menu_name' => 'Portfolio'
		);

		$args = array(
		    'labels' => $labels,
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true, 
		    'show_in_menu' => true, 
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'portfolio' ),
		    'capability_type' => 'post',
		    'has_archive' => true, 
		    'hierarchical' => false,
		    'menu_position' => null,
		    'supports' => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail', 'comments' )
		); 

		register_post_type( 'portfolio', $args );
		
	}
	
	add_action('init','jr_portfolio_post_type');
	
      
    /*****************************************************************************
     ** iii. Custom Taxonomies
	 *****************************************************************************/
	
	function jr_responsibilities_tax() {
		
		
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Responsibilities', 'taxonomy general name' ),
			'singular_name'     => _x( 'Responsibility', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Responsibilities' ),
			'all_items'         => __( 'All Responsibilities' ),
			'parent_item'       => __( 'Parent Responsibility' ),
			'parent_item_colon' => __( 'Parent Responsibility:' ),
			'edit_item'         => __( 'Edit Responsibility' ),
			'update_item'       => __( 'Update Responsibility' ),
			'add_new_item'      => __( 'Add New Responsibility' ),
			'new_item_name'     => __( 'New Responsibility Name' ),
			'menu_name'         => __( 'Responsibilities' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'responsibilities' ),
		);

		register_taxonomy( 'responsibilities', array( 'portfolio' ), $args );
		
	}
	
	add_action( 'init', 'jr_responsibilities_tax' );
      
      
    /*****************************************************************************
     ** iv. Theme Functions
	 *****************************************************************************/
     
	function jr_load_featured_image(){
		
		$query = new WP_query(
			array(
				'post_type' => 'featured-image',
				'posts_per_page' => 1
			)
		);
		
		if($query->have_posts()){
			
			$query->the_post();
			
			get_template_part('loop','featimage'); 
		}
		
	}

    /*****************************************************************************
     ** v. Short Codes
     *****************************************************************************/

	function jr_youtube_shortcode( $atts, $content = null ) {
		
		extract( shortcode_atts( array(
			'id' => ''
		), $atts ) );
		
		$output .= "<div class=\"video\">";
		$output .= "<div class=\"video-wrapper\">";
		$output .= "<iframe frameborder=\"0\" allowfullscreen=\"\"";  	 
		$output .= "src=\"http://www.youtube.com/embed/";
		$output .= $id;
		$output .= "?showinfo=0&amp;rel=0\"></iframe>";
		$output .= "</div>";
		
		if(!empty($content)){
			$output .= "<p class=\"wp-caption-text\">" . $content . "</p>";
		}
		
		$output .= "</div>";
		
		return $output;
	}
	add_shortcode( 'youtube', 'jr_youtube_shortcode' );

	/*

	// Overwrite default image caption shortcode
	function jr_img_caption_shortcode_filter($val, $attr, $content = null)
	{
		extract(shortcode_atts(array(
			'id'      => '',
			'align'   => 'aligncenter',
			'width'   => '',
			'caption' => ''
		), $attr));

		// No caption, no dice... But why width? 
		if ( 1 > (int) $width || empty($caption) )
			return $val;

		if ( $id )
			$id = esc_attr( $id );

		// Add itemprop="contentURL" to image - Ugly hack
		$content = str_replace('<img', '<img itemprop="contentURL"', $content);

		return '<figure id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '" itemscope itemtype="http://schema.org/ImageObject" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption id="figcaption_'. $id . '" class="wp-caption-text" itemprop="description">' . $caption . '</figcaption></figure>';
	
	}
	add_filter( 'img_caption_shortcode', 'jr_img_caption_shortcode_filter', 10, 3 );
	*/

?>
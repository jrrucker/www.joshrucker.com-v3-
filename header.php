<!DOCTYPE html>
<html>

	<head>	

		<title><?php wp_title(' :: ', true, 'right'); ?><?php bloginfo('name'); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/_css/main.css" />

		<meta charset="utf-8">
        <meta content="General" name="rating"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
        
        <link type="text/plain" rel="author" href="<?php bloginfo('template_url'); ?>/humans.txt" />
		<meta name="description" content="<?php
			if(is_single() || is_page()){
				echo get_the_excerpt();
			} else {
				echo "Josh Rucker writes on web development, life, and things that happen in between.";
			}
		?>" />

		<!-- Typekit -->
        <script type="text/javascript" src="//use.typekit.net/meg6qsn.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<?php wp_head(); ?>

	</head>
	
	<body <?php body_class(); ?>>
		
		<header id="header" role="banner">
		
			<div class="wrapper">
			
                <h1 class="heading-branding">
					<a href="<?php bloginfo('url'); ?>">Josh <b>Rucker</b></a>
				</h1>
				
				<nav class="main-nav">
					
					<ul>
						<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
						<?php $pages = get_pages(); ?>
						<?php foreach ( $pages as $page ): ?>
							<li><a href="<?php echo get_page_link( $page->ID ); ?>">
								<?php echo $page->post_title; ?>
								</a></li>
						<?php endforeach; ?>
						<li><a href="http://joshrucker.com/portfolio/">Work</a></li>							
					</ul>
					
				</nav>
		
			</div>
			
       	</header><!-- end #header -->

		<?php if(!is_page('about')){ get_sidebar("about"); } ?>
		<?php //get_sidebar("about"); ?>

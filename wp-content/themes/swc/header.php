<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>

	<meta charset="utf-8">
	<!--[if IE]><![endif]-->

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<?php if (is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title><?php wp_title(''); ?></title>
	
	<meta name="title" content="<?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	
	<meta name="google-site-verification" content="">
	<!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
	
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/_/img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/_/img/apple-touch-icon.png">	

	<script src="<?php echo get_template_directory_uri(); ?>/_/js/modernizr-2.min.js"></script>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
<!--	<script src="http://use.typekit.com/xxxxxxx.js"></script>
	<script>try{Typekit.load();}catch(e){}</script> -->

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	
	<div class="page-wrap">

		<header class="header">
			<?php if ( is_front_page() ) : ?>
				<h1><a class="ir" id="logo" href="<?php home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
			<?php else : ?>
				<a class="ir" id="logo" href="<?php home_url(); ?>/"><?php bloginfo('name'); ?></a>
			<?php endif; ?>
			<div class="description"><?php bloginfo('description'); ?></div>
		</header>
		
		<nav class="main-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'main-nav' ) ); ?>
		</nav>
		
		<section class="main-content">

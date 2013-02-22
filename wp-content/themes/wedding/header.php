<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow" />
  <?php } ?>

  <title><?php wp_title(''); ?></title>
  <meta name="google-site-verification" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/i/favicon.ico">
  <link rel="shortcut" href="<?php echo get_template_directory_uri(); ?>/i/favicon.png">

  <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.min.js"></script>

  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

  <script src="//use.typekit.net/xdb0ddk.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
      <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

  <div id="bg"></div>

  <div class="page-wrap">
    <div class="centered">
      <header class="header">
        <?php if ( is_front_page() ) : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/i/logo.png" alt="Jacob and Danielle are getting married!">
          <h1>Danielle<small>&amp;</small>Jacob</h1>
        <?php else : ?>
          <h1><a href="<?php echo home_url(); ?>/">Danielle<small>&amp;</small>Jacob</a></h1>
        <?php endif; ?>
        <h2><?php bloginfo('description'); ?></h2>

        <?php if ( !is_front_page() ) : ?>
          <nav class="main-nav">
            <?php wp_nav_menu( array( 'theme_location' => 'main-nav', 'container' => '' ) ); ?>
          </nav>
        <?php endif; ?>
      </header>



      <section class="main-content">

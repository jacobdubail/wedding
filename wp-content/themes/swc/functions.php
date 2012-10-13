<?php 
	    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h3>',
    		'after_title'   => '</h3>'
    	));
    }

	if (function_exists('add_theme_support')) {
     add_theme_support('nav-menus');
	}
	add_action( 'init', 'register_my_menu' );
	function register_my_menu() {
		register_nav_menu( 'main-nav', __( 'Main Nav' ) );
	}
	
	// enable threaded comments
	function enable_threaded_comments(){
		if (!is_admin()) {
			if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
				wp_enqueue_script('comment-reply');
			}
	}
	add_action('get_header', 'enable_threaded_comments');
	
	// add feed links to header
	add_theme_support( 'automatic_feed_links' );
		
	// remove junk from head
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	
	// add google analytics to footer
/*
function add_google_analytics() {
	echo '<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>';
	echo '<script type="text/javascript">';
	echo 'var pageTracker = _gat._getTracker("	
UA-xxxxxxx-x");';
	echo 'pageTracker._trackPageview();';
	echo '</script>';
}
add_action('wp_footer', 'add_google_analytics');
*/
    
  
	//do shortcodes in widgets
	add_filter('widget_text', 'do_shortcode');
	
	// category id in body and post class
	function category_id_class($classes) {
		global $post;
		foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';
		return $classes;
	}
	add_filter('post_class', 'category_id_class');
	add_filter('body_class', 'category_id_class');


		
	//remove_filter('the_excerpt', 'wpautop');
	//remove_filter('the_content', 'wpautop');
	

		add_action('wp_enqueue_scripts', 'follan_register_scripts');
	function follan_register_scripts() {
		wp_deregister_script('jquery');
		wp_deregister_script( 'l10n' );
		
		
//		wp_register_script('follan_modernizr', '/wp-content/themes/follan/_/js/modernizr-2.min.js', '', '2.5.3', false );
//		wp_enqueue_script('follan_modernizr');
		
		
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js", false, '1.7.2', true);
	   wp_enqueue_script('jquery');
	   
	   wp_register_script('follan_plugins', '/wp-content/themes/swc/_/js/plugins.js', array('jquery'), '1', true );
		wp_enqueue_script('follan_plugins');
		
		wp_register_script('follan_functions', '/wp-content/themes/swc/_/js/functions.js', array('jquery', 'follan_plugins'), '1', true );
		wp_enqueue_script('follan_functions');
		
		if ( is_front_page() || !is_singular() || !is_page('portraits') )
			wp_deregister_script( 'comment-reply' );		
		
		
		//$handle, $src, $deps, $ver, $media
		wp_register_style('follan_styles', '/wp-content/themes/swc/style.css', '', '1', 'all');
		wp_enqueue_style('follan_styles');
		
	}
	
//	add_action('wp_enqueue_styles', 'gform_deregister_styles');
	function gform_deregister_styles() {
		wp_deregister_style('foxyshop_css');	
	}
	
	function load_the_ui() {
		wp_enqueue_script('jquery-ui-core', '/wp-includes/js/jquery/ui.core.js', '', '', true); 
		wp_enqueue_script('jquery-ui-tabs', '/wp-includes/js/jquery/ui.tabs.js', '', '', true);
	}
	//if ( is_page('contact-us') ) {
		//add_action('init', 'load_the_ui'); 
	//}
	
//	add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );
	function my_deregister_javascript() {
	  if ( !is_page('contact-us') ) {
	    wp_deregister_script( 'contact-form-7' );
	  }
	}
//	add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
	function my_deregister_styles() {
	  if ( !is_page('contact-us') ) {
	    wp_deregister_style( 'contact-form-7' );
	  }
	}

	// custom excerpt length
	/*
function custom_excerpt_length($length) {
		return 20;
	}
	add_filter('excerpt_length', 'custom_excerpt_length');
*/
	
	
	// custom excerpt ellipses for 2.9+
	/*
function custom_excerpt_more($more) {
		return '...';
	}
	add_filter('excerpt_more', 'custom_excerpt_more');
*/
	
	// custom admin login logo
	/*
function custom_login_logo() {
		echo '<style type="text/css">
		h1 a { background-image: url('.get_bloginfo('template_directory').'/images/custom-login-logo.png) !important; }
		</style>';
	}
	add_action('login_head', 'custom_login_logo');
*/

	// remove version info from head and feeds
	function complete_version_removal() {
		return '';
	}
	add_filter('the_generator', 'complete_version_removal');

	// customize admin footer text
	function custom_admin_footer() {
		echo '<a href="http://jacobdubail.com/">Website Development by Jacob Dubail</a>';
	} 
	add_filter('admin_footer_text', 'custom_admin_footer');
	
	// enable html markup in user profiles
	remove_filter('pre_user_description', 'wp_filter_kses');
	
	// remove nofollow from comments
	function xwp_dofollow($str) {
		$str = preg_replace(
			'~<a ([^>]*)\s*(["|\']{1}\w*)\s*nofollow([^>]*)>~U',
			'<a ${1}${2}${3}>', $str);
		return str_replace(array(' rel=""', " rel=''"), '', $str);
	}
	remove_filter('pre_comment_content',     'wp_rel_nofollow');
	add_filter   ('get_comment_author_link', 'xwp_dofollow');
	add_filter   ('post_comments_link',      'xwp_dofollow');
	add_filter   ('comment_reply_link',      'xwp_dofollow');
	add_filter   ('comment_text',            'xwp_dofollow');
	
	function jtd_allow_rel() {
		global $allowedtags;
		$allowedtags['a']['rel'] = array ();
	}
	add_action( 'wp_loaded', 'jtd_allow_rel' );
	
	function jtd_add_google_profile( $contactmethods ) {
		// Add Google Profiles
		$contactmethods['google_profile'] = 'Google Profile URL';
		$contactmethods['facebook']       = 'Facebook';
		$contactmethods['twitter']        = 'Twitter';
		unset($contactmethods['aim']);
		unset($contactmethods['yim']);		
		unset($contactmethods['jabber']);
		return $contactmethods;
	}
	add_filter( 'user_contactmethods', 'jtd_add_google_profile', 10, 1);


	
	// add featured image support
	add_theme_support( 'post-thumbnails' );
	//if ( function_exists( 'add_image_size' ) ) { 
	//	add_image_size( 'slide-thumb', 960, 283, true );
	//}
	
	
	
	//Custom Post Type for Slides
	/*function anything_slides() {
	
		register_post_type( 
			'slides',
			array( 
				'label' => __('Slides'), 
				'description' => __('Create a Slide'), 
				'public' => true, 
				'show_ui' => true,
				'supports' => array (
					'title',
					'thumbnail'
				),
				'taxonomies' => array (
					'category'
				)
			)
		);
	
	}
	add_action('init', 'anything_slides');	
	*/
	
	//add_action( 'wp_print_scripts', 'my_deregister_styles' );
	//function my_deregister_styles() {
	//	wp_deregister_style( 'cleaner-gallery' );
	//}	
	
	
	
	
	
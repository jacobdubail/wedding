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

  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic_feed_links' );
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


  add_filter('widget_text', 'do_shortcode');

  function category_id_class($classes) {
    global $post;
    foreach((get_the_category($post->ID)) as $category)
      $classes [] = 'cat-' . $category->cat_ID . '-id';
  //  foreach((get_the_terms($post->ID, 'foxyshop_categories')) as $category)
  //    $classes [] = $category->slug;
    return $classes;
  }
  add_filter('post_class', 'category_id_class');
  add_filter('body_class', 'category_id_class');

  add_action('wp_enqueue_scripts', 'wedding_register_scripts');
  function wedding_register_scripts() {
    wp_deregister_script('jquery');
    wp_deregister_script( 'l10n' );

    $jQuery = "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.9/jquery.min.js";
    $test   = @fopen($jQuery,'r');
    if ( $test === false ) {
      $jQuery = get_template_directory_uri() . '/js/jquery.min.js';
    }

    wp_register_script('jquery', $jQuery, false, '1.9');
    wp_enqueue_script('jquery');

    wp_register_script('wedding_plugins', '/wp-content/themes/wedding/js/plugins.min.js', array('jquery'), '1', true );
    wp_enqueue_script('wedding_plugins');

    wp_register_script('wedding_functions', '/wp-content/themes/wedding/js/script.min.js', array('jquery', 'wedding_plugins'), '1.1', true );
    wp_enqueue_script('wedding_functions');

    wp_register_style('wedding_styles', '/wp-content/themes/wedding/css/style.css', '', '1.1', 'all');
    wp_enqueue_style('wedding_styles');

  }

  function complete_version_removal() { return ''; }
  add_filter('the_generator', 'complete_version_removal');
  remove_filter('pre_user_description',    'wp_filter_kses');
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


	function do_the_magic() {
		log_msg( "inside do_the_magic " . getcwd() );
		$dir = chdir( GITHUB_SYNC_DIR );
		log_msg( "chdir'd to " . $dir . ' ' . get_cwd() );
		exec( 'git pull', $out );
		log_msg( "exec'd ", $out );
	}


add_action('init', 'my_foxyshop_dequeue', 11);
function my_foxyshop_dequeue() {
  wp_dequeue_style('foxyshop_css');
}



/**
* Title   : Aqua Resizer
* Description : Resizes WordPress images on the fly
* Version : 1.1.6
* Author  : Syamil MJ
* Author URI  : http://aquagraphite.com
* License : WTFPL - http://sam.zoy.org/wtfpl/
* Documentation : https://github.com/sy4mil/Aqua-Resizer/
*
* @param  string $url - (required) must be uploaded using wp media uploader
* @param  int $width - (required)
* @param  int $height - (optional)
* @param  bool $crop - (optional) default to soft crop
* @param  bool $single - (optional) returns an array if false
* @uses   wp_upload_dir()
* @uses   image_resize_dimensions() | image_resize()
* @uses   wp_get_image_editor()
*
* @return str|array
*/

function aq_resize( $url, $width, $height = null, $crop = null, $single = true ) {

  //validate inputs
  if(!$url OR !$width ) return false;

  //define upload path & dir
  $upload_info = wp_upload_dir();
  $upload_dir = $upload_info['basedir'];
  $upload_url = $upload_info['baseurl'];

  //check if $img_url is local
  if(strpos( $url, $upload_url ) === false) return false;

  //define path of image
  $rel_path = str_replace( $upload_url, '', $url);
  $img_path = $upload_dir . $rel_path;

  //check if img path exists, and is an image indeed
  if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;

  //get image info
  $info = pathinfo($img_path);
  $ext = $info['extension'];
  list($orig_w,$orig_h) = getimagesize($img_path);

  //get image size after cropping
  $dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
  $dst_w = $dims[4];
  $dst_h = $dims[5];

  //use this to check if cropped image already exists, so we can return that instead
  $suffix = "{$dst_w}x{$dst_h}";
  $dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
  $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

  if(!$dst_h) {
    //can't resize, so return original url
    $img_url = $url;
    $dst_w = $orig_w;
    $dst_h = $orig_h;
  }
  //else check if cache exists
  elseif(file_exists($destfilename) && getimagesize($destfilename)) {
    $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
  }
  //else, we resize the image and return the new resized image url
  else {

    // Note: This pre-3.5 fallback check will edited out in subsequent version
    if(function_exists('wp_get_image_editor')) {

      $editor = wp_get_image_editor($img_path);

      if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
        return false;

      $resized_file = $editor->save();

      if(!is_wp_error($resized_file)) {
        $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path']);
        $img_url = $upload_url . $resized_rel_path;
      } else {
        return false;
      }

    } else {

      $resized_img_path = image_resize( $img_path, $width, $height, $crop ); // Fallback foo
      if(!is_wp_error($resized_img_path)) {
        $resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
        $img_url = $upload_url . $resized_rel_path;
      } else {
        return false;
      }

    }

  }

  //return the output
  if($single) {
    //str return
    $image = $img_url;
  } else {
    //array return
    $image = array (
      0 => $img_url,
      1 => $dst_w,
      2 => $dst_h
    );
  }

  return $image;
}




//Shows Related Products
function jtd_foxyshop_related_products ( $sectiontitle = "Related Products", $maxproducts = 3 ) {
  global $product, $post, $foxyshop_settings;

  $related_order = "";
  $args          = array('post_type' => 'foxyshop_product', "post__not_in" => array($product['id']));
  //Native Related Products
  if ( $foxyshop_settings['related_products_custom'] && $product['related_products'] ) {
    $args['post__in']       = explode(",",$product['related_products']);
    $args['posts_per_page'] = -1;
    if ($related_order      = get_post_meta($product['id'], "_related_order", 1)) add_filter('posts_orderby', 'foxyshop_related_order');

  //Tags
  } else {
    return;
  }

  if ( !array_key_exists('orderby', $args) ) $args = array_merge( $args, foxyshop_sort_order_array() );
  $relatedlist = new WP_Query($args);

  if ( count($relatedlist->posts) > 0 ) {

    $original_product = $product;

    echo '<ul class="foxyshop_related_product_list">';
    echo '<li class="titleline"><h3>' . $sectiontitle . '</h3></li>';

    while ($relatedlist->have_posts() ) :

      $relatedlist->the_post();
      $product      = foxyshop_setup_product();
      $thumbnailSRC = foxyshop_get_main_image(apply_filters('foxyshop_related_products_thumbnail_size',"large"));
      $thumb        = aq_resize( $thumbnailSRC, 283, 120, 1, true );

      $write  = '<li class="foxyshop_product_box cf">'."\n";
      $write .= '<div class="foxyshop_product_image">';
      $write .= '<a href="' . $product['url'] . '"><img src="' . $thumb . '" alt="' . esc_attr($product['name']) . '" class="foxyshop_main_image" /></a>';
      $write .= "</div>\n";
      $write .= '<div class="foxyshop_product_info">';
      $write .= '<h2><a href="' . $product['url'] . '">' . apply_filters('the_title', $product['name']) . '</a></h2>';
      $write .= foxyshop_price(0,0);
      $write .= "</div>\n";
      //$write .= '<div class="clr"></div>';
      $write .= "</li>\n";
      echo apply_filters('foxyshop_related_products_html', $write, $product);

    endwhile;
    echo "</ul>\n";
    echo '<div class="clr"></div>';
    $product = $original_product;
    wp_reset_postdata();
  }
  if ($related_order) remove_filter('posts_orderby', 'foxyshop_related_order');
}



function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o     = '<form class="protected-post-form" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post">
    <h4>To view this protected content, please enter the password below:</h4>
    <p class="gfield">
      <label for="' . $label . '">' . __( "Password:" ) . ' </label>
      <input name="post_password" id="' . $label . '" type="password" size="20" />
    </p>
    <input type="submit" name="Submit" class="btn" value="' . esc_attr__( "Submit" ) . '" />

    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );


add_filter('protected_title_format', 'blank');
function blank($title) {
  return '%s';
}
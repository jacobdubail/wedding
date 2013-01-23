<?php /*
------------ ATTENTION ------------
If you need to edit this template, do not edit the version in the plugin directory. Place a copy in your template folder and edit it there.
This will allow you to upgrade FoxyShop without breaking your customizations. More details here: http://www.foxy-shop.com/documentation/theme-customization/
-----------------------------------
*/

	get_header();

	global $product;

	foxyshop_include('header');

	echo '<div id="foxyshop_container">';

	//Run the query for all products in this category
	global $paged, $wp_query;
	$paged = get_query_var('page');
	$args  = array(
		'post_type' => 'foxyshop_product',
		'post_status' => 'publish',
		'posts_per_page' => foxyshop_products_per_page(),
		'paged' => get_query_var('page')
	);
	$args  = array_merge($args,foxyshop_sort_order_array());
	query_posts($args);

		echo '<ul class="foxyshop_product_list grid" id="masonry">';
			while (have_posts()) :
				the_post();

				//Product Display
				foxyshop_include('product-loop');

			endwhile;
		echo '</ul>';

	//Pagination
	//foxyshop_get_pagination();

	echo "</div>";

foxyshop_include('footer');
get_footer();
?>
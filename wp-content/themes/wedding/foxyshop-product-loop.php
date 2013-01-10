<?php /*
------------ ATTENTION ------------
If you need to edit this template, do not edit the version in the plugin directory. Place a copy in your template folder and edit it there.
This will allow you to upgrade FoxyShop without breaking your customizations. More details here: http://www.foxy-shop.com/documentation/theme-customization/
-----------------------------------
*/

/***************************
Product display details
referenced in:
- foxyshop-all-products.php
- foxyshop-search.php
- foxyshop-single-category.php
- foxyshop-single-category-shortcode.php
- foxyshop-single-category-widget.php
****************************/

//Setup Product
global $product, $post;
$product = foxyshop_setup_product();
if (!$product['hide_product']) {

	$terms = get_the_terms( $post->ID, 'type');

	echo "<pre>";
	print_r( $terms );
	echo "</pre>";

	echo '<li class="foxyshop_product_box item">';

	//Show Image on Left
	echo '<div class="foxyshop_product_image">';
		if ( $thumbnailSRC = foxyshop_get_main_image("medium") ) {
			$thumb = aq_resize( $thumbnailSRC, 283, 120, 1, true );
			echo '<a href="' . $product['url'] . '"><img src="' . $thumb . '" alt="' . htmlspecialchars($product['name']) . '" class="foxyshop_main_image" /></a>';
		}
	echo "</div>\n";

	//Show Main Product Info
	?>
	<div class="foxyshop_product_info">

	<h2 class="product_title">
		<a href="<?php echo $product['url']; ?>" title="<?php echo apply_filters('the_title', $product['name']); ?>"><?php echo apply_filters('the_title', $product['name']); ?></a>
	</h2>

	<?php
	if ($product['short_description']) {
		echo "<p>" . $product['short_description'] . "</p>";
	} else {
		echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 20, '&hellip;' ) );
	}

	//More Details Button
	echo '<a href="' . $product['url'] . '" class="foxyshop_button">More Details</a>';

	//Add To Cart Button (options)
	// foxyshop_product_link("Add To Cart", false);
	// foxyshop_product_link("Add %name% To Cart", false);
	// echo '<a href="'.foxyshop_product_link("", true).'" class="foxyshop_button">Add To Cart</a>';

	//Show Price (and sale if applicable)
	foxyshop_price();

	echo "</div>\n";

	//Clear Floats and End Item
	echo '<div class="clr"></div>';
	echo "</li>\n";

}
?>
<?php /*
------------ ATTENTION ------------
If you need to edit this template, do not edit the version in the plugin directory. Place a copy in your template folder and edit it there.
This will allow you to upgrade FoxyShop without breaking your customizations. More details here: http://www.foxy-shop.com/documentation/theme-customization/
-----------------------------------
*/ ?>

<?php get_header(); ?>

<?php foxyshop_include('header'); ?>
<div id="foxyshop_container" class="grid">

<?php
	while (have_posts()) : the_post();

	//Initialize Product
	global $product;
	$product = foxyshop_setup_product();

	//Initialize Form
	foxyshop_start_form();

	foxyshop_build_image_slideshow("prettyPhoto", true);
	//foxyshop_build_image_slideshow("cloud-zoom", true);
	//foxyshop_build_image_slideshow("colorbox", true); //only recommended for 0.7.2+

?>


	<div class="foxyshop_product_info col-1-2">

		<h2><?php echo apply_filters('the_title', $product['name']); ?></h2>

<?php
	//Show a sale tag if the product is on sale
	//if (foxyshop_is_on_sale()) echo '<p class="sale-product">SALE!</p>';

	//Product Is New Tag (number of days since added)
	//if (foxyshop_is_product_new(14)) echo '<p class="new-product">NEW!</p>';

		echo $product['description'];


		//Show Variations (showQuantity: 0 = Do Not Show Qty, 1 = Show Before Variations, 2 = Show Below Variations)
		foxyshop_product_variations(2);

		//Check Inventory Levels and Display Status (last variable allows backordering of out of stock items)
		foxyshop_inventory_management("There are only %c item%s left in stock.", "Item is not in stock.", false);

		//Add On Products ($qty [1 or 0], $before_entry, $after_entry)
		foxyshop_addon_products();

		echo '<button type="submit" name="x:productsubmit" id="productsubmit" class="foxyshop_button">Add To Cart</button>';

		echo '<div id="foxyshop_main_price">';
			foxyshop_price();
		echo '</div>';


	echo '</div>';

	foxyshop_related_products("Related Products");

	echo '</form>';


endwhile;
?>

</div>

<?php foxyshop_include('footer'); ?>

<?php get_footer(); ?>
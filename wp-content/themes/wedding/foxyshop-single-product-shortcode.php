<?php /*
------------ ATTENTION ------------
If you need to edit this template, do not edit the version in the plugin directory. Place a copy in your template folder and edit it there.
This will allow you to upgrade FoxyShop without breaking your customizations. More details here: http://www.foxy-shop.com/documentation/theme-customization/
-----------------------------------
*/ ?>

<?php //foxyshop_include('header'); ?>
<div id="foxyshop_container" class="grid">
<?php
global $foxyshop_prettyphoto_included;
	
	//Initialize Product
	global $product, $prod;
	$product = foxyshop_setup_product($prod);
	
	//Just for the widget, since url links are no longer available
	global $foxyshop_skip_url_link;
	$foxyshop_skip_url_link = 1;

	foxyshop_start_form();
	
	
	foxyshop_build_image_slideshow("prettyPhoto", true);



	//Main Product Information Area
	echo '<div class="foxyshop_product_info col-1-2">';
	//echo '<h2>' . apply_filters('the_title', $product['name']) . '</h2>';
	
	//Show a sale tag if the product is on sale
	//if (foxyshop_is_on_sale()) echo '<p>SALE!</p>';

	//Product Is New Tag (number of days since added)
	//if (foxyshop_is_product_new(14)) echo '<p>NEW!</p>';
	
	//Main Product Description
	echo $product['description'];


	//Show Variations (showQuantity: 0 = Do Not Show Qty, 1 = Show Before Variations, 2 = Show Below Variations)
	foxyshop_product_variations(2);
	
	//(style) clear floats before the submit button
	echo '<div class="clr"></div>';

	//Check Inventory Levels and Display Status (last variable allows ordering of out of stock items)
	foxyshop_inventory_management("There are only %c item%s left in stock.", "Item is not in stock.", false);

	//Add On Products ($qty, $before_entry, $after_entry)
	foxyshop_addon_products(true);
	
	//Add To Cart Button
	echo '<input type="submit" name="x:productsubmit" id="productsubmit" class="foxyshop_button btn" value="Add To Cart"/>';
	
	//Shows the Price (includes sale price if applicable)
	echo '<div id="foxyshop_main_price">';
	foxyshop_price();
	echo '</div>';

	//Shows any related products
	foxyshop_related_products("Related Products");



	//Custom Code Can Go Here




	//Ends the form
	echo '</div>';
	echo '</form>';


	?>
	<div class="clr"></div>
</div>
<?php foxyshop_include('footer'); ?>
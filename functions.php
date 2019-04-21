<?php
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 40 );
// Add "Add to Cart" Button To Loop
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
// Remove Sidebar
if ( ! function_exists( 'et_show_cart_total' ) ) {
	function et_show_cart_total() {
		if ( ! class_exists( 'woocommerce' ) || ! WC()->cart ) {
			return;
		}
		$url = WC()->cart->get_cart_url();
		$items_number = WC()->cart->get_cart_contents_count();
		if ($items_number != 0) {
			$total_order = WC()->cart->get_cart_total();
			printf(
				'<a href="%1$s" class="et-cart-info">
					<span class="count"><i>%2$s</i> %3$s</span>
				</a>',
				esc_url($url), $items_number, strip_tags($total_order)
			);
		}
	}
}
// Add Cart Value To Cart Icon
add_filter( 'woocommerce_sale_flash', 'tcore_percentage_sale', 10, 3 );
function tcore_percentage_sale( $text, $post, $product ) {
	$text = '<span class="onsale">';

	$regular = $product->regular_price;
	$sale = $product->sale_price;

	if ($product->is_type('simple')) {
		if ( isset( $sale ) ) {
			$discount = round( ( ($regular - $sale) / $regular ) * 100 );
		}
	} else {
		$discount = get_variable_sale_percentage( $product );
	}
	$text .= $discount . '%';
	$text .= '</span>';

	return $text;
}
// Add Percent to Sale
function get_variable_sale_percentage( $product ) {
	$variation_min_regular_price = $product->get_variation_regular_price('min', true);
	$variation_max_regular_price = $product->get_variation_regular_price('max', true);
	$variation_min_sale_price = $product->get_variation_sale_price('min', true);
	$variation_max_sale_price = $product->get_variation_sale_price('max', true);
	
	$lower_percentage = round( ( ( $variation_min_regular_price - $variation_min_sale_price ) / $variation_min_regular_price ) * 100 );
	$higher_percentage = round( ( ( $variation_max_regular_price - $variation_max_sale_price ) / $variation_max_regular_price ) * 100 );
	$percentages = array($lower_percentage, $higher_percentage);
	sort($percentages);

	return $percentages[1];
}
// Workaround for Variable Product

# Divi WooCommerce
> The css that previously makes My Account (now whole WooCommerce) page better on Divi theme.

![screenshot](https://github.com/izzuddinfz/divi-woomyacc/raw/master/Annotation%202019-04-04%20122410.png)

![screenshot](https://github.com/izzuddinfz/divi-woomyacc/raw/master/Annotation%202019-04-18%20222758.png)

![screenshot](https://github.com/izzuddinfz/divi-woomyacc/raw/master/Annotation%202019-04-18%20222913.png)

## Usage

Use by copy the css ([custom.css](https://github.com/izzuddinfz/divi-woomyacc/blob/master/custom.css)) code to the Custom CSS in Divi > Theme Option else copy this css ([custom.css](https://github.com/izzuddinfz/divi-woomyacc/blob/master/custom.css)) to your child theme css.

Copy code below to function.php, the function of the code please refer to the comments.

```php
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
```

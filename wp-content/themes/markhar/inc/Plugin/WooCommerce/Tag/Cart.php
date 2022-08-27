<?php
/**
 * Пример реализации мини-корзины WooCommerce
 *
 * Вы можете добавить Мини-корзину WooCommerce в header.php следующим образом ...
 *
	<?php
		THKKZ\Plugin\WooCommerce\Cart::cart();
	?>

 * @package __theme
 */

namespace THKKZ\Plugin\WooCommerce\Tag;

class Cart
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
	public function register()
	{
    add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'cart_link_fragment' ) );
	}

	public static function cart()
  {
    // Если корзина пуста
    if ( WC()->cart->get_cart_contents_count() == 0 ) {
      $class = 'cart__item--empty';
    }
		?>
    <div class="cart">
        <?php self::cart_link(); ?>
        <div class="cart__item <?php echo $class; ?>">
          <?php
            $instance = array(
              'title' => '',
            );

            the_widget( 'WC_Widget_Cart', $instance );
          ?>
        </div>
    </div>
		<?php
	}

	protected static function cart_link()
  {
    $class = '';

		// if ( is_cart() ) {
		// 	$class = 'cart__link--current';
		// }
    ?>
		<a class="cart__link <?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Посмотреть корзину', '__theme' ); ?>">
      <i class="fas fa-shopping-cart"></i>
      <?php
			$item_count_text = sprintf(
				/* translators: количество товаров в мини-корзине. */
				_n( '%d', '%d', WC()->cart->get_cart_contents_count(), '__theme' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
      <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}

	protected function cart_link_fragment( $fragments )
  {
		ob_start();
		self::cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

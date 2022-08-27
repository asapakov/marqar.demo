<?php
/**
 * WooCommerce
 * 
 * Дополнительные настройки.
 *
 * @package __theme
 */

namespace THKKZ\Plugin\WooCommerce;

class Extra
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
  public function register()
  {
    add_filter( 'body_class', array( $this, 'body_class' ) );
    add_filter( 'woocommerce_sale_flash', array( $this, 'custom_sale_text' ), 10, 3 );
    add_filter( 'gettext', array( $this, 'translate_text' ) );
    add_filter( 'ngettext', array( $this, 'translate_text' ) );
    // add_action( 'woocommerce_product_query', array( $this, 'grouped_products_query' ) );
  }

  /**
   * Добавит класс 'woocommerce-active' в тег body.
   *
   * @param array $classes Классы css, применяемые к тегу body.
   * 
   * @return array $classes
   */
  public function body_class( $classes )
  {
    $classes[] = 'woocommerce-active';

    return $classes;
  }

  /**
   * Подсчет процента.
   *
   * @param ? $text - ?
   * @param ? $post - ?
   * @param ? $_product - ?
   *
   * @return string Скидочный процент
   */
  public function custom_sale_text( $text, $post, $product )
  {
    $percent = 100 - floor( $product->get_price() * 100 / $product->get_regular_price() );

    return '<span class="onsale">-' . $percent . '%</span>';
  }

  /**
   * Отображать только групповые товары.
   *
   * @param object $q Запрос
   * 
   * @return object $q
   */
  public function grouped_products_query( $q )
  {
    //Получить текущий запрос цикла
    $taxonomy_query = $q->get('tax_query') ;

    // Добавить условие сгруппированных товаров
    $taxonomy_query['relation'] = 'AND';
    $taxonomy_query[] = array(
            'taxonomy' => 'product_type',
            'field' => 'slug',
            'terms' => 'grouped'
    );

    $q->set( 'tax_query', $taxonomy_query );
  }

  /**
   * Перевод служебный слов
   * 
   * @param string $translated
   * 
   * @return string $translated;
   */
  public function translate_text( $translated )
  {
    $translated = str_ireplace('Подытог', 'Итого', $translated);
    // $translated = str_ireplace('Таблица размеров', 'Характеристики', $translated);
    // $translated = str_ireplace('Хит продаж', 'Хит', $translated);
    // $translated = str_ireplace('О бренде', 'О производителе', $translated);
    // $translated = str_ireplace('Новый', 'Новинка', $translated);

    return $translated;
  }
}

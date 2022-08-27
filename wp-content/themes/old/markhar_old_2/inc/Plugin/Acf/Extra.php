<?php
/**
 * ACF PRO
 *
 * Дополнительные настройки.
 *
 *
 * @package __theme
 */

namespace THKKZ\Plugin\Acf;

class Extra
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
  public function register()
  {
    add_filter('wp_nav_menu_objects', array( $this, 'nav_menu_icon' ), 10, 2);
  }

  /**
   * Добавляет иконку для пунктов меню.
   *
   * Должено быть настроено поле menu_icon в плагине ACF
   *
   * Пример: <svg width="16" height="16" aria-hidden="true"><use xlink:href="#icon-email"></use></svg>
   *
   * @param $items объект пунктов меню
   * @param $args
   *
   * @return object $items Пункт меню
   */
  public function nav_menu_icon( $items, $args )
  {
    if ( ! function_exists( 'get_field' ) ) return $items;

    foreach( $items as &$item ) {
      // Поле ACF menu_icon
      $icon = get_field( 'menu_icon', $item );
      $is_text_hidden = get_field( 'menu_text', $item );

      // Скрываем текст ссылки
      if ( $is_text_hidden ) {
        $item->title = '<span class="sr-only">' . $item->title . '</span>';
      }

      // Иконка пункта меню
      if( $icon ) {
        $item->title = $icon . $item->title;
      }
    }

    return $items;
  }
}

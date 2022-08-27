<?php
/**
 * Дополнительный функционал.
 *
 * @package __theme
 */

namespace THKKZ\Custom\Extra;

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
    add_filter( 'widget_title', array( $this, 'widget_title_html' ) );
    add_filter( 'get_the_archive_title', array( $this, 'remove_archive_title_pre' ) );
    add_action( 'wp_head', array( $this, 'pingback_header' ) );
	}

  /**
   * Добавляет пользовательские классы в массив классов для <body>.
   *
   * @param array $classes Классы для элемента <body>
   *
   * @return array $classes
   */
  public function body_class( $classes )
  {
    // Если пользователь авторизован
    if ( is_user_logged_in() ) {
      $classes[] = 'user-auth';
    }

    // Прячем корзину в шапке если она пуста
    if ( function_exists( 'WC' ) && WC()->cart->get_cart_contents_count() == 0 ) {
      $classes[] = 'cart-empty';
    }

    // Текущий язык
    if ( function_exists( 'pll_current_language' ) && pll_current_language() ) {
      $classes[] = pll_current_language() . '-language';
    }

		// Если авторов более 2-х.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

    // Добавляет класс для страниц (поста, страницы, вложения, произвольный тип записи).
    if ( ! is_singular() ) {
      $classes[] = 'hfeed';
    }

    // Внутренняя старница
    if ( ! is_front_page() ) {
      $classes[] = 'inner';
    }

    // Добавляет класс .no-sidebar если сайтбар не активен
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
      $classes[] = 'no-sidebar';
    }

    return $classes;
  }

  /**
   * Разрешаем HTML в заголовках виджета.
   *
   * Пример использования: [a href={tel:+88888888888} title={Телефон}]+8 888 888 88 88[/a]
   *
   * @param $title Заголовок виджета
   *
   * @return mixed|string
   *
   * @link https://sh14.ru/wordpress/html-v-zagolovke-vidzhetov
   */
  public function widget_title_html( $title )
  {
    // конвертируем квадратные скобки в уголки
    $title = str_replace( '[', '<', $title );
    $title = str_replace( ']', '>', $title );

    // удаляем все теги, кроме разрешенных
    $title = strip_tags( $title, '<br><span><svg><use><a>' );

    // Для группировки значений атрибутов
    $title = str_replace( '{', '"', $title );
    $title = str_replace( '}', '"', $title );

    // удаляяем символ двойных кавычек
    $title = str_replace( '&quot;', '', $title );

    return $title;
  }

  /**
   * Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива.
   *
   * @param $title Заголовок
   *
   * @return string $title Заголовок
   */
  public function remove_archive_title_pre( $title )
  {
    return preg_replace( '~^[^:]+: ~', '', $title );
  }

  /**
   * Добавляет заголовок автоматического обнаружения URL-адресов для отдельных сообщений, страниц или вложений.
   *
   * @return
   */
  public function pingback_header()
  {
    if ( is_singular() && pings_open() ) {
      printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
  }
}

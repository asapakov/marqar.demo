<?php
/**
 * Подключение стилей и скриптов.
 *
 * @package __theme
 */

namespace THKKZ\Setup;

class Enqueue
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
	public function register()
	{
    // Стили
    add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

    // Скрипты
    add_action( 'wp_enqueue_scripts', array( $this, 'register_script' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_script' ) );

    // Отложенная загрузка
    add_filter( 'style_loader_tag', array( $this, 'lazyload_styles' ), 10, 2 );
    add_filter( 'script_loader_tag', array( $this, 'lazyload_script' ), 10, 3 );
	}

  /**
   * Регистрируем стили.
   */
  public function register_styles() {
    wp_register_style( '__theme-google-font', '//fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap', false );
    wp_register_style( '__theme-style', THEME_URI . '/assets/css/main.css', array(), THEME_VERSION );
  }

  /**
   * Подключаем стили.
   *
   * @return
   */
  public function enqueue_styles() {
    // Подключаем на всех страницах
    wp_enqueue_style( '__theme-google-font' );
    wp_enqueue_style( '__theme-style' );

    // Подключаем на главной странице
    if ( is_front_page() ) {
      //
    }

    // Подключаем на внутренних страницах
    if ( is_singular() ) {
      //
    }
  }

  /**
   * Регистрируем скрипты.
   *
   * @return
   */
  public function register_script() {
    // Переопределяем jQuery на новую версию
		if ( ! is_customize_preview() ) {
			wp_deregister_script( 'jquery' );
      wp_register_script( 'jquery', THEME_URI . '/assets/libs/jquery/jquery.js', array(), '3.6.0', true );
		}

    // Аналитика
    // wp_enqueue_script( '__theme_google-analytics', THEME_URI . '/assets/js/google-analytics.js' );
    // wp_enqueue_script( '__theme_yandex-metrika', THEME_URI . '/assets/js/yandex-metrika.js' );

    wp_register_script( '__theme-main', THEME_URI . '/assets/js/main.js', array( 'jquery' ), THEME_VERSION, true );
    wp_register_script( '__theme-slick', THEME_URI . '/assets/libs/slick/slick.js', array( 'jquery' ), '1.8.1', true );
  }

  /**
   * Подключаем скрипты.
   *
   * @return
   */
  public function enqueue_script() {
    // Подключаем на всех страницах
    // wp_enqueue_script( '__theme_google-analytics' );
    wp_enqueue_script( '__theme-slick' );
    wp_enqueue_script( '__theme-main' );

    // Подключаем на главной странице
    if ( is_front_page() ) {

    }

    // Подключаем для страниц имеющих комментарии
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
  }

  /**
   * Отложенная загрузка стилей.
   *
   * @return $html Разметка <link>
   */
  public function lazyload_styles( $html, $handle ) {
    // Список стилей для отложенной загрузки
    $style_handle = array(
      '__theme-google-font',
      '__theme-style',
    );

    if ( in_array( $handle, $style_handle ) ) {
      return preg_replace( '/\/>$/', 'rel="preload" as="style" />', $html, 1 );
    }

    return $html;
  }

  /**
   * Отложенная загрузка скриптов.
   *
   * @return $html Разметка <link>
   */
  public function lazyload_script( $html, $handle ) {
    // Список скриптов для отложенной загрузки
    $script_handle = array(
      'jquery-core-js',
    );

    if ( in_array( $handle, $script_handle ) ) {
      return preg_replace( '/\/>$/', 'rel="preload" as="script" />', $html, 1 );
    }

    return $html;
  }
}

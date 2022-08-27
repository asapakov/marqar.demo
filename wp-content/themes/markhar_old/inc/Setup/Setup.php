<?php
/**
 * Базовые настройки шаблона.
 *
 * @package __theme
 */

namespace THKKZ\Setup;

class Setup
{
  /**
   * Регистрация hooks и actions для WordPress.
   *
   * @return
   */
  public function register()
  {
    add_action( 'after_setup_theme', array( $this, 'setup' ) );
    add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );
  }

  /**
   * Настройки шаблона.
   *
   * @return
   */
  public function setup()
  {
    /*
    * Добавляем языковые переводы в тему.
    * Переводы хранятся в каталоге /languages.
    */
    load_theme_textdomain( '__theme', THEME_DIR . '/languages' );

    /**
     * Добавляет ссылки на RSS-ленты сайта в <head>
     */
    add_theme_support( 'automatic-feed-links' );

    /*
    * Добавляем правильно заголовок <title> на сайт.
    */
    add_theme_support( 'title-tag' );

    /*
    * Включаем поддержку миниатюр для постов и страниц.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 300, 300, true );

    /*
    * Переключение основной разметки WordPress в спецификацию HTML5.
    *
    * Например: для полей будут подставляться соответствующие типы type = (email, phone и т.п.) вместо text.
    */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        )
    );

    /*
    * Добавляем форматы для записей
    *
    * Используется для представления контента в определенном формате и стиле.
    * Данный стиль задает сам пользователь при создании темы.
    * Т.е. css файлы со стилями и php файлы с логикой if ( has_post_format( 'video' ))
    *
    * @link https://developer.wordpress.org/themes/functionality/post-formats/
    */
    add_theme_support( 'post-formats', array(
        'aside',
        'gallery',
        'link',
        'image',
        'quote',
        'status',
        'video',
        'audio',
        'chat'
      )
    );

    /**
     * Добавляем возможность пользователю изменять цвет основного фона сайта через кастомайзер.
     */
    // add_theme_support( 'custom-background', apply_filters( '__theme_custom_background_args', array(
    //       'default-color' => 'ffffff',
    //       'default-image' => '',
    //     )
    //   )
    // );

    /**
     * Включаем поддержку выборочное обновление для виджетов в кастомайзере.
     */
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Добавляем поддержку логотипа.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     * @link https://developer.wordpress.org/themes/functionality/custom-logo/
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true,
      )
    );
  }

  /**
   * Определите максимальную ширину содержимого, чтобы WordPress мог правильно изменять размер ваших изображений.
   *
   * @global int $content_width Максимальная ширина контента
   *
   * @link https://developer.wordpress.org/themes/basics/theme-functions/#content-width
   * @link https://pineco.de/why-we-should-set-the-content_width-variable-in-wordpress-themes/
   *
   * @return
   */
  public function content_width()
  {
      $GLOBALS['content_width'] = apply_filters( 'content_width', 1440 );
  }
}

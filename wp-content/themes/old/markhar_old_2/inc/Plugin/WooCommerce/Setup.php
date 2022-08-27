<?php
/**
 * WooCommerce
 *
 * Базовые настройки.
 *
 * @package __theme
 */

namespace THKKZ\Plugin\WooCommerce;

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

    // $this->clear_all_styles();
    add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
    add_filter( 'woocommerce_enqueue_styles', array( $this, 'dequeue_styles' ) );

    add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
  }

  /**
   * Базовые настройки WooCommerce.
   *
   * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
   * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
   * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
   *
   * @return void
   */
  public function setup()
  {
    $args = array(
      'thumbnail_image_width' => 500,
      'gallery_thumbnail_image_width' => 150,
      'single_image_width'    => 1200,
      'product_grid'          => array(
        'default_rows'    => 3,
        'min_rows'        => 1,
        'default_columns' => 3,
        'min_columns'     => 1,
        'max_columns'     => 3,
      ),
    );

    add_theme_support( 'woocommerce', $args );

    // Поддержка функционала
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
  }

  /**
   * Скрипты и стили для WooCommerce.
   *
   * @return void
   */
  public function scripts()
  {
    // wp_enqueue_style( '__theme-woocommerce-style', THEME_URI . '/assets/css/woocommerce.css', array(), THEME_VERSION );

    $font_path   = \WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
        font-family: "star";
        src: url("' . $font_path . 'star.eot");
        src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
          url("' . $font_path . 'star.woff") format("woff"),
          url("' . $font_path . 'star.ttf") format("truetype"),
          url("' . $font_path . 'star.svg#star") format("svg");
        font-weight: normal;
        font-style: normal;
      }';

    wp_add_inline_style( '__theme-woocommerce-style', $inline_font );
  }

  /**
   * Убрать все стили WooCommerce по умолчанию.
   *
   * Удаление таблицы стилей WooCommerce по умолчанию и установка собственной.
   * Данная настройка защитит вас во время основных обновлений WooCommerce от потере собственных стилей.
   *
   * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
   *
   * @return void
   */
  public function clear_all_styles()
  {
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
  }

  /**
   * Убрать выбранные стили WooCommerce по умолчанию
   *
   * Удаление таблицы стилей WooCommerce по умолчанию и установка собственной.
   * Данная настройка защитит вас во время основных обновлений WooCommerce от потере собственных стилей.
   *
   * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
   *
   * @var $enqueue_styles Массив с активными стилями
   */
  public function dequeue_styles( $enqueue_styles )
  {
    // unset( $enqueue_styles['woocommerce-general'] );
    // unset( $enqueue_styles['woocommerce-layout'] );
    // unset( $enqueue_styles['woocommerce-smallscreen'] );

    if ( is_front_page() || is_home() ) {
      unset( $enqueue_styles['woocommerce-smallscreen'] );
    }

    wp_dequeue_style( 'wc-block-vendors-style' );
    wp_deregister_style( 'wc-block-vendors-style' );

    return $enqueue_styles;
  }

  /**
   * Сопутствующие товары args.
   *
   * @param array $args Связанные продукты args
   *
   * @return array $args
   */
  public function related_products_args( $args )
  {
    $defaults = array(
      'posts_per_page' => 5,
      'columns'        => 5,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
  }
}

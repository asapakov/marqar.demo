<?php
/**
 * Fix для старых версий WordPress.
 *
 * @package __theme
 */

namespace THKKZ\Setup;

class Fix
{
  /**
   * Регистрация hooks и actions для WordPress.
   *
   * @return
   */
  public function register()
  {
    $this->body_open();
  }

  /**
   * Для WordPress меньше 5.2 версии
   *
   * @link https://core.trac.wordpress.org/ticket/12563
   *
   * @return
   */
  public function body_open()
  {
    if ( ! function_exists( 'wp_body_open' ) ) {
      function wp_body_open() {
        do_action( 'wp_body_open' );
      }
    }
  }
}

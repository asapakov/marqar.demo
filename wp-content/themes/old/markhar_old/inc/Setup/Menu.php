<?php
/**
 * Регистрация областей для навигаций.
 *
 * @package __theme
 */

namespace THKKZ\Setup;

class Menu
{
  /**
   * Регистрация hooks и actions для WordPress.
   *
   * @return
   */
  public function register()
  {
    add_action( 'after_setup_theme', array( $this, 'menus' ) );
  }

  /**
   * Регистрация меню
   *
   * @return
   */
  public function menus()
  {
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', '__theme' ),
    ) );
  }
}

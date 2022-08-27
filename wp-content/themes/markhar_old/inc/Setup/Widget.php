<?php
/**
 * Регистрация областей для виджетов.
 *
 * @package __theme
 */

namespace THKKZ\Setup;

class Widget
{
  /**
   * Регистрация hooks и actions для WordPress.
   *
   * @return
   */
  public function register()
  {
    add_action( 'widgets_init', array( $this, 'widgets' ) );
  }

  /**
   * Области виджетов.
   *
   * Для отмены регистрации виджета используйте unregister_sidebar( 'name' );
   *
   * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
   *
   * @return
   */
  public function widgets()
  {
    // Сайтбар для внутренних страниц
    register_sidebar( array(
      'name'          => esc_html__( 'Сайтбар', '__theme' ),
      'id'            => 'sidebar-1',
      'description'   => esc_html__( 'Добавить виджет здесь.', '__theme' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    ) );

    // Секция в подвале 1
    register_sidebar( array(
      'name'          => esc_html__( 'Подвал 1', '__theme' ),
      'id'            => 'footer-1',
      'description'   => esc_html__( 'Добавить виджет здесь.', '__theme' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );

    // Секция в подвале 2
    register_sidebar( array(
      'name'          => esc_html__( 'Подвал 2', '__theme' ),
      'id'            => 'footer-2',
      'description'   => esc_html__( 'Добавить виджет здесь.', '__theme' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );

    // Секция в подвале 3
    register_sidebar( array(
      'name'          => esc_html__( 'Подвал 3', '__theme' ),
      'id'            => 'footer-3',
      'description'   => esc_html__( 'Добавить виджет здесь.', '__theme' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );

    // Секция в подвале 4
    register_sidebar( array(
      'name'          => esc_html__( 'Подвал 4', '__theme' ),
      'id'            => 'footer-4',
      'description'   => esc_html__( 'Добавить виджет здесь.', '__theme' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );
  }
}

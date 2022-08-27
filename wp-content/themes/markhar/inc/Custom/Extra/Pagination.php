<?php
/**
 * Пагинация.
 *
 * @package __theme
 */

namespace THKKZ\Custom\Extra;

class Pagination
{
  /**
   * Регистрация hooks и actions для WordPress.
   *
   * @return
   */
  public function register()
  {
    add_filter('navigation_markup_template', array( $this, 'navigation_template' ), 10, 2 );
  }

  /**
   * Разметка пагинации
   *
   * @return $template
   */
  public function navigation_template( $template, $class )
  {
    /*
    Вид базового шаблона:
    <nav class="navigation %1$s" role="navigation">
      <h2 class="screen-reader-text">%2$s</h2>
      <div class="nav-links">%3$s</div>
    </nav>
    */

    $template = '
    <nav class="page-archive__pagination page-pagination %1$s" role="navigation">
      <div class="page-pagination__links">%3$s</div>
    </nav>
    ';;

    return $template;
  }
}

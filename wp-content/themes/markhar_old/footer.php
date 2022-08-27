<?php
/**
 * Файл шаблона нижней части сайта (Footer - Подвал)
 *
 * Закрывает html докумен, содержит нижнюю разметку сайта, повторяющуюся на страницах.
 *
 * Документация:
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#footer-php
 *
 * @package __theme
 */

  if ( ! defined( 'ABSPATH' ) ) return;

 // Классы
 $classes = array();

 // Максимальное количество виджетов в подвале
 $max_widget = 4;

  /**
   * Проверяем наличие виджетов в зарегистрированных областях
   * и формируем классы
   *
   * @var $i Счетчик
   * @var $count_widget Количество активных виджетов
   */
  for ( $i = 1, $count_widget = 0; $i <= $max_widget; $i++, $count_widget++) {
    if ( is_active_sidebar( "footer-$i" ) ) {
      $classes[$count_widget] = "page-footer__item--$i";
    }
  }
?>

  </div><!-- #page -->

  <footer id="colophon" class="page-footer" role="contentinfo">
    <div class="page-footer__top">
      <div class="page-footer__top-container container">
        <div class="page-footer__list page-footer__list--<?php echo $count_widget; ?>">
          <?php foreach ( $classes as $key => $class ) : $count = ++$key; ?>
            <?php if ( is_active_sidebar( "footer-$count" ) ) : ?>
              <div class="page-footer__item <?php echo $class; ?>">
                <?php dynamic_sidebar( "footer-$count" ); ?>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="page-footer__bottom">
      <div class="page-footer__bottom-container container">
        <b class="page-footer__copyright">Copyright © <?php echo date( 'Y' ); ?> <?php echo bloginfo( 'name' ); ?></b>
        <a class="page-footer__dev" href="https://thk.kz"><?php esc_html_e( 'Создание сайта', '__theme'); ?> <span class="sr-only">Точка KZ</span></a>
      </div>
    </div>


    </div>
  </footer>


  <?php wp_footer(); ?>

</body>
</html>

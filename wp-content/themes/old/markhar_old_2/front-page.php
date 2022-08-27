<?php
/**
 * Основной файл шаблона
 *
 * Это основной файл и один из обязательных файлов в теме WordPress.
 * Обязательные файлы: index.php и style.css.
 *
 * Он используется для отображения страницы, когда ни какие другие файлы шаблона не соответствуют запросу.
 * Например: файл index.php загрузится на главной странице если файл home.php не будет найден.
 *
 * Документация:
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package __theme
 */

  if ( ! defined( 'ABSPATH' ) ) return;

  get_header();
?>

  <main id="content" class="page-content">
    <h1 class="sr-only">Markhar</h1>

    <?php get_template_part( 'views/home/page', 'slider' ); ?>

    <?php get_template_part( 'views/home/page', 'about' ); ?>

    <?php get_template_part( 'views/home/page', 'feature' ); ?>

    <?php get_template_part( 'views/home/page', 'doc' ); ?>

    <?php get_template_part( 'views/home/page', 'call' ); ?>

  </main>

<?php get_footer(); ?>

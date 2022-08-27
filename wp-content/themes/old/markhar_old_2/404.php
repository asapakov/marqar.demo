<?php
/**
 * Страница 404
 *
 * Данный шаблон отображается если пользователь пеешел по несуществующей ссылке.
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package __theme
 */

if ( ! defined( 'ABSPATH' ) ) return;

get_header();
?>

  <main id="content" class="page-content">

    <?php THKKZ\Tag\Banner::banner(); ?>

    <div class="page-content__container container">

      <div class="page-content__content">
        <?php get_template_part( 'views/page/content', '404' ); ?>
      </div>

      <div class="page-content__sidebar">
        <?php get_sidebar(); ?>
      </div>

    </div>
  </main><!-- #main -->

<?php
get_footer();

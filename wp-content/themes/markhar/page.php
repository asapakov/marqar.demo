<?php
/**
 * Страница
 *
 * Выводит контент содержимого опубликованного через страницы.
 *
 * @link  https://developer.wordpress.org/themes/basics/template-hierarchy/
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
        <?php
          while ( have_posts() ) :
            the_post();

            get_template_part( 'views/page/content', 'page' );

          endwhile;
        ?>
      </div>

      <div class="page-content__sidebar">
        <?php get_sidebar(); ?>
      </div>

    </div>
  </main><!-- #main -->

<?php get_footer(); ?>

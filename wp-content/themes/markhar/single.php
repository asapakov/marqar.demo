<?php
/**
 * Страница записей
 *
 * Выводит контент содержимого опубликованного через записи.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
        <?php if ( have_posts() ) : ?>
          <div class="page-content__content-wrapp">
            <?php
              while ( have_posts() ) :
                the_post();

                get_template_part( 'views/page/content', get_post_type() );

              endwhile;
            ?>
          </div>

          <?php
            the_post_navigation( array(
              'prev_text'    => '<svg width="16" height="16" aria-hidden="true"><use xlink:href="#icon-left-arrow"></use></svg> %title',
              'next_text'    => '%title <svg width="16" height="16" aria-hidden="true"><use xlink:href="#icon-right-arrow"></use></svg>',
              'in_same_term' => true
            ) );
          ?>

          <?php else : ?>

            <?php get_template_part( 'views/page/content', 'none' ); ?>

          <?php endif; ?>

      </div>

      <div class="page-content__sidebar">
        <?php get_sidebar(); ?>
      </div>

    </div>
  </main><!-- #main -->

<?php
get_footer();

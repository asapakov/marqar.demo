<?php
/**
 * Шаблон категорий
 *
 * Выводит записи выбранной категории.
 *
 * Документация:
 * @link https://codex.wordpress.org/Creating_an_Archive_Index
 *
 * @package __theme
 */

if ( ! defined( 'ABSPATH' ) ) return;

get_header();
?>

  <main id="content" class="page-archive">

    <?php THKKZ\Tag\Banner::banner(); ?>

    <div class="page-archive__container container">

      <div class="page-archive__content">
        <?php if ( have_posts() ) : ?>
          <div class="page-archive__content-wrapp">
            <?php
              while ( have_posts() ) :
                the_post();

                get_template_part( 'views/page/content', 'archive' );

              endwhile;
            ?>
          </div>

          <?php the_posts_pagination( array(
            'prev_text'    => '<svg width="16" height="16" aria-hidden="true"><use xlink:href="#icon-left-arrow"></use></svg>',
            'next_text'    => '<svg width="16" height="16" aria-hidden="true"><use xlink:href="#icon-right-arrow"></use></svg>',
          ) ); ?>

          <?php else : ?>

            <?php get_template_part( 'views/page/content', 'none' ); ?>

          <?php endif; ?>

      </div>

      <div class="page-archive__sidebar">
        <?php get_sidebar(); ?>
      </div>

    </div>
  </main><!-- #main -->

<?php
get_footer();

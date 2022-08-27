<?php
/**
 * Вывод контента для страницы 404
 *
 * Выводит если запрашиваемая страница не была найдена.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package __theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-article' ); ?>>

  <div class="content-article__content">
    <p><?php esc_html_e( 'Похоже, в этом месте ничего не было найдено. Может быть, попробуйте одну из ссылок ниже или поиск?', '__theme' ); ?></p>

    <div class="content-article__search">
      <?php get_search_form(); ?>
    </div>

    <div class="content-article__list">
      <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
    </div>

    <div class="content-article__list">
      <h2 class="widget-title"><?php esc_html_e( 'Часто используемые разделы', '__theme' ); ?></h2>
      <ul>
        <?php
        wp_list_categories(
          array(
            'orderby'    => 'count',
            'order'      => 'DESC',
            'show_count' => 1,
            'title_li'   => '',
            'number'     => 10,
          )
        );
        ?>
      </ul>
    </div><!-- .widget -->

    <div class="content-article__list">
      <?php
        /* translators: %1$s: smiley */
        $__theme_archive_content = '<p>' . sprintf( esc_html__( 'Попробуйте поискать в ежемесячных архивах. %1$s', '__theme' ), '' ) . '</p>';
        the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$__theme_archive_content" );

        the_widget( 'WP_Widget_Tag_Cloud' );
      ?>
    </div>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->

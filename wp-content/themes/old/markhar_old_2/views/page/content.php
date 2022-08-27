<?php
/**
 * Общий вывод контента
 *
 * Выводит контент не различая тип публикации (запись, страница и прочее).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package __theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-article' ); ?>>

  <div class="content-article__content">
    <?php
      the_content(
        sprintf(
          wp_kses(
            __( 'Читать далее<span class="screen-reader-text"> "%s"</span>', '__theme' ),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          wp_kses_post( get_the_title() )
        )
      );

      wp_link_pages(
        array(
          'before' => '<div class="article__links">' . esc_html__( 'Страницы:', '__theme' ),
          'after'  => '</div>',
        )
      );

      wp_link_pages(
        array(
          'before' => '<div class="article__links">' . esc_html__( 'Страницы:', '__theme' ),
          'after'  => '</div>',
        )
      );
    ?>
  </div>

  <?php if ( comments_open() || get_comments_number() ) : ?>
    <div class="content-article__comment">
      <?php comments_template(); ?>
    </div>
  <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->

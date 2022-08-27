<?php
/**
 * Контент при поиске
 *
 * Выводит контент который был найден при поиске.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package __theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-archive' ); ?>>

  <a class="content-archive__time-link" href="">
    <time class="content-archive__time" datetime="<?php echo get_the_date( DATE_W3C ); ?>">
      <b class="content-archive__time-date"><?php echo get_the_date( 'd' ) ?></b>
      <span class="content-archive__time-mounth"><?php echo get_the_date( 'F' ) ?></span>
    </time>
  </a>

  <a class="content-archive__img-link" href="<?php the_permalink(); ?>">
    <div class="content-archive__img">
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'full' ); ?>
      <?php endif; ?>
    </div>
    <span class="content-archive__cat"><?php echo single_cat_title(); ?></span>
  </a>

  <div class="content-archive__content">
    <h3 class="content-archive__title">
      <a class="content-archive__link" href="#"><?php the_title() ?></a>
    </h3>

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
    ?>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->

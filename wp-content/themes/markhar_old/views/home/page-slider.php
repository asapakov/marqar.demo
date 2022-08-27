<?php
/**
 * Слайдшоу
 *
 * Выводится на главной странице.
 *
 * @package __theme
 */

  global $post;

  // Количество слайдов
  $count_slides = 3;

  // Получаем слайды
  $posts = get_posts( array(
    'numberposts' => $count_slides,
    'order'       => 'DESC',
    'post_type'   =>  array('post', 'page', 'product'),
    'meta_query' => array(
      array(
      'key' => 'show_slide',
      'value' => '1',
      'compare' => 'LIKE'
      )
    )
  ) );

  // Показываем секцию если слайды найдены
  if ( ! empty( $posts ) ) :
?>

<section class="page-slider page-slider--nojs">
  <h2 class="sr-only">Слайдшоу</h2>

  <ul class="page-slider__list">
    <?php
      // Особенность WordPress обязательно наименовать $post
      // Иначе миниатюра не будет выводиться
      foreach( $posts as $post ) :
        setup_postdata( $post );
    ?>
    <li class="page-slider__item" style="background-image: url(<?php echo get_the_post_thumbnail_url( null, 'full' ); ?>);">
      <div class="page-slider__container container">
        <div class="page-slider__wrapp">
          <h3 class="page-slider__title"><span class="page-slider__link"><?php the_title(); ?></span></h3>
          <div class="page-slider__desc">
            <?php the_content( '' ); ?>
          </div>
          <a class="page-slider__more button button--white" href="<?php the_permalink(); ?>">Читать далее</a>
        </div>
      </div>
    </li>
    <?php endforeach; wp_reset_postdata(); ?>

  </ul>
</section>

<?php endif; ?>

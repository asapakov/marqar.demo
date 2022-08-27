<?php
/**
 * Секция Консультация
 *
 * Выводится на главной странице.
 *
 * @package __theme
 */

  // Страница о нас
  $page_id = 112;

  // Получаем страницу
  $page = get_post( $page_id );

  // Показываем секцию если страница найдена
  if ( ! empty( $page ) ) :
    $post = $page;
    setup_postdata( $post );
?>

<section class="page-call" style="background-image: url(<?php echo get_the_post_thumbnail_url( null, 'full' ); ?>);">
  <div class="page-call__container container">

    <div class="page-call__wrapp">
      <h2 class="page-call__title"><?php the_title(); ?></h2>
      <a class="page-call__more button" href="<?php the_permalink(); ?>">Получить консультацию</a>
    </div>

  </div>
</section>

<?php wp_reset_postdata(); endif; ?>

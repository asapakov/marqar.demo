<?php
/**
 * Секция Преимущества
 *
 * Выводится на главной странице.
 *
 * @package __theme
 */

  global $post;

  // ID категории Преимущества
  $cat_id = 5;

  // Получаем категорию
  $cat = get_category( $cat_id );

  // Показываем секцию если есть записи
  if ( ! empty( $cat ) ) :
    $posts = get_posts( array(
      'numberposts' => 6,
      'category'    => $cat_id,
      'order' => 'ASC',
    ) );

    if ( ! empty( $posts ) ) :
?>

<section class="page-feature">
  <div class="page-feature__container container">

    <header class="page-feature__header title-header">
      <p class="title-header__desc"><?php echo $cat->description; ?></p>
      <h2 class="title-header__title"><?php echo $cat->name; ?></h2>
      <div class="title-header__break"></div>
    </header>

    <ul class="page-feature__list">
      <?php $i = 1; foreach( $posts as $post ) : setup_postdata($post); ?>
      <li class="page-feature__item">

          <?php
            $img = get_field( 'post_about_icon' );
            if ( !empty( $img ) ) :
          ?>
        <div class="page-feature__img">
          <div class="anim-circlephone"></div>
          <div class="anim-circle-fill"></div>
          <div class="anim-img-circle"> <?php echo $img; ?> </div>
        </div>
        <?php endif; ?>

        <h3 class="page-feature__subtitle"><?php the_title(); ?></h3>
        <div class="page-feature__desc"><?php the_content( '' ); ?></div>
      </li>
      <?php $i++; endforeach; wp_reset_postdata(); ?>
    </ul>

    <div class="button-wrapp">
      <a class="page-feature__more button" href="<?php echo get_page_link( 145 ); ?>">Подробнее</a>
    </div>
  </div>
</section>

<?php endif; endif; ?>

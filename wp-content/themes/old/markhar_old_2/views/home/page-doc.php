<?php
/**
 * Секция Документы
 *
 * Выводится на главной странице.
 *
 * @package __theme
 */

  global $post;

  // ID категории Документы
  $cat_id = 6;

  // Получаем категорию
  $cat = get_category( $cat_id );

  // Показываем секцию если есть записи
  if ( ! empty( $cat ) ) :
    $posts = get_posts( array(
      'numberposts' => 4,
      'category'    => $cat_id,
    ) );

    if ( ! empty( $posts ) ) :
?>

<div class="page-doc">
  <div class="page-doc__container container">

    <header class="page-doc__header title-header">
      <p class="title-header__desc"><?php echo $cat->description; ?></p>
      <h2 class="title-header__title"><?php echo $cat->name; ?></h2>
      <div class="title-header__break"></div>
    </header>

    <ul class="page-doc__list">
      <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
      <li class="page-doc__item">
        <h3 class="page-doc__subtitle"><?php the_title(); ?></h3>
        <?php
          $img = get_field( 'document_thumb' );
          if ( !empty( $img ) ) :
        ?>
        <p class="page-doc__img">
          <?php echo wp_get_attachment_image( $img['ID'], array( '144', '144' ) ); ?>
        </p>
        <?php else : ?>
          <?php echo wp_get_attachment_image( 97, array( '144', '144' ) ); ?>
        <?php endif; ?>

        <a class="page-doc__more button button--primary" href="<?php the_permalink(); ?>">Ознакомиться</a>
      </li>
      <?php endforeach; wp_reset_postdata(); ?>
    </ul>

  </div>
</div>

<?php endif; endif; ?>

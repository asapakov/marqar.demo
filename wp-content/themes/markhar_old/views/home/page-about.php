<?php
/**
 * Секция о нас
 *
 * Выводится на главной странице.
 *
 * @package __theme
 */

  global $post;

  // ID категории О компании
  $cat_id = 4;

  // Получаем категорию
  $cat = get_category( $cat_id );

  // Показываем секцию если есть записи
  if ( ! empty( $cat ) ) :
    $posts = get_posts( array(
      'numberposts' => 5,
      'category'    => $cat_id,
    ) );

    if ( ! empty( $posts ) ) :
?>

<section class="page-about page-about--nojs">
  <div class="page-about__container container">

    <header class="page-about__header title-header">
      <p class="title-header__desc"><?php echo $cat->description; ?></p>
      <h2 class="title-header__title"><?php echo $cat->name; ?></h2>
      <div class="title-header__break"></div>
    </header>

    <ul class="page-about__list-toggle">
      <?php $i = 1; foreach( $posts as $post ) : setup_postdata($post); ?>
      <li class="page-about__item-toggle">
        <button class="page-about__toggle <?php if ( $i === 1) echo 'page-about__toggle--show'; ?>" type="button" data-toggle="toggle-<?php echo $i; ?>">
          <i class="page-about__toggle-icon"><?php echo get_field( 'post_about_icon' ); ?></i>
          <span class="page-about__toggle-title">
            <?php
            $text = get_field( 'post_about_text' );
              if ( !empty( $text ) ) echo $text;
              else the_title();
            ?>
          </span>
        </button>
      </li>
      <?php $i++; endforeach; wp_reset_postdata(); ?>
    </ul>

    <div class="page-about__content">
      <p class="page-about__img">
        <?php
          $img = get_field( 'category_img', $cat );
          if ( !empty( $img ) ) echo wp_get_attachment_image( $img['ID'], array( '550', '315' ) );
        ?>
      </p>

      <div class="page-about__info">
        <ul class="page-about__list">
          <?php $i = 1; foreach( $posts as $post ) : setup_postdata($post); ?>
          <li id="toggle-<?php echo $i; ?>" class="page-about__item <?php if ( $i === 1) echo 'page-about__item--show'; ?>">
            <h3 class="page-about__subtitle"><?php the_title(); ?></h3>
            <div class="page-about__desc">
              <?php the_content( '' ); ?>
            </div>
          </li>
          <?php $i++; endforeach; wp_reset_postdata(); ?>
        </ul>

        <a class="page-about__more button" href="<?php echo get_page_link( 56 ); ?>">Читать далее</a>
      </div>
    </div>

  </div>
</section>

<?php endif; endif; ?>

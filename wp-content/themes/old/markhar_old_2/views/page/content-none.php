<?php
/**
 * Пустой контент
 *
 * Данный шаблон выводится если ни чего не было найдено или категория не имеет записей.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package __theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-article content-article--none' ); ?>>

  <div class="content-article__content">
    <h2 class="content-article__title"><?php esc_html_e( 'Ничего не найдено', '__theme' ); ?></h2>

    <?php
      if ( is_home() && current_user_can( 'publish_posts' ) ) :

        printf(
          '<p>' . wp_kses(
            /* translators: 1: ссылка на страницу создания новой записи. */
            __( 'Готовы опубликовать свою первую запись? <a href="%1$s">Опубликовать</a>.', '__theme' ),
            array(
              'a' => array(
                'href' => array(),
              ),
            )
          ) . '</p>',
          esc_url( admin_url( 'post-new.php' ) )
        );

      elseif ( is_search() ) :
    ?>
      <p><?php esc_html_e( 'Извините, но ничего не соответствует вашим условиям поиска.', '__theme' ); ?></p>
      <p><?php esc_html_e( 'Пожалуйста, попытайтесь снова с другими ключевыми словами.', '__theme' ); ?></p>
      <?php
      get_search_form();

    else :
    ?>
      <p><?php esc_html_e( 'Кажется, мы не можем найти то, что вы ищете. Возможно, поиск поможет.', '__theme' ); ?></p>
      <?php
      get_search_form();

    endif;
    ?>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->

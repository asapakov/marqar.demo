<?php
/**
 * Разметка шапки с картинкой и заголовком для внутрених страниц.
 *
 * @package __theme
 */

namespace THKKZ\Tag;

class Banner
{
	/**
	 * Регистрация hooks и actions для WordPress.
   *
	 * @return
	 */
	public function register()
	{

	}

	public static function banner()
  {
    $category = get_category( get_query_var( 'cat' ) );

    $title = get_the_archive_title();
    $desc =  get_the_archive_description();
    $img = get_header_image_tag();

    if ( is_singular() && has_post_thumbnail() ) {
      $img = get_the_post_thumbnail( null, 'full' );
    } elseif ( is_category() && get_field( 'category_image', $category ) ) {
      $img = wp_get_attachment_image( get_field( 'category_image', $category ), 'full' ) ;
    }

    if ( is_singular() ) {
      $title = get_the_title();
    } elseif ( is_search() ) {
      $title = sprintf( esc_html__( 'You searched for: %s', '__theme' ), '<span>' . get_search_query() . '</span>' );
    } elseif ( is_404() ) {
      $title = sprintf( esc_html__('Page not found 404', '__theme' ) );
    }
  ?>
    <section class="page-banner">
      <div class="page-banner__content-container container">

        <div class="page-banner__wrapp">
          <h1 class="page-banner__title"><?php echo $title; ?></h1>
          <?php if ( ! empty( $desc ) ) : ?>
          <div class="page-banner__desc"><?php echo $desc; ?></div>
          <?php endif; ?>
        </div>

        <div class="page-banner__breadcrumb">
          <div class="page-banner__breadcrumb-container container">
            <?php __theme_crumbs(); ?>
          </div>
        </div>

      </div>


      <div class="page-banner__img"><?php echo $img; ?></div>
    </section>
  <?php
	}
}

<?php
/**
 * Пользовательские функции.
 *
 * @package __theme
 */

/**
 * Отладка кода.
 *
 * @return void
 */
if ( ! function_exists( '__theme_dd' ) ) {
	function __theme_dd() {
		echo '<pre>';
		array_map( function( $x ) {
			var_dump( $x );
		}, func_get_args() );
		echo '</pre>';
		die;
	}
}

/**
 * Font Awesome CDN.
 *
 * Подключение Font Awesome из Font Awesome Free или Pro CDN.
 *
 * @link https://fontawesome.com/how-to-use/customizing-wordpress/snippets/setup-cdn-webfont#lay-the-foundation
 *
 *  @return void
 *
 * __theme_fontawesome(
 *   'https://use.fontawesome.com/releases/v5.15.1/css/solid.css',
 *   'sha384-yo370P8tRI3EbMVcDU+ziwsS/s62yNv3tgdMqDSsRSILohhnOrDNl142Df8wuHA+'
 * );
 * __theme_fontawesome(
 *   'https://use.fontawesome.com/releases/v5.15.1/css/brands.css',
 *   'sha384-/feuykTegPRR7MxelAQ+2VUMibQwKyO6okSsWiblZAJhUSTF9QAVR0QLk6YwNURa'
 * );
 * __theme_fontawesome(
 *   'https://use.fontawesome.com/releases/v5.15.1/css/fontawesome.css',
 *   'sha384-ijEtygNrZDKunAWYDdV3wAZWvTHSrGhdUfImfngIba35nhQ03lSNgfTJAKaGFjk2'
 * );
 */
if ( ! function_exists( '__theme_fontawesome' ) ) {
  function __theme_fontawesome( $cdn_url = '', $integrity = null ) {
    $matches = [];
    $match_result = preg_match( '|/([^/]+?)\.css$|', $cdn_url, $matches );
    $resource_handle_uniqueness = ( $match_result === 1 ) ? $matches[1] : md5( $cdn_url );
    $resource_handle = "font-awesome-cdn-webfont-$resource_handle_uniqueness";

    foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
      add_action(
        $action,
        function () use ( $cdn_url, $resource_handle ) {
          wp_register_style( $resource_handle, $cdn_url, [], null );
        }
      );
    }

    if( $integrity ) {
      add_filter(
        'style_loader_tag',
        function( $html, $handle ) use ( $resource_handle, $integrity ) {
          if ( in_array( $handle, [ $resource_handle ], true ) ) {
            return preg_replace(
              '/\/>$/',
              'integrity="' . $integrity .
              '" crossorigin="anonymous" rel="preload" as="style" />',
              $html,
              1
            );
          } else {
            return $html;
          }
        },
        10,
        2
      );
    }
  }
}

/**
 * SVG спрайт.
 *
 * @param
 *
 * @return
 */
if ( ! function_exists( '__theme_sprite' ) ) {
  function __theme_sprite() {
    $sprite_mono = THEME_DIR . '/assets/images/sprite-mono.svg';
    $sprite_multi = THEME_DIR . '/assets/images/sprite-multi.svg';

    if ( file_exists( $sprite_mono ) || file_exists( $sprite_multi ) ) :
  ?>
    <div class="hidden">
      <?php if ( file_exists( $sprite_mono ) ) echo file_get_contents( $sprite_mono ); ?>
      <?php if ( file_exists( $sprite_multi ) ) echo file_get_contents( $sprite_multi ); ?>
    </div>
  <?php
  endif;
  }
}

/**
 * Навигационное меню.
 *
 * @param $location string Название области меню
 * @param $depth int Уровень вложенности меню
 *
 * @return
 */
if ( ! function_exists( '__theme_nav_menu' ) ) {
  function __theme_nav_menu( $location, $options = array() ) {
    $args = array(
      'theme_location' => $location,
      'container' => '',
      'echo' => false,
      'fallback_cb' => '__return_false',
    );

    $args = array_merge( $args, $options );

    $menu = wp_nav_menu( $args );

    if ( ! empty( $menu ) ) : echo $menu;
    else :
  ?>
    <span><?php esc_html_e( 'Меню для области "' . ucfirst( $location ) . '" не создано.', '__theme' ); ?></span>
  <?php
    endif;
  }
}

/**
 * Логотип.
 *
 * @param
 *
 * @return
 */
if ( ! function_exists( '__theme_logo' ) ) {
  function __theme_logo() {
    $class_content = '';

    if ( ! display_header_text() ) $class_content = 'sr-only';
  ?>
    <div class="page-logo">
      <div class="page-logo__img">
        <?php the_custom_logo(); ?>
      </div>

      <div class="page-logo__content <?php echo $class_content; ?>">
        <?php
          $title = get_bloginfo(); // Заголовок сайта
          $description = get_bloginfo( 'description', 'display' ); // Описание сайта
        ?>

        <?php if ( $title || is_customize_preview() ) : ?>
          <b class="page-logo__content-title"><?php echo $title; ?></b>
        <?php endif; ?>

        <?php if ( $description || is_customize_preview() ) : ?>
          <div class="page-logo__content-desc">
            <?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php
  }
}

/**
  * Хлебные крошки.
  *
  * @param  array  $options
  *
  * @return void
*/
// if ( ! function_exists( '__theme_crumbs' ) ) {
//   function __theme_crumbs($options = array()) {
//     if ( function_exists( 'woocommerce_breadcrumb' )) {
//       woocommerce_breadcrumb( $options );
//     } else {
//       $Crumbs = new THKKZ\Custom\Breadcrumbs\Crumbs($options);
//       $Crumbs->theBreadcrumbs();
//     }
//   }
// }

if ( ! function_exists( '__theme_crumbs' ) ) {
  function __theme_crumbs( $args = array() ) {

    if ( function_exists( 'woocommerce_breadcrumb' )) {
      woocommerce_breadcrumb( $options );
    } else {
      $breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

      if ( ! is_object( $breadcrumb ) )
        $breadcrumb = new THKKZ\Custom\Breadcrumbs\Crumbs( $args );

      return $breadcrumb->trail();
    }
  }
}

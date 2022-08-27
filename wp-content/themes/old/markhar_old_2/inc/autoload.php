<?php
/**
 * Автозагрузчик классов.
 *
 * @link https://awhitepixel.com/blog/autoloader-namespaces-theme-plugin/
 *
 * @package __theme
 */

 /**
  * Подключает вызываемые классы.
  *
  * @return
  */
 spl_autoload_register( function( $class ) {
  if ( strpos( $class, THEME_NAMESPACE ) !== 0 ) {
    return;
  }

  $class = str_replace( THEME_NAMESPACE, '', $class );
  $class = str_replace( '\\', DIRECTORY_SEPARATOR, $class );

  $file = THEME_DIR . DIRECTORY_SEPARATOR .  'inc' . DIRECTORY_SEPARATOR . $class . '.php';

  if ( file_exists( $file ) ) {
    require_once( $file );
  }
} );

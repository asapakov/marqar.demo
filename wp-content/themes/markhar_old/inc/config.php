<?php
/**
 * Конфигурации темы.
 *
 * @package __theme
 */

// Окружение
if ( ! defined( 'THEME_NAMESPACE' ) ) {
  define( 'THEME_NAMESPACE', 'THKKZ\\' );
}

/**
 * Режим разработки.
 *
 * development - режим разработки
 * production - режим использования
 */
if ( ! defined( 'THEME_ENV' ) ) {
  define( 'THEME_ENV', 'development' );
}

// Путь до каталога текущей темы
if ( ! defined( 'THEME_DIR' ) ) {
  define( 'THEME_DIR', get_theme_file_path() );
}

// URI путь до каталога текущей темы
if ( ! defined( 'THEME_URI' ) ) {
  define( 'THEME_URI', get_theme_file_uri() );
}

// Версия темы
if ( ! defined( 'THEME_VERSION' ) ) {
  if ( defined( 'THEME_ENV' ) && THEME_ENV === 'development' ) {
    define( 'THEME_VERSION', rand(1, 10e3) );
  } else {
    define( 'THEME_VERSION', wp_get_theme( get_template() )->get('Version') );
  }
}

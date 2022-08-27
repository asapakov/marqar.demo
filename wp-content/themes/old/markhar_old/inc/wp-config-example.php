<?php
/**
 * Пример пользовательских настроек для файла wp-config.php в корне CMS
 */

/**
 * Получаем текущий url сайта.
 *
 *  @var string|bool $domain - доменное имя
 */
function get_domain_url($domain = false) {
  if ( ( ! empty( $_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ) || $_SERVER['SERVER_PORT'] === 443 ) {
      $protocol = 'https://';
  } else {
      $protocol = 'http://';
  }

  if ($domain) {
      return $protocol . $domain;
  }

  return $protocol . $_SERVER['HTTP_HOST'];
}

// Переопределяем стандартные пути wordpress
define( 'WP_CONTENT_DIR', __DIR__ . '/wp-content' );
define( 'WP_CONTENT_URL', get_domain_url() . '/wp-content' );
define( 'WP_SITEURL', get_domain_url() );
define( 'WP_HOME', get_domain_url() );

// Пользовательские настройки
define( 'WP_ENV', 'development' ); // окружение development или production

define( 'WP_DEBUG', WP_ENV === 'development' ? true : false ); // режим отладки

// Если включен режим отладки
if ( WP_DEBUG ) {
  ini_set( 'display_errors', 1 ); // отображение всех ошибок
  define( 'WP_DEBUG_LOG', true ); // логирование ошибок
  define( 'WP_DEBUG_DISPLAY', true ); // отображение ошибок на экране
  define( 'SCRIPT_DEBUG', true ); // использование dev версий файлов wordpress (css, js)
  define( 'SAVEQUERIES', true ); // для анализа запросов к БД, для отладки использовать $wpdb->queries
  define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true ); // отображение фатальных ошибок
  define( 'ALLOW_UNFILTERED_UPLOADS', true ); // отключение проверки безопасности загружаемых файлов
}

// Отключение установки плагинов, обновления wordpress, переводов, тем и плагинов через админку
define( 'DISALLOW_FILE_MODS', WP_ENV === 'production' ? true : false );

define( 'WP_POST_REVISIONS', 3 ); // максимальное количество ревизий для записей
// define( 'WPCF7_AUTOP', false ); // убирает лишние теги в разметки Contact Form 7

define( 'WP_MEMORY_LIMIT', '300M' ); // максимальный вес загружаемых файлов

<?php
/**
* Основные параметры WordPress.
*
* Скрипт для создания wp-config.php использует этот файл в процессе
* установки. Необязательно использовать веб-интерфейс, можно
* скопировать файл в "wp-config.php" и заполнить значения вручную.
*
* Этот файл содержит следующие параметры:
*
* * Настройки MySQL
* * Секретные ключи
* * Префикс таблиц базы данных
* * ABSPATH
*
* @link https://ru.wordpress.org/support/article/editing-wp-config-php/
*
* @package WordPress
*/

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'marqardb');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
* Уникальные ключи и соли для аутентификации.
*
* Смените значение каждой константы на уникальную фразу.
* Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
* Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
*
* @since 2.6.0
*/
define('AUTH_KEY',         ';:Q{A^mB4q{T.[ok89Zw<JcE$1$zBt[TIW&z6Bd6(EjilMDzp^#<@|>TqF%6,%;%');
define('SECURE_AUTH_KEY',  'e&a[RwrYSW3ZjyAd!x|y9kK<LcZgxfcmwS@sRc4nIG|--T6 $Uxb*8?l+?? `J}`');
define('LOGGED_IN_KEY',    '}eNGwXO4BmIC_~hS)]GL3m-E9lV7_phDgA77hZ`<L+6XS(-m.z/W7o/oMYvP(>gv');
define('NONCE_KEY',        ':tluz#bsy~m$hTzga>9M>P4*d=WYsV+@<p7PZ,oK9rElMuSR#q#mE_kpgH+U^5O+');
define('AUTH_SALT',        '-07{w39x&Jol*Y(sc$X.=z~ZM$)i,`P]oHe>~stvr:_/%RlmN{s[^Vm44;qjkAZ[');
define('SECURE_AUTH_SALT', '+rP  +G^r>L?&(R]5Wlt??+gg%q)jG):10-[MWKTgCA7;t=,l9,rH|z4<G]K!Nfn');
define('LOGGED_IN_SALT',   '[YSdYy-9gwT>q~W00[w+8 @G}X,zCgN^q!)4fWnr$MBjgTaDI$*/5t3Ah=x=ILcR');
define('NONCE_SALT',       'X/,0$-`~wE3EOR+ *G-]q<[RedU,mZ`;$D>IeLl&j1Sn[]Cdl`FJ;4v~Scc*!)wF');

/**#@-*/

/**
* Префикс таблиц в базе данных WordPress.
*
* Можно установить несколько сайтов в одну базу данных, если использовать
* разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
*/
$table_prefix = 'wp_';

/**
* Для разработчиков: Режим отладки WordPress.
*
* Измените это значение на true, чтобы включить отображение уведомлений при разработке.
* Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
* в своём рабочем окружении.
*
* Информацию о других отладочных константах можно найти в документации.
*
* @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
*/
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';

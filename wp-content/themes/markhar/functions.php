<?php
/**
 * Содержит различные пользовательские настройки текущей темы.
 *
 * Подключает различные расширения, дополнения, переопределяет стандартные настройки WordPress, плагинов.
 * Содержит пользовательскую логику.
 *
 * Документация:
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package __theme
 */

// Проверка наличия WordPress
if ( ! defined( 'ABSPATH' ) ) return;

// Конфигурации
locate_template( 'inc/config.php', true, true );

// Пользовательские функции
locate_template( 'inc/helpers.php', true, true );

// Автозагрузчик классов
locate_template( 'inc/autoload.php', true, true );

// Инициализация шаблона
if ( class_exists( 'THKKZ\Init' ) ) {
	THKKZ\Init::get_instance()->register_services();
}

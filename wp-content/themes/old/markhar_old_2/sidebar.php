<?php
/**
 * Сайтбар (боковая панель)
 *
 * Содержит различные виджеты.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package __theme
 */

if ( ! defined( 'ABSPATH' ) ) return;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="page-sidebar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

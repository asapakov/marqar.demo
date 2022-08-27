<?php
/**
 * Файл шаблона верхней части сайта (Header - Шапка)
 *
 * Открывает html докумен, содержит правила <head>,
 * а так же верхнюю разметку сайта, повторяющуюся на страницах.
 *
 * Документация:
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#header-php
 *
 * @package __theme
 */

if ( ! defined( 'ABSPATH' ) ) return;
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-P5BCJXM');
  </script> <!-- End Google Tag Manager -->

  <meta name="description" content="">
  <meta name="keywords" content="">

  <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5BCJXM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?php wp_body_open(); ?>

  <?php __theme_sprite(); ?>

  <div id="page" class="page-wrapp">

    <header id="masthead" class="page-header page-header--nojs" role="banner">
      <div class="page-header__container container">
        <div class="page-header__logo">
          <?php __theme_logo(); ?>
        </div>

        <div id="site-navigation" class="page-header__nav page-nav">
          <button class="page-nav__toggle" type="button" aria-label="Меню" aria-role="switch"></button>
          <div class="page-nav__wrapp">
            <?php __theme_nav_menu( 'primary', array(
              'walker' => new THKKZ\Custom\Menu\MainNavMenu,
            ) ); ?>
          </div>
        </div>

        <div class="page-header__login login-nav">
          <a class="login-nav__link" href="https://markhar.com/s/frontend/web/site/login" title="Авторизоваться на сайт">
            <span class="sr-only">Авторизоваться на сайт</span>
            <svg class="login-nav__icon" width="18" height="18" aria-hidden="true">
              <use xlink:href="#icon-enter"></use>
            </svg>
          </a>

          <a class="login-nav__link" href="https://markhar.com/s/frontend/web/site/signup" title="Зарегистрироваться на сайте">
            <span class="sr-only">Зарегистрироваться на сайте</span>
            <svg class="login-nav__icon" width="18" height="18" aria-hidden="true">
              <use xlink:href="#icon-key"></use>
            </svg>
          </a>
        </div>
      </div>
    </header>

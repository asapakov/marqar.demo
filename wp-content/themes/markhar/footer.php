<?php
/**
 * Файл шаблона нижней части сайта (Footer - Подвал)
 *
 * Закрывает html докумен, содержит нижнюю разметку сайта, повторяющуюся на страницах.
 *
 * Документация:
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#footer-php
 *
 * @package __theme
 */

  if ( ! defined( 'ABSPATH' ) ) return;

 // Классы
 $classes = array();

 // Максимальное количество виджетов в подвале
 $max_widget = 4;

  /**
   * Проверяем наличие виджетов в зарегистрированных областях
   * и формируем классы
   *
   * @var $i Счетчик
   * @var $count_widget Количество активных виджетов
   */
  for ( $i = 1, $count_widget = 0; $i <= $max_widget; $i++, $count_widget++) {
    if ( is_active_sidebar( "footer-$i" ) ) {
      $classes[$count_widget] = "page-footer__item--$i";
    }
  }
?>

  </div><!-- #page -->

  <footer id="colophon" class="page-footer" role="contentinfo">
    <div class="page-footer__top">
      <div class="page-footer__top-container container">
        <div class="page-footer__list page-footer__list--<?php echo $count_widget; ?>">
          <?php foreach ( $classes as $key => $class ) : $count = ++$key; ?>
            <?php if ( is_active_sidebar( "footer-$count" ) ) : ?>
              <div class="page-footer__item <?php echo $class; ?>">
                <?php dynamic_sidebar( "footer-$count" ); ?>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="page-footer__bottom">
      <div class="page-footer__bottom-container container">
        <b class="page-footer__copyright">Copyright © <?php echo date( 'Y' ); ?> <?php echo bloginfo( 'name' ); ?></b>
        <a class="page-footer__dev" href="https://thk.kz"><?php esc_html_e( 'Создание сайта', '__theme'); ?> <span class="sr-only">Точка KZ</span></a>
      </div>
    </div>


    </div>
  </footer>


  <?php wp_footer(); ?>

<!-- binotel widget -->
<script type="text/javascript">
  (function(d, w, s) {
	var widgetHash = 'si0c6zmamm8cnuk58kr9', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
	gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
	var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
  })(document, window, 'script');
</script>



<style>
body #bingc-phone-sample span {
 display: none;
 }
 body #bingc-phone-sample:after{
 content: "Не резидентам РК за пределами КЗ - обращаться в Телеграмм";
 }
.telegram-button, .viber-button {
    position: fixed;
    right: 13px;
    bottom: 5%;
    transform: translate(-50%, -50%);
    background: #0088cc;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    color: #fff;
    text-align: center;
    line-height: 53px;
    font-size: 35px;
    z-index: 9999;
}
.viber-button {
	right: 120px !important;
	background: #fff;
}
.telegram-button a,
.viber-button a {
    color: #fff;
}
.telegram-button:before,
.telegram-button:after,
.viber-button:before,
.viber-button:after {
    content: " ";
    display: block;
    position: absolute;
    border: 60%;
    border: 1px solid #0088cc;
    left: -20px;
    right: -20px;
    top: -20px;
    bottom: -20px;
    border-radius: 60%;
    animation: animate 1.5s linear infinite;
    opacity: 0;
    backface-visibility: hidden; 
}
 
.telegram-button:after,
.viber-button:after {
    animation-delay: .5s;
}
 
@keyframes animate
{
    0%
    {
        transform: scale(0.5);
        opacity: 0;
    }
    50%
    {
        opacity: 1;
    }
    100%
    {
        transform: scale(1.2);
        opacity: 0;
    }
}
	
@media (max-width : 425px) {  
	.telegram-button {   
		bottom: 0;
		right: 0;
	  }
	.viber-button {
		right: 0 !important;
		bottom: 120px;
	}
}
.viber-button img,
.telegram-button img {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
}
</style>
	
<!-- telegram -->
<a href="https://t.me/MARQAR_FAQBOT" target="_blank" title="Написать в Telegram" rel="noopener noreferrer">
	<div class="telegram-button">
		<img src="<?php echo get_template_directory_uri() . '/assets/images/tg.png' ?>">
	</div>
</a>

<!-- viber -->
<a href="viber://chat?number=87770821922" target="_blank" title="Позвонить через viber" rel="noopener noreferrer">
	<div class="viber-button">
		<img src="<?php echo get_template_directory_uri() . '/assets/images/viber.png' ?>">
	</div>
</a>

</body>
</html>

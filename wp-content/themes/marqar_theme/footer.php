<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>


<section class="d-flex page__feedback feedback">
    <div class="feedback__box">
        <h2 class="feedback__title">Свяжитесь с нами</h2>
        <form action="" class="feedback__form form-feedback">
            <input autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="Имя"
                   class="form-feedback__input input" data-placeholder="Имя">
            <input autocomplete="off" type="tel" name="form[]" data-error="Ошибка" placeholder="Номер телефона"
                   class="form-feedback__input input" data-placeholder="Номер телефона">
            <button type="submit" class="form-feedback__submit">Отправить</button>
        </form>
    </div>
</section>


<footer>

    <div class="py-4"
         style="background-image: url(/wp-content/themes/marqar_theme/assets/images/rectangle-7-300x113.png);">
        <div class="d-flex">
            <div class="col-2 text-center"><img src="/wp-content/themes/marqar_theme/assets/images/logo-3.png"></div>
            <div class="col-10 text-start"><p class="footer-text">Компания MARQAR LLP ожидает от всех участников проекта
                    поддержания принципов справедливости,
                    честности и конфиденциальности при заключении сделок и иной деловой активноcти.</p></div>
        </div>
        <div class="d-flex text-light justify-content-around mt-4">
            <div name="social-media" class="social-media-footer d-flex justify-content-between col-2 ms-5">
                <div><a href=""><i class="fa fa-instagram fa-2x"></i></a></div>
                <div><a href=""><i class="fa fa-youtube-play fa-2x"></i></a></div>
                <div><a href=""><i class="fa fa-telegram fa-2x"></i></a></div>
            </div>
            <div class="d-flex my-auto">
                <img style="height: 22px" src=/wp-content/themes/marqar_theme/assets/images/footer-map-icon.png>
                <p class="footer-text-bottom ms-2">050021 Алматы, Бульвар
                    Бухар Жырау 2</p>
            </div>
            <div class="d-flex">
                <img style="height: 22px" src=/wp-content/themes/marqar_theme/assets/images/footer-mail-icon.png>
                <p class="footer-text-bottom ms-2">info@marqar.kz</p>
            </div>
            <div class="d-flex">
                <img style="height: 22px" src="/wp-content/themes/marqar_theme/assets/images/footer-phone-icon.png">
                <p class="footer-text-bottom ms-2">+7 778 326 15
                    25</p>
            </div>
        </div>
    </div>
    </div>

</footer>

<!-- binotel widget -->
<script type="text/javascript">
    (function (d, w, s) {
        var widgetHash = 'si0c6zmamm8cnuk58kr9', gcw = d.createElement(s);
        gcw.type = 'text/javascript';
        gcw.async = true;
        gcw.src = '//widgets.binotel.com/getcall/widgets/' + widgetHash + '.js';
        var sn = d.getElementsByTagName(s)[0];
        sn.parentNode.insertBefore(gcw, sn);
    })(document, window, 'script');
</script>

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


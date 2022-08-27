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
<footer style=" margin-top: 10rem">
    <div class="d-flex align-items-center mt-auto"
         style="background-image: url(/wp-content/themes/marqar_theme/assets/images/rectangle-7-300x113.png); height: 100px">
        <div class="w-100 d-flex justify-content-evenly">
            <div><img src=/wp-content/themes/marqar_theme/assets/images/footer-marqar.png></div>
            <div class="d-flex my-auto">
                <img style="height: 21px" src=/wp-content/themes/marqar_theme/assets/images/footer-map-icon.png>
                <p style="font-family: Roboto; font-size: 16px; font-weight: 400; color: white">050021 Алматы, Бульвар
                    Бухар Жырау 2</p>
            </div>
            <div class="d-flex">
                <img style="height: 21px" src=/wp-content/themes/marqar_theme/assets/images/footer-mail-icon.png>
                <p style="font-family: Roboto; font-size: 16px; font-weight: 400; color: white">info@marqar.kz</p>
            </div>
            <div class="d-flex">
                <img style="height: 21px" src="/wp-content/themes/marqar_theme/assets/images/footer-phone-icon.png">
                <p style="font-family: Roboto; font-size: 16px; font-weight: 400; color: white">+7 778 326 15
                    25</p>
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


<style>
    body #bingc-phone-sample span {
        display: none;
    }

    body #bingc-phone-sample:after {
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

    @keyframes animate {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: scale(1.2);
            opacity: 0;
        }
    }

    @media (max-width: 425px) {
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


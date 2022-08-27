<?php
/**
 * Template Name: Запись документов
 * Template Post Type: page, post
 */
?>

<style>
    .bgChange {
        background-color: #0B2137;
    }
</style>

<?php get_header(); ?>
<div name="webV" class="d-none d-sm-block pb-5"
     style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDarkTheme.png); background-size: cover; background-repeat: repeat-y; background-attachment: fixed">

    <br><br><br>
    <div class="container text-start w-75 mt-5" style="margin-bottom: 200px">
        <div class="container">
            <p class="" style="font-family: Roboto; font-weight: 500; font-size: 16px; color: #DAAB31">Инновационные
                кейсы на
                помощь решения любых ваших задач</p>
            <div class="d-flex row ">
                <div class="col me-auto"><a href="/о-компании/"
                                            style="font-family: Roboto; font-weight: 400; font-size: 32px; color: white; opacity: 0.75; text-decoration: none">О
                        компании
                        / </a><a
                            style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white"><?php the_title() ?></a>
                </div>
            </div>
        </div>
        <div class="container p-3 shadow-lg rounded bgChange mt-3">

            <hr>
            <div class="m-3"
                 style="font-family: Roboto; font-weight: 400; font-size: 18px; color: white; opacity: 0.75">
                <p><?php the_content(); ?></p></div>
        </div>
    </div>
    <?php
    get_footer();
    ?>
</div>

<div name="mobV" class="d-block d-sm-none pb-3 px-2"
     style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDark.png); background-repeat: repeat-y; height: auto">
    <div class="text-start ms-1 pt-3">
        <p class="mb-0" style="font-family: Roboto;font-weight: 400; font-size: 14px; color: #DAAB31">
            Инновационные кейсы</p>
        <p class="mt-0" style="font-family: Roboto;font-weight: 600; font-size: 22px; color: white">Документы "MARQAR"</p>
    </div>
    <div class="container mt-4 text-start rounded border px-2">
        <div style="font-family: Roboto; font-weight: 700; font-size: 24px; color: white"><?= the_title() ?></div>
        <hr style="color: white">
        <div style="color: white; opacity: 0.54; font-family: Roboto; font-weight: 400; font-size: 15px;"
             class="mt-4 mx-0"><?= the_content() ?>
        </div>
    </div>
    <script type="text/javascript">
        (function(d, w, s) {
            var widgetHash = 'si0c6zmamm8cnuk58kr9', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
            gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
            var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
        })(document, window, 'script');
    </script>
</div>
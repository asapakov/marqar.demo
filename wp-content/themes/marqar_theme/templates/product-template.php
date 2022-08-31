<?php
/**
 * Template Name: Запись продуктов
 * Template Post Type: page, post
 */
?>

<style>
    .tabhover {
        font-family: Roboto;
        font-weight: 700;
        font-size: 24px;
        color: #C1C1C1;
        border: 1px solid #C1C1C1;
    }

    .btn:hover {
        text-decoration: none;
        color: white;
        border: none;
    }

    .btnBigHover:hover {
        transform: scale(1.1);
        transition-duration: 0.5s;
    }

    .tablinks {
        border: none;
        color: #C1C1C1;
        background: none;
    }

    .tablinks:hover {
        color: white;
    }

    .tabhover:hover {
        background-color: #DAAB31;
    }

    .active1 {
        background-color: #DAAB31;
        color: white;
    }

    .bgChange {
        background: #0B2137;
    }


</style>

<?php get_header(); ?>
<div class="d-none d-sm-block pt-5"
     style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDarkTheme.png); background-size: cover; background-repeat: repeat-y; background-attachment: fixed">

    <br><br><br>
    <div class="container text-start w-75" style="margin-bottom: 200px">
        <div class="container">
            <div class="d-flex row ">
                <div class="col-sm-8 me-auto"><a href="/наши-продукты/"
                                                 style="font-family: Roboto; font-weight: 400; font-size: 32px; color: white; opacity: 0.75; text-decoration: none">Наши
                        продукты / </a><a
                            style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white"><?php the_title() ?></a>
                </div>
                <div class="col text-end">
                    <a href=https://marqar.kz/s/frontend/web/site/signup class="btn text-center btnBigHover shadow-lg"
                       style="background-color: #DAAB31; font-family: Roboto; font-size: 24px; font-weight: 400; color: white">
                        <h5 class="text-light mb-0 pb-0"><span class="buy-button-top">32 000</span> тенге</h5><p class="buy-button-bottom mb-0">или 68 USD по НБРК</p>
                    </a>                </div>
            </div>

            <div class="container shadow-lg mt-4 p-0 rounded mt-5 bgChange">
                <div class="w-100 rounded m-0 p-0"><img class="w-100" style="height: 400px; object-fit: cover"
                                                        src="<?php the_field('изображение_общее'); ?>"</div>
                <div class=" text-center d-flex justify-content-around">
                    <div class="tabhover w-25">
                        <button class="tablinks w-100 active1" onclick="openPage(event, 'general')">Общее</button>
                    </div>
                    <div class="tabhover w-25">
                        <button class="tablinks w-100" onclick="openPage(event, 'purpose')">Наша цель</button>
                    </div>
                    <div class="tabhover w-25">
                        <button class="tablinks w-100" onclick="openPage(event, 'teacher')">Преподаватель</button>
                    </div>
                    <div class="tabhover w-25">
                        <button class="tablinks w-100" onclick="openPage(event, 'lessons')">Расписание</button>
                    </div>
                </div>


                <?php while (have_posts()) :
                    the_post(); ?>

                    <div style="display: " id="general" class="tabcontent p-3">
                        <div class="container text-start">
                            <?php while (have_rows('общее')) : the_row(); ?>
                                <?php if (get_sub_field('заголовок')) : ?>
                                    <div style="font-family: Roboto; font-weight: 700; font-size: 28px; color: white"><?= get_sub_field('заголовок') ?></div>
                                <?php endif; ?>

                                <?php if (get_sub_field('общий_текст')) : ?>
                                    <div style="color: white; opacity: 0.75; font-family: Roboto; font-weight: 400; font-size: 18px;"
                                         class="mt-4"><?= get_sub_field('общий_текст') ?>
                                    </div><?php endif; ?>
                            <?php endwhile; ?>

                        </div>
                    </div>
                    <!---->
                    <div style="display: none" id="purpose" class="tabcontent p-3">
                        <?php while (have_rows('наша_цель')) : the_row(); ?>
                            <div class="container text-start">
                                <?php if (get_sub_field('заголовок')) : ?>
                                    <div style="font-family: Roboto; font-weight: 700; font-size: 28px; color: white">
                                        <p><?= get_sub_field('заголовок') ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if (get_sub_field('общая_цель')) : ?>
                                    <div class="mt-3"
                                         style="color: white; opacity: 0.75; font-family: Roboto; font-weight: 400; font-size: 18px">
                                        <?= get_sub_field('общая_цель'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <!---->
                    <div style="display: none" id="teacher" class="tabcontent p-3">
                        <?php while (have_rows('преподаватель')) : the_row(); ?>
                            <div class="container text-start">
                                <?php if (get_sub_field('заголовок')) : ?>
                                    <div>
                                        <p style="font-family: Roboto; font-size: 28px; font-weight: 700; color: white"><?= get_sub_field('заголовок') ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <?php if (get_sub_field('фото_преподавателя')) : ?>
                                        <div class="w-25"><img style="width: 100%" class=" rounded"
                                                               src=<?= get_sub_field('фото_преподавателя') ?>
                                                               alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (get_sub_field('информация_преподавателя')) : ?>
                                        <div class="w-75"><p
                                                    style="font-family: Roboto; font-size: 18px; font-weight: 400; color: white"><?= get_sub_field('информация_преподавателя') ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <!---->
                    <div style="display: none" id="lessons" class="tabcontent p-3">

                    </div>
                    <!---->
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
<script>
    function openPage(evt, pageName) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active1", "");
        }

        document.getElementById(pageName).style.display = "block";
        evt.currentTarget.className += " active1";
    }
</script>


<!---->

<div class="d-block d-sm-none">
    <div class="p-2 pb-4" style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDark.png);">
        <div class="container text-start pt-3">
            <p class="mb-0" style="font-family: Roboto;font-weight: 400; font-size: 14px; color: #DAAB31">
                Инновационные
                кейсы</p>
            <a href="/наши-продукты/" class="mt-0"
               style="font-family: Roboto;font-weight: 600; font-size: 22px; color: white; text-decoration: none">Наши
                продукты</a>
        </div>
        <div class="container d-flex mt-2">
            <a class="btn" href="/наши-продукты/" style="color: white; background-color: #DAAB31">Новинки</a>
            <a href="/наши-продукты/" class="ms-3 rounded btn"
               style="color: #DAAB31; background: none; border: 1px solid #DAAB31;">
                Интеллект
            </a>
            <button class="ms-3 rounded" style="color: #DAAB31; background: none; border: 1px solid #DAAB31">
                Здоровье
            </button>
        </div>
        <div class="container mt-4 ">
            <img style="height: 220px; width: 100%" src="<?php the_post_thumbnail(); ?>">
        </div>
        <div class="container mt-4 text-start rounded border ms-1 py-1 ">
            <?php while (have_rows('общее')) : the_row(); ?>
                <?php if (get_sub_field('заголовок')) : ?>
                    <div style="font-family: Roboto; font-weight: 700; font-size: 24px; color: white"><?= get_sub_field('заголовок') ?></div>
                <?php endif; ?>
                <hr style="color: white">
                <?php if (get_sub_field('общий_текст')) : ?>
                    <div style="color: white; opacity: 0.54; font-family: Roboto; font-weight: 400; font-size: 16px;"
                         class="mt-4"><?= get_sub_field('общий_текст') ?>
                    </div><?php endif; ?>
            <?php endwhile; ?>
        </div>
        <!---->
    </div>
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
</div>

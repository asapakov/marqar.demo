<?php
/**
 * Template Name: О компании
 */
?>

<style>
    .hoverbig:hover {
        transform: scale(1.05);
        transition-duration: 0.5s;
    }

    .tablinks {
        color: white;
        border: none;
        background: none;
        font-size: 24px;
        font-family: Roboto, serif;
        opacity: 0.5;
    }

    .tablinks:hover {
        color: white;
        border: none;
        opacity: 1;
    }

    .active {
        opacity: 1;
        color: #DAAB31;
    }

    .bghover:hover {
        background-color: #DAAB31;
    }

    .bgChange {
        background-color: #0B2137;
    }

</style>

<?php get_header(); ?>
<div name="webV" class="d-none d-sm-block pt-5">
    <body class="w-100 "
          style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDarkTheme.png); background-size: cover; background-repeat: repeat-y; background-attachment: fixed">

    <?php
    if (is_page('о-компании/')) {
    ?>

    <br>
    <div class="container mt-5 w-100">
        <div class="text-center">
            <p class="mb-0" style="font-family: Roboto; font-weight: 500; font-size: 16px; color: white; opacity: 0.75">
                Наша история
                и традиции</p>
            <p style="font-family: Roboto; font-weight: 500; font-size: 32px; margin-bottom: 0; color: white">Узнайте
                больше о
                Нас</p>
        </div>

        <!-- Tab links -->

        <div class="container w-75 text-center shadow lg p-1 d-flex justify-content-around mt-4 bgChange p-0">
            <div class="bghover rounded" style="width: 33%">
                <button class="tablinks active" onclick="openPage(event, 'about')">О
                    компании
                </button>
            </div>
            <div class="bghover rounded" style="width: 33%">
                <button class="tablinks" onclick="openPage(event, 'map')">Мы на
                    карте мира
                </button>
            </div>
            <div class="bghover rounded" style="width: 33%">
                <button class="tablinks" onclick="openPage(event, 'docs')">
                    Документы
                </button>
            </div>
        </div>

        <!-- Tab content -->

        <div style="display: ; margin-bottom: 150px" id="about" class="tabcontent">
            <div class="container w-75 shadow-lg p-3 bgChange" style="padding-bottom: 20px">
                <div>
                    <p style="font-family: Roboto; font-weight: 400; font-size: 28px; color: white">Мы
                        отказались от
                        стандартных программ и применяем только то, что работает эффективно!</p>
                </div>
                <hr class="m-0 p-0">
                <div style="margin-top: 28px">
                    <p style="font-family: Roboto; font-weight: 400; font-size: 18px; color: #a0aec9">
                        MARQAR —
                        это Казахстанская компания,
                        деятельностью которой является предоставление товаров и услуг на собственной платформе с
                        инновационной системой стимулирования продаж, мотивации к обучению, саморазвитию, повышению
                        профессиональных навыков и морально-этических качеств.
                        Мы создаём благоприятную почву для развития бизнеса, формируем потребительскую среду с высокой
                        покупательской способностью по программе, в которой потребление жизненных благ является основой
                        для материальной стабильности участника. </p>
                </div>

                <?php
                $cat = array(6);
                $showposts = -1; // -1 shows all posts
                $do_not_show_stickies = 1; // 0 to show stickies
                $args = array(
                    'category__in' => $cat,
                    'orderby' => 'meta_value_num date',
                    'order' => 'ASC',
                    'showposts' => $showposts,
                    'caller_get_posts' => $do_not_show_stickies
                );
                $my_query = new WP_Query($args);
                ?>

                <?php if ($my_query->have_posts()) : ?>

                    <?php while ($my_query->have_posts()) :
                        $my_query->the_post(); ?>
                        <?php
                        //necessary to show the tags
                        global $wp_query;
                        $wp_query->in_the_loop = true;
                        ?>


                        <!---->

                        <?php $group_fields = get_field("преподаватель"); ?>
                        <?php if ($group_fields) : ?>

                        <?php foreach ($group_fields as $key => $item) : ?>
                            <?php if ($item) : ?>
                                <?= "<img src=" . esc_url($group_fields[$key]) . " alt=" . esc_attr($group_fields[$key]['photo']) . ">" ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    <?php endif; ?>

                        <!---->
                        <div class="row mt-5 p-3" style="height: 250px">
                            <div class="col m-0 p-0" style="height: 100%">
                                <div class="h-100"><img class="h-100" src=<?php the_post_thumbnail(); ?></div>
                                </div>
                                <div class="col ms-2" style="height: 100%">
                                    <div style="color: white; font-family: Roboto; font-weight: 700;font-size: 20px"
                                    "><?php the_field('заголовок');
                                    ?></div>
                                <div class="mt-2"
                                     style="font-family: Roboto; font-weight: 400; color: #a0aec9;"><?php the_field('общий_текст');
                                    ?></div>
                            </div>
                        </div>

                    <?php endwhile; ?>

                <?php else : ?>

                    <h2 class="center">Not Found</h2>
                    <p class="center">Sorry, but you are looking for something that isn't here.</p>
                    <?php get_search_form(); ?>

                <?php endif; ?>
            </div>
        </div>

        <div style="display: none; margin-bottom: 150px" id="map" class="tabcontent">
            <div class="container w-75 shadow-lg p-3 bgChange" style="padding-bottom: 20px">
                <div>
                    <p style="font-family: Roboto; font-weight: 400; font-size: 28px; color: white">MARQAR -
                        стремительно развивающаяся компания!</p>
                </div>
                <hr class="m-0 p-0">
                <div style="margin-top: 28px">
                    <p style="font-family: Roboto; font-weight: 400; font-size: 18px; color: #a0aec9;">
                        На сегодняшний день компания MARQAR представлена более чем в 30 странах мира.
                        Участниками нашего проекта являются граждане таких стран, как Англия, США, Канада, Германия,
                        Греция, Италия, Испания, Литва, Австрия, Бельгия, Франция, Чехия, Болгария, Иран, ОАЭ, Украина,
                        Молдова, Беларусь, Россия, Киргизия, Узбекистан, Таджикистан, Азербайджан, Армения, Грузия и
                        многих других. </p>
                </div>


                <div>
                    <img style="width: 100%; height: auto" src="/wp-content/themes/marqar_theme/assets/images/map.png">
                </div>
                <div>
                    <p style="font-family: Roboto; font-weight: 400; font-size: 28px; color: white"
                       class="mt-5 mb-3">
                        Представители “MARQAR” в вашей стране</p>
                    <p style="font-family: Roboto; font-weight: 400; font-size: 18px; color: #a0aec9; "
                       class="mt-0">
                        Стремительный рост и развитие нашей компании на мировом рынке являются свидетельством
                        перспективности избранного нами вектора развития, а также подтверждением огромного доверия к
                        проекту со стороны людей из разных уголков земного шара.
                        Возрастание интереса к нашим продуктам обусловлено доступностью, содержательностью программ и,
                        безусловно, потенциальными возможностями, связанными с инновационной деятельностью компании.
                        Наш проект служит мостом для объединения различных слоев и культур населения Земли, его
                        воплощение стирает границы и снимает ограничения для прихода новой и трансформирующей энергии
                        жизни.</p>
                </div>


            </div>
        </div>

        <div style="display: none; margin-bottom: 150px" id="docs" class="tabcontent">
            <div class="container w-75 p-3">

                <?php
                $cat = array(5);
                $showposts = -1; // -1 shows all posts
                $do_not_show_stickies = 1; // 0 to show stickies
                $args = array(
                    'category__in' => $cat,
                    'orderby' => 'meta_value_num date',
                    'order' => 'ASC',
                    'showposts' => $showposts,
                    'caller_get_posts' => $do_not_show_stickies
                );
                $my_query = new WP_Query($args);
                ?>

                <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
                    global $wp_query;
                    $wp_query->in_the_loop = true;
                    ?>

                    <!---->
                    <a href="<?php the_permalink(); ?>" class="text-center bgChange"
                       style="text-decoration: none; color: inherit">
                        <div class="hoverbig shadow-lg mt-3 mx-auto rounded bgChange "
                             style="height: 180px; margin-left: 150px">
                            <div class="text-start bgChange p-2 align-items-center"
                                 style="font-family: Roboto; font-weight: 400; font-size: 24px; color: white"><?php the_title() ?></div>

                            <hr class="bgChange text-light mb-4 p-0">

                            <div class="text-start bgChange ps-2 pb-2 align-items-center"
                                 style="font-family: Roboto; font-weight: 300; font-size: 18px; color: #a0aec9;"><?php the_excerpt(); ?></div>
                        </div>
                    </a>

                <?php endwhile; ?>

                <?php else : ?>

                    <h2 class="center">Not Found</h2>
                    <p class="center">Sorry, but you are looking for something that isn't here.</p>
                    <?php get_search_form(); ?>

                <?php endif; ?>

            </div>

        </div>
    </div>

    </body>

    <script>
        function openPage(evt, pageName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(pageName).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>

    <!---->
    <?php
    }
    ?>
    <?php
    get_footer();
    ?>
</div>

<!---->
<div name="mobV" class="d-block d-sm-none pt-5">


    <?php
    $cat = array(5);
    $showposts = -1; // -1 shows all posts
    $do_not_show_stickies = 1; // 0 to show stickies
    $args = array(
        'category__in' => $cat,
        'orderby' => 'meta_value_num date',
        'order' => 'ASC',
        'showposts' => $showposts,
        'caller_get_posts' => $do_not_show_stickies
    );
    $my_query = new WP_Query($args);
    ?>

    <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
        global $wp_query;
        $wp_query->in_the_loop = true;
        ?>

        <!---->
        <a href="<?php the_permalink(); ?>" class="text-center"
           style="text-decoration: none; color: inherit">
            <div class="container mt-5 mb-5 mx-2 rounded"
                 style="background-color: #0B2137">
                <div class="text-start p-2 align-items-center"
                     style="font-family: Roboto; font-weight: 400; font-size: 20px; color: white"><?php the_title() ?></div>
                <div class="text-start ps-2 pb-2 align-items-center"
                     style="font-family: Roboto; font-weight: 300; font-size: 13px; color: white;"><?php the_excerpt(); ?></div>
            </div>
        </a>

    <?php endwhile; ?>

    <?php else : ?>

        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php get_search_form(); ?>

    <?php endif; ?>
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

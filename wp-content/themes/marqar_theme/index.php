<?php
get_header(); ?>
<style>
    .overlay{
        position: absolute;
        top: 80%;
    }
    .hoverblick:hover {
        background-image: url("/wp-content/themes/marqar_theme/assets/images/bg-text.png");
        border-radius: 7px;
    }

    .imghover2:hover {
        border: gold 1px solid;
        box-shadow: black;
        transform: translateY(-20px);
    }

    .effect10 {
        float: left;
        display: inline-block;
        width: 100%;
        max-width: 300px;
        margin-right: 1.5%;
        position: relative;
        cursor: pointer;
        overflow: hidden;
    }

    .effect10 img {
        transform: scale(1.5);
        max-width: 100%;
        transition: 0.5s ease all;
    }

    .effect10 a {
        text-decoration: none;
        color: #fff;
        width: 100%;
        text-align: center;
        left: 0;
        font-size: 40px;
        height: 0;
        position: absolute;
        transition: 0.5s ease all;
        visibility: hidden;
        opacity: 0;
        bottom: 150px;
        transform: scale(0.3);
    }

    .effect10:hover a {
        background: rgba(0, 0, 0, 0.2);
        visibility: visible;
        height: 20%;
        padding: 40.1% 0;
        opacity: 1;
        bottom: 3px;
        transform: scale(1);
        text-shadow: -0 -1px 1px #000000,
        0 -1px 1px #000000,
        -0 1px 1px #000000,
        0 1px 1px #000000,
        -1px -0 1px #000000,
        1px -0 1px #000000,
        -1px 0 1px #000000,
        1px 0 1px #000000,
        -1px -1px 1px #000000,
        1px -1px 1px #000000,
        -1px 1px 1px #000000,
        1px 1px 1px #000000,
        -1px -1px 1px #000000,
        1px -1px 1px #000000,
        -1px 1px 1px #000000,
        1px 1px 1px #000000;
    }

    .effect10:hover img {
        transform: scale(1);
    }

    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    html,
    body {
        display: grid;
        height: 100%;
        width: 100%;
        place-items: center;
        background: linear-gradient(375deg, #1cc7d0, #2ede98);
    }

    ::selection {
        color: #fff;
        background: #1cc7d0;
    }

    .wrapper {
        height: 400px;
        width: 320px;
        position: relative;
        transform-style: preserve-3d;
        perspective: 1000px;
    }

    .wrapper .card {
        position: absolute;
        height: 100%;
        width: 100%;
        padding: 5px;
        background: #fff;
        border-radius: 10px;
        transform: translateY(0deg);
        transform-style: preserve-3d;
        backface-visibility: hidden;
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.7s cubic-bezier(0.4, 0.2, 0.2, 1);
    }

    .wrapper:hover > .front-face {
        transform: rotateY(-180deg);
    }

    .wrapper .card img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .wrapper .back-face {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        flex-direction: column;
        transform: rotateY(180deg);
    }

    .wrapper:hover > .back-face {
        transform: rotateY(0deg);
    }

    .wrapper .back-face img {
        height: 150px;
        width: 150px;
        padding: 5px;
        border-radius: 50%;
        background: linear-gradient(375deg, #1cc7d0, #2ede98);
    }

    .wrapper .back-face .info {
        text-align: center;
    }

    .back-face .info .title {
        font-size: 30px;
        font-weight: 500;
    }

    .back-face ul {
        display: flex;
    }

    .back-face ul a {
        display: block;
        height: 40px;
        width: 40px;
        color: #fff;
        text-align: center;
        margin: 0 5px;
        line-height: 38px;
        border: 2px solid transparent;
        border-radius: 50%;
        background: linear-gradient(375deg, #1cc7d0, #2ede98);
        transition: all 0.5s ease;
    }

    .back-face ul a:hover {
        color: #1cc7d0;
        border-color: #1cc7d0;
        background: linear-gradient(375deg, transparent, transparent);
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .containerImg {
        position: relative;
        text-align: center;
        color: white;
    }

</style>
<div class="d-none d-sm-block"
     style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDarkTheme.png); background-size: contain; background-repeat: repeat-y">

    <?php
    echo do_shortcode('[smartslider3 slider="1"]');
    ?>
    <div class="container rounded shadow-lg overlay" style="height: 130px; background: linear-gradient(269.35deg, #DAA520 0%, #DAC471 42.71%, #DAC471 61.98%, #DAA520 100%);">
        <div class="d-flex justify-content-evenly">
            <div class="text-center pt-auto">
                <p style="font-family: Roboto; font-weight: 500; font-size: 50px; color: white; margin-bottom: 0px">8</p>
                <p style="font-family: Roboto; font-weight: 400; font-size: 22px; color: white; margin-bottom: 0px">Кейсов</p>
            </div>
            <div class="my-auto"><img class="h-75" src="/wp-content/themes/marqar_theme/assets/images/lineforstats.png"></div>
            <div class="text-center">
                <p style="font-family: Roboto; font-weight: 500; font-size: 50px; color: white; margin-bottom: 0px">1 200</p>
                <p style="font-family: Roboto; font-weight: 400; font-size: 22px; color: white; margin-bottom: 0px">Подписчиков</p>
            </div>
            <div class="my-auto"><img class="h-75" src="/wp-content/themes/marqar_theme/assets/images/lineforstats.png"></div>
            <div class="text-center">
                <p style="font-family: Roboto; font-weight: 500; font-size: 50px; color: white; margin-bottom: 0px">140</p>
                <p style="font-family: Roboto; font-weight: 400; font-size: 22px; color: white; margin-bottom: 0px">Стран</p>
            </div>
        </div>
    </div>
    <div id="izuchenie" class="container pb-0">
        <div class="container ms-5 ps-5 d-none d-sm-block" style="margin-top: 100px">
            <p class="ms-5" style="font-family: Roboto; font-weight: 500; font-size: 16px; color: #DAAB31">Инновационная
                система обучения</p>
            <p class="ms-5" style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">
                Перекрестное
                изучение языков</p>
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-sm-3"><img class="rounded imghover"
                                       src="/wp-content/themes/marqar_theme/assets/images/infoone-300x300.png"
                                       alt=""></div>
            <div class="col-sm-3"><img class="rounded imghover"
                                       src="/wp-content/themes/marqar_theme/assets/images/infotwo-300x300.png"
                                       alt=""></div>
            <div class="col-sm-3"><img class="rounded imghover"
                                       src="/wp-content/themes/marqar_theme/assets/images/infothree-300x300.png"
                                       alt=""></div>
        </div>
        <div class="text-center mt-3 d-none d-sm-block">
            <div class="text-center mt-2 pb-0 mb-0 align-items-end">
                <a href="/наши-продукты/" class="btn"
                   style="background-color: #DAAB31; font-family: Roboto; font-weight: 400; font-size: 24px; color: white">Узнать
                    больше</a>
            </div>
        </div>
    </div>

    <div id="mar" class="pb-5 "
         style="background-image: url(/wp-content/themes/marqar_theme/assets/images/unsplash_phyq704ffda.png); background-size: cover; background-repeat: repeat-y">
        <div class="container">
            <div class="container ms-5 ps-5 pt-5" style="margin-top: 100px">

                <p class="ms-5" style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">
                    О компании</p>

            </div>
            <div class="row d-flex ms-5 ps-4 mt-5">
                <div class="col-sm-4 w-25 ms-5 p-2 hoverblick">
                    <div><p style="font-family: Roboto; font-weight: 700; font-size: 22px; color: white">Наша миссия
                            и
                            ценности</p></div>
                    <div><p style="font-family: Roboto; font-weight: 400; font-size: 16px; color: #7C7C7C">Продажа
                            товаров и услуг на собственной платформе с инновационным системным подходом.</p></div>
                </div>
                <div class="col-sm-4 w-25 ms-5 p-2 hoverblick">
                    <div><p style="font-family: Roboto; font-weight: 700; font-size: 22px; color: white">Наша
                            цель</p></div>
                    <div><p style="font-family: Roboto; font-weight: 400; font-size: 16px; color: #7C7C7C">Повышение
                            качества жизни на примере передовых стран, выраженного в выполнении программ.</p></div>
                </div>
                <div class="col-sm-4 w-25 ms-5 p-2 hoverblick">
                    <div><p style="font-family: Roboto; font-weight: 700; font-size: 22px; color: white; ">Наши
                            решения</p></div>
                    <div><p style="font-family: Roboto; font-weight: 400; font-size: 16px; color: #7C7C7C">“MARQAR”
                            предлагает Вам решения для морального здоровья, уровня финансовой и морально-этической
                            грамотности.</p></div>
                </div>
            </div>


            <!--CAROUSEL-->

            <div id="carouselPerson" class="carousel slide w-75 mt-4 mx-auto d-none d-sm-block" style="height: 350px"
                 data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <div class="d-block row d-flex justify-content-center">
                            <div class="col-sm-4 rounded"><img
                                        src="/wp-content/themes/marqar_theme/assets/images/person1.png"
                                        class="w-100 rounded" alt="person1"></div>
                            <div class="col-sm-8 text-start">
                                <div>
                                    <p style="font-family: Roboto; font-weight: 500; font-size: 16px; color: #DAAB31">
                                        Генеральный директор ТОО “MARQAR”</p></div>
                                <div>
                                    <p style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">
                                        Валиханов
                                        Марат Маратович</p></div>
                                <div>
                                    <p style="font-family: Roboto; font-weight: 400; font-size: 18px; color: #7C7C7C; font-style: italic">
                                        “Когда твои цели откликаются тёплым трепетом в душе, создавая при этом
                                        гармоничный ритм и пульс жизни, самое недоступное становится достижимым, самое
                                        невероятное превращается в реальность.”</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <div class="d-block row d-flex">
                            <div class="col-sm-4 rounded"><img
                                        src="/wp-content/themes/marqar_theme/assets/images/person3.png"
                                        class="w-100 rounded" alt="person3"></div>
                            <div class="col-sm-8 text-start">
                                <div>
                                    <p style="font-family: Roboto; font-weight: 500; font-size: 16px; color: #DAAB31">
                                        Директор по развитию ТОО “MARQAR”</p></div>
                                <div>
                                    <p style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">
                                        Агитаев Азамат Габдуалиевич</p></div>
                                <div>
                                    <p style="font-family: Roboto; font-weight: 400; font-size: 18px; color: #7C7C7C; font-style: italic">
                                        “Өмір — теңіз, жүзем онда демеңіз,
                                        Ізгіліктен жасалмаса кемеңіз.”<br>
                                        <strong style="font-style: italic">Рудаки</strong></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <div class="d-block row d-flex">
                            <div class="col-sm-4 rounded"><img
                                        src="/wp-content/themes/marqar_theme/assets/images/person2.png"
                                        class="w-100 rounded" alt="person2"></div>
                            <div class="col-sm-8 text-start">
                                <div>
                                    <p style="font-family: Roboto; font-weight: 500; font-size: 16px; color: #DAAB31">
                                        Руководитель проекта "Интеллект кейс"</p></div>
                                <div>
                                    <p style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">
                                        Найзабекова Эльмира Дуйсенбековна</p></div>
                                <div>
                                    <p style="font-family: Roboto; font-weight: 400; font-size: 18px; color: #7C7C7C; font-style: italic">
                                        “Мне нравится видеть, как люди меняются.
                                        И уверена, что при желании каждый может раскрыть свои таланты и достичь
                                        любой
                                        цели.
                                        Именно это наша компания дает каждому участнику.
                                        И не только в финансовом плане, но и в интеллектуальном.
                                        Ведь знание языков – это мир без границ!”</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <div class="d-block row d-flex">
                            <div class="col-sm-4 rounded"><img
                                        src="/wp-content/themes/marqar_theme/assets/images/person4.png"
                                        class="w-100 rounded" alt="person2"></div>
                            <div class="col-sm-8 text-start">
                                <div>
                                    <p style="font-family: Roboto; font-weight: 500; font-size: 16px; color: #DAAB31">
                                        Руководитель проекта "Здоровье и красота"
                                    </p></div>
                                <div>
                                    <p style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">
                                        Кусаинова Жанат Сейтхановна</p></div>
                                <div>
                                    <p style="font-family: Roboto; font-weight: 400; font-size: 18px; color: #7C7C7C; font-style: italic">
                                        “Секрет перемен состоит в том,чтобы сосредоточиться на создании нового,а не на
                                        борьбе со старым...”</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CAROUSEL-->
        </div>
    </div>
    <!---->
    <!--<div id="kursy" class="container">
        <div class="container ms-5 ps-5 w-75" style="margin-top: 100px">
            <p class="ms-5" style="font-family: Roboto; font-weight: 500; font-size: 16px; color: #DAAB31">
               Постоянная положительная динамика продаж Компании</p>
            <p class="ms-5" style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">
                Присоединяйтесь к 27550+ пользователям
                открывшим для себя “MARQAR”</p>
            <p class="ms-5" style="font-family: Roboto; font-weight: 400; font-size: 18px; color: white; opacity: 0.75">
                Знание нескольких языков открывает для каждого новые горизонты в глобальном мире. В
                параллельно-перекрестном
                преподавании языков компания «MARQAR» видит будущее образования.</p>
        </div>

        <div class="container d-flex justify-content-center">
            <div class="col-sm-3 pt-5 rounded"><img class="rounded"
                                                    src="/wp-content/themes/marqar_theme/assets/images/tile-2-300x300.png">
            </div>
            <div class="col-sm-3 rounded"><img class="rounded"
                                               src="/wp-content/themes/marqar_theme/assets/images/tile-1-300x300.png">
            </div>
            <div class="col-sm-3 pt-5 rounded"><img class="rounded"
                                                    src="/wp-content/themes/marqar_theme/assets/images/tile-300x300.png">
            </div>
        </div>
        <div class="text-center mt-2 pb-4">
            <a href=https://marqar.kz/s/frontend/web/site/signup class="btn"
               style="background-color: #DAAB31; font-family: Roboto; font-weight: 400; font-size: 24px; color: white">Подписаться</a>
        </div>

    </div>-->

    <div id="produkty" class="container pt-5">
        <div class="container ms-5 ps-5 w-75">
            <p class="ms-5" style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">
                Наши кейсы</p>
        </div>
        <!---->
        <div class="d-flex justify-content-evenly">
            <div name="card1" class="wrapper" style="margin-top: 100px">
                <div class="card front-face ">
                    <div class="w-100 h-100 m-0 p-0"><img class="rounded"
                                                          src="/wp-content/themes/marqar_theme/assets/images/casetwo.png">
                    </div>
                </div>
                <div class="card back-face containerImg">
                    <img class="rounded w-100 h-100" style="opacity: 15%"
                         src="/wp-content/themes/marqar_theme/assets/images/casetwo.png">
                    <div class="centered text-start text-dark w-100 px-3"><p class="w-100"
                                                                             style="font-family: Roboto; font-weight: 400; font-size: 20px">
                            Интеллект - кейс
                            Международная платформа образования для получения продуктов интеллектуального и физического
                            характера, таких как образовательные онлайн курсы, художественная и учебная литература,
                            канцелярские товары, гаджеты, ноутбуки.</p></div>
                </div>
            </div>
            <div name="card2" class="wrapper" style="margin-top: 50px">
                <div class="card front-face ">
                    <div class="w-100 h-100 m-0 p-0"><img class="rounded"
                                                          src="/wp-content/themes/marqar_theme/assets/images/caseone.png">
                    </div>
                </div>
                <div class="card back-face containerImg">
                    <img class="rounded w-100 h-100" style="opacity: 15%"
                         src="/wp-content/themes/marqar_theme/assets/images/caseone.png">
                    <div class="centered text-start text-dark w-100 px-3"><p class="w-100"
                                                                             style="font-family: Roboto; font-weight: 400; font-size: 20px">
                            Здоровье и красота - кейс
                            Платформа по предоставлению оздоровительных услуг в санаторно-профилакторных лечебных
                            учреждениях. Оздоровительные продукты и оборудование.</p></div>
                </div>
            </div>
            <div name="card3" class="wrapper">
                <div class="card front-face ">
                    <div class="w-100 h-100 m-0 p-0"><img class="rounded"
                                                          src="/wp-content/themes/marqar_theme/assets/images/casethree.png">
                    </div>
                </div>
                <div class="card back-face containerImg">
                    <img class="rounded w-100 h-100" style="opacity: 15%"
                         src="/wp-content/themes/marqar_theme/assets/images/casethree.png">
                    <div class="centered text-start text-dark w-100 px-3"><p class="w-100"
                                                                             style="font-family: Roboto; font-weight: 400; font-size: 20px">
                            Туризм - кейс
                            Платформа по предоставлению и организации туристических поездок как по Казахстану, так и за
                            рубежом.</p></div>
                </div>
            </div>
        </div>
        <!---->
        <div class="text-center mt-5">
            <a href=https://marqar.kz/s/frontend/web/site/signup class="btn"
               style="background-color: #DAAB31; font-family: Roboto; font-weight: 400; font-size: 24px; color: white">Подписаться</a>
        </div>
    </div>

    <?php
    get_footer();
    ?>
</div>

<!---->

<div class="d-block d-sm-none">
    <div name="bisn-part" style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bg-mob-home.png)">
        <div class="w-100 mt-0 pt-3 ps-3 pe-4">
            <p style="font-family: Roboto;font-size: 40px; font-weight: 700; color: white;">
                Ваш <span style="color: #DAAB31">надежный</span>
                бизнес-партнер</p>
            <p style="font-family: Roboto;font-size: 16px; font-weight: 400; color: white; opacity: 0.54">Мы формируем
                социальную бизнес-среду, в которой потребление жизненных благ приносит вознаграждение </p>
            <div class="text-center py-2 mt-1 mb-3" style="width: 85%"><input type="email"
                                                                              style="width: 100%; background-image: url(/wp-content/themes/marqar_theme/assets/images/bg-input-email.png); color: white; opacity: 0.54; font-family: Roboto; font-weight: 300; font-size: 16px"
                                                                              placeholder="Введите свой e-mail адрес">
            </div>
            <div class=mb-4 mt-4
            ">
            <button class="btn" style="background-color: #DAAB31">
                <div class="d-flex align-items-center">
                    <img height="100%" src=/wp-content/themes/marqar_theme/assets/images/email-logo.png
                         alt="email-logo">
                    <p class="ms-3 py-auto align-middle mb-0"
                       style="font-family: Roboto;font-weight: 700; font-size: 16px; color: white">Отправить</p>
                </div>
            </button>
        </div>
    </div>


    <div name="perek" class="pb-3"
         style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bg-ornam-moob.png); background-color: white; background-size: cover">
        <div class="text-start ms-4 pt-3">
            <p class="mb-0" style="font-family: Roboto;font-weight: 400; font-size: 14px; color: #DAAB31">Новая
                инновационная система
                обучения</p>
            <p class="mt-0" style="font-family: Roboto;font-weight: 600; font-size: 22px; color: black">Перекрестное
                изучение
                языков </p>
        </div>
        <!--CAROU-->
        <div id="carouselExampleCaptions" style="height: 430px" class="carousel slide" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active container ms-5" style="height: 420px; width: 80%">
                    <div class="img rounded"><img src=/wp-content/themes/marqar_theme/assets/images/slide1-mob.png
                                                  class="d-block w-100 rounded" alt="slide1"></div>
                    <div class="carousel-caption d-block">
                        <div class="bg-image rounded px-2 py-1" style="background-color: white;opacity: 75%">
                            <h5 style="font-family: Roboto; font-weight: 700; font-size: 16px; color: black">Приоритет
                                современного образования</h5>
                            <hr class="m-0 p-0" style="color: black">
                            <p class="mb-0 mt-2"
                               style="font-family: Roboto; font-weight: 300; font-size: 14px; color: #7C7C7C">Знание
                                нескольких языков открыает для каждого новые горизонты в глобальном мире. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item container ms-5" style="height: 420px; width: 80%">
                    <div class="img rounded"><img src=/wp-content/themes/marqar_theme/assets/images/slide2-mob.png
                                                  class="d-block w-100 rounded" alt="slide2"></div>
                    <div class="carousel-caption d-block">
                        <div class="bg-image rounded px-2 py-1" style="background-color: white;opacity: 75%">
                            <h5 style="font-family: Roboto; font-weight: 700; font-size: 16px; color: black">Постоянный
                                рост количества языков</h5>
                            <hr class="m-0 p-0" style="color: black">
                            <p class="mb-0 mt-2"
                               style="font-family: Roboto; font-weight: 300; font-size: 14px; color: #7C7C7C">Каждый
                                участник проекта будет иметь возможность изучать любой из языков на базе
                                английского.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item container ms-5" style="height: 420px; width: 80%">
                    <div class="img rounded"><img src=/wp-content/themes/marqar_theme/assets/images/slide3-mob.png
                                                  class="d-block w-100 rounded" alt="slide3"></div>
                    <div class="carousel-caption d-block">
                        <div class="bg-image rounded px-2 py-1" style="background-color: white;opacity: 75%">
                            <h5 style="font-family: Roboto; font-weight: 700; font-size: 16px; color: black">Непрерывное
                                улучшение курсов</h5>
                            <hr class="m-0 p-0" style="color: black">
                            <p class="mb-0 mt-2"
                               style="font-family: Roboto; font-weight: 300; font-size: 14px; color: #7C7C7C">Мы готовы
                                в любой
                                момент полностью вернуть оплату за обучение в случае, если вас не устроит полученный на
                                курсе результат.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!--CAROU-->
        <div class="text-center">
            <a href="/наши-продукты/" class="btn"
               style="background-color: #DAAB31; font-family: Roboto; font-weight: 700; font-size: 16px; color: white">
                Узнать больше
            </a>
        </div>
    </div>

    <div name="mar" class="pb-3"
         style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bg-mar-mob.png); background-color: white; background-size: auto">
        <div class="text-start ms-4 pt-3">
            <p class="mb-0" style="font-family: Roboto;font-weight: 400; font-size: 14px; color: #DAAB31">Инновационные
                технологии</p>
            <p class="mt-0" style="font-family: Roboto;font-weight: 600; font-size: 22px; color: #DAAB31"><span
                        style="color: white">MARQAR</span> - достойный, растущий, развивающийся.</p>
        </div>
        <!---->
        <div class="ms-2 d-block row d-flex justify-content-center">
            <div class="container d-flex">
                <div class="w-50 rounded p-1"><img class="w-100 rounded"
                                                   src=/wp-content/themes/marqar_theme/assets/images/person1.png></div>
                <div class="w-50 ms-2">
                    <div>
                        <p class="mb-0 pb-0"
                           style="font-family: Roboto; font-weight: 500; font-size: 10px; color: #DAAB31">
                            Генеральный директор ТОО “MARQAR”</p></div>
                    <div class="mt-0 pt-0">
                        <p class="mt-0 pt-0"
                           style="font-family: Roboto; font-weight: 500; font-size: 12px; color: white">
                            Валиханов
                            Марат Маратович</p></div>
                    <div>
                        <p style="font-family: Roboto; font-weight: 400; font-size: 10px; color: #7C7C7C; font-style: italic">
                            “Когда твои цели откликаются тёплым трепетом в душе, создавая при этом
                            гармоничный ритм и пульс жизни, самое недоступное становится достижимым, самое
                            невероятное превращается в реальность.”</p></div>
                </div>
            </div>
        </div>
    </div>

    <div name="prod" class="pb-3"
         style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bg-ornam-moob.png); background-color: white; background-size: cover">
        <div class="text-start ms-4 pt-3">
            <p class="mb-0" style="font-family: Roboto;font-weight: 400; font-size: 14px; color: #DAAB31">Постоянная
                положительная динамика продаж Компании</p>
            <p class="mt-0" style="font-family: Roboto;font-weight: 600; font-size: 22px; color: black">Присоединяйтесь
                к <span style="color: #DAAB31">27550+</span> пользователям “MARQAR”</p>
        </div>
        <div class="container d-flex px-0">
            <div class=" pt-5"><img class=""
                                    src="/wp-content/themes/marqar_theme/assets/images/tile3.png">
            </div>
            <div class=" ms-3 me-1 rounded"><img class="rounded"
                                                 src="/wp-content/themes/marqar_theme/assets/images/tile2.png">
            </div>
            <div class=" ms-2 pt-5"><img class=""
                                         src="/wp-content/themes/marqar_theme/assets/images/tile4.png">
            </div>
        </div>
    </div>

    <div name="case" class="pb-3"
         style="background-image: url(/wp-content/themes/marqar_theme/assets/images/unsplash_1fxmet2u5du-1536x603.png); background-color: white; background-size: cover">
        <div class="text-start ms-4 pt-3">
            <p class="mb-0" style="font-family: Roboto;font-weight: 400; font-size: 14px; color: #DAAB31">Выгодные
                предложения для любого клиента</p>
            <p class="mt-0" style="font-family: Roboto;font-weight: 600; font-size: 22px; color: white">Множество
                кейсов, ещё больше возможностей</p>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <div class="me-2 ms-0" style="margin-top: 120px"><img class="rounded"
                                                                  src="/wp-content/themes/marqar_theme/assets/images/caseOneMob.png">
            </div>
            <div class="me-2" style="margin-top: 60px"><img class="rounded"
                                                            src="/wp-content/themes/marqar_theme/assets/images/caseTwoMob.png">
            </div>
            <div class="me-0 ms-2"><img class="rounded"
                                        src="/wp-content/themes/marqar_theme/assets/images/caseThreeMob.png">
            </div>
        </div>
        <div class="text-center mt-4 pb-4">
            <a href="#" class="btn"
               style="background-color: #DAAB31; font-family: Roboto; font-weight: 400; font-size: 24px; color: white">Посмотреть
                все кейсы</a>
        </div>
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
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
<div name="webV" class="d-none d-sm-block pt-5"
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
                        <h5 class="text-light mb-0 pb-0"><span class="buy-button-top">32 000</span> тенге</h5>
                        <p class="buy-button-bottom mb-0">≈ 68 USD по НБРК</p>
                    </a></div>
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
                        <button class="tablinks w-100" onclick="openPage(event, 'lessons')">Программа</button>
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
                        <?php if (is_single(1467)) : ?>
                        <div>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                            Занятия 1-9
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">1. Verb be (am, is, are)
                                                    </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">числа, дни недели/numbers, days of the
                                                        week</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">2. Фонетика/Phonetics </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">страны/ countries</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">3.Personal pronouns
                                                    </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">nationalities</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">4. Wh – and How questions with be</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">phone numbers, numbers 11-100, 1000</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">5. Revise and check (тест) Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Test</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">6. Singular and plural nouns a/an</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">small things</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">7. This /that/ these/ those </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">souvenirs</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">8. Possessive adjectives</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">people and </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">9. Adjectives </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">adjectives</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Занятия 10-19
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">10. Revise and check (тест) + Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Test</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">11. Present simple</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">food and drink</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">12. Verbs</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Common verb phrases 1</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">13. Present simple /практика с вопросами</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Jobs and plases of work</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">14. Adverbs of frequency</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">a typical day</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">15. Revise and check (тест) Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Test</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">16. Word order in questions be and present
                                                        simple </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">sports; common verb phrases 2: free
                                                        time</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">17. Imperatives; object pronouns me, him,
                                                        etc.</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Kinds of film</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">18. Modal verbs can/ can’t</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">more verb phrases</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">19. like/love/hate+verb+ing</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">activities</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                aria-expanded="false" aria-controls="flush-collapseThree">
                                            Занятия 20-29
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">20. Revise and check (тест) Speaking</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">activities</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">21. Present continuous</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">common verb phrases 2: travelling</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">22. Present simple and Present continuous </h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">lothes</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">23. Practical English «Would you like to come
                                                    »</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">Practical English</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">24. There’s …../there are some/ any</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">hotels; in, on, under</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">25. Past simple: be</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">in, at, on</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">26. Past simple irregular verbs: do, get, go,
                                                    have </h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">verb phrases</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">27. Past simple regular and irregular verbs</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">more irregular verbs</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">28. Present continuous for future </h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">future time expressions </p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">29. Revise and check (тест) Speaking</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">Test</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseFour"
                                                aria-expanded="false" aria-controls="flush-collapseFour">
                                            Занятия 30-36
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">30. Have got</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">have got</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">31. Something / nothing </h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">describing people</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">32. Present perfect</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">past participles</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">33. Ever and never</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">take and get</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">34. Practical English « Describing holiday»</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">Practical English</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">35. Test </h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">test</p>
                                            </div>
                                            <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                <h5 class="card-title">36. Test</h5>
                                                <hr class=" mb-0 py-1 text-light">
                                                <p class="card-text my-auto">test</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endif ?><!--Eng in Ru-->
                        <?php if (is_single(51)) : ?>
                        <div>

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                            Lessons 1-9
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">1. To be етістігі, Алфавит
                                                    </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">To be - сөйлемде көмекші етістік,
                                                        байланыстырушы етістік, негізгі етістік, модальдік етістіктің
                                                        синонимі, міндет ету мағынасында қолданылады.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">2. Phonetics, ағылшын тіліндегі дыбыстар</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Тіл білімінің тілдік, дыбыстық жағын
                                                        зерттейтін саласы. Сондықтан бұл тақырыпта ағылшын тіліндегі
                                                        әріптер мен дыбыстардың классификациясы.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">3. Personal pronouns</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Тұлғаға, затқа, заттың сынына және
                                                        санына, үстеуге сілтеме жасап (олардың орындарын ауыстырып),
                                                        бірақ оларды атамай, басқаша сөздермен (есім сөздермен)
                                                        алмастыратын сөз табы.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">4. Test</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның
                                                        тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">5. Infinitive “to”</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Tұйық етістік – инфинитив етістік пен
                                                        зат есімнің қызметін атқаратын етістіктің жақсыз формасы. Әдетте
                                                        инфинитив to демеулігімен қолданылады.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">6. Plural form</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тілінде зат есімнің көпше түрі
                                                        - s (es) көптік жалғаулары арқылы жасалады.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">7. Demonstrative pronouns</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сілтеу есімдігіне this, that, these,
                                                        those, the same, such деген сөздер жатады. Сілтеу есімдіктері -
                                                        сілтеу, көрсету, нұсқау мағыналарын білдіреді.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">8. Test</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның
                                                        тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">9. A simple sentence</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тілінде жай сөйлем құрап
                                                        үйренеміз</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Lessons 10-19
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">10. Combination of English letters</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тіліндегі әріптердің үйлесіп
                                                        келуі бойынша, сөздерді дұрыс дыбыстап үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">11. Present Simple Tense</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тіліндегі жай осы шақ</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">12. Test/Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның
                                                        тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">13. Countable and uncountable nouns</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Саналатын және саналмайтын зат
                                                        есімдерді ажыратып үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">14. Indefinite article</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Белгісіздік артиклі қай кезде
                                                        қолданылатынын үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">15. Test/Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның
                                                        тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">16. Definite article</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Белгілілік артиклін қай кезде
                                                        қолданылатынын үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">17. Present Continuous</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның
                                                        тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">18. Test/Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Созылыңқы осы шақты үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">19. Questions in English (5 types of
                                                        questions)</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тіліндегі 5 түрлі сұрақ түрі
                                                        және оған жауап беру түрлері</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                aria-expanded="false" aria-controls="flush-collapseThree">
                                            Lessons 20-29
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">20. Test/Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның
                                                        тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">21. Possessive Pronouns and Possessive
                                                        Cases</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Тәуелділік есімдіктерін қолданып сөйлем
                                                        құрауды үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">22. Future Simple</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тіліндегі келер шақ, болжамдар
                                                        мен жоспарларды айтып үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">23. Past Simple</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тіліндегі жай өткен шақ. Өтіп
                                                        кеткен уақыттағы іс-әрекетті айтуды үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">24. Test/Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның
                                                        тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">25. There is/There are</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Осы конструкция бойынша сөйлем құрап
                                                        үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">26. Comparative degree of adjectives</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сын есімнің салысиырмалы шырайлары</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">27. Modal verbs
                                                        can,may,might,must,should,have to</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тілінің модальдік есістіктері.
                                                        Қолданылуы</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">28. Test/Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның
                                                        тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">29. Participle in English language</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ағылшын тіліндегі есімше.
                                                        Қолданылуы</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseFour"
                                                aria-expanded="false" aria-controls="flush-collapseFour">
                                            Lessons 30-36
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">30. Quantitative and ordinal numerals. Years</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Жалпы ағылшын тіліндегі сандар түрі, олардың қолданылуы</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">31. Presents Perfect
                                                        Cases</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткендегі уақытта болып кеткен іс-әрекет, уақыты және орны белгісіз. </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">32. Test/Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның тексеру тесті</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">33. Passive voice</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ырықсыз етістің ағылшын тілінде қолданылуы</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">34. Complex sentences</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Күрделі сөйлемдер құрап үйренеміз</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">35. Superlative adjectives</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сын есімдердің күшейтпелі түрі</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">36. Test/Speaking</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Апта бойы қамтылған бағдарламаның тексеру тесті</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php endif ?><!--Eng in Kz-->
                        <?php if (is_single(48)) : ?>
                        <div>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <h4>Начинающий уровень</h4>
                                <div name="1" class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                            Сабақ 1-9
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">1. Танысу. Кірісе сабақ (қазақ әліпбиі,
                                                        дыбыстар, фразалар)
                                                    </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Студенттермен танысу. Деңгейлерін
                                                        анықтау</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">2. Жіктік жалғау/Отбасы</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Жіктік жалғауларын қолдана отырып,
                                                        отбасы мүшелерімен таныстыру
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">3. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">4. Көптік жалғау/Үй жануарлары</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сөздерді көптік мағынада қолдануды
                                                        үйрену</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">5. Тәуелдік жалғау/Дене мүшелері</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Тәуелдік жалғауларын қолдана
                                                        отырып, сөз тіркестерін құруды үйрену</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">6. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">7. -мен, -бен, -пен/Менің үйім</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сөз бен сөзді бірі-бірімен
                                                        байланыстыруды меңғеру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">8. Ілік септік/Тұрмыстық техника</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ілік септігінің жалғауларын қолдана
                                                        отырып, сөйлем құрауды үйрену</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">9. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div name="2" class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Сабақ 10-19
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">10. Көмекші есімдер/Ғимараттар</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Жай сөйлем түрін құрауды
                                                        меңгеру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">11. Барыс септік/ -хана, -жай
                                                        жұрнақтары</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">хана, -жай жұрнақтары арқылы
                                                        жасалатын сөздерді қолдана отырып сөйлем құрастыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">12. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">13. Жатыс септік/Ұсақ-түйек заттар</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Жатыс септікті қолдана отырып
                                                        қойылған сұраққта жауап беру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">14. Шығыс септік/Менің сүйікті ісім</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Қажетті сөздерді қолдана отырып
                                                        қарапайым сөйлем құарстыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">15. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">16. Көмектес септік/Көлік түрлері</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сөздерді көмектес септікте қолдану
                                                        арқылы сөйлем құрастыру
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">17. Табыс септік/Тағам</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өздеріне ұнайтын тағам жайлы айту
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">18. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау.
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">19. Сұрау есімдіктері</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сұрау есімдіктерін қолданаотырып
                                                        сұраулы сөйлем құрастыру
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div name="3" class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                aria-expanded="false" aria-controls="flush-collapseThree">
                                            Сабақ 20-29
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingThree"
                                         data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">20. Керек/керек емес/Дүкенде</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Тақырып бойынша меңгерген сөздермен
                                                        диалог құрастыру
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">21. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">22. Менде бар/жоқ/Киім</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Киміге қатысты сөздерді қолдана
                                                        отырып
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">23. Ұнайды/Ұнамайды/Етістіктер</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Меңігерген етістіктерді қолдана
                                                        отырып болымды жіне болымсыз сөйлемдер құрастыру
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">24. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">25. Істегенді жақсы
                                                        көремін/Етістіктер</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өзінің сүйікті ісі жайлы шағын
                                                        мәтін құрастыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">26. Сын есімнің салыстырмалы
                                                        шырайы/Жабайы жануарлар</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Заттарды бір-бірімен салыстыруды
                                                        үйрену</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">27. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">28. Сын есімнің күшейтпелі
                                                        шырайы/Тағамдар</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сөйлемді күшейтпелі мағынада айтуды
                                                        үйрену</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">29. Болады/Болмайды/Айлар, апта күндері,
                                                        мерекелер</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Жаңа сөздермен болымды және
                                                        болымсыз мағынада сөйлемдер құрастыру
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div name="4" class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseFour"
                                                aria-expanded="false" aria-controls="flush-collapseFour">
                                            Сабақ 30-36
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingThree"
                                         data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">30. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">31. ... кезде.../Қонақ күту</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Қонақ күу дәстүрі жайлы шағын мәтін
                                                        құрастыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">32. ... деп едім/жатырмын/Билет сатып
                                                        алу</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өз жоспарлары жайлы айтып үйрену
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">33. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">33 Айтылым/Говорение Өткен
                                                        тақырыптарды пысықтау. Жұптық жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">34. Қалау рай/Саяхат</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Саяхат тақырыбында қалау райдың
                                                        жұрнақтарын қолдана отырып құрмалас сөйлем құрастыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">35. Шартты рай/Ауа райы болжамы</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ауа райы тақырыбында шартты райдың
                                                        жұрнақтарын қолдана отырып құрмалас сөйлем құрастыру
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">36. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion accordion-flush mt-5" id="accordionFlushExample">
                                <h4>Продвинутый уровень</h4>
                                <div name="5" class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseFive"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                            Сабақ 1-9
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFive" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingFive"
                                         data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">1. Танысу. Кірісе сабақ (қазақ әліпбиі,
                                                        дыбыстар, фразалар)
                                                    </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Студенттермен танысу. Деңгейлерін
                                                        анықтау</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">2. Жіктік жалғау/Отбасы</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Жіктік жалғауларын қолдана отырып,
                                                        отбасы мүшелерімен таныстыру
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">3. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">4. Тәуелдік жалғау/Менің үйім</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Тәуелдік жалғауларын қолдана
                                                        отырып,үйін сипаттап беру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">5. Көптік жалғау/Менің бөлмем</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сөздерді көптік мағынада қолдануды
                                                        үйрену</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">6. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">7. Ілік септік/Дене мүшелері/ -мен,
                                                        бен,-пен шылаулары </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ілік септіктің сұрағына жауап беру,
                                                        сөз бен сөзді бірі-бірімен байланыстыруды меңғеру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">8. Барыс септік /Ғимараттар</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Барыс септік жалғауларын қолдана
                                                        отырып құрмалас сөйлем құрастыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">9. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div name="6" class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseSix"
                                                aria-expanded="false" aria-controls="flush-collapseSix">
                                            Сабақ 10-19
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSix" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">10. Жатыс септік-хана, -жай
                                                        жұрнақтары </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Жатыс септік-хана, -жай
                                                        жұрнақтары </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">11. Шығыс септік</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">11 Шығыс септік
                                                        Исходный падеж Шығысс септіктің сұрақтарына жауап беруді
                                                        үйрену
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">12. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">13. Көмектес септік/Көлік түрлері</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Көлік түрлерін қолдана отырып
                                                        көмектес септікте құрмалас сөйлем құрастыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">14. Табыс септік/Тағам,ас</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өздеріне ұнайтын тағам жайлы
                                                        айту</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">15. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">16. Салыстырмалы шырай/Киім</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Киімдер, заттар мен құбылыстарды
                                                        бір-бірімен салыстыруды үйрену
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">17. Күшейтпелі шырай/Азық-түлік</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Сын есімдерді күшейтпелі мағынада
                                                        қолданаотырып құрмалас сөйлем құрастыру
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">18. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау.
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">19. Ауыспалы Осы шақ/Менің күн
                                                        тәртібім</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ауыспалы Осы шақ/Менің күн тәртібім
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div name="7" class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSeven">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven"
                                                aria-expanded="false" aria-controls="flush-collapseSeven">
                                            Сабақ 20-29
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSeven" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingSeven"
                                         data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">20. Нақ Осы шақ/Етістіктер</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Етістіктерді сөйлемдерде Нақ Осы
                                                        шақта қолдану
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">21. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">22. Уақыт/Етістіктер</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Уақытты айтуды меңгерту
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">23. Жедел Өткен шақ/Саяхат</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Құрмалас сөйлемдерді Жедел өткен
                                                        шақта айту

                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">24. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">25. Болымсыз етістік/ Су – тіршілік
                                                        көзі</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Болымды етістіктерді болымсыз
                                                        етістіктерге айналдыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">26. Қалау рай/ Айлар, апта күндері</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Мерекелер тақырыбында қалау райдың
                                                        жұрнақтарын қолдана отырып құрмалас сөйлем құрастыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">27. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">28. Шартты рай/Ауа райы болжамы</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Ауа райы тақырыбында шартты райдың
                                                        жұрнақтарын қолдана отырып құрмалас сөйлем құрастыру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">29. Кім? Қайда? Кім болып
                                                        істейді?/Мамандық түрлері </h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Мамандық түрлеріне байланысты
                                                        сөздермен сөйлем құрастыру
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div name="8" class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingEight">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseEight"
                                                aria-expanded="false" aria-controls="flush-collapseEight">
                                            Сабақ 30-36
                                        </button>
                                    </h2>
                                    <div id="flush-collapseEight" class="accordion-collapse collapse"
                                         aria-labelledby="flush-headingEight"
                                         data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="container py-4 border border-opacity-10 rounded">
                                                <div class="card-lesson shadow-lg border border-opacity-10">
                                                    <h5 class="card-title">30. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау.</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">31. Істегенді жақсы көремін/Бос
                                                        уақытым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Бос уақыты жайлы шағын мәтін
                                                        құрастцру</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">32. ... деп едім/жатырмын/Билет сатып
                                                        алу</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өз жоспарлары жайлы айтып үйрену
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">33. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">33 Айтылым/Говорение Өткен
                                                        тақырыптарды пысықтау. Жұптық жұмыс</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">34. -ғанды, -генді қалаймын/Туған
                                                        күн</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Қалау райда туған күн иесіне тілек
                                                        айтып үйрену</p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">35. Өздік есімдігі</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өздік есімдітерді қолдана отырып
                                                        құрмалас сөйлем құрастыру
                                                    </p>
                                                </div>
                                                <div class="card-lesson shadow-lg border border-opacity-10 mt-3">
                                                    <h5 class="card-title">36. Айтылым</h5>
                                                    <hr class=" mb-0 py-1 text-light">
                                                    <p class="card-text my-auto">Өткен тақырыптарды пысықтау. Жұптық
                                                        жұмыс
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php endif ?><!--KazL-->
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

<div name="mobV" class="d-block d-sm-none">
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

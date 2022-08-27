<?php
/**
 * Template Name: Наши продукты
 */
?>
<style>
    .hoverbig:hover {
        transform: scale(1.05);
        transition-duration: 0.6s;
    }
</style>
<?php get_header(); ?>
<div name="webV" class="d-none d-sm-block pt-5"
     style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDarkTheme.png); background-size: cover; background-repeat: repeat-y">

    <?php
    $cat = array(4);
    $showposts = -1; // -1 shows all posts
    $do_not_show_stickies = 1; // 0 to show stickies
    $args = array(
        'category__in' => $cat,
        'showposts' => $showposts,
        'caller_get_posts' => $do_not_show_stickies
    );
    $my_query = new WP_Query($args);

    ?>
    <br>
    <div class="container mt-5 w-75">
        <div>
            <p class="mt-1" style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">Наши
                продукты
                (маркет плейс)</p>
        </div>
    </div>
    <br>

    <?php if ($my_query->have_posts()) : ?>

        <div class="container text-center">
            <div class="container text-center pe-5">
                <div class="row ms-3 ps-5 me-3">

                    <?php while ($my_query->have_posts()) : $my_query->the_post();
                        global $wp_query;
                        $wp_query->in_the_loop = true;
                        add_theme_support('post-thumbnails');
                        add_image_size('thumb-size', 386, 396, true);
                        $thumbnail_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumb-size');
                        $thumbnail_url = $thumbnail_data[0];
                        ?>

                        <div class="col-sm-4">
                            <a href="<?php the_permalink(); ?>" class="bg-image d-flex hoverbig rounded shadow-lg"
                               style="background-image:url('<?php echo $thumbnail_url ?>'); background-size: cover; background-repeat: no-repeat; background-position: center; text-decoration: none;color: inherit;display: block;">
                                <div class="d-flex" style="width: 330px; height: 335px">
                                    <div class="pt-auto mt-auto">
                                        <div class="d-flex text-start mt-auto ms-3  ">

                                            <div class="rounded p-1 me-2"
                                                 style="margin-top: auto; margin-bottom: 10px; color: white; background: #BD861C; font-family: Roboto; font-weight: 700;">
                                                3 месяца
                                            </div>
                                            <div class="rounded p-1 me-2"
                                                 style="margin-top: auto; margin-bottom: 10px; color: white; background: #0B2137; font-family: Roboto; font-weight: 700;">
                                                36 занятий
                                            </div>
                                        </div>
                                        <div class="rounded bg-image text-start pb-1"
                                             style="height: auto; width: 95%; opacity: 95%; margin-bottom: 10px; margin-left: 10px; background: #0B2137">
                                            <p class="text-start ms-3 mb-0 pt-1"><b
                                                        style="color: white"><?php the_title(); ?></b></p>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    <?php else : ?>

        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php get_search_form(); ?>

    <?php endif; ?>
    <?php
    get_footer();
    ?>
</div>
<!---->

<div name="mobV" class="d-block d-sm-none pb-3"
     style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDark.png); background-repeat: repeat-y; height: 100%">
    <div class="text-start ms-4 pt-3">
        <p class="mb-0" style="font-family: Roboto;font-weight: 400; font-size: 14px; color: #DAAB31">
            Инновационные
            кейсы</p>
        <p class="mt-0" style="font-family: Roboto;font-weight: 600; font-size: 22px; color: white">Наши
            продукты</p>
    </div>
    <div class="ms-4 d-flex">
        <a class="btn" href="/наши-продукты/" style="color: white; background-color: #DAAB31">Новинки</a>
        <a href="/наши-продукты/" class="ms-3 rounded btn"
           style="color: #DAAB31; background: none; border: 1px solid #DAAB31;">
            Интеллект
        </a>
        <button disabled class="ms-3 rounded"
                style="color: #DAAB31; background: none; border: 1px solid #DAAB31">
            Здоровье
        </button>
    </div>

    <?php
    $cat = array(4);
    $showposts = -1; // -1 shows all posts
    $do_not_show_stickies = 1; // 0 to show stickies
    $args = array(
        'category__in' => $cat,
        'showposts' => $showposts,
        'caller_get_posts' => $do_not_show_stickies
    );
    $my_query = new WP_Query($args);
    ?>

    <?php if ($my_query->have_posts()) : ?>
        <div class="row mt-5">


            <?php while ($my_query->have_posts()) :
                $my_query->the_post();
                global $wp_query;
                $wp_query->in_the_loop = true;
                add_theme_support('post-thumbnails');
                add_image_size('thumb-size', 386, 396, true);
                $thumbnail_data = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumb-size');
                $thumbnail_url = $thumbnail_data[0];
                ?>
                <div class="col-5 ms-4 p-0">
                    <a href="<?php the_permalink(); ?>" class="">
                        <div><img style="height: 180px" class="rounded" src="<?php the_post_thumbnail(); ?></div>
                                <div class=" mb-0 pb-0"><p class="mb-0"
                                                           style="font-family: Roboto; font-weight: 700; font-size: 12px; color: white"><?php the_title() ?></p>
                        </div>
                        <div class="mt-0 pt-0"><p
                                    style="font-family: Roboto; font-weight: 700; font-size: 12px; color: white; opacity: 0.54">
                                3 месяца | 36 занятий</p></div>
                    </a>
                </div>

            <?php endwhile; ?>
        </div>

    <?php else : ?>

        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php get_search_form(); ?>

    <?php endif; ?>

    <!---->
</div>
<!---->




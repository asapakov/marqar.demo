<?php
/**
 * Template Name: Новости
 */
?>
<style>
    .hoverbig:hover {
        transform: scale(1.05);
        transition-duration: 0.4s;
        border: 1px solid white;
    }

    .bgChange {
        background-color: #0B2137;
    }


</style>
<?php get_header(); ?>
<div name="webV" class="d-none d-sm-block pt-5"
     style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDarkTheme.png); background-size: cover; background-repeat: repeat-y">

    <br><br><br>
    <div class="container text-start">
        <div style="margin-left: 200px">
            <p class="mb-0" style="font-family: Roboto; font-weight: 500; font-size: 16px; color: #DAAB31">Самые
                актуальные
                новости</p>
            <p class="mt-1" style="font-family: Roboto; font-weight: 500; font-size: 32px; color: white">Новости
                "MARQAR"</p>
        </div>

        <?php
        $cat = array(3);
        $showposts = -1; // -1 shows all posts
        $do_not_show_stickies = 1; // 0 to show stickies
        $args = array(
            'category__in' => $cat,
            'showposts' => $showposts,
            'caller_get_posts' => $do_not_show_stickies
        );
        $my_query = new WP_Query($args);

        ?>
        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) :
            $my_query->the_post();
            global $wp_query;
            $wp_query->in_the_loop = true;
            ?>

            <a href="<?php the_permalink(); ?>" class="container text-center ps-0"
               style="text-decoration: none; color: inherit">
                <div class="card flex-row hoverbig w-75 shadow-lg mb-3 rounded bgChange"
                     style="height: 220px; margin-left: 150px; background-color: #0B2137">
                    <img
                            class="card-img-left example-card-img-responsive ms-0 rounded"
                            style="height: 218px; width: auto" src="<?php the_post_thumbnail(); ?>"
                    <div class=" card-body p-0">
                        <h4 class="card-title h5 h4-sm text-start" style="color: white"><?php the_title() ?></h4>
                        <h6 class="card-text text-start"
                            style="color: white; opacity: 0.75"><?php the_excerpt(); ?></h6>
                    </div>
                </div>
            </a>


        <?php endwhile; ?>
        <?php else : ?>

            <h2 class="center">Not Found</h2>
            <p class="center">Sorry, but you are looking for something that isn't here.</p>
            <?php get_search_form(); ?>

        <?php endif; ?>


    </div>
    <?php
    get_footer();
    ?>
</div>
<!---->

<div name="mobV" class="d-block d-sm-none pb-3"
     style="background-image: url(/wp-content/themes/marqar_theme/assets/images/bgDark.png); background-repeat: repeat-y; height: 100%">
    <div class="text-start ms-4 pt-3">
        <p class="mb-0" style="font-family: Roboto;font-weight: 400; font-size: 14px; color: #DAAB31">
            Самые актуальные акции</p>
        <p class="mt-0" style="font-family: Roboto;font-weight: 600; font-size: 22px; color: white">Новости "MARQAR"</p>


    <?php
    $cat = array(3);
    $showposts = -1; // -1 shows all posts
    $do_not_show_stickies = 1; // 0 to show stickies
    $args = array(
        'category__in' => $cat,
        'showposts' => $showposts,
        'caller_get_posts' => $do_not_show_stickies
    );
    $my_query = new WP_Query($args);

    ?>
    <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) :
        $my_query->the_post();
        global $wp_query;
        $wp_query->in_the_loop = true;
        ?>

        <a href="<?php the_permalink(); ?>" class="container d-flex p-0 mx-auto" style="text-decoration: none; color: inherit">
        <div class="d-flex rounded border mt-2 me-2" style="height: 130px; background-color: #0B2137">
            <div class="col-sm-4 d-flex align-items-center"><img class="rounded" style="height: 100%; width: 190px" src="<?php the_post_thumbnail(); ?></div>
            <div class="col-sm-4 ms-2 p-1 align-items-center">
                <div class="text-start mb-0"><p class="mb-0" style="font-family: Roboto; font-weight: 700; font-size: 10px; color: white"><?php the_title() ?></p></div>
                <div class="text-start mt-0"><div style="font-family: Roboto; font-weight: 400; font-size: 8px; color: white; opacity: 0.54"><?php the_excerpt(); ?></div></div>
            </div>
        </div>
        </a>


    <?php endwhile; ?>
    <?php else : ?>

        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php get_search_form(); ?>

    <?php endif; ?>
    <!---->
        <script type="text/javascript">
            (function(d, w, s) {
                var widgetHash = 'si0c6zmamm8cnuk58kr9', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
                gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
                var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
            })(document, window, 'script');
        </script>
</div>
<!---->





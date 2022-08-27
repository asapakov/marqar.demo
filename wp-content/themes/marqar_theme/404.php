<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>
    <body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold">404</h1>
            <p class="fs-3"> <span class="text-danger">Оп!</span> Страница не найдена.</p>
            <p class="lead">
                Запрашиваемая Вами страница не существует!
            </p>
            <a href="/" class="btn btn-primary">На главную</a>
        </div>
    </div>
    </body>
<div name="webV" class="d-none d-sm-block pb-5">

<?php
get_footer();
?>
</div>



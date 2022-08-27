<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<style>
    .nav-links {
        font-family: Roboto;
        font-weight: 400;
        font-size: 16px;
        color: #D5E2F3;
        line-height: 19px;
    }

    .nav-links:hover {
        color: #DAAB31;
        text-decoration: none;
    }

    .logInClass {
        background: none;
        border: 1px solid #DAAB31;
    }

    .logInBtn {
        font-family: Roboto;
        font-weight: 400;
        font-size: 16px;
        color: #DAAB31;
        text-decoration: none;
    }

    .logInBtn:hover {
        transform: scale(1.03);
        transition-duration: 0.5s;
        color: white;
    }

</style>

<!doctype html>
<html <?php language_attributes(); ?>>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>


<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>

<header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #0B2137">
        <div class="container align-items-center">
            <a class="navbar-brand text-center" href="/"><img
                        src="/wp-content/themes/marqar_theme/assets/images/logo-2.png" alt=""></a>
            <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars" style="color: #DAAB31"></i>
            </button>-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fa-solid fa-bars" style="color: #DAAB31"></i></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <div class="mx-auto">
                    <ul class="navbar-nav  mb-2 mb-lg-0 ">

                        <li class="nav-item me-3">
                            <a class="nav-links active" aria-current="page" style="text-decoration: none" href="/">Главная
                                страница</a>
                        </li>

                        <li class="nav-item col">
                            <a class="nav-links me-3" style="text-decoration: none" href="/о-компании/">О компании</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-links me-3 mx-auto" style="text-decoration: none"
                               href=https://marqar.kz/s/frontend/web/site/signup>Присоединиться</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-links me-3" style="text-decoration: none" href="/наши-продукты/">Наши
                                продукты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-links me-3" style="text-decoration: none" href="/новости/">Новости</a>
                        </li>
                    </ul>
                </div>
                <!---->
                <!--<form class="col-sm-2 align-items-center py-auto d-flex" role="search">
                    <input class="form-control me-2 my-auto" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn" type="submit">
                        <div class=" text-center">
                            <div class="row justify-content-center">
                                <i class="fa-solid fa-magnifying-glass" style="color: #DAAB31"></i>
                            </div>
                        </div>
                    </button>
                </form>-->
                <!---->
                <div class="ms-auto">
                    <div class="align-items-evenly rounded text-center p-1 logInClass">
                        <div class="d-flex justify-content-center px-2">
                            <div><a href="https://marqar.kz/s/frontend/web/site/login" class="logInBtn">Вход</a></div>
                            <div class="ms-3 me-3" style="color: #DAAB31">|</div>
                            <div><a href="https://marqar.kz/s/frontend/web/site/signup" class="logInBtn">Регистрация</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</header>

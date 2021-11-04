<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://artmir.ru/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="https://artmir.ru/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>@yield('page_title')</title>
    <style>
        header {
            font-family: sans-serif;
        }

        header a {
            color: inherit;
        }

        header .callback-btn {
            font-size: 1.1rem;
        }

        header .callback-btn div {
            border-bottom: 1px dashed;
        }
    </style>
</head>
<body>
<header>
    <div class="container-fluid mb-3 mt-2">
        <div class="row">
            <div class="col col-md-3">
                <div class="card border-0" style="max-width:235px">
                    <div class="row g-0">
                        <div class="logo col-4 text-center">
                            <a href="/" class="text-decoration-none">
                                <img alt="Школа рисования для взрослых 'АртМир'" src="/img/layout/logo.png"
                                     class="img-responsive">
                            </a>
                        </div>
                        <div class="col-8 pt-2 lh-1">
                            <a href="/" class="text-decoration-none fs-3 d-inline-block">ARTMIR.RU</a>
                            <a href="/" class="text-decoration-none d-inline-block" style="font-size: 1.23rem;">студия живописи</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col text-center fs-4 lh-1 pt-2">Мастер-классы живописи
                в Санкт-Петербурге
                <small class="d-inline-block">1 минута от м. Звенигородская</small></div>
            <div class="col col-md-3 lh-1 pt-2">
                <div class="phone d-inline-block float-end">
                    <div class="num fs-3">
                        <a href="tel:+79219076449" class="text-decoration-none">907-64-49</a>
                    </div>
                    <div data-url="https://artmir.ru/forms/callback" class="callback-btn">
                        заказать звонок
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@yield('title')
@yield('content')
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>

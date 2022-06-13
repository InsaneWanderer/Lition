<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,400i" rel="stylesheet">

		<!-- Include Amplitude JS -->
		<script type="text/javascript" src="/../dist/amplitude.js"></script>

		<!-- Include Style Sheet -->
		<link rel="stylesheet"  href="/css/style.css"/>
        <script type="text/javascript" src="/amplitudejs-5.3.2/dist/amplitude.js"></script>
        <!-- Подключаем jQuery -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</head>

<body>
    <header class ="header">
        <nav class="navbar navbar-expand-lg navbar-light  d-lg-none">
            <div class="container-fluid">
                <div class ="">
                    <img class ="img-fluid header_logo" src="/img/LITION.png">
                </div>
                <div class ="adaptive col-md-10 col-8 d-flex">
                    <a class ="header_profile first_icon d-flex" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </a>
                    <a class ="test first_icon d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Книги
                            </a>
                            {{-- TODO {{route('subs')}} {{route('allBooks')}}  {{route('catalog')}}  {{route('editForm')}}--}}
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li> <a class ="nav-link" href="">Подборки</a></li>
                                <li> <a class ="nav-link {{ str_contains(request()->url(), '/subscriptions') ? 'color' : '' }}" href="{{route('subs')}}">Подписки</a></li>
                                <li> <a class ="{{ request()->url() === 'http://lition.ru' ? 'color' : '' }}" href="/">Рекомендации</a></li>
                                <li><a class ="{{ str_contains(request()->url(), '/all') ? 'color' : '' }}" href="">Новинки</a></li>
                                <li><a class ="{{ str_contains(request()->url(), '/catalog') ? 'color' : '' }}" href="" href="catalog.html">Каталог</a></li>
                                @if (Auth::guard('web-user')->user()?->admin)
                                    <li> <a class ="{{ str_contains(request()->url(), '/redact') ? 'color' : '' }}" href="{{ route('redact') }}">Добавить книгу</a></li>
                                    <li> <a class ="nav-link" href="{{ route('goCreateCollection') }}">Добавить подборку</a></li>
                                @endif
                            </ul>
                        </li>
                        @if(Auth::guard('web-user')->user())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Моё
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li> <a class ="nav-link" href="">Запомненные</a></li>
                                    <li>  <a class ="nav-link" href="">Мои покупки</a></li>
                                    <li> <a class ="nav-link color" href="">История просмотров</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class ="nav-link" href="#">Выйти</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class ="container d-none d-lg-block">
            <div class ="row">
                <div class ="col-lg-1">
                    <img class ="img-fluid header_logo" src="/img/LITION.png">
                </div>
                <nav class = "col-lg-9 header_nav  d-flex">
                    <a class ="nav-link color" href="/">Книги</a>
                    @if(Auth::guard('web-user')->user())
                        <a class ="nav-link" href="#">Моё</a>
                    @endif
                </nav>
                <div class ="col-lg-2 d-flex header_end">

                    <a class ="header_profile d-flex" >
                        <div class="wraper ">
                            {{-- TODO  --}}
                            <form action="{{ route('search') }}" method="GET">
                                @csrf
                                <input name="find" id="find" name="find" type="text" class="input " autocomplete="off" placeholder="Поиск">
                            </form>
                            <i class="fa fa-search" aria-hidden="false"></i>
                        </div>
                    </a>

                    <input type="checkbox" id="side-checkbox" />
                    <div class="side-panel">
                        <label class="side-button-2" for="side-checkbox">+</label>
                        <div class="side-title">
                            <h2 class ="side_tittle_text">АВТОРИЗАЦИЯ</h2></div>
                            <div class ="side_tittle_under">
                                <div class ="side_tittle_undertext">
                                    <h4 class ="side_tittle_head">Войдите</h4>
                                    <div class ="side_tittle_underhead">Чтобы увидеть свои подписки и покупки</div>
                                            <div class="form-group" id="sendMail">
                                                    <input type="email" autocomplete="off" name='email' class="form-control mail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Электронная почта">

                                                    <button type="button" onclick="checkMail()" class="subscribe_about button_head" >ПРОДОЛЖИТЬ</button>

                                            </div>
                                            <div class="form-group" id="codePart" style="display: none">
                                                <input type="text" autocomplete="off" name="iCode" class="form-control_2 mail" id="code" aria-describedby="emailHelp" placeholder="Введите код">
                                                <button type="button" id="btnCode" class="subscribe_about button_head" >ПРОДОЛЖИТЬ</button>
                                            </div>


                                    </div>
                                </div>
                            </div>
                            @if (Auth::guard('web-user')->user())
                                <div class="side-button-1-wr">
                                    <a class ="test d-flex" href="{{ route('logout') }}">
                                        <p class="side-b side-open">Выйти</p>
                                    </a>
                                </div>
                            @else
                                <div class="side-button-1-wr">
                                    <label class="side-button-1 d-flex" for="side-checkbox">
                                        <a class ="test d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                            </svg>
                                            <p class="side-b side-open">Войти</p>
                                            <p class="side-b side-close">Войти</p>
                                        </a>
                                    </label>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class ="under_header d-none d-lg-block">
        <div class ="container">
            <div class ="row">
                {{-- TODO routes --}}
                <nav class="col-md-10 offset-md-1 d-flex under_header_nav">
                    <a class ="{{ request()->url() === 'http://lition.ru' ? 'nav-link color' : 'nav-link' }}" href="/">Рекомендации</a>
                    <a class ="{{ str_contains(request()->url(), '/all') ? 'nav-link color' : 'nav-link' }}" href="">Новинки</a>
                    <!-- <a class ="nav-link" href="novelties.html">Аудиокниги</a>
                    <a class ="nav-link" href="novelties.html">Другие языки</a> -->
                    <a class ="{{ str_contains(request()->url(), '/catalog') ? 'nav-link color' : 'nav-link' }}" href="{{ route('collections') }}">Каталог</a>
                    <a class ="nav-link" href="">Подборки</a>
                    <a class ="{{ str_contains(request()->url(), '/subscriptions') ? 'nav-link color' : 'nav-link' }}" href="{{route('subs')}}">Подписки</a>
                    @if (Auth::guard('web-user')->user()?->admin)
                        <a class ="{{ str_contains(request()->url(), '/redact') ? 'nav-link color' : 'nav-link' }}" href="{{ route('redact') }}">Добавить книгу</a>
                        <a class ="{{ str_contains(request()->url(), '/collections/create') ? 'nav-link color' : 'nav-link' }}" href="{{ route('goCreateCollection') }}">Добавить подборку</a>
                    @endif
                </nav>
            </div>
        </div>
    </section>

    @yield('content')

    <footer class ="footer container">
        <div class ="footer_flex d-flex ">
            <div class ="logo d-flex">
                <i class="fab fa-vk logo_icon"></i>
                <i class="fab fa-twitter logo_icon"></i>
                <i class="fab fa-instagram logo_icon"></i>
                <i class="fab fa-facebook-f logo_icon"></i>
                <i class="fab fa-odnoklassniki logo_icon"></i>
                <i class="fab fa-telegram-plane logo_icon"></i>
                <i class="fab fa-youtube logo_icon"></i>
            </div>
        </div>
        <nav class ="row row-cols-3 row-cols-md-3 row-cols-lg-3 g-4 footer_nav">
            <div class ="col padding">
                <ul class ="footer_list">
                    <li class ="footer_header">LITION</li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">О нас</a>
                    </li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Блог</a>
                    </li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Карьера в LITION</a>
                    </li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Агенты LITION</a>
                    </li>
                </ul>
            </div>
            <div class ="col  padding">
                <ul class ="footer_list">
                    <li class ="footer_header">Помощь</li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Вопросы и ответы</a>
                    </li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Список устройств</a>
                    </li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Дистрибьюторам</a>
                    </li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Контакты</a>
                    </li>
                </ul>
            </div>
            <div class ="col  padding">
                <ul class ="footer_list">
                    <li class ="footer_header">Другое</li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Акции </a>
                    </li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Календарь премьер</a>
                    </li>
                    <li class ="footer_padding">
                        <a class ="footer_underheader" href="#">Сертификаты</a>
                    </li>
                </ul>
            </div>
        </nav>
    </footer>

    {{-- {{route('auth')}} --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <!-- Подключаем jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Подключаем слайдер Slick -->
    <script src="/js/slick.min.js"></script>
    <!-- Подключаем файл скриптов -->
    <script src="js/book.js"></script>
    <!-- Подключаем файл скриптов -->
    <script src="/js/main.js"></script>
    <script src="/js/index.js"></script>
    <script>

function checkMail(){
        const email = $('#exampleInputEmail1').val();
        if(email.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){

            var x = document.getElementById("sendMail");
            x.style.display='none';
            var y = document.getElementById("codePart");
            y.style.display='block';
            var code = Math.floor(Math.random() * 8999) + 1000;
            $.ajax({
                url: "{{route('sendMail')}}",
                type: "POST",
                data: {email:email, code:code},
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                },
                error: function (msg) {
                    alert('Ошибка');
                }

            });
            $('#btnCode').click(function(){

                var myCode = $("#code").val();
                if(myCode == code){
                    $.ajax({
                        url: "{{route('login')}}",
                        type: "POST",
                        data: {email:email, code:code},
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            document.location.reload()
                        },
                        error: function (msg) {
                            alert('Ошибка');
                        }
                    });
                }
                else {
                    alert('Неверный код');
                }
            });
        }
    }
    </script>
</body>

@extends('layouts.main-layout')

@section('title', 'Главная')

@section('content')

    <section class="container d-none d-md-block">
        <div class="slider">
            @foreach($books as $book)
                <div class="slider__background ">
                    <div class ="slider__item d-flex wrap">
                        <img src="{{ url($book->cover_path) }}"  alt="" style="display: block; margin-left:auto;margin-right:auto" height="100%">
                        <div class ="slider_text">
                            <h5 class ="slider_author">
                                @foreach ($book->authors as $author)

                                    {{ $author->name." ".$author->surname }}

                                    @if (!$loop->last)
                                        <span>, </span>
                                    @endif

                                @endforeach
                            </h5>
                            <h3 class ="slider_header">{{ $book->name }}</h3>
                            <p class ="slider_undertext d-none d-lg-block">{{ mb_substr($book->description, 0, 250)."..." }}</p>
                            <form class ="slider_btn" action="{{ route('book', [$book->slug]) }}">
                                <button type="submit" class="slider_about">ПОДРОБНЕЕ О КНИГЕ</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @include('layouts.subscriptions-layout', ['subscriptions' => $subscriptions])

    <section class ="hints container">
        <div class ="books_slider">
            <div class ="books_text">
                <h2>Новинки в LITION</h4>
            </div>
        </div>
        <div class="slickslider">
            @foreach($books as $book)
                <article class ="collection_wrapper_second_new">
                    <a href="{{ route('book', [$book->slug]) }}" class ="collection_link_second_new">
                        <div class ="collection_position_second">
                            <div>
                                <div class ="collection_first_second_new">
                                    <img src="{{ url($book->cover_path) }}" height="200px" class ="img_first_second_new">
                                    <h5 class ="books_undertext">{{$book->name}}</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach

        </div>
    </section>
    <section class ="films container-fluid">
        <div class ="container">
            <div class ="row">
                <div class ="col-md-8">
                    <h2 class ="films_header">Популярные книги, лучшие  новинки</h2>
                    <p class ="films_text">В каталоге представлено более 100 000 книг. Вы легко найдёте то, что вам нужно – в наших коллекциях или через поиск по жанру/писателю.</p>
                </div>
            </div>
            <ul class ="films_list">
                <li class ="film_list">ТОП-НОВИНКИ</li>

                <a class ="film_catalog " href="catalog.html">ВЕСЬ КАТАЛОГ</a>
            </ul>

            @include('layouts.books-collection', $books)
        </div>
    </section>

@endsection

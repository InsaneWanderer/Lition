@extends('layouts.main-layout')

@section('title', 'Книга')

@section('content')

    <section class ="book container">
            <div class ="row ">
                <div class ="Book_text">
                    <h2 class ="book_name">{{$book->name}}</h2>
                </div>
                <div class ="col-lg-6 book_image">
                    <img src ="{{ url($book->cover_path) }}" height="100%" class =" img-fluid image">
                </div>
                <div class ="text_right col-lg-6 ">
                    <div class ="text_author d-flex">
                        <p class ="author">Автор:</p>
                        <a href ="#" class ="author_name">
                            @foreach ($book->authors as $author)

                                {{ $author->name." ".$author->surname }}

                                @if (!$loop->last)
                                    <span>, </span>
                                @endif

                            @endforeach
                        </a>
                    </div>
                    <div class ="text_author d-flex">
                        <p class ="genres">Жанры:</p>
                        <div class ="d-flex">
                        @foreach($book->genres as $genre)
                        {{-- {{ route('booksByGenre', [$genre->id]) }} --}}
                            <a href ="" class ="genre_name">{{ $genre->name }}</a>
                            @if($loop->remaining !== 0)
                                ,
                            @endif
                        @endforeach
                    </div>
                    </div>
                    <div class ="books_btn d-flex">
                    <form class ="read_btn " action="{{ route('read', [$book->slug, 1, 'русский', true]) }}">
                        <button type="submit" class="book_about"> <i class="fas fa-book-open icon_book"></i>Читать фрагмент</button>
                    </form>

                    <form class ="read_btn">
                        <button type="button" class="book_about"><i class="far fa-heart icon_book"></i>Отложить книгу</button>
                    </form>
                </div>
                <form class ="read_btn " action="{{ route('read', [$book->slug, 1, 'русский']) }}">
                    <button type="submit" class="book_about_second"> <i class=""></i>Читать</button>
                </form>
                <form class ="read_btn ">
                    <button type="button" class="book_about_third"> <i class=""></i>Отметить прочитанной</button>
                </form>

                @if (Auth::user()?->admin)
                    <div class ="books_btn d-flex">
                        <form class ="read_btn " action="{{route('redact', [$book->slug])}}">
                            <button type="submit" class="book_about_third"> <i class=""></i>Изменить</button>
                        </form>

                        <form method="POST" class ="read_btn " action="{{route('delete', [$book->id])}}">
                            @csrf
                            <button type="submit" class="book_about_third"> <i class=""></i>Удалить</button>
                        </form>

                        <form method="GET" class ="read_btn " action="{{route('files', [$book->slug])}}">
                            @csrf
                            <button type="submit" class="book_about_third"> <i class=""></i>Управление файлами</button>
                        </form>
                    </div>
                @endif


                <div class ="films_logo d-flex">
                    <h5 class ="films_share">Поделиться:</h5>
                    <div class ="film_padding">
                    <a href="#"><i class="fab fa-vk logo_icon_second logo_vk"></i></a>
                </div>
                <div class ="film_padding">
                    <a href="#"><i class="fab fa-facebook-f logo_icon_second logo_face"></i></a>
                </div>
                <div class ="film_padding">
                    <a href="#"><i class="fab fa-odnoklassniki logo_icon_second logo_odn"></i></a>
                </div>
                <div class ="film_padding">
                    <a href="#"><i class="fab fa-twitter logo_icon_second logo_twit"></i></a>
                </div>
                </div>
                </div>

            </div>

        </section>
        <section class ="book_under container">
            <div class = "ro">
                <ul class ="book_list d-flex">
                    <li class ="book_description">Описание</li>
                    <li class ="book_description_second">Входит в подписки</li>
                </ul>
            </div>
            <div class ="row">
                <div class ="description col-md-12">
                    <p class ="description_text">{{$book->description}}</p>
                </div>
            </div>

        </section>

        @if ($authors_books->count() > 0)
            <section class ="hints container">
                <div class ="books_slider">
                    <div class ="books_text">
                        <h2>От писателя</h2>
                    </div>
                </div>
                <div class="slickslider">
                    @foreach($authors_books as $authorsBook)
                    <article class ="collection_wrapper_second_new">
                        {{-- {{route('book', [$authorBook->slug])}} --}}
                        <a href="" class ="collection_link_second_new">
                            <div class ="collection_position_second">
                                <div>
                                    <div class ="collection_first_second_new">
                                        <img src="{{ url($authorsBook->cover_path) }}" class ="img_first_second_new">
                                        <h5 class ="books_undertext">{{ $authorsBook->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($book->collections()->count() > 0)
            <section class ="container">
                <div class ="books_text">
                    <h2>Входит в Коллекции</h2>
                </div>
                <div class="slider">

                    @foreach ($book->collections() as $collection)

                        <article class ="collection_wrapper_second ">
                            {{-- {{ route('booksByCollection', [$collection->id]) }} --}}
                            <a href="" class ="collection_link_third">
                                <div class ="collection_position_second">
                                    <div>
                                        <div class ="collection_third_second">
                                            <img src="{{ url($collection->cover) }}" class ="img_third_second">
                                        </div>
                                        <div class ="collection_second_second">
                                            <img src="{{ url($collection->cover) }}"  class ="img_third_second">
                                        </div>
                                        <div class ="collection_first_second">
                                            <img src="{{ url($collection->cover) }}" class ="img_first_second">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>

                    @endforeach

                </div>

            </section>

        @endif

    </section>

@endsection

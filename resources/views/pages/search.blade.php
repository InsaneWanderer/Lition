@extends('layouts.main-layout')

@section('title', 'Поиск')

@section('content')

<section class =" second container-fluid">
    <div class ="container">
        <div class ="row">

            <div class ="col-md-12">
                <div class ="films_flex">
                    <h2 class ="films_header_second">{{ $result_string }}</h2>
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
        </div>
        <form class=" d-flex">
            <div class="select">
            <input class="select__input" type="hidden" name="" id="genre">
            <div class="select__head">Жанры</div>
            <ul class="select__list" style="display: none;">
                @foreach ($genres as $genre)
                    <li class="select__item" >{{ $genre->name }}</li>
                @endforeach
            </ul>
        </div>


        <div class="selectsecond">
        <input class="select__inputsecond" type="hidden" name="">
        <div class="select__headsecond">Тип</div>
        <ul class="select__listsecond" id="audioBook" style="display: none;">
            <li class="select__itemsecond">Электронная книга</li>
            <li class="select__itemsecond">Аудиокнига</li>
        </ul>
    </div>
    <div class="selectthird">
        <input class="select__inputthird" id="language" type="hidden" name="">
        <div class="select__headthird">Язык</div>
        <ul class="select__listthird" style="display: none;">
            @foreach ($languages as $language)
                <li class="select__itemthird">{{ $language }}</li>
            @endforeach
        </ul>
    </div>
</form>
    <div class ="row row-cols-1 row-cols-md-2 row-cols-lg-6 g-4" id="books">
        @foreach ($books as $book)
            <div class="{{ str_replace(',', '', \App\Services\BookService::genresString($book)).' '.str_replace(',', '', \App\Services\BookService::languages($book)).($book->files()->where('file_type', 'аудио')->count() > 0 ? 'hasAudio' : '') }}">

                <a href="{{ route('book', [$book->slug]) }}" class ="col card_new">
                    <input hidden id="bookGenres" value="{{ \App\Services\BookService::genresString($book) }}">
                    <input hidden id="languages" value="{{ \App\Services\BookService::languages($book) }}">
                    <input hidden id="hasAudio" value="{{ $book->files()->where('file_type', 'аудио')->count() > 0 }}">
                    <img src="{{ url($book->cover_path) }}" class ="img-fluid film" alt="">
                    <div class ="new_wrapper">
                        <h6 class ="new_undertext">{{ $book->name }}</h5>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

</section>

<script>

    function filterBooks() {
        var genre = $('#genre').value();
    }

</script>

@endsection

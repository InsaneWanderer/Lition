@extends('layouts.main-layout')

@section('title', 'Книга')

@section('content')

    <section class ="book container">
        <div class ="row ">
            <div class ="Book_text">
                <h2 class ="book_name">{{ $book->name }}</h2>
            </div>

            <div class ="col-lg-5 book_image">
                <div id="flat-black-player-container">
                    @if (count($audio) > 0)
                        <div id="list-screen" class="slide-in-top">
                            <div id="list-screen-header" class="hide-playlist">
                                <img id="up-arrow" src="/img/up.svg"/>
                                Спрятать плейлист
                            </div>

                            <div id="list">

                                <div class="song amplitude-song-container amplitude-play-pause" data-amplitude-song-index="0">
                                <span class="song-number-now-playing">
                                    <span class="number">1</span>
                                    <img class="now-playing" src="/img/now-playing.svg"/>
                                </span>

                                <div class="song-meta-container">
                                    <span class="song-name" data-amplitude-song-info="name" data-amplitude-song-index="0"></span>
                                    <span class="song-artist-album"><span data-amplitude-song-info="artist" data-amplitude-song-index="0"></span> - <span data-amplitude-song-info="album" data-amplitude-song-index="0"></span></span>
                                </div>
                                </div>

                            </div>

                            <div id="list-screen-footer">
                                <div id="list-screen-meta-container">
                                <span data-amplitude-song-info="name" class="song-name"></span>

                                <div class="song-artist-album">
                                    <span data-amplitude-song-info="artist"></span>
                                </div>
                                </div>
                                <div class="list-controls">
                                <div class="list-previous amplitude-prev"></div>
                                <div class="list-play-pause amplitude-play-pause"></div>
                                <div class="list-next amplitude-next"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div id="player-screen">
                    @if (count($audio) > 0)
                      <div class="player-header down-header">
                        <img id="down" src="/img/down.svg"/>
                        Показать плейлист
                      </div>
                    @endif
                      <div id="player-top">
                        <img data-amplitude-song-info="cover_art_url" src="{{ url($book->cover_path) }}"/>
                      </div>
                      @if (count($audio) > 0)
                        <div id="player-progress-bar-container">
                            <progress id="song-played-progress" class="amplitude-song-played-progress"></progress>
                            <progress id="song-buffered-progress" class="amplitude-buffered-progress" value="0"></progress>
                        </div>
                        <div id="player-middle">
                            <div id="time-container">
                                <span class="amplitude-current-time time-container"></span>
                                <span class="amplitude-duration-time time-container"></span>
                            </div>
                            <div id="meta-container">
                                <span data-amplitude-song-info="name" class="song-name"></span>

                                <div class="song-artist-album">
                                    <span data-amplitude-song-info="artist"></span>
                                </div>
                            </div>
                        </div>

                        <div id="player-bottom">
                            <div id="control-container">

                            <div id="shuffle-container">
                                <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
                            </div>

                            <div id="prev-container">
                                <div class="amplitude-prev" id="previous"></div>
                            </div>

                            <div id="play-pause-container">
                                <div class="amplitude-play-pause" id="play-pause"></div>
                            </div>

                            <div id="next-container">
                                <div class="amplitude-next" id="next"></div>
                            </div>

                            <div id="repeat-container">
                                <div class="amplitude-repeat" id="repeat"></div>
                            </div>

                            </div>

                            <div id="volume-container">
                            <img src="/img/volume.svg"/><input type="range" class="amplitude-volume-slider" step=".1"/>
                            </div>
                        </div>

                      @endif
                    </div>
                  </div>
            </div>
            <div class ="text_right col-lg-6 ">
                <div class ="text_author d-flex">
                    <p class ="author"> {{ $book->authors->count() == 1 ? 'Автор' : 'Авторы' }}:</p>
                    <a href ="#" class ="author_name">
                        @foreach ($book->authors as $author)

                            {{ $author->name." ".$author->surname }}

                            @if (!$loop->last)
                                ,
                            @endif

                        @endforeach
                    </a>
                </div>
                <div class ="text_author d-flex">
                    <p class ="volume">Объём:</p>
                    <a href ="#" class ="volume_name">{{ $book->pages_count }} стр.</a>
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
                    <button type="submit" class="book_about"><i class="far fa-heart icon_book"></i>Отложить книгу</button>
                </form>
            </div>
            <form class ="read_btn " action="{{ route('read', [$book->slug, 1, 'русский']) }}">
                <button type="submit" class="book_about_second"> <i class=""></i>Читать по подписке</button>
            </form>
            <form class ="read_btn ">
                <button type="submit" class="book_about_third"> <i class=""></i>Отметить прочитанной</button>
            </form>
            @if (Auth::user()?->admin)
                <form class ="read_btn " action="{{route('redact', [$book->slug])}}">
                    <button type="submit" class="book_about_third"> <i class=""></i>Изменить</button>
                </form>

                <form method="POST" class ="read_btn " action="{{route('delete', [$book->id])}}">
                    @csrf
                    <button type="submit" class="book_about_third"> <i class=""></i>Удалить</button>
                </form>

                <form method="GET" class ="read_btn " action="{{route('files', [$book->slug])}}">
                    <button type="submit" class="book_about_third"> <i class=""></i>Управление файлами</button>
                </form>
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

    </section>

    <section class ="book_under container">
        <div class = "ro">
            <ul class ="book_list d-flex">
                <li class ="book_description">Описание</li>
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
<script type="text/javascript">


</script>

<!--
Include UX functions JS

NOTE: These are for handling things outside of the scope of AmplitudeJS
-->
<script type="text/javascript">
    window.onkeydown = function(e) {
        return !(e.keyCode == 32);
    };

    /*
    Handles a click on the down button to slide down the playlist.
    */
    document.getElementsByClassName('down-header')[0].addEventListener('click', function(){
    var list = document.getElementById('list');

    list.style.height = ( parseInt( document.getElementById('flat-black-player-container').offsetHeight ) - 135 ) + 'px';

    document.getElementById('list-screen').classList.remove('slide-out-top');
    document.getElementById('list-screen').classList.add('slide-in-top');
    document.getElementById('list-screen').style.display = "block";
    });

    /*
    Handles a click on the up arrow to hide the list screen.
    */
    document.getElementsByClassName('hide-playlist')[0].addEventListener('click', function(){
    document.getElementById('list-screen').classList.remove('slide-in-top');
    document.getElementById('list-screen').classList.add('slide-out-top');
    document.getElementById('list-screen').style.display = "none";
    });

    /*
    Handles a click on the song played progress bar.
    */
    document.getElementById('song-played-progress').addEventListener('click', function( e ){
    var offset = this.getBoundingClientRect();
    var x = e.pageX - offset.left;

    Amplitude.setSongPlayedPercentage( ( parseFloat( x ) / parseFloat( this.offsetWidth) ) * 100 );
    });

    document.querySelector('img[data-amplitude-song-info="cover_art_url"]').style.height = document.querySelector('img[data-amplitude-song-info="cover_art_url"]').offsetWidth + 'px';

    Amplitude.init({
    "bindings": {
        37: 'prev',
        39: 'next',
        32: 'play_pause'
    },
    "songs": <?php echo(json_encode($audio)); ?>
    });
</script>
@endsection

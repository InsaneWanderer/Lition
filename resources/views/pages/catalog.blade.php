@extends('layouts.main-layout')

@section('title', 'Книга')

@section('content')

    <section class="container">
        <div class ="row">
            <div class ="col-lg-11 offset-lg-1 col-md-12">
                <h2 class ="catalog">Каталог</h2>
                <h6 class ="under_catalog">КОЛЛЕКЦИИ</h6>
            </div>
            <div class="slickslider">
                @for ($i = 0; $i < 10; $i++)

                    @foreach ($collections as $collection)
                        
                        <article class ="collection_wrapper_second ">
                            <a href="{{ route('booksByCollection', [$collection->id]) }}" class ="collection_link_third">
                                <div class ="collection_position_second">
                                    <div>
                                        <div class ="collection_third_second">
                                            <img src="{{'../img/'.$collection->cover}}" class ="img_third_second">
                                        </div>
                                        <div class ="collection_second_second">
                                            <img src="{{'../img/'.$collection->cover}}"  class ="img_third_second">
                                        </div>
                                        <div class ="collection_first_second">
                                            <img src="{{'../img/'.$collection->cover}}" class ="img_first_second">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>

                    @endforeach
                    
                @endfor
            </div>
        </div>

        <div class ="col-lg-11 offset-lg-1">
            <h6 class ="under_catalog under_carousel">ПОПУЛЯРНЫЕ ЖАНРЫ</h6>
               
            <div class ="row row-cols-2 row-cols-md-2 row-cols-lg-2 g-4 genre ">

            @foreach ($genres as $genre)
                
                @if ($loop->index == 0 || $loop->index % 12 == 0)
                    <div class="testik genre_padding col">
                @endif

                @if ($loop->index == 0 || $loop->index % 4 == 0)
                    <div class ="genre_list">
                @endif

                <div class ="genre_element">
                    <a class ="genre_color" href="{{route('booksByGenre', [$genre->id])}}">{{$genre->name}}</a>
                </div>                

                @if (($loop->index + 1) % 4 == 0 || $loop->remaining == 0)
                    </div>
                @endif
                
                @if (($loop->index + 1) % 12 == 0 || $loop->remaining == 0)
                    </div>
                @endif

            @endforeach

        </div>

    </section>

@endsection
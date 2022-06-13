@extends('layouts.main-layout')

@section('title', 'Все книги')

@section('content')
    <section class =" second container-fluid">
        <div class ="container">
            <div class ="row">
                <div class ="col-md-12">
                    <div class ="films_flex">
                        <h2 class ="films_header_second">Новинки</h2>
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
                    <p class ="films_text_second">Новинки книг в разных форматах: легально, безопасно, без рекламы.</p>
                </div>   
            </div> 
                
            @if (count($books) > 0) 
                <div class ="row row-cols-1 row-cols-md-2 row-cols-lg-6 g-4">
                        @foreach($books as $book)               
                            <a href="{{route('book', [$book->slug])}}" class ="col card_new">
                                <img src="{{'/img/'.$book->cover}}"  class ="img-fluid film" alt="">
                                <div class ="new_wrapper">
                                    <h6 class ="new_undertext">{{$book->name}}</h5>
                                </div>
                            </a>
                        @endforeach                       
                </div>            
            @else  
                <p class ="films_text_second">Упс. Ничего не найдено. Попробуйте позже!</p>
            @endif     
        </div>
    </section>
@endsection
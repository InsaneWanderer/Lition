@extends('layouts.main-layout')

@section('title', {{ $title }})

@section('content')

<div style="margin: 2%;">

@php
    $s = 1;
@endphp

    <section class ="container">
        <P>

        @foreach ($content as $line)

            {{ $line }}

        @endforeach

        </P>
        <div class = buttons_transit>
            <div class ="prev_btn">
            <a href="#" class="previous ">Предыдущая</a>
        </div>
        <div class ="button_padding">
            <a href="" class="border-btn active ">1</a>
        </div>
        <div class ="button_padding">
            <a href="book_secondт.html" class="border-btn ">2</a>
        </div>
        <div class ="button_padding">
            <a href="" class="border-btn ">3</a>
        </div>
        <div class ="button_padding">
            <a href="" class="border-btn ">4</a>
        </div>
        <div class ="button_padding">
            <a href="" class="border-btn ">5</a>
        </div>
        <div class ="button_padding">
            <a href="" class="border-btn ">6</a>
        </div>
            <div class ="button_padding">
                <a href="" class="border-btn ">7</a>
                    </div>
            <div class ="button_padding">
                <p class ="points">...</p>
                </div>
                <div class ="button_padding">
                    <a href="" class="border-btn ">33</a>
                    </div>
                    <div class ="next_btn">
                        <a href="book_secondт.html" class="previous " > Следующая</a>
                    </div>
                </div>

    </section>

</div>

@endsection

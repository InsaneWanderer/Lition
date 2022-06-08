@extends('layouts.main-layout')

@section('title', $title)

@section('content')

<div style="margin: 2%;">

    <section class ="container">
        <P>

        @foreach ($content as $line)

            <br>{{ iconv("windows-1251","utf-8", $line) }}

        @endforeach

        @if ($fragment)
            <p><br><br>Читайте дальше по подписке</p>
        @endif
        </P>

        @if (!$fragment)
            <div class = buttons_transit>
                @if ($cur_page != 1)
                        <div class ="prev_btn">
                        <a href="{{ route('read', [$slug, $cur_page - 1, 'русский']) }}" class="previous ">Предыдущая</a>
                    </div>
                @endif

                @for ($i = $start; $i < $end + 1 && $i <= $page_count; $i++)
                    <div class ="button_padding">
                        <a href="{{ route('read', [$slug, $i, 'русский']) }}" class="border-btn  {{ $i == $cur_page ? 'active' : '' }}">{{ $i }}</a>
                    </div>
                @endfor

                @if (!($page_count - 7 < $cur_page) )
                    <div class ="button_padding">
                        <p class ="points">...</p>
                    </div>

                @endif
                    @if ($cur_page != $page_count)
                        <div class ="button_padding">
                            <a href="{{ route('read', [$slug, $page_count, 'русский']) }}" class="border-btn ">{{ $page_count }}</a>
                        </div>
                    @endif

                @if ($cur_page != $page_count)
                    <div class ="next_btn">
                        <a href="{{ route('read', [$slug, $cur_page + 1, 'русский']) }}" class="previous " > Следующая</a>
                    </div>
                @endif

            </div>
        @endif

    </section>

</div>

@endsection

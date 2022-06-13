@extends('layouts.main-layout')

@section('title', $title)

@section('content')

<div style="margin: 2%;">

    <section class ="container">
        <P id="text-place">

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



<script>
    function getSelection() {
        var selection = (!!document.getSelection) ? document.getSelection() :
           (!!window.getSelection)   ? window.getSelection() :
           document.selection.createRange().text;
        return selection.toString();

    }

    function x() {
            loc=location.href;
            lang='ru';
            flag=true;
            text = '';
            if (window.getSelection) {
                text= window.getSelection();
            }
            else if (document.getSelection) {
                text = document.getSelection();
            }
            else if (document.selection) {
                text = document.selection.createRange().text;
            }
        }

    function y() {
        if (text == '') {
            location='http://translate.google.ru/translate?u='+encodeURIComponent(loc)+'&sl=auto&tl='+lang;
        }
    }

    function z() {
        if ((text!='')) {
            var res=window.open('http://translate.google.ru/translate_t?text='+text+'&sl=auto&tl='+ lang ,'gTranslate_popup','left='+((window.screenX||window.screenLeft)+10)+',top='+((window.screenY||window.screenTop)+10)+',height=500px,width=950px,resizable=1,scrollbars=1');
            window.setTimeout( function() {
                res.focus();
                },300);
        }
    }

    $(document).ready(function() {
        $('#text-place').mouseup(function() {
            var selection = getSelection();
            if (selection != "") {
                x(); y(); z();
            }
        });
    });
</script>



@endsection

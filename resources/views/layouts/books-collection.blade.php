@if (count($books) > 0)
    @foreach($books as $book)
        @if ($loop->index % 6 == 0)
            <div class ="row row-cols-1 row-cols-md-2 row-cols-lg-6 g-4 ">
        @endif

        <a href="{{ route('book', [$book->slug]) }}" class ="col card_new">
            <img style="display: block; margin-left:auto;margin-right:auto" src="{{ url($book->cover_path) }}"  class ="img-fluid film " alt="">
            <div class ="new_wrapper">
                <h6 class ="new_undertext" style="color:black">{{$book->name}}</h5>
            </div>
        </a>

        @if ($loop->iteration % 6 == 0 || $loop->last)
            </div>
        @endif

        @if ($loop->index == 23)
            <button class="btn" type="button">
                ПОКАЗАТЬ БОЛЬШЕ
            </button>
            <div class ="container content hidden">
        @endif

        @if ($loop->last)
            </div>
        @endif

    @endforeach
@else
    <p class ="films_text_second">Упс. Ничего не найдено. Попробуйте позже!</p>
@endif

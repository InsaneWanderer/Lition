@extends('layouts.main-layout')

@section('title', 'Книга')

@section('content')
<form action="{{ route('edit') }}" method="POST">
    <section class ="book container">
        <div class ="row ">
            @csrf
            <input type="hidden" name='id' value='{{$book == null ? 0 : $book->id}}'>
            <div class ="Book_text d-flex ">
                <h2 class ="book_name">Название книги:</h2>
                <div class ="book_left">
                <input autocomplete="off" type="text" name="title" class ="input_left" value="{{ $book == null ? '' : $book->name }}">
                </div>
            </div>
            <div class ="obl ">
                <h2>Выбрать обложку</h2>

                <form action="" class ="d-flex">
                    <div class ="admin_img d-flex" >
                        <img id="blah" src="{{ $book == null ? ' ' : '/storage/imgs/'.$book->book_cover }}" alt="" class =" img-fluid image" width="100%">
                    </div>
                    <div class ="d-flex photo_pad">
                        <div>
                            <label for="select-image " class ="name_photo">Фото:</label>
                        </div>
                        <div class ="admin_left" >
                            <input name="cover" type="file" onchange="readURL(this)" accept="image/*" id="select-image" >
                        </div>
                    </div>
                </form>
            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author d-flex">
                    <div class ="Author_name">
                        <h2 class ="author_h">Автор:</h2>
                    </div>
                </div>
                <div class ="author_left">
                    <input autocomplete="off" name="author" type="text" value="{{ $book == null ? '' : $author->name.' '.$author->surname }}">
                </div>
            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author d-flex">
                    <div class ="Author_name">
                        <h2 class ="author_h">Год написания:</h2>
                    </div>
                </div>
                <div class ="author_left">
                    <input autocomplete="off" type="text" name="year" value="{{ $book == null ? '' : $book->year }}">
                </div>
            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author d-flex">
                    @php
                        $g = "";
                        if($book != null)
                        {
                            foreach($book->genres as $genre)
                            {
                                $g .= $genre->name.', ';

                            }
                            $g = Str::substr($g, 0, -2);
                        }
                    @endphp
                    <div class ="Author_name">
                        <h2 class ="author_h">Жанры:</h2>
                    </div>
                </div>
                <div class ="author_left">
                    <input autocomplete="off" name="genres" type="text" value="{{ $g }}">
                </div>

            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author d-flex">
                    <div class ="Author_name">
                        <h2 class ="author_h">Описание книги:</h2>
                    </div>
                    </div>
                    <div class ="author_left">
                        <textarea name="description" type="text" class ="description_text_admin" >{{ $book == null ? '' : $book->description }}</textarea>
                </div>

            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author">
                    <div class ="Author_name">
                        <h2>Минимальная подписка</h2>
                    </div>
                    <div class ="radio_btn d-flex">
                        <div class ="radio_tag d-flex">
                            <div class ="input_name">
                                <input name="sub" type="radio" {{$book==null ? 'checked' : ($book->min_sub_id == 1 ? 'checked' : null)}} value="1"/>
                            </div>
                            <p class ="text_radio">Лайт</p>
                        </div>
                        <div class ="radio_tag d-flex">
                            <div class ="input_name">
                                <input name="sub" type="radio" {{$book==null ? null : ($book->min_sub_id == 2 ? 'checked' : null)}} value="2"/>
                            </div>
                            <p class ="text_radio">Оптиум</p>
                        </div>
                        <div class ="radio_tag d-flex">
                            <div class ="input_name">
                                <input name="sub" type="radio" {{$book==null ? null : ($book->min_sub_id == 3 ? 'checked' : null)}} value="3"/>
                            </div>
                            <p class ="text_radio">Премиум</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class ="Book_text text_right d-flex ">
                <h2 class ="book_name">Файл текста книги:</h2>
                <div class ="book_left">
                    <input name="hiddenFile" type='text' hidden value="{{ $file }}">
                    <input name="text-file" type="file" accept=".txt" id="select-text" >
                </div>
            </div>
            <div class ="button_Send">
                <button type="submit" class ="book_about_third">Отправить</button>
            </div>
    </section>

</form>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).width(150).height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

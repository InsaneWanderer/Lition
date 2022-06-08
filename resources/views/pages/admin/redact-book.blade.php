@extends('layouts.main-layout')

@section('title', 'Книга')

@section('content')
<form id="upload-form" action="{{ $book == null ? route('add') : route('update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <section class ="book container">
        <div class ="row ">
            <input type="hidden" name="id" id="id" value='{{$book?->id}}'>
            <div class ="Book_text d-flex ">
                <h2 class ="book_name">Название книги:</h2>
                <div class ="book_left">
                <input autocomplete="off" type="text" id="name" name="name" class ="input_left" value="{{ $book?->name }}">
                </div>
            </div>
            <div class ="obl ">
                <h2>Выбрать обложку</h2>

                <form action="" class ="d-flex">
                    <div class ="admin_img d-flex" >
                        <img id="blah" src="{{ $book == null ? ' ' : $book->cover_path }}" alt="" class =" img-fluid image" width="100%">
                    </div>
                    <div class ="d-flex photo_pad">
                        <div>
                            <label for="select-image " class ="name_photo">Фото:</label>
                        </div>
                        <div class ="admin_left" >
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <input id="cover" name="cover" type="file" onchange="readURL(this)" value="{{ $book == null ? ' ' : $book->cover }}"accept="image/*" id="select-image" >
                        </div>
                    </div>
                </form>
            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author d-flex">
                    <div class ="Author_name">
                        <h2 class ="author_h">Авторы:</h2>
                    </div>
                </div>
                <div class ="author_left">
                    <input autocomplete="off" id="authors" name="authors" type="text" value="{{ $authors }}">
                </div>
            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author d-flex">
                    <div class ="Author_name">
                        <h2 class ="author_h">Год написания:</h2>
                    </div>
                </div>
                <div class ="author_left">
                    <input autocomplete="off" type="text" id="year" name="year" value="{{ $book?->year }}">
                </div>
            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author d-flex">
                    <div class ="Author_name">
                        <h2 class ="author_h">Жанры:</h2>
                    </div>
                </div>
                <div class ="author_left">
                    <input autocomplete="off" name="genres" id="genres" type="text" value="{{ $genres }}">
                </div>

            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author d-flex">
                    <div class ="Author_name">
                        <h2 class ="author_h">Описание книги:</h2>
                    </div>
                    </div>
                    <div class ="author_left">
                        <textarea id="description" name="description" type="text" class ="description_text_admin" >{{ $book?->description }}</textarea>
                </div>

            </div>
            <div class ="text_right d-flex  ">
                <div class ="text_author">
                    <div class ="Author_name">
                        <h2>Минимальная подписка</h2>
                    </div>
                    <div class ="radio_btn d-flex">
                        @foreach ($subs as $sub)
                            <div class ="radio_tag d-flex">
                                <div class ="input_name">
                                    <input id="subscription_id" name="subscription_id" type="radio" {{$book==null ? '' : ($book->subscription_id == $sub->id ? 'checked' : null)}} value="{{ $sub->id }}"/>
                                </div>
                                <p class ="text_radio">{{ $sub->name }}</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class ="Book_text text_right d-flex ">
                <h2 class ="book_name">Файл текста книги:</h2>
                <div class ="book_left">
                    <input onchange="getTfile(this)" name="text_file" id="text_file" type="file" accept=".txt" id="select-text" >
                </div>
            </div>
            <div class ="button_Send">
                <button type="submit" class ="book_about_third">Отправить</button>
            </div>
    </section>

</form>

<script>
    var cfile = null;
    var tfile = null;

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).width(150).height(200);
            };

            reader.readAsDataURL(input.files[0]);
            cfile = input.files[0];
        }
    }

    function getTfile(input) {
        if (input.files && input.files[0]) {
            tfile = input.files[0];
        }
    }

    function edit() {
        var route = '{{ $book == null ? route('add') : route('update') }}';
        let formdata = new FormData($('#upload-form')[0]);
        alert(formdata.get('cover'));

        $.ajax({
            url: route,
            type: "POST",
            data: formdata,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                this.reset();
                alert('succes');
            },
            error: function (request, status, error) {
                alert(request. responseText);
            }

        });
    }
</script>
@endsection

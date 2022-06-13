@extends('layouts.main-layout')

@section('title', 'Книга')

@section('content')
<form id="upload-form" action="{{ route('editFiles', ['slug' => $book->slug]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <section class ="book container">
        <div>

        </div>
        <div id="just-test">
            <div id="file-block">
                <div>
                    <div class ="Book_text text_right d-flex ">
                        <h2 class ="book_name">Файл:</h2>
                        <div class ="book_left">
                            <input onchange="getTfile(this)" name="files[]" id="text_file" type="file" id="select-text" >
                        </div>
                    </div>
                    <div class ="text_right d-flex  ">
                        <div class ="text_author d-flex">
                            <div class ="Author_name">
                                <h2 class ="author_h">Тип файла:</h2>
                            </div>
                        </div>
                        <div class ="author_left">
                            <input autocomplete="off" name="types[]" id="genres" type="text" value="">
                        </div>

                    </div>
                </div>
                <div class ="button_Send text-right d-flex">
                    <button type="button" onclick="removeFile(this)" class ="book_about_third">Удалить файл</button>
                </div>
            </div>
        </div>

        <div class ="button_Send">
            <button type="button" onclick="addFile()" class ="book_about_third">Добавить файл</button>
        </div>
        <div class ="button_Send">
            <button type="submit" class ="book_about_third">Отправить</button>
        </div>
    </section>

</form>

<script>
    var cfile = null;
    var tfile = null;

    function addFile() {
        $('#file-block').clone().appendTo("#just-test:last");
    }

    function removeFile(btn) {
        $(btn).closest("#file-block").remove();
    }
</script>
@endsection

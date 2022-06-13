@extends('layouts.main-layout')

@section('title', 'Книга')

@section('content')
<form id="upload-form" action="{{ $collection == null ? route('createCollection') : route('updateCollection') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <section class ="book container">
        <div class ="row ">
            <input type="hidden" name="id" id="id" value='{{$collection?->id}}'>
            <div class ="Book_text d-flex ">
                <h2 class ="book_name">Название подборки:</h2>
                <div class ="book_left">
                <input autocomplete="off" type="text" id="name" name="name" class ="input_left" value="{{ $collection?->name }}">
                </div>
            </div>
            <div class ="obl ">
                <h2>Выбрать обложку</h2>

                <form action="" class ="d-flex">
                    <div class ="admin_img d-flex" >
                        <img id="blah" src="{{ $collection == null ? ' ' : $collection->cover_path }}" alt="" class =" img-fluid image" width="100%">
                    </div>
                    <div class ="d-flex photo_pad">
                        <div>
                            <label for="select-image " class ="name_photo">Фото:</label>
                        </div>
                        <div class ="admin_left" >
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <input id="cover" name="cover" type="file" onchange="readURL(this)" value="{{ $collection == null ? ' ' : $collection->cover }}"accept="image/*" id="select-image" >
                        </div>
                    </div>
                </form>
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

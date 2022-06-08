<section class ="subscribe container">
    <div class ="row">
        <div class ="col-md-12">
            <h2 class ="subscribe_header">Выберите подписку</h2>
            <p class ="subscribe_text">Тысячи книг по цене одной на целый месяц: мировые бестселлеры, российская классика, лучшие триллеры. Откройте нашу библиотеку уже сегодня.</p>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4 subscribe__items">
        @foreach ($subscriptions as $sub)
            <div class="col ">
                <a class="card subscribe_item d-flex align-items-center h-100 " href="#">
                    <img style="display: block; margin-left:auto;margin-right:auto" src="/img/14043255.jpg" class="card-img-top" alt="">
                    <div class="card-body p-0">
                        <h2 class="subscribe_header_text">{{$sub->name}}</h2>
                        <p class="subscribe_header_under">{{$sub->description}}</p>
                        <p class="subscribe_price">{{$sub->price}} ₽ в месяц</p>
                        <form action="{{ route('setSub') }}" class ="subscribe_btn">
                            <input name='sub_id' hidden type="text" value="{{ $sub->id }}">
                            <button type="submit" class="subscribe_about">ОФОРМИТЬ ПОДПИСКУ</button>
                        </form>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>

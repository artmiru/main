<style>
    #mk-list {
        font-family: sans-serif;
        padding: 50px 0;
    }

    #mk-list .mk-places span {
        border-radius: 50%;
        width: 35px;
        height: 35px;
        text-align: center !important;
        vertical-align: middle !important;
        line-height: 33px;
        font-size: 24px;
        display: inline-block;
    }

    #mk-list .mk-full-price, #mk-list .mk-discount-price {
        line-height: 1;
    }

    #mk-list .mk-discount-price {
        font-size: 1.1rem;
    }
</style>

<section id="mk-list" class="bg-light">
    <div class="container-fluid">
        <div class="col"><h3 class="text-center mb-4">Что мы рисуем в ближайшее время:</h3></div>
        <div class="row g-3">
            @foreach($mks as $mk)
                @if($mk->status == 1)
                    <div class="col-md-3 text-center">
                        <div class="bg-white shadow-sm pt-2 pb-4 h-100">
                            <h4 class="m-0">"{{$mk->title}}"</h4>
                            <div class="mk-date mb-1">{{DateFormate($mk->date_time,'j M. (l) в H:i')}}</div>
                            <a class="d-block mb-2" href="/img/mk/paintings/{{$mk->src}}.jpg">
                                <img src="/img/mk/paintings/{{$mk->src}}_t.jpg" alt="" class="img-fluid">
                            </a>
                            <div class="mk-teacher mb-2"><a href="/teacher/{{$mk->folder}}">{{$mk->name}}</a></div>
                            <div class="mk-full-price">Стоимость: 2900&#x20bd;</div>
                            <div class="mk-discount-price mb-2">При оплате заранее: <span class="fw-bold">{{$mk->price}}&#x20bd;</span>
                            </div>
                            <div class="mk-places mb-2">Осталось
                                <span class="border border-1">5</span> мест
                            </div>
                            <button class="btn btn-danger btn-lg mb-2">ЗАПИСАТЬСЯ</button>
                            <a href="#" class="mk-rules d-block"><small>условия записи на мастер-класс</small></a>
                        </div>
                    </div>
                @endif
                @if ($loop->iteration == 24)
                    @break
                @endif
            @endforeach
        </div>
    </div>
</section>

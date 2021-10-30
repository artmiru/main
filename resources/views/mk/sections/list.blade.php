@extends('layouts.mk-layout')
@section('title', 'Мастер-классы живописи!')

@section('content')
    <section id="mk-list" class="py-5 bg-light">
        <div class="container-fluid">
            <div class="row g-3">
                @foreach($mks as $mk)
                    @if($mk->status == 1)
                        <div class="col-md-3 text-center">
                            <div class="bg-white shadow-sm pt-2 pb-4 h-100">
                                <h4>"{{$mk->title}}"</h4>
                                <div class="mk-date">{{$mk->date_time}}</div>
                                <a class="d-block" href="/img/mk/paintings/{{$mk->src}}.jpg">
                                    <img src="/img/mk/paintings/{{$mk->src}}_t.jpg" alt="" class="img-fluid">
                                </a>
                                <div class="mk-teacher"><a href="/teacher/{{$mk->folder}}">{{$mk->name}}</a></div>
                                <div class="mk-full-price">Стоимость: 2900&#x20bd;</div>
                                <div class="mk-discount-price fs-5">При оплате заранее: {{$mk->price}}&#x20bd;</div>
                                <div class="mk-places">Осталось
                                    <span class="fs-4 badge text-dark rounded-circle border border-1">5</span> мест
                                </div>
                                <button class="btn btn-danger btn-lg">ЗАПИСАТЬСЯ</button>
                                <a href="#" class="mk-rules d-block">Условия записи на мастер-класс</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection

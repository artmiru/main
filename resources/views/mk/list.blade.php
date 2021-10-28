@extends('layouts.mk-layout')
@section('title', 'Hello, world!')

@section('content')
<div class="container">
    <div class="row">
        @foreach($mks as $mk)
            <div class="col-4 text-center py-3">
                <h4>{{$mk->title}}</h4>
                <img src="/img/mk/paintings/{{$mk->src}}_t.jpg" alt="" class="img-fluid">
            </div>
        @endforeach
    </div>
</div>
@endsection

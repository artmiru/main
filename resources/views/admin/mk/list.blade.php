@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                @foreach($mks as $mk)

                <div class="col-12 text-black">{{DateFormate($mk->date_time,'j M. (l) в H:i')}} "{{$mk->mkpic->title}}"</div>
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>фио</th>
                        <th>телефон</th>
                        <th>статус</th>
                        <th>комментарии</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mk->user as $user)
                    <tr>
                        <th scope="row">{{$user->family}} {{$user->name}}</th>
                        <td>
                            {{$user->phone}}
                        </td>
                        <td>{{$user->state}}</td>
                        <td>{{$user->comments}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

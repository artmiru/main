@extends('layouts.app')
@section('content')
    <section id="profile">
        <div class="container-fluid">
            <div class="row py-4 shadow-sm">
                <div class="col-sm-6">
                    <div class="p-4 bg-light">
                        <div>ФИО</div>
                        <h3>
                            {{$user->id}} {{$user->family}} {{$user->name}} {{$user->patronymic}}
                            <button class="btn btn-warning">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </h3>
                        <p class="fs-4 mb-0">Тел.: +{{$user->phone}}</p>
                        <p>Email: {{$user->email}}</p>
                        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger">Абонемент</button>
                            <button type="button" class="btn btn-primary">Записать на урок</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="p-4 bg-light">
                        <div>Комментарии</div>
                        <div class="border border-1 bg-white p-1">{{$user->comments}}</div>
                    </div>
                </div>
            </div>
            <div class="row pt-2 bg-light bg-opacity-50">
                <div class="col-12">
                    <h4>Абонементы</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>№</th>
                            <th>дата покупки</th>
                            <th>ур. всего</th>
                            <th>осталось</th>
                            <th>скидка</th>
                            <th>сумма</th>
                            <th>статус</th>
                            <th>метод оплаты</th>
                            <th>комментарии</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row pt-2 bg-light bg-opacity-50">
                <div class="col-12">
                    <h4>Посещения</h4>
                    <table class="table mb-3">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>аб.</th>
                            <th>дата</th>
                            <th>название</th>
                            <th>статус</th>
                            <th>комментарии</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td></td>
                                <td class="text-nowrap">{{date('d.m.y H:i',strtotime($visit->date_time))}}</td>
                                <td class="text-nowrap">"{{$visit->title}}"</td>
                                <td class="text-nowrap">{{$visit->status}}</td>
                                <td>{{$visit->comments}}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

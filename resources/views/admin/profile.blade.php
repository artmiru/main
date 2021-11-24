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
                <div class="col-12 pb-3">
                    <h4>Абонементы</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>№</th>
                            <th class="text-nowrap">дата покупки</th>
                            <th class="text-nowrap">ур. всего</th>
                            <th>осталось</th>
                            <th>скидка</th>
                            <th>сумма</th>
                            <th class="text-nowrap">статус</th>
                            <th>метод</th>
                            <th>комментарии</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($abonements as $ab)

                            <tr data-bs-toggle="collapse" data-bs-target="#id-{{$ab->id}}" aria-expanded="false" aria-controls="id-{{$ab->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$ab->ab_id}} (old:{{$ab->old_id}})</td>
                                <td class="text-nowrap">{{date('d.m.y H:i',strtotime($ab->created_at))}}</td>
                                <td class="text-center">{{$ab->hour/2}}</td>
                                <td class="text-center">{{($ab->hour/2)-($ab->sum_used_hours/2)}}</td>
                                <td>{{$ab->discount}}%</td>
                                <td>{{$ab->amount}} Р.</td>
                                <td>{{$ab->payment_status_title}}</td>
                                <td>{{$ab->payment_method_title}}</td>
                                <td>{{$ab->comments}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <button class="btn btn-primary">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-warning">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <button class="btn btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse" id="id-{{$ab->id}}">
                                <td></td>
                                <td colspan="10">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>дата посещения</th>
                                            <th>статус</th>
                                            <th>комментарии</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ab->visits as $vis)
                                        <tr>
                                            <td scope="row">
                                                @if($vis->visit_status_id == 1 or $vis->visit_status_id == 2)
                                                {{$vis->hour_used_sum/2}}/{{$vis->hours_amount/2}}
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>{{$vis->date_time}}</td>
                                            <td>{{$vis->status}}</td>
                                            <td>{{$vis->comments}}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($mk_visits->isNotEmpty())
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
                        @foreach($mk_visits as $mk_visit)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td></td>
                                <td class="text-nowrap">{{date('d.m.y H:i',strtotime($mk_visit->date_time))}}</td>
                                <td class="text-nowrap">"{{$mk_visit->title}}"</td>
                                <td class="text-nowrap">{{$mk_visit->status}}</td>
                                <td>{{$mk_visit->comments}}</td>
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
                @endif
        </div>
    </section>
@endsection

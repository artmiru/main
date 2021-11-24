@extends('layouts.app')
@section('content')
    <section id="courses-list">
        <div class="container-fluid">
            @foreach($courses as $course)
            <div class="row">
                <div class="col-12">{{$course->date_time}}</div>


                    <table class="table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th></th>
                            <th>имя</th>
                            <th>статус</th>
                            <th>аб.</th>
                            <th>ур.</th>
                            <th>комментарии</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->visits as $visit)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td></td>
                            <td><a href="profile/{{$visit->user_id}}">{{$visit->family.' '.$visit->name}}</a></td>
                            <td>
                                <select class="form-select" name="visit_status_id" id="visit_status_id">
                                    @if(isset($visit->sid))
                                        <option value="{{$visit->sid}}">{{$visit->stitle}}</option>
                                        @foreach($visit_statuses as $status)
                                            <option value="{{$status->id}}">{{$status->title}}</option>
                                        @endforeach
                                    @else
                                        @foreach($visit_statuses as $status)
                                            <option value="{{$status->id}}">{{$status->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>{{$visit->ab_old_id}}</td>
                            <td>{{$visit->hour_used_sum/2}}/{{$visit->all_hours/2}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

            </div>
            @endforeach
        </div>

    </section>

    <section id="mk-list-admin" class="bg-light pt-4">
        <div class="container-fluid">
            @foreach($mks as $mk)
                <div class="mk-title row">
                    <div class="col-md-6">{{DateFormate($mk->date_time,'j M. (l) в H:i')}}
                        "{{$mk->title}}"
                    </div>
                    <div class="col-md-6 text-md-end">
                        {{$mk->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive p-0">
                        <table class="table align-middle bg-white shadow-sm">
                            <thead>
                            <tr>
                                <th style="width: 20px;">#</th>
                                <th style="width: 250px;">фио</th>
                                <th style="width: 125px;">телефон</th>
                                <th style="width: 150px;">статус</th>
                                <th>комментарии</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mk->visits as $visit)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="profile/{{$visit->user_id}}">{{$visit->family}} {{$visit->name}} {{$visit->patronymic}}</a></td>
                                    <td>
                                        +{{$visit->phone}}
                                    </td>
                                    <td>
                                        <select class="form-select" name="visit_status_id" id="visit_status_id">

                                            @if(isset($visit->stid))
                                                <option value="{{$visit->stid}}">{{$visit->stitle}}</option>
                                                @foreach($visit_statuses as $status)
                                                    <option value="{{$status->id}}">{{$status->title}}</option>
                                                @endforeach
                                            @else
                                                @foreach($visit_statuses as $status)
                                                    <option value="{{$status->id}}">{{$status->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td>{{$visit->comments}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

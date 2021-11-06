@extends('layouts.app')
@section('content')
    {{dump($mks)}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
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
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

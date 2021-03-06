@extends('layouts.prepodsApp')

@section('content')

@if(request()->input('error') == 'false')
    <div class="alert alert-success alert-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>

        <i class="fa fa-check fa-lg"></i> {{request()->input('message')}}
    </div>
@elseif (request()->input('error') == 'true') 
    <div class="alert alert-danger alert-message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>

        <i class="fa fa-check fa-lg"></i> {{request()->input('message')}}
    </div>
@endif
<h1>ПРЕПОДАВАТЕЛИ</h1>
<div class="col-md-12 panel-group" id="accordion">
    <!-- 1 панель -->
    @foreach($sites as $v)
    <div class="panel panel-default">
        <!-- Заголовок панели -->
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#{{$v['date']}}">Дата - {{$v['date']}}</a>
            </h4>
        </div>
        <div id="{{$v['date']}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead style="font-weight: bold;">
                            <tr>
                                <td>Название сайта</td>
                                <td>Кол-во посещений</td>
                                <td>Категория</td>
                                <td>Доступ</td>
                                <td>Видимость</td>
                            </tr>
                        <thead>
                        <tbody>
                            @foreach($v[0] as $v2)                         
                            <tr>
                                <td>{{$v2['site']}}</td>
                                <td>{{$v2['count']}}</td>
                                <td>{{$v2['category']}}</td>
                                @if($v2['access'] == 1)
                                <td>Да</td>
                                @else
                                <td>Нет</td>
                                @endif
                                @if($v2['visible'] == 1)
                                <td>Да</td>
                                @else
                                <td>Нет</td>
                                @endif
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        @endforeach
        {{$paginate->links()}}
    

    @endsection

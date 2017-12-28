@extends('layouts.app')

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

<div class="col-md-12 panel-group" id="accordion">
    <!-- 1 панель -->
        @foreach($days as $day)
     <div class="panel panel-default" load='false'>
             <!-- Заголовок панели -->
             <div class="panel-heading" >
                 <h4 class="panel-title">
                     <a data-toggle="collapse" data-parent="#accordion" href="#{{$day->date}}">Дата - {{$day->date}}</a>
                 </h4>
             </div>
     </div>

     @endforeach
     {{$days->links()}}
    @endsection
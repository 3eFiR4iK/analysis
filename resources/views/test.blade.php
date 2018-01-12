@extends('layouts.app')

@section('content')
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
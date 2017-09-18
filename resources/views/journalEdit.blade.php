@extends('layouts.journalApp')

@section('content')

<div class="panel panel-info">
    <div class="panel-heading">Выберете раздел</div>
    <div class="panel-body">

        <div class="list-group"> 
            @foreach($edits as $e)
            
            <a link="/journal/edit/{{$e['id']}}"  class="list-group-item">{{$e['name']}}</a>
            @endforeach
        </div>
    </div>
</div>
<div id="content"></div>
@endsection
@extends('layouts.journalApp')

@section('content')

<div class="panel panel-info">
    <div class="panel-heading">Выберете категорию</div>
    <div class="panel-body">

        <div class="list-group"> 
            @foreach($categories as $c)
            <a link="/journal/{{$c->id}}"  class="list-group-item">{{$c->name}}</a>
            @endforeach
        </div>
    </div>
</div>
<div id="content"></div>
@endsection
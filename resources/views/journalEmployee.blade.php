@extends('layouts.journalApp')

@section('content')
<div class="panel panel-info">
    <div class="panel-heading">Выберете сотрудника</div>
    <div class="panel-body">

        <div class="list-group">
            @foreach($users as $u)
            <a link="/journal/employee/{{$u->id}}" class="list-group-item">{{$u->name}}</a>
            @endforeach
        </div>
    </div>
</div>


@endsection

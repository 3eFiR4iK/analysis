@extends('layouts.journalApp')

@section('content')
<h2 style="text-align:center;">Экспорт в word</h2>
<form method="POST" action="/journal/export">

    От <input type="date" class="form-control" style="width: 20%;" name="firstDate"> 
    До <input type="date" class="form-control" style="width: 20%;" name="secondDate">
    <br>

    <label for="idUser">Пользователь</label>
    <select class="form-control select" name="idUser[]" multiple="mutiple">
        <option disabled >выберете сотрудника</option>
        @foreach($users as $u)
        <option value="{{$u->id}}">{{$u->name}}</option>
        @endforeach
    </select><br>
    <label for="idCategory">Категория</label>
    <select class="form-control select" name="idCategory[]" multiple="mutiple">
        <option disabled >выберете категорию</option>
        @foreach($categories as $cat)
        <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
    </select><br>
    <label for="idEvent">Действие</label>
    <select class="form-control select" name="idEvent[]" multiple="mutiple">
        <option disabled >выберете действие</option>
        @foreach($events as $event)
        <option value="{{$event->id}}">{{$event->name}}</option>
        @endforeach
    </select><br>
    <label for="idRoom">Кабинет</label>
    <select class="form-control select" name="idRoom[]" multiple="mutiple">
        <option disabled >выберете кабинет</option>
        @foreach($rooms as $room)
        <option value="{{$room->id}}">{{$room->name}}</option>
        @endforeach
    </select><br>
    <label for="weekly">Недельный</label>
    <input type="checkbox" name="weekly">
    {{csrf_field()}}
    <button class="btn btn-success" type="submit" style="width: 100%;margin:20px 0px; ">Сохранить</button>
</form>
@endsection


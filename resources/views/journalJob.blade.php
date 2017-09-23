@extends('layouts.journalApp')

@section('content')



        <div class="table-responsive">

        <form method="post" id="upload" action="/journal/addjob">

        <div class="panel-info">
            <div class="panel-heading"><h3 style="padding-left:5%; ">Добавить проделаную работу</h3><br></div>
        </div><br><br>
        <select name="idEvent" class="form-control select" required>
                            <option disabled selected>выберете действие</option>
                            @foreach($events as $e)
                              <option value="{{$e->id}}">{{$e->name}}</option>
                            @endforeach
                        </select><br>
                        <select name="idRoom" class="form-control select">
                            <option disabled selected>выберете кабинет</option>
                            @foreach($rooms as $r)
                              <option value="{{$r->id}}">{{$r->name}}</option>
                            @endforeach
                        </select><br>
                        <select name="idUser" class="form-control select" required>
                            <option disabled selected>выберете сотрудника</option>
                            @foreach($users as $u)
                              <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach
                        </select><br>
                        <label for="comment">коментарий</label>
                        <input type="text" class="form-control" name="comment"><br>
                        <label for="count">кол-во</label>
                        <input type="number" class="form-control" name="count"><br>
                        <label for="date" >дата</label>
                        <input type="date" class="form-control" name="date" required>

                        {{ csrf_field() }}
                        <br>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
             
        </form>
    </div>


@endsection
@extends('layouts.journalApp')

@section('content')

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

        <div class="table-responsive">

        <form method="post" id="upload" action="/journal/addjob">

        <div class="panel-info">
            <div class="panel-heading"><h3 style="padding-left:5%; ">Добавить проделаную работу</h3><br></div>
        </div><br><br>
        <select name="idCategory" class="form-control select">
            <option disabled selected>выберете категорию</option>
            @foreach($categories as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </select><br>
        <select name="idEvent" class="form-control select"  required>
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
                        <select name="idUser[]" placeholder="asdas" multiple="mutiple" class="form-control select" required>
                            <option disabled >выберете сотрудника</option>
                            @foreach($users as $u)
                              <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach
                        </select><br>
                        <label for="comment">коментарий</label>
                        <input type="text" class="form-control" name="comment"><br>
                        <label for="count">кол-во</label>
                        <input type="number" class="form-control" name="count"><br>
                        <label for="time">затраченое время</label>
                        <input  type="time" class="form-control" name="time"><br>
                        <label for="date" >дата</label>
                        <input type="date" class="form-control" name="date" required>

                        {{ csrf_field() }}
                        <br>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
             
        </form>
    </div>

<script>
    
$('document').ready(function(){
    $('select[name=idEvent]').prop('disabled',true);

    $('select[name=idCategory]').change(function(){
        var id = $('select[name=idCategory]').serialize().split('=')[1];
        $.ajax({
            type: 'GET',
            url: '/journal/getevents/'+ id,
            success: function(data){
                $('select[name=idEvent]').empty();
                $.each(data,function(e){
                    //console.log(this);
                    $('select[name=idEvent]').append('<option value="'+this['id']+'">'+this['name']+'</option>');
                });
                $('select[name=idEvent]').prop('disabled',false);
                    $('select[name=idEvent]').select2('open');
            },
        });
    });
});


</script>
@endsection
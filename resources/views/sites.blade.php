@extends('layouts.app')

@section('content')

<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-hover ">
            <thead style="font-weight: bold;">
                <tr>
                    <td>Название сайта</td>
                    <td>категория</td>
                </tr>
            <thead>
            <tbody>
                @foreach($sites as $site)       
                <tr>
                    <td id="site">{{$site->nameSite}}</td>
                    <td>&nbsp;</td>
                </tr>
                </form>
                @endforeach
            </tbody>    
        </table>
    </div>
</div>
<script>
   $(document).ready(function(){
       $('tr').click(function () {
    var c = $('<div class="box-modal" />');
    var tag = $(this).find('td').html();
    c.html('<form method="POST" action="/sites/add">\n\
            <table class="table table-hover">\n\
                <thead>\n\
                  <tr><td>&nbsp;</td><td>категория</td><td>запрещенный</td><td>отображать?</td></tr>\n\
                </thead>  \n\
                <tbody><tr><td><a href="http://'+tag+'/" target="_blank">'+tag+'</a></td>\n\
                <td><select name="categories">\n\
                             <option disabled selected>Выберите категорию</option>\n\
                             @foreach($categories as $c)\n\
                            <option value="{{$c->id}}">{{$c->name_category}}</option>\n\
                    @endforeach</td>\n\
                <td><input type="checkbox" name="access"></td><td><input type="checkbox" name="visible"></td>\n\
            <tr></tbody>{{ csrf_field() }}\n\
           </table><input type="hidden" name="site" value="'+tag+'">\n\
                     <button type="submit" class="btn btn-primary">Сохранить \n\
                    </button> </form>    '
                        );
            c.prepend('<div class="box-modal_close arcticmodal-close">X</div>');
            $.arcticmodal({
                content: c
            });
        });
    });
</script>
@endsection
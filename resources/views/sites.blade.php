@extends('layouts.app')

@section('content')

<div class="panel-body">
    <div id="exTab2" class="container">	
        <ul class="nav nav-tabs">
            <li class="active">
                <a  href="#1" data-toggle="tab">Без категории</a>
            </li>
            <li><a href="#2" data-toggle="tab">Отсортированные</a>
            </li>
        </ul>

        <div class="tab-content ">
            <div class="tab-pane active" id="1">
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
                                <td id="site" access="{{$site->access}}" visible="{{$site->visible}}">{{$site->nameSite}}</td>
                                <td>&nbsp;</td>
                            </tr>
                            </form>
                            @endforeach
                        </tbody>    
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="2">
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead style="font-weight: bold;">
                            <tr>
                                <td>Название сайта</td>
                                <td>категория</td>
                            </tr>
                        <thead>
                        <tbody>
                            @foreach($old as $site)       
                            <tr>
                                <td id="site" access="{{$site->access}}" visible="{{$site->visible}}">{{$site->nameSite}}</td>
                                @if($site->categories)
                                <td id ="category">{{$site->categories->name_category}}</td>
                                @else
                                <td id ="category">&nbsp;</td>
                                @endif
                            </tr>
                            </form>
                            @endforeach
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>



<script>
    $(document).ready(function () {

        
        $('tr').click(function () {
           
            var c = $('<div class="box-modal" />');
            var site = $(this).find('#site').html();
            var category = $(this).find('#category').html();
            if (category == undefined) {
                category = 'Выберете категорию';
            }
            var access = $(this).find('#site').attr('access');
            var visible = $(this).find('#site').attr('visible');
            if (access == 0){access="checked";}else{access="";}
            if (visible == 0){visible="checked";}else{visible="";}

            c.html('<form method="POST" action="/sites/add">\n\
            <table class="table table-hover">\n\
                <thead>\n\
                  <tr><td>&nbsp;</td><td>категория</td><td>запрещенный</td><td>скрыть</td></tr>\n\
                </thead>  \n\
                <tbody><tr><td><a href="http://' + site + '/" target="_blank">' + site + '</a></td>\n\
                <td><select name="categories" class="select">\n\
                             <option disabled selected>' + category + '</option>\n\
                             @foreach($categories as $c)\n\
                            <option value="{{$c->id}}">{{$c->name_category}}</option>\n\
                    @endforeach</td>\n\
                <td><input type="checkbox" name="access" '+access+'></td>\n\
                <td><input type="checkbox" name="visible" '+visible+'></td>\n\
            <tr></tbody>{{ csrf_field() }}\n\
           </table><input type="hidden" name="site" value="' + site + '">\n\
                     <button type="submit" class="btn btn-primary">Сохранить \n\
                    </button> </form>    '
                    );
            c.prepend('<div class="box-modal_close arcticmodal-close">X</div>');
            $.arcticmodal({
                content: c
            });
         $( ".select" ).select2();});
    });
</script>
@endsection
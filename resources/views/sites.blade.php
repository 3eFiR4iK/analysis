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
                                <td id="site" access="{{$site->access}}" access_prepods="{{$site->access_prepods}}" visible="{{$site->visible}}">{{$site->nameSite}}</td>
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
                    @if($search !== ' ' )
                    {{$sites->appends(['search'=>$search])->links()}}
		   @else 
		    {{$sites->links()}}
		  @endif
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
                                <td id="site" access="{{$site->access}}" access_prepods="{{$site->access_prepods}}" visible="{{$site->visible}}">{{$site->nameSite}}</td>
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
		   @if($search !== '')
			{{$old->appends(['search'=>$search])->links()}}
		   @else 
			{{$old->links()}}
		   @endif
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function checkin(){
    $('#modalselect').on('select2:select', function (e) {
                kadet = e.params.data.element.attributes.access_kadet.value;
                prepod = e.params.data.element.attributes.access_prepods.value;
                console.log(kadet);
                if (kadet == 0) {
                    $('input[name=access').attr('checked', '');
                } else
                    $('input[name=access]').removeAttr('checked');
                if (prepod == 0) {
                    $('input[name=access_prepods]').attr('checked', '');
                } else
                    $('input[name=access_prepods]').removeAttr('checked');
            });
    }
</script>

<script>
    $(document).ready(function () {


        $('tr').click(function () {

            var c = $('<div class="box-modal" />');
            var site = $(this).find('#site').html();
            var category = $(this).find('#category').html();
            console.log(category);
            if (category == undefined) {
                category = 'Выберете категорию';
            }
            var access = $(this).find('#site').attr('access');
            var access_prepods = $(this).find('#site').attr('access_prepods');
            var visible = $(this).find('#site').attr('visible');
            if (access == 0) {
                access = "checked";
            } else {
                access = "";
            }
            if (access_prepods == 0) {
                access_prepods = "checked";
            } else {
                access_prepods = "";
            }
            if (visible == 0) {
                visible = "checked";
            } else {
                visible = "";
            }

            c.html('<form method="POST" action="/sites/add">\n\
            <table class="table table-hover">\n\
                <thead>\n\
                  <tr><td>&nbsp;</td><td>категория</td><td>запрет кадет</td><td>запрет препод</td><td>скрыть</td></tr>\n\
                </thead>  \n\
                <tbody><tr><td><a href="http://' + site + '/" target="_blank">' + site + '</a></td>\n\
                <td><select id="modalselect" name="categories" class="select">\n\
                             <option disabled selected>' + category + '</option>\n\
                             @foreach($categories as $c)\n\
                            <option value="{{$c->id}}" access_kadet="{{$c->access}}" access_prepods="{{$c->access_prepods}}">{{$c->name_category}}</option>\n\
                    @endforeach</td>\n\
                <td><input type="checkbox" name="access" ' + access + '></td>\n\
                <td><input type="checkbox" name="access_prepods" ' + access_prepods + '></td>\n\
                <td><input type="checkbox" name="visible" ' + visible + '></td>\n\
            <tr></tbody>{{ csrf_field() }}\n\
           </table><input type="hidden" name="site" value="' + site + '">\n\
                    <div style="text-align:right;"> <button type="submit" class="btn btn-primary">Сохранить \n\
                    </button></div> </form>    '
                    );
            c.prepend('<div class="box-modal_close arcticmodal-close">X</div>');
            $.arcticmodal({
                content: c
            });
            $(".select").select2();
            checkin();
            });
    });
</script>

<script src="{{asset('js/progressBar.js')}}"></script>

@endsection

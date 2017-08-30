<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Analysis</title>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('modal/jquery.arcticmodal-0.3.min.js') }}"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{asset('modal/jquery.arcticmodal-0.3.css')}}" rel="stylesheet">
        <link href="{{asset('css/simple.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet">
        <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
        <!-- Scripts -->
                <script type="text/javascript">
              $(document).ready(function () {
                 $( ".select" ).select2();
              });
        </script>
        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
            ]) !!}
            ;
        </script>

    </head>

    <body>

        <div id="app">
            <nav class="navbar navbar-default navbar-fixed-top">

                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/journal') }}">
                        Журнал ЛИОТ
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" >
                    <ul class="nav navbar-nav">       
                        <li><a href="/journal/job" class="button16" data-toggle="modal">Добавить проделаную работу</a></li>
                        <li><a href="#myModal" class="button16" data-toggle="modal">добавить категорию</a></li>
                        <li><a href="#myModal3" class="button16" data-toggle="modal">добавить действие</a></li>
                        <li><a href="#myModal2" class="button16" data-toggle="modal">Добавить кабинет</a></li>
                    </ul>
                </div>        
            </nav> 
            <div class="col-md-2 left-menu">
                <ul class="nav">
                        <li class="nav-header">Главные ссылки</li>
                        <li class="active"><a href="/journal/employee">Сотрудники</a></li>
                        <li><a href="/journal/">Категории</a></li>
                        <li class="nav-divider"></li>
                        <li><a href="/journal/export">Export to Word</a></li>
                </ul>
                </div>
            <div class="col-md-10" style="margin-top:8vh">@yield('content')</div>
</div>
 <!-- модальное окно -->
    <div id="myModal" class="modal fade">
        <form method="post" id="upload" action="/journal/addcategory">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Введите категорию</h4>
                    </div>
                    <!-- Основное содержимое модального окна -->
                    <div class="modal-body">
                        <input type="text" class="form-control" name="nameCategory">
                    </div>
                    <!-- Футер модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        {{ csrf_field() }}
                        
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
 <div id="myModal2" class="modal fade">
        <form method="post" id="upload" action="/journal/addcab">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Введите название кабинета</h4>
                    </div>
                    <!-- Основное содержимое модального окна -->
                    <div class="modal-body">
                        <input type="text" class="form-control" name="nameCab">
                    </div>
                    <!-- Футер модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        {{ csrf_field() }}
                        
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
 
    <div id="myModal3" class="modal fade">
        <form method="post" id="upload" action="/journal/addevent">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Введите действие</h4>
                    </div>
                    <!-- Основное содержимое модального окна -->
                    <div class="modal-body">
                        <input type="text" class="form-control" name="nameEvent"><br>
                        <select name="idCategory" class="form-control">
                            <option disabled selected>выберете категорию</option>
                            @foreach($categories as $c)
                              <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Футер модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        {{ csrf_field() }}
                        
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    
 


<script>

    $(document).ready(function(){
      $('.list-group-item').click(function(){
        href = $(this).attr('link');
        $('#content').empty();
        $.ajax({
         url: href,
         type: "get",
         success: function(data){
         $('#content').prepend(data);
         }
      });
    });});

</script>
<!-- Scripts -->

</body>
</html>

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
        <link rel="stylesheet" href="{{asset('css/bar.css')}}">
        
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
            <nav class="navbar navbar-default navbar-static-top">

                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Analysis
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" >
                    <ul class="nav navbar-nav">                 
                         <li><a href="/analysis/prepods" class="button16">Преподаватели</a></li>
                        <li><a href="#myModal" class="button16" data-toggle="modal">Import файла</a></li>
                        <li><a href="#myModal3" class="button16" data-toggle="modal">Export</a></li>
                        <li><a href="#myModal2" class="button16" data-toggle="modal">Добавить категорию</a></li>
                        <li><a href="#myModal4" class="button16" data-toggle="modal">Удалить категорию</a></li>
                       
                    </ul>


                    <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                        <li>
                            <a href="/sites">Новых сайтов <span style="color:red">{{$new}}</span></a>
                        </li>
                    </ul>
                </div>
        </div>

    </nav>
    <!-- модальное окно -->
    <div id="myModal" class="modal fade">
        <form enctype="multipart/form-data" method="post" id="upload" action="/import">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Введите дату</h4>
                    </div>
                    <!-- Основное содержимое модального окна -->
                    <div class="modal-body">
                        <input type="date" class="form-control" name="date">
                    </div>
                    <!-- Футер модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        {{ csrf_field() }}
                        <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="f" id="f" onchange="document.getElementById('upload').submit()" style="display: none;">
                        <label for="f" class="btn btn-primary">Сохранить</label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="myModal2" class="modal fade">
        <form method="post" id="upload" action="/addCategory">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Введите название категории</h4>
                    </div>
                    <!-- Основное содержимое модального окна -->
                    <div class="modal-body">
                        <input type="text" class="form-control" name="name">
                    </div>
                    <!-- Футер модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Сохранить</label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="myModal3" class="modal fade">
        <form method="post" action="/export">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Экспорт</h4>
                    </div>
                    <!-- Основное содержимое модального окна -->
                    <div class="modal-body">
                        <select class="form-control" name="mounth">
                            <option disabled selected>Выберите месяц</option>
                            <option value="1">январь</option>
                            <option value="2">февраль</option>
                            <option value="3">март</option>
                            <option value="4">апрель</option>
                            <option value="5">май</option>
                            <option value="6">июнь</option>
                            <option value="7">июль</option>
                            <option value="8">август</option>
                            <option value="9">сентябрь</option>
                            <option value="10">октябрь</option>
                            <option value="11">ноябрь</option>
                            <option value="12">декабрь</option>
                        </select>
                    </div>
                    <!-- Футер модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        {{ csrf_field() }}
                        
                        <button type="submit" class="btn btn-primary">Выполнить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
       <div id="myModal4" class="modal fade">
        <form method="post" action="/delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Удаление категории</h4>
                    </div>
                    <!-- Основное содержимое модального окна -->
                    <div class="modal-body">
                        <select class="select" name="category" style="width:100%">
                            <option disabled selected>выберете категорию</option>
                            @foreach($categories as $c)
                            <option value="{{$c->id}}">{{$c->name_category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Футер модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @yield('content')

</div>

<!-- Scripts -->

</body>
</html>

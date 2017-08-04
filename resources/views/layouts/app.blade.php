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
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
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
                            <li><a href="#myModal" class="button16" data-toggle="modal">Import файла</a></li>
                            <li><a href="/export" class="button16">Export</a></li>
                            <li><a href="#myModal2" class="button16" data-toggle="modal">Добавить категорию</a></li>
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

            @yield('content')
            
        </div>

        <!-- Scripts -->

    </body>
</html>

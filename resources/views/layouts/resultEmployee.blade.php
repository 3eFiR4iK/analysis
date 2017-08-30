
        <div class="panel-info">
            <div class="panel-heading"><h3 style="padding-left:5%; ">{{$userName->name}}</h3><br></div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead style="font-weight: bold;">
                    <tr>
                        <td>Название</td>
                        <td>Кабинет</td>
                        <td>Кол-во</td>
                        <td>Коментарий</td>
                        <td>Дата</td>
                    </tr>
                <thead>
                <tbody>
                    @foreach($users_event as $uv)                         
                    <tr>
                        <td>{{$uv->event->name}}</td>
                        <td>{{$uv->rooms->name}}</td>
                        <td>{{$uv->count}}</td>
                        <td>{{$uv->comment}}</td>
                        <td>{{$uv->date}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

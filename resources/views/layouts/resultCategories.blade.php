
        <div class="panel-info">
            <div class="panel-heading"><h3 style="padding-left:5%; ">{{$catName->name}}</h3><br></div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover ">
                <thead style="font-weight: bold;">
                    <tr>
                        <td>Название</td>
                        <td>Кол-во</td>
                    </tr>
                <thead>
                <tbody>
                    @foreach($category as $c)                         
                    <tr>
                        <td>{{$c->name}}</td>
                        <td>{{$c->count}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

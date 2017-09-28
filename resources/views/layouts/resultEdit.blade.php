<div class="panel-info">
    <div class="panel-heading"><h3 style="padding-left:5%; ">{{$name}}</h3><br></div>
</div>
<div class="table-responsive">
    <table class="table table-hover ">
        <thead style="font-weight: bold;">
            <tr>
                <td>Название</td>
            </tr>
        <thead>
        <tbody>
            @foreach($edit as $e)                         
            <tr id="{{$e->id}}" ondblclick="dbl($(this));">
                <td id="name">{{$e->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    window.dblclick = false;
    window.tag;

    $(function () {
        $.contextMenu({
            selector: 'tr.cont',
            items: {
                "save": {name: "Сохранить", icon: "edit",
                    callback: function () {
                        $.ajax({
                            url: $('#updateForm').attr("action"),
                            type: 'POST',
                            data: $('#updateForm').serialize(),
                            success: function (data) {
                                $('[link = "' + window.link + '"]').click();
                            }
                        });
                        //$('#updateForm').submit();
                    }},
                "delete": {name: "Удалить", icon: "delete",
                    callback: function () {
                        $.ajax({
                            url: '/journal/delete',
                            type: 'POST',
                            data: {
                                id: $('tr.cont > input[name=id]').attr('value'),
                                section: $('tr.cont > input[name=section]').attr('value'),
                                _token: $('tr.cont > input[name=_token]').attr('value')
                            },
                            success: function (data) {
                                $('[link = "' + window.link + '"]').click();
                            }
                        });
                        console.log($('tr.cont > input[name=_token]').attr('value'));
                    }},
                "sep1": "---------",
                "quit": {name: "Отмена", icon: function () {
                        return 'context-menu-icon context-menu-icon-quit';
                    },
                    callback: function () {
                        $('div.table-responsive').empty();
                        $('div.table-responsive').prepend(window.tag);
                        window.dblclick = false;
                    }}
            }
        });
    });


    function dbl(tr) {
        if (window.dblclick === false) {

            window.tag = $('div.table-responsive').html();
            //console.log(window.tag);
            tr.attr("class", "cont");

            var name = tr.find('#name').html();
            var section = $('div.panel-heading > h3').text();
            tr.find('#name').empty().prepend('<input type="text" class="form-control" value="' + name + '" name="name"/>');

            $('div.table-responsive > table').wrap("<form action='/journal/update' method='post' id='updateForm'></form>");
            tr.prepend("<input type='hidden' value='" + tr.attr('id') + "' name='id'> ");
            tr.prepend("<input type='hidden' value='" + section + "' name='section'> ");
            tr.prepend('{{ csrf_field() }}');
            window.dblclick = true;
        }
    }    
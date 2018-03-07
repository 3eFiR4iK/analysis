
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
            <tr id="{{$uv->id}}" ondblclick="dbl($(this));">
                <td id="event">{{$uv->event->name}}</td>
                <td id="room">{{$uv->rooms->name}}</td>
                <td id="count">{{$uv->count}}</td>
                <td id="comment">{{$uv->comment}}</td>
                <td id="date">{{$uv->date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    window.dblclick = false;
    window.tag;
    
     $(function() {
        $.contextMenu({
            selector: 'tr.cont', 
            items: {
                "save": {name: "Сохранить", icon: "edit",
                callback:function(){
                  $.ajax({
                      url: $('#updateForm').attr("action"),
                      type: 'POST',
                      data: $('#updateForm').serialize(),
                      success: function(data){
                         $('[link = "'+window.link+'"]').click();
                      }
                  });
                 //$('#updateForm').submit();
                }},
                "sep1": "---------",
                "quit": {name: "Отмена", icon: function(){
                    return 'context-menu-icon context-menu-icon-quit';
                },
                callback:function(){
                    $('div.table-responsive').empty();
                    $('div.table-responsive').prepend(window.tag);
                    window.dblclick = false;
                }}
            }
        }); 
    });
    

    function dbl(tr) {
            if(window.dblclick === false){
            
            window.tag = $('div.table-responsive').html();
            //console.log(window.tag);
            tr.attr("class","cont");
            
            var event = tr.find('#event').html();
            var room = tr.find('#room').html();
            var count = tr.find('#count').html();
            var comment = tr.find('#comment').html();
            var date = tr.find('#date').html();
            console.log(comment);
            $.ajax({
                url: "/ajax",
                type: "get",
                success: function (data) {
                    //data['events'].forEach(function(elem){console.log(elem['name']);});
//                console.log(data['events']);
                    tr.find('#event').empty();
                    tr.find('#room').empty();
                    tr.find('#count').empty();
                    tr.find('#comment').empty();
                    tr.find('#date').empty();
                    
                    //------------event----------//
                    tr.find('#event').prepend("<select class='form-control select' name='event'>");
                    tr.find('#event > select').prepend("<option disabled selected>" + event + "</option>");
                    data["events"].forEach(function (elem) {
                        tr.find('#event > select').prepend("<option value=" + elem["id"] + ">" + elem["name"] + "</option>");
                    });
                    //-----------room-----------//
                    tr.find('#room').prepend("<select class='form-control select' name='room'>");
                    tr.find('#room > select').prepend("<option disabled selected>" + room + "</option>");
                            //console.log(data["room"]);
                    data["room"].forEach(function (elem) {
                        tr.find('#room > select').prepend("<option value=" + elem["id"] + ">" + elem["name"] + "</option>");
                    });

                    tr.find('#count').prepend('<input type="number" class="form-control" value="' + count + '" name="count"/>');
                    tr.find('#comment').prepend("<input type='text' class='form-control' value='" + comment + "' name='comment'/>");
                    tr.find('#date').prepend('<input type="date" class="form-control" value="' + date + '" name="date"/>');
                    $('div.table-responsive > table').wrap("<form action='/journal/updateempl' method='post' id='updateForm'></form>");
                    tr.prepend("<input type='hidden' value='"+tr.attr('id')+"' name='id'> ");
                    tr.prepend('{{ csrf_field() }}');
                    window.dblclick = true;
                }

            });
            }
            //console.log(mas);
        }


    

</script>

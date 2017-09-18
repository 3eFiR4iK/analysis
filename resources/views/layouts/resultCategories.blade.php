
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
                    <tr id="{{$c->id}}" ondblclick="dbl($(this));">
                        <td id="name">{{$c->name}}</td>
                        <td>{{$c->count}}</td>
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
            
            var name = tr.find('#name').html();
            
            $.ajax({
                url: "/ajax",
                type: "get",
                success: function (data) {
                    //data['events'].forEach(function(elem){console.log(elem['name']);});
//                console.log(data['events']);
                    tr.find('#name').empty().prepend('<input type="text" class="form-control" value="' + name + '" name="name"/>');;
                    $('div.table-responsive > table').wrap("<form action='/journal/updateevent' method='post' id='updateForm'></form>");
                    tr.prepend("<input type='hidden' value='"+tr.attr('id')+"' name='id'> ");
                    tr.prepend('{{ csrf_field() }}');
                    window.dblclick = true;
                }

            });
            }
            //console.log(mas);
        }
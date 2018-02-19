$(document).ready(function () {
    $('div.panel-heading > h4 > a').click(function () {
//alert($(this).parents('.panel').attr('load'));
        if ($(this).parents('.panel').attr('load') == 'false') {
            if (window.location.pathname == '/analysis') {
                getVisits($(this).attr('href'), true, $(this).parents('.panel'));
            } else if (window.location.pathname == '/analysis/prepods') {
                getVisits($(this).attr('href'), false, $(this).parents('.panel'));
            }

            $(this).parents('.panel').attr('load', 'true');
// alert("ok");
        }
    });

});






function getVisits(date, kadet, tag) {

    $.ajax({
        url: "/analysis/getVisits/" + date.slice(1) + "/" + kadet,
        type: 'get',
        success: function (data) {
            var json = $.parseJSON(data);
            var table = '<div id="' + date.slice(1) + '" class="panel-collapse collapse in" aria-expanded="true" style=""><div class="panel-body"> <div class="table-responsive"><table class="table table-hover "><thead style="font-weight: bold;"><tr><td>Название сайта</td><td>Кол-во посещений</td>         <td>Категория</td><td>Доступ</td>                            <td>Видимость</td></tr></thead><thead><tbody>';

            var row = '';
            $.each(json, function (elem) {
                row += "<tr><td>" + this.sites.nameSite + "</td><td>" + this.count + "</td>";
                if (this.sites.category_id == 0) {
                    row += "<td>без категории</td>";
                } else {
                    row += "<td>" + this.sites.categories.name_category + "</td>";
                }
                if (kadet == true) {
                    if (this.sites.access == 1) {
                        row += "<td>да</td>";
                    } else
                        row += "<td>нет</td>";
                } else {
                    if (this.sites.access_prepods == 1) {
                        row += "<td>да</td>";
                    } else
                        row += "<td>нет</td>";
                }
                if (this.sites.visible == 1) {
                    row += "<td>да</td>";
                } else
                    row += "<td>нет</td>";

//console.log(this.sites.categories);
            });
            tag.append(table + row + "</tbody></table></div>");
        }
    });


}


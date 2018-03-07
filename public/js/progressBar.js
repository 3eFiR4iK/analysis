//global

sends = 0;
allcount = -1;
count = 0;
abort = false;
//endglobal

function showBar() {
    var c = $('<div class="window"> />');
    c.html('<div class="status">\n\
		    <p>Copying...</p>\n\
			<a href="#">X</a>\n\
		</div>\n\
		<div class="anim">\n\
			<img src="/img/giphy.gif" alt="">\n\
		    <p>site: </p>\n\
		</div>\n\
		<div class="process">\n\
			<div class="bar">\n\
				<!-- 26 -->\n\
			</div>\n\
			<a href="#" class="button" onclick="window.abort=true;"><p>Cancel</p></a>\n\
		</div>');
    $.arcticmodal({
        content: c
    });
}

function map(x, in_min, in_max, out_min, out_max)
{
    return Math.floor((x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min);
}

function addSection(last, now) {
    if (last != now) {
        for (var i = 1; i <= now - last; i++) {
            $('div.window > div.process > div.bar').append("<p>&nbsp;</p>");
        }
    }
}

function showSite(site) {
    $('div.window > div.anim > p').text("site: " + site);
}

function main() {
    var c = $('<div class="box-modal" />');
    c.html('<form id="progressbar">\n\
            <table class="table table-hover">\n\
                <thead>\n\
                  <tr><td>искомое значение</td><td>категория</td><td>запрещенный для кадета</td><td>запрещенный для преподавателя</td><td>скрыть</td></tr>\n\
                </thead>  \n\
                <tbody><tr><td><input type="text" name="find"></td>\n\
                <td><select name="categories" class="select">\n\
                             ' + $('select[name=category]').html() + '\n\
                <td><input type="checkbox" name="access"></td>\n\
                <td><input type="checkbox" name="access_prepods"></td>\n\
                <td><input type="checkbox" name="visible"></td>\n\
            <tr></tbody><input type="hidden" name="_token" value="' + $('meta[name=csrf-token]').attr('content') + '">\n\
           </table>\n\
                    <input type="hidden" name ajax value="true">\n\
                     <a id="btnprogress" class="btn btn-primary arcticmodal-close">Сохранить \n\
                    </a> </form>'
            );
    c.prepend('<div class="box-modal_close arcticmodal-close">X</div>');
    $.arcticmodal({
        content: c
    });
    $(".select").select2();
}

$(document).ready(function () {
    $(document).bind('keydown', function (e) {
        if (e.which === 70 && e.shiftKey) {
            main();
            $('a#btnprogress').click(function () {
                console.log($('form#progressbar').serialize());
                findSites();
            });
        }
    });
});

function send(form, sitesUrl,last=0) {
    //console.log(form + "  " + window.count
    if (window.abort == false){
    $.ajax({
        type: 'POST',
        url: '/sites/add',
        data: form + '&site=' + sitesUrl[window.count],
        success: function () {
            if(window.count == window.allcount){
		showSite("done !");
		window.abort = true;
  	    }
           if(last < 26)
            addSection(last, map(window.count, 0, window.allcount, 0, 26));
            
last = map(window.count, 0, window.allcount, 0, 26);

            //console.log(sitesUrl);
            showSite(window.count + " из " + sitesUrl.length + " / " + sitesUrl[window.count]);
            console.log(window.count + " из " + sitesUrl.length + " / " + sitesUrl[window.count]);
	    window.count++;
            send(form, sitesUrl,last);
        },
        error: function (data) {
            window.count++;
            addSection(last, map(window.count, 0, window.allcount, 0, 26));
            last = map(window.count, 0, window.allcount, 0, 26);

            //console.log(sitesUrl);
            showSite(window.count + " из " + sitesUrl.length + " / " + sitesUrl[window.count]);
            console.log(window.count + " из " + sitesUrl.length + " / " + sitesUrl[window.count]);
            if (count === window.allcount) {
                showSite("done !");
                window.abort = true;
            }

            
            $('div.panel-body').append(data['responseText']);
            send(form, sitesUrl,last);
        }
    });
    }else{
        window.allcount =-1;
        window.count =-1;
    }
    
    window.abort =false;
}

function findSites() {

    var tags = $('div.tab-pane.active>div.table-responsive>table>tbody>tr>td#site');
    var sites = new Array();
    var regexp = new RegExp($('form#progressbar > table >tbody>tr>td>input[name=find]').val());
    //console.log($('form#progressbar > table >tbody>tr>td>input[name=find]').val());
    //var allcount = 0;
    $.each(tags, function (e) {
        if ($(this).text().search(regexp) != -1) {
            window.allcount++;
            sites.push($(this).text());
        }
    });
    var conf = confirm("найдено "+sites.length+" сайтов");
    if(conf == false){
        window.allcount =-1;
        window.count =-1;
        return;
    } else {
        console.log(window.allcount);
    showBar();
    send($('form#progressbar').serialize(), sites);
    }
    
}

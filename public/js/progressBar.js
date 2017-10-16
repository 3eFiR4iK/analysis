function showBar(){
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
			<a href="#" class="button"><p>Cancel</p></a>\n\
		</div>');
	$.arcticmodal({
                content: c
            });
}

function map(x,  in_min,  in_max,  out_min,  out_max)
{
  return Math.floor((x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min);
}

function addSection(last,now){
    if(last != now){
        for(var i=1;i<=now-last;i++){
            $('div.window > div.process > div.bar').append("<p>&nbsp;</p>");
        }
    }
}

function showSite(site){
    $('div.window > div.anim > p').text("site: "+site);
}

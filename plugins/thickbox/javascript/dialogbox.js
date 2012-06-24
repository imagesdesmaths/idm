var url = document.URL, 
	p_index = url.indexOf("?"), 
	d_index = url.indexOf("#"), 
	t_url = (d_index!==-1) ? url.substring(0, d_index) : url,
	param = t_url.substr(p_index+1),
	d = param.split('&'), 
	str = false,
	type = false;

for(var j=0; j < d.length; j++){
	var e = d[j].split('=');
	var f = e[0].split('_');
	if(e[0] == 'id_article') {
		str = e[1];
		type = f;
	}
	else if(e[0] == 'id_breve') {
		str = e[1];
		type = f;
	}
}

function close_thickbox(){
	if (typeof tb_remove == "function") {
		tb_remove();
	} else {
		self.parent.tb_remove();
	}
}

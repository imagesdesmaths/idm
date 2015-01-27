function debugOpenClose(id){
	elmt_title = document.getElementById('dump_segment_'+id);
	elmt_content = document.getElementById('dump_segment_content_'+id);
	elmt_picto = document.getElementById('dump_segment_picto_'+id);
	
	if(elmt_content.style.display == ''){
		elmt_content.style.display = 'none';
	}else{
		elmt_content.style.display = '';
	}
}
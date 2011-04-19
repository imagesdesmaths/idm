var onglet_actif = undefined;
jQuery.fn.desactive_onglet = function() {
	var url = $(this).children('a').attr("href");
	if (url){
		var ancre = url.split('#'); ancre = ancre[1];
		$('#'+ancre).hide();
	}
	$(this).removeClass('onglet_on').addClass('onglet');
}

jQuery.fn.active_onglet = function(hash) {
	if (onglet_actif)	$(onglet_actif).desactive_onglet();
	onglet_actif = this;
	var url = $(this).children('a').attr("href");
	var ancre = url.split('#'); ancre = ancre[1];
	$(this).addClass('onglet_on').removeClass('onglet');
	$('#'+ancre).show();
	if (hash)
		window.location.hash=hash;
	else
		window.location.hash=ancre;
}

function refresh_apercu(r){
	$('#apercu_gauche').html(r);
	$('#apercu').html(r);
}
jQuery.fn.ajaxWait = function() {
	$(this).prepend("<br class='nettoyeur' /><div>"+ajax_image_searching+"</div>");
	return this;
}

var action_confirmee=true;
function confirmAction(message) {
	if (!confirm(message)) {
		/*if (!e) var e = window.event;
		e.cancelBubble = true;
		if (e.stopPropagation) e.stopPropagation();*/
		action_confirmee=false;
		return false;
	}
	action_confirmee=true;
	return true;
}

jQuery.fn.ajaxAction = function() {
	var id=$(this).attr("id");
	$('#'+id+' a.ajaxAction').click(function(){
		if ($(this).is('.confirmer') && (action_confirmee==false)) return false;
		var action = $(this).attr("href");
		var idtarget = action.split('#')[1];
		if (!idtarget) idtarget = id;	
		var url = (($(this).attr("rel")).split('#'))[0];
		var redir = url + "&var_ajaxcharset="+ajaxcharset+"&bloc="+idtarget;
		action = (action.split('#')[0]).replace(/&?redirect=[^&#]*/,''); // l'ancre perturbe IE ...
		$('#'+idtarget+',#apercu_gauche').ajaxWait();
		$.get(action,{redirect: redir}, function(data){
			$('#'+idtarget).html(data).ajaxAction();
			if($('#'+idtarget).is('.forms_champs')) forms_init_multi($('#'+idtarget).parent());
			if($('#'+idtarget).is('#champs')) forms_init_lang();
		});
		if ($('#apercu_gauche').length)
			$.get( url+"&var_ajaxcharset="+ajaxcharset+"&bloc=apercu" , function(data){refresh_apercu(data);} );
		if (idtarget!='proprietes')
			$.get(url+"&var_ajaxcharset="+ajaxcharset+"&bloc=proprietes",function(data){ $('#proprietes').html(data).ajaxAction(); });
		return false;
	});
	$('#'+id+' form.ajaxAction').each(function(){
		var idtarget = $(this).children('input[name=idtarget]').val();
		if (!idtarget) idtarget = $(this).parent().attr("id");
		var redir = $(this).children('input[name=redirect]');
		var url = (($(redir).val()).split('#'))[0];
		$(redir).val(url + "&var_ajaxcharset="+ajaxcharset+"&bloc="+idtarget);
		$(redir).after("<input type='hidden' name='var_ajaxcharset' value='"+ajaxcharset+"' />");
		$(this).ajaxForm({"target":'#'+idtarget, 
		/* jquery >=1.1.3 */
			"success":
			function(){
				$.get(url+"&var_ajaxcharset="+ajaxcharset+"&bloc=apercu",function(data){refresh_apercu(data);});
				if (idtarget!='proprietes')
				{
					$.get(url+"&var_ajaxcharset="+ajaxcharset+"&bloc=proprietes",function(data){ $('#proprietes').html(data).ajaxAction(); });
				}
				$('#'+idtarget).ajaxAction();
				if($('#'+idtarget).is('.forms_champs')) forms_init_multi($('#'+idtarget).parent());
				if($('#'+idtarget).is('#champs')) forms_init_lang();
			},
			"beforeSubmit":
			function(param,form){
				forms_multi_submit.apply(form[0],[param]);
				$('#'+idtarget+',#apercu_gauche').ajaxWait();
			},
		/* jquery < 1.1.3 */
			"after":
			function(){
				if ($('#apercu_gauche').length)
					$.get(url+"&var_ajaxcharset="+ajaxcharset+"&bloc=apercu",function(data){refresh_apercu(data);});
				if (idtarget!='proprietes')
					$.get(url+"&var_ajaxcharset="+ajaxcharset+"&bloc=proprietes",function(data){ $('#proprietes').html(data).ajaxAction(); });
				$('#'+idtarget).ajaxAction();
				if($('#'+idtarget).is('.forms_champs')) forms_init_multi($('#'+idtarget).parent());
				if($('#'+idtarget).is('#champs')) forms_init_lang();
			},
			"before":
			function(param,form){	
				forms_multi_submit.apply(form[0],[param]);
				$('#'+idtarget+',#apercu_gauche').ajaxWait();
			}
			});
	});
	if ((jQuery.fn.jquery.substr(2,1)>0) || (jQuery.fn.jquery.substr(0,1)>1))
		$('.antifocus').one('focus',function(){ this.value='';$(this).removeClass('antifocus'); } );
	else
		$('.antifocus').onefocus( function(){ this.value='';$(this).removeClass('antifocus'); } );
	$('#'+id+' div.sortableChoix').Sortable(
		{
			accept : 			'sortableChoixItem',
			activeclass : 'sortableactive',
			hoverclass : 	'sortablehover',
			helperclass : 'sortChoixHelper',
			handle : '.sortableChoixHandle',
			/*opacity: 		0.8,*/
			/*fx:				200,*/
			revert:			true,
			tolerance:		'intersect',
			/*containment: 'parent',*/
			onStop : function(){
				serial = $.SortSerialize($(this).parent().attr("id"));
				$(this).parent().siblings('input[name=ordre]').val(serial.hash);
			}
		}
	)
	$('#champs .boutons_ordonne').hide();
	if (id=='champs')
		$('#champs div#sortableChamps').Sortable(
			{
				accept : 			'sortableChampsItem',
				activeclass : 'sortableactive',
				hoverclass : 	'sortablehover',
				helperclass : 'sortChampsHelper',
				handle : '.sortableChampsHandle',
				/*opacity: 		0.8,*/
				/*fx:				200,*/
				revert:			true,
				tolerance:		'intersect',
				/*containment: 'parent',*/
				onStart : function(arg){
					serial = $.SortSerialize($(this).parent().attr("id"));
					var form = $(this).parent().siblings('form.sortableChamps');
					form.children('input[name=ordre]').val(serial.hash);
				},
				onStop : function(arg){
					serial = $.SortSerialize($(this).parent().attr("id"));
					var form = $(this).parent().siblings('form.sortableChamps');
					var prev = $(form).children('input[name=ordre]').val();
					if (prev != serial.hash) {
						$(form).children('input[name=ordre]').val(serial.hash);
						$(form).children('input[type=submit]').eq(0).each(function(){ this.click(); });
					}
				}
			}
		)
}

$(document).ready(function(){
	var hash = window.location.hash;
	var onglets = $('#barre_onglets div.onglet');
	if ($(onglets).length==3){
		$(onglets)
			.each(function(){ $(this).desactive_onglet()})
			.click(function(){ $(this).active_onglet(); })
			.mouseout(function(){$(onglet_actif).addClass('onglet_on');});
		if ((hash=='#champs')||(hash=='#champ_visible')||(hash=='#nouveau_champ'))
			$(onglets).eq(2).active_onglet(hash);
		else if (hash=='#proprietes')
			$(onglets).eq(1).active_onglet();
		else if (hash=='#resume')
			$(onglets).eq(0).active_onglet();
		else
			$(onglets).eq(2).active_onglet();
		$('#champs').ajaxAction();
		$('#proprietes').ajaxAction();
	}
	else{
		if ((jQuery.fn.jquery.substr(2,1)>0) || (jQuery.fn.jquery.substr(0,1)>1))
			$('.antifocus').one('focus',function(){ this.value='';$(this).removeClass('antifocus'); } );
		else
			$('.antifocus').onefocus( function(){ this.value='';$(this).removeClass('antifocus'); } );
	}

});

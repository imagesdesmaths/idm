<?php
function forcer_choix_rubrique_boite(&$flux) {
  if ($GLOBALS['afficher_boite_rubrique'] == "oui") {
    $flux .= "
<script type='text/javascript'>
	function masquer_boite(){
		ma_Boite=document.getElementById('maBoite');
		if (document.all) { // Rustine pour IE6 -- la peste soit de ce navigateur
			document.all.maBoite.style.display='none';
		}
		else {
			forcer_police();
			ma_Boite.style.display='none';

		}
	}
	function forcer_police(){
		if(document.getElementById('titreparent')){
			monTitreparent=document.getElementById('titreparent');
			monTitreparent.style.color='red !important';
			monTitreparent.style.fontWeight='bolder !important';
			monTitreparent.style.fontSize='120%';
		}
		else if(document.getElementById('id_parent')){
			monTitreparent=document.getElementById('id_parent');
			monTitreparent.style.color='red !important';
			monTitreparent.style.fontWeight='bolder !important';
			monTitreparent.style.fontSize='120%';
		}
	}

</script>
<div id='maBoite' class='XXX' style='display:inherit; position:fixed; width:99%; height:99%;'>
	<div style='position:absolute; width:70%; top:25%; left:15%; border:#5DA7C5 medium solid; background-color:#EEEEEE; opacity:0.8; z-index:100; padding:10px; -moz-border-radius:10px; text-align:justify'>
		<h2>Attention&nbsp!</h2>
		<div>
	";
    $flux .= file_get_contents(find_in_path('message_boite.inc'));
    $flux .= "
		</div>
		<div>&nbsp;</div>
		<div style='text-align:center'>[<a href='javascript:masquer_boite()'>Fermer</a>]</div>
	</div>
</div>
	";
  }
  return $flux;
}
?>
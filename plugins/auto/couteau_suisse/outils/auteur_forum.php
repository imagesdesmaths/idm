<?php

function Auteur_forum_affichage_final($flux){
	if(_request('page')=='forum') {
		$form = defined('_SPIP19100')?"jQuery('.previsu').parent()":"jQuery('fieldset.previsu', this).parent().parent()";
		#	include_spip('inc/charsets');
		// filtrer et remettre le tout dans le charset cible
		$nom = unicode2charset(html2unicode(_T('couteau:nom_forum')));
		$nom = '"' . str_replace('"', '\"', $nom) . '"';
		// code jQuery
		$code =<<<jscode
<script type="text/javascript"><!--
// compatibilite Ajax : ajouter "this" a "jQuery" pour mieux localiser les actions 
// et tagger avec cs_done pour eviter de binder plrs fois le meme bloc
function cs_auteur_forum() {
	form = $form;
	// SPIP 2.0 remplace 'auteur' par 'session_nom'
	auteur = jQuery('#session_nom', this);
	if(!auteur.length) auteur = jQuery('#auteur', this);
	if(form.length && auteur.length)
	// eviter les forums anonymes
	form.not('.cs_done').addClass('cs_done').bind('submit', function(event){
		if(auteur.val().length==0) {
			alert($nom);
			auteur.focus();
			auteur.attr('style','border-color:#E86519;');
			return false;
		}
	});
}
if(typeof onAjaxLoad=='function')onAjaxLoad(cs_auteur_forum);
if(window.jQuery)jQuery(document).ready(function(){
	cs_auteur_forum.apply(document);
});
//--></script>
jscode;
		$flux = str_replace("</head>","$code\n</head>",$flux);
	}
	return $flux;
}

?>
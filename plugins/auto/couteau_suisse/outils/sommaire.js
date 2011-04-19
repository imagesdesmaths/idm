var sommaire_sel = 'div.cs_sommaire_titre_avec_fond, div.cs_sommaire_titre_sans_fond';

// compatibilite Ajax : ajouter "this" a "jQuery" pour mieux localiser les actions 
// et tagger avec cs_done pour eviter de binder plrs fois le meme bloc
function cs_sommaire_init() {
	jQuery(sommaire_sel, this)
		.cs_todo()
		.click( function(){
			jQuery(this).toggleClass('cs_sommaire_replie')
				.next().toggleClass('cs_sommaire_invisible')
			// annulation du clic
			return false;
		});
}

// Sauve l'etat du 1er sommaire de la page dans un cookie si on quitte la page, et le remet quand on revient
// pour SPIP < 2.0, il faut le plugin jquery.cookie.js
function cs_sommaire_cookie() {
	if(typeof jQuery.cookie!='function') return;
	var replie = jQuery.cookie('cs_sommaire');
	jQuery.cookie('cs_sommaire', null);
	if (Number(replie))
		jQuery(sommaire_sel).eq(0).addClass('cs_sommaire_replie')
			.next().toggleClass('cs_sommaire_invisible');
	jQuery(window).bind('unload', function() {
		jQuery.cookie('cs_sommaire',
			Number(jQuery(sommaire_sel).eq(0).is('.cs_sommaire_replie'))
		);
	});
}

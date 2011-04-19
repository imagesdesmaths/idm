// compatibilite Ajax : ajouter "this" a "jQuery" pour mieux localiser les actions
// et tagger avec cs_done pour eviter de traiter plrs fois le meme bloc
function InhibeFlash_init() {
  var code;
  jQuery('object', this).each(function(){
  	jQuery('param',this).remove();
  }).wrap("<div class='noflash'></div>");
  jQuery('div.noflash', this).not('.cs_done').addClass('cs_done').each(function(){
  	var code = this.innerHTML;
  	// ajouter les attributs juste avant la fermeture de la balise object
  	var reg=new RegExp("(<object [^>]*>)", "i");
  	code = code.replace(reg,"");
  	var reg=new RegExp("(<\/object>)", "i");
  	code = code.replace(reg,"");
  	this.innerHTML=code;
  })
}

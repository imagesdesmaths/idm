var gloss_el = null;
var gloss_dt = null;
var gloss_dd = null;
var gloss_dl = null;

// compatibilite Ajax : ajouter "this" a "jQuery" pour mieux localiser les actions
// et tagger avec cs_done pour eviter de binder plrs fois le meme bloc
function glossaire_init() {
  if(jQuery('span.gl_js', this).length) {
	if(!jQuery('#glossOverDiv').length) {
		jQuery('body').append('<div id="glossOverDiv" style="position:absolute; display:none; visibility: hidden;"><span class="gl_dl"><span class="gl_dt">TITRE</span><span class="gl_dd">Definition</span></span></div>');
		gloss_el = document.getElementById('glossOverDiv');
		gloss_dl = gloss_el.firstChild;
		gloss_dt = gloss_dl.firstChild;
		gloss_dd = gloss_dl.lastChild;
	}
	jQuery('span.gl_mot', this).cs_todo().hover(
		function(e) {
			$this = jQuery(this);	  
			// cas du surligneur (SPIP 2)
			if(this.firstChild.className=="spip_surligne") {
				this.className = "gl_mot spip_surligne";
				this.innerHTML = this.firstChild.innerHTML;
			}
			gloss_dt.innerHTML = $this.parent().children('.gl_js')[0].title;  // titre
			gloss_dd.innerHTML = $this.parent().children('.gl_jst')[0].title; // definition
			reg = $this.css('font-size').match(/^\d\d?(?:\.\d+)?px/);
			if(reg) gloss_el.style.fontSize = reg[0];
			jQuery(gloss_el)
				.css('top', e.pageY.toString()+"px")
				.css('left', e.pageX.toString()+"px")
				.css('font-family', jQuery(this).css('font-family'));
			gloss_el.style.display    = 'block';
			gloss_el.style.visibility = 'visible';
			if(typeof jQuery.fn.offset=="function") { // plugin jquery.dimensions disponible a partir de SPIP 2
if(1) {///////////////////////// optimisation du placement, encore en test...
	var $glossOverDiv = jQuery('#glossOverDiv');
	var $gloss_dl = jQuery(gloss_dl);
	positionBy = 'auto'; // Type de positionnement : 'dessus', 'dessous', 'auto', 'mouse' (a tester...)
	ombre = 0;  // Taille d'une ombre, en pixels (non implemente)
	decalX = 2; // decalage entre le glossaire et le lien appelant
	width = 180; // largeur totale de #glossOverDiv : definie dans glossaire.css
	height = 'auto'; // hauteur totale de #glossOverDiv : 'auto' ou nombre de pixels
	// initiation verticale
	var glossHeight, wHeight;
	var linkHeight = this.offsetHeight;
	var defHeight = isNaN(parseInt(height, 10)) ? 'auto' : (/\D/g).test(height) ? height : height + 'px';
	var sTop, linkTop, posY, mouseY, baseLine;
	sTop = jQuery(document).scrollTop();
	// initiation horizontale
	var glossWidth = width + ombre;
	var linkWidth = this.offsetWidth;
	var linkLeft, posX, mouseX, winWidth;
	winWidth = jQuery(window).width();
	// c'est parti !
	linkTop = posY = $this.offset().top;
	linkLeft = $this.offset().left;
	mouseX = e.pageX;
	mouseY = e.pageY;
// securite pour l'instant
$glossOverDiv.css({margin:'0px'}); $gloss_dl.css({margin:'0px'});
	// calcul de la position horizontale : glossaire au centre du lien
	posX = Math.max(linkLeft - (glossWidth-linkWidth)/2,0);
	if (positionBy == 'dessous' || positionBy == 'dessus') { // glossaire fixe
		$glossOverDiv.css({left: posX + 'px'});
	} else {
		// au cas ou, glossaire a droite ou a gauche du lien ?
		posX2 = (linkWidth > linkLeft && linkLeft > glossWidth) || (linkLeft + linkWidth + glossWidth + decalX > winWidth)
		  ? linkLeft - glossWidth - decalX 
		  : linkWidth + linkLeft + decalX;
		// suivre la souris ?
		if (positionBy == 'mouse' || linkWidth + glossWidth > winWidth) {
		  posX = Math.max(mouseX - (glossWidth-linkWidth)/2,0); // glossaire au centre de la souris
		/*if (mouseX + 20 + glossWidth > winWidth)
			posX = (mouseX - glossWidth) >= 0 ? mouseX - glossWidth :  mouseX - (glossWidth/2);
		else posX = mouseX;*/
	}
	var pY = e.pageY;
	$glossOverDiv.css({left: (posX > 0 && positionBy != 'dessus') ? posX : (mouseX + (glossWidth/2) > winWidth) ? winWidth/2 - glossWidth/2 : Math.max(mouseX - (glossWidth/2),0)});
	}
	// calcul de la position verticale
	wHeight = jQuery(window).height();
	$glossOverDiv.css({overflow: defHeight == 'auto' ? 'visible' : 'auto', height: defHeight});
	glossHeight = defHeight == 'auto' ? Math.max($gloss_dl.outerHeight(),$gloss_dl.height()) : parseInt(defHeight,10);   
	glossHeight += ombre;
	tipY = posY;
	baseLine = sTop + wHeight;
	if (positionBy == 'dessous') tipY = posY + linkHeight + 2; // glossaire fixe sous le lien
	else if (positionBy == 'dessus') tipY = posY - glossHeight - 2; // glossaire fixe au-dessus du lien
	else if ( posX < mouseX && Math.max(posX, 0) + glossWidth > mouseX ) { // glossaire cache le lien
		if (posY + glossHeight > baseLine && mouseY - sTop > glossHeight) { 
		  tipY = posY - glossHeight - 2;
		} else { 
		  tipY = posY + linkHeight + 2;
		}
	} else if ( posY + glossHeight > baseLine ) {
		tipY = (glossHeight >= wHeight) ? sTop : baseLine - glossHeight;
	} else if ($this.css('display') == 'block' || positionBy == 'mouse') {
		tipY = pY;
	} else {
		tipY = posY /*- ombre*/;
	}
	$glossOverDiv.css({top: tipY + 'px'});
}////////////////////////////////////////

			} // typeof jQuery.fn.offset=="function"
			gloss_el.style.visibility = 'visible';
		},
		function(e) {
			gloss_el.style.display    = 'none';
			gloss_el.style.visibility = 'hidden';
		}
	);

	// accessibilite au clavier
	if(typeof jQuery.fn.offset=="function") { // plugin jquery.dimensions disponible a partir de SPIP 2
		jQuery('a.cs_glossaire').focus(
			function() {
				legl_mot = this.firstChild;
				gloss_dt.innerHTML = jQuery(this).children('.gl_js')[0].title;  // titre
				gloss_dd.innerHTML = jQuery(this).children('.gl_jst')[0].title; // definition
				reg = jQuery(this.firstChild).css('font-size').match(/^\d\d?(?:\.\d+)?px/);
				if(reg) gloss_el.style.fontSize = reg[0];
				var result = jQuery(this).offset({ scroll: false });
				jQuery(gloss_el)
					.css('top',result.top+"px")
					.css('left', result.left+"px")
					.css('font-family', jQuery(this.firstChild).css('font-family'));
				gloss_el.style.display    = 'block';
				gloss_el.style.visibility = 'visible';
			}
		);
		jQuery('a.cs_glossaire').blur(
			function() {
				gloss_el.style.display    = 'none';
				gloss_el.style.visibility = 'hidden';
			}
		);
	} // typeof jQuery.fn.offset=="function"
  }
}
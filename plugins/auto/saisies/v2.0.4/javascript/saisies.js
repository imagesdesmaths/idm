jQuery(function(){
	saisies_fieldset_pliable();
	onAjaxLoad(saisies_fieldset_pliable);
});

function saisies_fieldset_pliable(){
	// On cherche les groupes de champs pliables
	jQuery('li.fieldset.pliable')
		.each(function(){
			var li = jQuery(this);
			var ul = jQuery(this).find('> fieldset > ul');
			var legend = jQuery(this).find('> fieldset > .legend');
			
			// S'il est déjà plié on cache le contenu
			if (li.is('.plie'))
				ul.hide();
			
			// Ensuite on ajoute une action sur le titre
			legend
				.unbind('click')
				.click(
					function(){
						li.toggleClass('plie');
						if (ul.is(':hidden'))
							ul.show();
						else
							ul.hide();
					}
				);
		});
};

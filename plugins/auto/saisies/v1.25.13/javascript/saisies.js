$(function(){
	saisies_fieldset_pliable();
	onAjaxLoad(saisies_fieldset_pliable);
});

function saisies_fieldset_pliable(){
	// On cherche les groupes de champs pliables
	$('li.fieldset.pliable')
		.each(function(){
			var li = $(this);
			var ul = $(this).find('> fieldset > ul');
			var legend = $(this).find('> fieldset > .legend');
			
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

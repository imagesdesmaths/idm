<?php
function controleurs_forms_champ_dist($regs) {
	list(,$crayon,$type,$champ,$id) = $regs;
	$e = explode('-',$id);
	$id_form = $e[0];
	$form_champ = $e[1];
	
	if (!preg_match(',^\w+$,',$champ)
	OR !$res = spip_query("SELECT $champ FROM spip_forms_champs WHERE id_form="._q($id_form)." AND champ="._q($form_champ))
	OR !$row = spip_fetch_array($res))
		return array("$type $id_form:$form_champ $champ: " . _U('crayons:pas_de_valeur'), 6);

	$valeur = $row[$champ];
	$nomcrayon = "$type-$champ-" . $id;
	$options = array('hauteurMaxi'=> 0, 'inmode' => 'ligne');
    
	$crayon = new Crayon($nomcrayon, $valeur, $options);
	$inputAttrs['style'] = 'width:' . $crayon->largeur . 'px;' .
       ($crayon->hauteur ? ' height:' . $crayon->hauteur . 'px;' : '');

	$html = $crayon->formulaire($option['inmode'], $inputAttrs);
	$status = NULL;

	return array($html,$status);
}
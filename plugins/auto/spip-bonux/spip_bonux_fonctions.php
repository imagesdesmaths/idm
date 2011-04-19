<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Romy Tetue
 * Licence GPL
 * 
 */

include_spip('inc/core21_filtres');

/**
 * une fonction pour generer des menus avec liens
 * ou un span lorsque l'item est selectionne
 *
 * @param string $url
 * @param string $libelle
 * @param bool $on
 * @param string $class
 * @param string $title
 * @return string
 */
function aoustrong($url,$libelle,$on=false,$class="",$title="",$rel=""){
	return lien_ou_expose($url,$libelle,$on,$class,$title,$rel);
}


/**
 * une fonction pour generer une balise img a partir d'un nom de fichier
 *
 * @param string $img
 * @param string $alt
 * @param string $class
 * @return string
 */
function tag_img($img,$alt="",$class=""){
	$balise_img = chercher_filtre('balise_img');
	return $balise_img($img,$alt,$class);
}

/**
 * Afficher un message "un truc"/"N trucs"
 *
 * @param int $nb
 * @return string
 */
function affiche_un_ou_plusieurs($nb,$chaine_un,$chaine_plusieurs,$var='nb'){
	return singulier_ou_pluriel($nb,$chaine_un,$chaine_plusieurs,$var);
}

/**
 * Ajouter un timestamp a une url de fichier
 *
 * @param unknown_type $fichier
 * @return unknown
 */
function timestamp($fichier){
	if (!$fichier) return $fichier;
	$m = filemtime($fichier);
	return "$fichier?$m";
}

/**
 * Transformer un tableau d'entrees array("rubrique|9","article|8",...)
 * en un tableau contenant uniquement les identifiants d'un type donne.
 * Accepte aussi que les valeurs d'entrees soient une chaine brute
 * "rubrique|9,article|8,..." 
 *
 * @param array/string $selected liste des entrees : tableau ou chaine separee par des virgules
 * @param string $type type de valeur a recuperer ('rubrique', 'article')
 * 
 * @return array liste des identifiants trouves.
**/
function picker_selected($selected, $type){
	$select = array();
	$type = preg_replace(',\W,','',$type);

	if ($selected and !is_array($selected)) 
		$selected = explode(',', $selected);
		
	if (is_array($selected))
		foreach($selected as $value)
			if (preg_match(",".$type."[|]([0-9]+),",$value,$match)
			  AND strlen($v=intval($match[1])))
			  $select[] = $v;
	return $select;
}

function picker_identifie_id_rapide($ref,$rubriques=0,$articles=0){
	include_spip("inc/json");
	include_spip("inc/lien");
	if (!($match = typer_raccourci($ref)))
		return json_export(false);
	@list($type,,$id,,,,) = $match;
	if (!in_array($type,array($rubriques?'rubrique':'x',$articles?'article':'x')))
		return json_export(false);
	$table_sql = table_objet_sql($type);
	$id_table_objet = id_table_objet($type);
	if (!$titre = sql_getfetsel('titre',$table_sql,"$id_table_objet=".intval($id)))
		return json_export(false);
	$titre = attribut_html(extraire_multi($titre));
	return json_export(array('type'=>$type,'id'=>"$type|$id",'titre'=>$titre));
}

/**
 * Donner n'importe quelle information sur un objet de maniere generique.
 *
 * La fonction va gerer en interne deux cas particuliers les plus utilises :
 * l'URL et le titre (qui n'est pas forcemment la champ SQL "titre").
 *
 * On peut ensuite personnaliser les autres infos en creant une fonction
 * generer_<nom_info>_entite($id_objet, $type_objet, $ligne).
 * $ligne correspond a la ligne SQL de tous les champs de l'objet, les fonctions
 * de personnalisation n'ont donc pas a refaire de requete.
 *
 * @param int $id_objet
 * @param string $type_objet
 * @param string $info
 * @return string
 */
function generer_info_entite($id_objet, $type_objet, $info){
	// On verifie qu'on a tout ce qu'il faut
	$id_objet = intval($id_objet);
	if (!($id_objet and $type_objet and $info))
		return '';
	
	// Si on demande l'url, on retourne direct la fonction
	if ($info == 'url')
		return generer_url_entite($id_objet, $type_objet);
	
	// Si on demande le titre, on le gere en interne
	if ($demande_titre = ($info == 'titre')){
		global $table_titre;
		$champ_titre = $table_titre[table_objet($type_objet)];
		if (!$champ_titre) $champ_titre = 'titre';
		$champ_titre = ", $champ_titre";
	}
	
	// Sinon on va tout chercher dans la table et on garde en memoire
	static $objets;
	
	// On ne fait la requete que si on a pas deja l'objet ou si on demande le titre mais qu'on ne l'a pas encore
	if (!$objets[$type_objet][$id_objet] or ($demande_titre and !$objets[$type_objet][$id_objet]['titre'])){
		include_spip('base/abstract_sql');
		include_spip('base/connect_sql');
		$objets[$type_objet][$id_objet] = sql_fetsel(
			'*'.$champ_titre,
			table_objet_sql($type_objet),
			id_table_objet($type_objet).' = '.intval($id_objet)
		);
	}
	$ligne = $objets[$type_objet][$id_objet];
	
	if ($demande_titre)
		$info_generee = $objets[$type_objet][$id_objet]['titre'];
	// Si la fonction generer_TRUC_entite existe, on l'utilise
	else if ($generer = charger_fonction("generer_${info}_entite", '', true))
		$info_generee = $generer($id_objet, $type_objet, $ligne);
	// Sinon on prend le champ SQL
	else
		$info_generee = $ligne[$info];
	
	// On va ensuite chercher les traitements automatiques a faire
	global $table_des_traitements;
	$maj = strtoupper($info);
	$traitement = $table_des_traitements[$maj];
	$table_objet = table_objet($type_objet);
	
	if (is_array($traitement)){
		$traitement = $traitement[isset($traitement[$table_objet]) ? $table_objet : 0];
		$traitement = str_replace('%s', '"'.str_replace('"', '\\"', $info_generee).'"', $traitement);
		eval("\$info_generee = $traitement;");
	}
	
	return $info_generee;
}

/**
 * Proteger les champs passes dans l'url et utiliser dans {tri ...}
 * preserver l'espace pour interpreter ensuite num xxx et multi xxx
 * @param string $t
 * @return string
 */
function tri_protege_champ($t){
	return preg_replace(',[^\s\w.+],','',$t);
}

/**
 * Interpreter les multi xxx et num xxx utilise comme tri
 * pour la clause order
 * 'multi xxx' devient simplement 'multi' qui est calcule dans le select
 * @param string $t
 * @return string
 */
function tri_champ_order($t,$table=NULL,$field=NULL){
	if (strncmp($t,'num ',4)==0){
		$t = substr($t,4);
		$t = preg_replace(',\s,','',$t);
		// Lever une ambiguité possible si le champs fait partie de la table (pour compatibilité de la balise tri avec compteur, somme, etc.)
		if (!is_null($table) && !is_null($field) && in_array($t,unserialize($field)))
			$t = "0+$table.$t";
		else
			$t = "0+$t";
		return $t;
	}
	elseif(strncmp($t,'multi ',6)==0){
		return "multi";
	}
	else {
		$t = preg_replace(',\s,','',$t);
		// Lever une ambiguité possible si le champs fait partie de la table (pour compatibilité de la balise tri avec compteur, somme, etc.)
		if (!is_null($table) && !is_null($field) && in_array($t,unserialize($field)))
			return $table.'.'.$t;
		else
			return $t;
	}
}

/**
 * Interpreter les multi xxx et num xxx utilise comme tri
 * pour la clause select
 * 'multi xxx' devient select "...." as multi
 * les autres cas ne produisent qu'une chaine vide '' en select
 *
 * @param string $t
 * @return string
 */
function tri_champ_select($t){
	if(strncmp($t,'multi ',6)==0){
		$t = substr($t,6);
		$t = preg_replace(',\s,','',$t);
		$t = sql_multi($t,$GLOBALS['spip_lang']);
		return $t;
	}
	return "''";
}

/**
 * Rediriger une page suivant une autorisation,
 * et ce, n'importe où dans un squelette, même dans les inclusions.
 *
 * @param bool $ok Indique si l'on doit rediriger ou pas
 * @param string $url Adresse vers laquelle rediriger
 * @param int $statut Statut HTML avec lequel on redirigera
 */
function sinon_interdire_acces($ok=false, $url='', $statut=0){
	if ($ok) return '';
	
	// vider tous les tampons
	while (ob_get_level())
		ob_end_clean();
	
	include_spip('inc/headers');
	$statut = intval($statut);
	
	// Si aucun argument on essaye de deviner quoi faire
	if (!$url and !$statut){
		// Si on est dans l'espace privé, on génère du 403 Forbidden
		if (test_espace_prive()){
			http_status(403);
			$echec = charger_fonction('403','exec');
			$echec();
		}
		// Sinon on redirige vers une 404
		else{
			$statut = 404;
		}
	}
	
	// Sinon on suit les directives indiquées dans les deux arguments
	
	// S'il y a un statut
	if ($statut){
		// Dans tous les cas on modifie l'entête avec ce qui est demandé
		http_status($statut);
		// Si le statut est une erreur 4xx on va chercher le squelette
		if ($statut >= 400)
			echo recuperer_fond("$statut");
	}
	
	// S'il y a une URL, on redirige (si pas de statut, la fonction mettra 302)
	if ($url) redirige_par_entete($url, '', $statut);
	
	exit;
}

?>

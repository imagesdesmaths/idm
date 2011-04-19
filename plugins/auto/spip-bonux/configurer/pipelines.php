<?php
/*
 * Plugin xxx
 * (c) 2009 xxx
 * Distribue sous licence GPL
 *
 */

/**
 * Proposer un chargement par defaut pour les #FORMULAIRE_CONFIGURER_XXX
 *
 * @param array $flux
 * @return array
 */
function spip_bonux_formulaire_charger($flux){
	if ($form = $flux['args']['form']
	  AND strncmp($form,'configurer_',11)==0 // un #FORMULAIRE_CONFIGURER_XXX
		AND !charger_fonction("charger","formulaires/$form/",true) // sans fonction charger()
		#AND !$flux['data'] // ne pas ecraser ce que des plugins on peut etre deja remplis (tq _saisies)
		) {

		$flux['data'] = spip_bonux_formulaires_configurer_recense($form);
		$flux['data']['editable'] = true;
		if (_request('var_mode')=='configurer' AND autoriser('webmestre')){
			if (!_AJAX) var_dump($flux['data']);
			// reinjecter pour la trace au traitement
			$flux['data']['_hidden'] = "<input type='hidden' name='var_mode' value='configurer' />";
		}
	}
	return $flux;
}

/**
 * Proposer un traitement par defaut pour les #FORMULAIRE_CONFIGURER_XXX
 *
 * @param array $flux
 * @return array
 */
function spip_bonux_formulaire_traiter($flux){
	if ($form = $flux['args']['form']
	  AND strncmp($form,'configurer_',11)==0 // un #FORMULAIRE_CONFIGURER_XXX
		AND !charger_fonction("traiter","formulaires/$form/",true) // sans fonction charger()
		) {

		// charger les valeurs
		// ce qui permet de prendre en charge une fonction charger() existante
		// qui prend alors la main sur l'auto detection
		if ($charger_valeurs = charger_fonction("charger","formulaires/$form/",true))
			$valeurs = call_user_func_array($charger_valeurs,$flux['args']['args']);
		$valeurs = pipeline(
			'formulaire_charger',
			array(
				'args'=>array('form'=>$form,'args'=>$flux['args']['args'],'je_suis_poste'=>false),
				'data'=>$valeurs)
		);
		// ne pas stocker editable !
		unset($valeurs['editable']);

		// recuperer les valeurs postees
		$store = array();
		foreach($valeurs as $k=>$v){
			if (substr($k,0,1)!=='_')
				$store[$k] = _request($k);
		}

		$trace = spip_bonux_configurer_stocker($form,$valeurs,$store);

		$flux['data'] = array('message_ok'=>_T('config_info_enregistree').$trace,'editable'=>true);
	}
	return $flux;
}

/**
 * Retrouver les champs d'un formulaire en parcourant son squelette
 * et en extrayant les balises input, textarea, select
 * 
 * @param string $form
 * @return array
 */
function spip_bonux_formulaires_configurer_recense($form){
	$valeurs = array();
	
	// traiter d'abord le cas fichier yaml de description

	// TODO

	// sinon cas analyse du squelette
	if ($f = find_in_path($form.'.' . _EXTENSION_SQUELETTES, 'formulaires/')
		AND lire_fichier($f, $contenu)) {

		for ($i=0;$i<2;$i++) {
			// a la seconde iteration, evaluer le fond avec les valeurs deja trouvees
			// permet de trouver aussi les name="#GET{truc}"
			if ($i==1) $contenu = recuperer_fond("formulaires/$form",array_merge($valeurs,array('editable'=>' ')));

			$balises = array_merge(extraire_balises($contenu,'input'),
				extraire_balises($contenu,'textarea'),
				extraire_balises($contenu,'select'));

			foreach($balises as $b) {
				if ($n = extraire_attribut($b, 'name')
					AND preg_match(",^([\w\-]+)(\[\w*\])*$,",$n,$r)
					AND !in_array($n,array('formulaire_action','formulaire_action_args'))
					AND extraire_attribut($b,'type')!=='submit') {
						$valeurs[$r[1]] = '';
						// recuperer les valeurs _meta_xx qui peuvent etre fournies
						// en input hidden dans le squelette
						if (strncmp($r[1],'_meta_',6)==0)
							$valeurs[$r[1]] = extraire_attribut($b,'value');
					}
			}
		}
	}


	spip_bonux_configurer_lire_meta($form,$valeurs);
	return $valeurs;
}

/**
 * Definir la regle de conteneur, en fonction de la presence
 * des 
 * _meta_table : nom de la table meta ou stocker (par defaut 'meta')
 * _meta_casier : nom du casier dans lequel serializer (par defaut xx de formulaire_configurer_xx)
 * _meta_prefixe : prefixer les meta (alternative au casier) dans la table des meta (par defaur rien)
 * 
 * @param string $form 
 * @param array $valeurs
 */
function spip_bonux_definir_configurer_conteneur($form,$valeurs) {
		// stocker en base
		// par defaut, dans un casier serialize dans spip_meta (idem CFG)
		$casier = substr($form,11);
		$table = 'meta';
		$prefixe = '';

		// si on indique juste une table, il faut vider les autres proprietes
		// car par defaut on utilise ni casier ni prefixe dans ce cas
		if (isset($valeurs['_meta_table'])) {
			$table = $valeurs['_meta_table'];
			$casier = (isset($valeurs['_meta_casier'])?$valeurs['_meta_casier']:'');
			$prefixe = (isset($valeurs['_meta_prefixe'])?$valeurs['_meta_prefixe']:'');
		}
		else {
			if(isset($valeurs['_meta_casier']))
				$casier = $valeurs['_meta_casier'];
			if(isset($valeurs['_meta_prefixe']))
				$prefixe = $valeurs['_meta_prefixe'];
		}

		return array($table,$casier,$prefixe);
}

/**
 * Stocker les metas
 * @param <type> $form
 * @param <type> $valeurs
 * @param <type> $store
 */
function spip_bonux_configurer_stocker($form,$valeurs,$store) {
	$trace = '';
	list($table,$casier,$prefixe) = spip_bonux_definir_configurer_conteneur($form,$valeurs);
	// stocker en base
	// par defaut, dans un casier serialize dans spip_meta (idem CFG)
	if (!isset($GLOBALS[$table]))
		lire_metas($table);

	// le casier peut etre de la forme casierprincipal/sous/casier
	// on ecrit donc au bon endroit sans perdre les autres sous casier freres
	if ($casier) {
		$c = explode('/',$casier);
		$casier_principal = array_shift($c);
		$st = isset($GLOBALS[$table][$casier_principal])?$GLOBALS[$table][$casier_principal]:array();
		if (is_string($st) AND (count($c) OR is_array($store))) {
			$st = unserialize($st);
			if ($st===false) 
				$st=array();
		}
		$sc = &$st;
		while (count($c) AND $cc=reset($c)) {
			// creer l'entree si elle n'existe pas
			if (!isset($sc[$cc]))
				$sc[$cc] = array();
			$sc = &$sc[$cc];
			array_shift($c);
		}
		if (is_array($sc) AND count($sc))
			$sc = array_merge($sc,$store);
		else
			$sc = $store;
		$store = array($casier_principal => serialize($st));
	}

	$prefixe = ($prefixe?$prefixe.'_':'');
	foreach($store as $k=>$v){
		ecrire_meta($prefixe.$k, $v, true, $table);
		if (_request('var_mode')=='configurer' AND autoriser('webmestre')){
			$trace .= "<br />table $table : ".$prefixe.$k." = $v;";
		}
	}
	return $trace;
}

function spip_bonux_configurer_lire_meta($form,&$valeurs) {
	list($table,$casier,$prefixe) = spip_bonux_definir_configurer_conteneur($form,$valeurs);

	$prefixe = ($prefixe?$prefixe.'_':'');
	if ($casier) {
		$meta = spip_bonux_lire_config("/$table/$prefixe$casier");
		$prefixe = '';
	}
	else {
		$meta = spip_bonux_lire_config("/$table");
	}

	foreach($valeurs as $k=>$v){
		if (substr($k,0,1)!=='_')
		$valeurs[$k] = (isset($meta[$prefixe.$k])?$meta[$prefixe.$k]:'');
	}
}

/**
 * Lecture de la configuration
 *
 * lire_config() permet de recuperer une config depuis le php<br>
 * memes arguments que la balise (forcement)<br>
 * $cfg: la config, lire_config('montruc') est un tableau<br>
 * lire_config('/table/champ') lit le valeur de champ dans la table des meta 'table'<br>
 * lire_config('montruc/sub') est l'element "sub" de cette config equivalent a lire_config('/meta/montruc/sub')<br>
 *
 * $unserialize est mis par l'histoire
 *
 * @param  string  $cfg          la config
 * @param  mixed   $def          un défaut optionnel
 * @param  boolean $unserialize  n'affecte que le dépôt 'meta'
 * @return string
 */
function spip_bonux_lire_config($cfg='', $def=null, $unserialize=true) {
	// lire le stockage sous la forme /table/valeur
	// ou valeur qui est en fait implicitement /meta/valeur
	// ou casier/valeur qui est en fait implicitement /meta/casier/valeur
	if ($cfg AND strpos($cfg,'/')===false){
		return isset($GLOBALS['meta'][$cfg])?
		  ((!$unserialize OR ($t=unserialize($GLOBALS['meta'][$cfg]))===false)?$GLOBALS['meta'][$cfg]:$t)
		  :$def;
	}

	// par defaut, sur la table des meta
	$table = 'meta';
	$cfg = explode('/',$cfg);
	// si le premier argument est vide, c'est une syntaxe /table/ ou un appel vide ''
	if (!reset($cfg) AND count($cfg)>1) {
		array_shift($cfg);
		if (count($cfg)) $table = array_shift($cfg);
		if (!isset($GLOBALS[$table]))
			lire_metas($table);
		if (!isset($GLOBALS[$table]))
			return $def;
	}

	$r = $GLOBALS[$table];

	// si on a demande #CONFIG{/meta,'',0}
	if (!count($cfg))
		return $unserialize ? $r : serialize($r);
	
	$deserialize = false; // on ne deserialise qu'une seule fois...
	while($casier = array_shift($cfg)) {
		$r = isset($r[$casier])?$r[$casier]:null;
		// deserializer tant que c'est necessaire
		if (!$deserialize AND $r  AND is_string($r) AND (count($cfg) OR $unserialize)) {
			$deserialize = true;
			$r = unserialize($r);
		}
	}

	if (is_null($r)) return $def;
	return $r;
}


if (!function_exists('balise_CONFIG')) {
/**
 * #CONFIG retourne lire_config()
 *
 * Le 3eme argument permet de controler la serialisation du resultat
 * (mais ne sert que pour le depot 'meta') qui doit parfois deserialiser
 *
 * ex: |in_array{#CONFIG{toto,#ARRAY,1}}.
 *
 * Ceci n'affecte pas d'autres depots et |in_array{#CONFIG{toto/,#ARRAY}} sera equivalent
 * #CONFIG{/tablemeta/champ,defaut} lit la valeur de 'champ' dans la table des meta 'tablemeta'
 *
 * @param  Object $p  Arbre syntaxique du compilo
 * @return Object
 */
function balise_CONFIG($p) {
	if (!$arg = interprete_argument_balise(1,$p)) {
		$arg = "''";
	}
	$sinon = interprete_argument_balise(2,$p);
	$unserialize = sinon(interprete_argument_balise(3,$p),"false");

	$p->code = 'spip_bonux_lire_config(' . $arg . ',' .
		($sinon && $sinon != "''" ? $sinon : 'null') . ',' . $unserialize . ')';

	return $p;
}
}

include_spip('inc/config');
?>

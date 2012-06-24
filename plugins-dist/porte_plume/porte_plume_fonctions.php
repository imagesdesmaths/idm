<?php
/*
 * Plugin Porte Plume pour SPIP 2
 * Licence GPL
 * Auteur Matthieu Marcillaud
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * La class Barre_outils est un objet contenant les differents
 * parametres definissant une barre markitup
 * 
 */
class Barre_outils{
	var $id = "";
	var $nameSpace = "";
	var $lang = "";
	var $previewAutoRefresh = false;
	var $previewParserPath = "";
	var $onEnter = array();
	var $onShiftEnter = array();
	var $onCtrlEnter = array();
	var $onTab = array();
	var $beforeInsert = "";
	var $afterInsert = "";
	var $markupSet = array();
	
	// liste de fonctions supplementaires a mettre apres le json
	var $functions = "";
	
	// private
	var $_liste_params_autorises = array(
	
		'replaceWith',
		'openWith',
		'closeWith',
		'openBlockWith', // sur multiline, avant les lignes selectionnees
		'closeBlockWith', // sur multiline, apres les lignes selectionnees
		'placeHolder', // remplace par ce texte lorsqu'il n'y a pas de selection
		
		'beforeInsert', // avant l'insertion
		'afterInsert', // apres l'insertion
		'beforeMultiInsert',
		'afterMultiInsert',

		'dropMenu', // appelle un sous menu
		
		'name', // nom affiche au survol
		'key', // raccourcis clavier
		'className', // classe css utilisee
		'lang', // langues dont le bouton doit apparaitre - array
		'lang_not', // langues dont le bouton ne doit pas apparaitre - array
		'selectionType', // '','word','line' : type de selection (normale, aux mots les plus proches, a la ligne la plus proche) 
		'multiline', // open/close sur chaque ligne (mais replace est applique sur l'ensemble de la selection)
		'forceMultiline', // pour faire comme si on faisait systematiquement un control+shift (et replace est applique sur chaque ligne de la selection)
		
		'separator',
		
		'call',
		'keepDefault',
		
		// cacher ou afficher facilement des boutons
		'display',
		// donner un identifiant unique au bouton (pour le php)
		'id',
	);
	
	/**
	 * Initialise les parametres
	 * @param array $params :  param->valeur
	 */
	function Barre_outils($params=array()){
		foreach ($params as $p=>$v) {
			if (isset($this->$p)) {
				// si tableau, on verifie les entrees
				if (is_array($v)) {
					$v = $this->verif_params($p,$v);
				}
				$this->$p = $v;
			}
		}
	}
	
	/**
	 * Verifie que les parametres transmis existent
	 * et retourne un tableau des parametres valides
	 * 
	 * @param string $nom : cle du parametre (eventuel)
	 * @param array  $params : parametres du parametre (param->valeur)
	 */
	function verif_params($nom, $params=array()) {
		// si markupset, on boucle sur les items
		if (stripos($nom, 'markupSet')!==false) {
			foreach ($params as $i=>$v) {
				$params[$i] = $this->verif_params($i, $v);
			}
		} 
		// sinon on teste la validite
		else {
			foreach ($params as $p=>$v) {
				if (!in_array($p, $this->_liste_params_autorises)) {
					unset($params[$p]);
				}
			}
		}
		return $params;
	}
	
	/**
	 * Permet d'affecter des parametres a un element de la barre
	 * La fonction retourne les parametres, de sorte qu'on peut s'en servir pour simplement recuperer ceux-ci.
	 * 
	 * Il est possible d'affecter des parametres avant/apres l'element trouve
	 * en definisant une valeur differente pour le $lieu : 'dedans','avant','apres'
	 * par defaut 'dedans' (modifie l'element trouve).
	 * 
	 * Lorsqu'on demande d'inserer avant ou apres, la fonction retourne les parametres inseres
	 * 
	 * @param false/array $tableau
	 * 		tableau ou chercher les elements (sert pour la recursion)
	 * @param string $identifiant
	 * 		identifiant du bouton a afficher
	 * @param array $params
	 * 		parametres a affecter a la trouvaille.
	 * 		Peut etre tableau cle/valeur ou
	 * 		Tableau de tableaux cle/valeur (sauf pour $lieu = dedans)
	 * @param string $lieu
	 * 		lieu d'affectation des parametres (dedans, avant, apres)
	 * @param bool $plusieurs
	 * 		definit si $params est une forme simple (tableau cle/valeur)
	 * 		ou comporte plusieurs boutons (tableau de tableaux cle/valeur).
	 */
	function affecter(&$tableau, $identifiant, $params=array(), $lieu='dedans', $plusieurs=false){
		static $cle_de_recherche = 'id'; // ou className ?
		
		if ($tableau === null)
			$tableau = &$this->markupSet;
			
		if (!in_array($lieu, array('dedans','avant','apres'))) 
			$lieu = 'dedans';
		
		// present en premiere ligne ?
		$trouve = false;
		foreach ($tableau as $i=>$v){
			if (isset($v[$cle_de_recherche]) and ($v[$cle_de_recherche] == $identifiant)) {
				$trouve = $i;
				break;
			}
		}
		// si trouve, affectations
		if (($trouve !== false)) {
			if ($params) {
				// verifier que les insertions sont correctes
				$les_params = ($plusieurs ? $params : array($params));
				foreach ($les_params as $i=>$un_params) {
					$les_params[$i] = $this->verif_params($identifiant, $un_params);
				}
	
				// dedans on merge ($params uniquement tableau cle/valeur)
				if ($lieu == 'dedans' && !$plusieurs) {
					return $tableau[$trouve] = array_merge($tableau[$trouve], $les_params[0]);
				}
				// avant ou apres, on insere ($params peut etre tableau cle/valeur ou tableau de tableaux cle/valeur)
				elseif ($lieu == 'avant') {
					array_splice($tableau, $trouve, 0, $les_params);
					return $params;
				}
				elseif ($lieu == 'apres') {
					array_splice($tableau, $trouve+1, 0, $les_params);
					return $params;
				}
			}
			return $tableau[$trouve];
		}
				
		// recursivons sinon !
		foreach ($tableau as $i=>$v){
			if (is_array($v)) {
				foreach ($v as $m=>$n) {
					if (is_array($n) AND ($r = $this->affecter($tableau[$i][$m], $identifiant, $params, $lieu, $plusieurs))) 
						return $r;
				}
			}
		}
		return false;
	}

	
	/**
	 * Permet d'affecter des parametres toutes les elements de la barre
	 * 
	 * @param array $params : parametres a affecter a la trouvaille
	 * @param array $ids : tableau identifiants particuliers a qui on affecte les parametres
	 *                     si vide, tous les identifiants seront modifies
	 * @param false/array $tableau : tableau ou chercher les elements (sert pour la recursion)
	 */
	function affecter_a_tous(&$tableau, $params=array(), $ids=array()){
		if (!$params)
			return false;
		
		if ($tableau === null)
			$tableau = &$this->markupSet;

		$params = $this->verif_params('divers', $params);

		// merge de premiere ligne
		foreach ($tableau as $i=>$v){
			if (!$ids OR in_array($v['id'], $ids)) {
				$tableau[$i] = array_merge($tableau[$i], $params);
			}
			// recursion si sous-menu
			if (isset($tableau[$i]['dropMenu'])) {
				$this->affecter_a_tous($tableau[$i]['dropMenu'], $params, $ids);
			}
		}
		return true;
	}
	
		
	/**
	 * Affecte les valeurs des parametres indiques au bouton demande
	 * et retourne l'ensemble des parametres du bouton (sinon false)
	 * 
	 * @param string/array $identifiant : id du ou des boutons a afficher
	 * @param array $params : param->valeur
	 * @return mixed
	 */
	function set($identifiant, $params=array()) {
		// prudence tout de meme a pas tout modifier involontairement (si array)
		if (!$identifiant) return false;
			
		if (is_string($identifiant)) {
			return $this->affecter($this->markupSet, $identifiant, $params);
		}
		elseif (is_array($identifiant)) {
			return $this->affecter_a_tous($this->markupSet, $params, $identifiant);
		}
		return false;		
	}
	
	/**
	 * Retourne les parametres du bouton demande
	 * 
	 * @param string $identifiant : nom (de la classe du) bouton
	 * @return mixed
	 */
	function get($identifiant) {
		if ($a = $this->affecter($this->markupSet, $identifiant)) {
			return $a;
		}
		return false;		
	}
	
		 		
	/**
	 * Affiche le bouton demande
	 * 
	 * @param string $identifiant : nom (de la classe du) bouton a afficher
	 * @return true/false
	 */
	function afficher($identifiant){
		return $this->set($identifiant,array('display'=>true));
	}
	
		
	/**
	 * Cache le bouton demande
	 * 
	 * @param string $identifiant : nom (de la classe du) bouton a afficher
	 * @return true/false
	 */
	function cacher($identifiant){
		return $this->set($identifiant,array('display'=>false));
	}
	
		 		
	/**
	 * Affiche tous les boutons
	 * 
	 * @param string $identifiant : nom (de la classe du) bouton a afficher
	 * @return true/false
	 */
	function afficherTout(){
		return $this->affecter_a_tous($this->markupSet, array('display'=>true));
	}
	
	/**
	 * Cache tous les boutons
	 * 
	 * @param string $identifiant : nom (de la classe du) bouton a afficher
	 * @return true/false
	 */
	function cacherTout(){
		return $this->affecter_a_tous($this->markupSet, array('display'=>false));
	}
	

	/**
	 * ajouter un bouton ou quelque chose, avant un autre deja present
	 * 
	 * @param string $identifiant : identifiant du bouton ou l'on doit se situer
	 * @param array $params
	 * 		Parametres de l'ajout.
	 * 		Description d'1 bouton (tableau cle/valeurs)
	 */
	function ajouterAvant($identifiant, $params){
		return $this->affecter($this->markupSet, $identifiant, $params, 'avant');
	}
	
	/**
	 * ajouter plusieurs boutons, avant un autre deja present
	 * 
	 * @param string $identifiant : identifiant du bouton ou l'on doit se situer
	 * @param array $tableau_params
	 * 		Parametres de l'ajout.
	 * 		Description de plusieurs boutons (tableau de tableaux cle/valeurs).
	 */
	function ajouterPlusieursAvant($identifiant, $tableau_params){
		return $this->affecter($this->markupSet, $identifiant, $tableau_params, 'avant', true);
	}
	
	/**
	 * ajouter un bouton ou quelque chose, apres un autre deja present
	 * 
	 * @param string $identifiant
	 * 		identifiant du bouton ou l'on doit se situer
	 * @param array $params
	 * 		parametres de l'ajout.
	 * 		Description d'1 bouton (tableau cle/valeurs)
	 */
	function ajouterApres($identifiant, $params){
		return $this->affecter($this->markupSet, $identifiant, $params, 'apres');
	}

	/**
	 * ajouter plusieurs boutons, apres un autre deja present
	 * 
	 * @param string $identifiant
	 * 		identifiant du bouton ou l'on doit se situer
	 * @param array $tableau_params
	 * 		Parametres de l'ajout.
	 * 		Description de plusieurs boutons (tableau de tableaux cle/valeurs).
	 */
	function ajouterPlusieursApres($identifiant, $tableau_params){
		return $this->affecter($this->markupSet, $identifiant, $tableau_params, 'apres', true);
	}
			
	/**
	 * ajouter une fonction js pour etre utilises dans les boutons
	 * 
	 * @param string $fonction : code de la fonction js
	 * @return null
	 */
	function ajouterFonction($fonction){
		if (false === strpos($this->functions, $fonction)){
			$this->functions .= "\n" . $fonction . "\n";
		}
	}
		
	/**
	 * Supprimer les elements non affiches (display:false)
	 * Et les séparateurs (li vides) selon la configuration
	 * 
	 * @param false/array $tableau : tableau a analyser (sert pour la recursion)
	 */
	function enlever_elements_non_affiches(&$tableau){
		if ($tableau === null)
			$tableau = &$this->markupSet;
		
		foreach ($tableau as $p=>$v){

			if (isset($v['display']) AND !$v['display']) {
				unset($tableau[$p]);
				$tableau = array_values($tableau); // remettre les cles automatiques sinon json les affiche et ça plante.
			}
			// sinon, on lance une recursion sur les sous-menus
			else {
				if (isset($v['dropMenu']) and is_array($v['dropMenu'])) {
					$this->enlever_elements_non_affiches($tableau[$p]['dropMenu']);
					// si le sous-menu est vide
					// on enleve le sous menu.
					// mais pas le parent ($tableau[$p]), qui peut effectuer une action.
					if (!$tableau[$p]['dropMenu']) {
						unset($tableau[$p]['dropMenu']);
					}
				}
			}

		}
	}

	/**
	 * Enleve les separateurs pour ameliorer l'accessibilite
	 * au detriment du stylage possible de ces separateurs.
	 *
	 * Le bouton precedent le separateur recoit une classe CSS 'separateur_avant'
	 * Celui apres 'separateur_apres'
	 * 
	 * @param 
	 * @return 
	**/
	function enlever_separateurs(&$tableau) {
		if ($tableau === null)
			$tableau = &$this->markupSet;

		foreach ($tableau as $p=>$v) {
			if (isset($v['separator']) and $v['separator']) {
				if (isset($tableau[$p-1])) {
					$tableau[$p-1]['className'] .= " separateur_avant";
				}
				if (isset($tableau[$p+1])) {
					$tableau[$p+1]['className'] .= " separateur separateur_apres $v[id]";
				}
				unset($tableau[$p]);
				$tableau = array_values($tableau); // remettre les cles automatiques sinon json les affiche et ça plante.
			}
			// sinon, on lance une recursion sur les sous-menus
			else {
				if (isset($v['dropMenu']) and is_array($v['dropMenu'])) {
					#$this->enlever_separateurs($tableau[$p]['dropMenu']);
				}
			}
		}
	}
	
	/**
	 * Supprime les elements vides (uniquement a la racine de l'objet)
	 * et uniquement si chaine ou tableau.
	 * 
	 * Supprime les parametres prives
	 * Supprime les parametres inutiles a markitup/json dans les parametres markupSet
	 * (id, display, icone)
	 */
	function enlever_parametres_inutiles() {
		foreach($this as $p=>$v){
			if (!$v) {
				if (is_array($v) or is_string($v)) {
					unset($this->$p);
				}
			} elseif ($p == 'functions') {
				unset($this->$p);
			}
		}
		foreach($this->markupSet as $p=>$v) {
			foreach ($v as $n=>$m) {
				if (in_array($n, array('id', 'display'))) {
					unset($this->markupSet[$p][$n]);
				}
			}
		}
		unset ($this->_liste_params_autorises);
	}
	
	
	/**
	 * Cree la sortie json pour le javascript des parametres de la barre
	 * et la retourne
	 * 
	 * @return string : declaration json de la barre
	 */
	function creer_json(){
		$barre = $this;
		$type = $barre->nameSpace;
		$fonctions = $barre->functions;

		$barre->enlever_elements_non_affiches($this->markupSet);
		$barre->enlever_separateurs($this->markupSet);
		$barre->enlever_parametres_inutiles();
		
		$json = Barre_outils::json_export($barre);

		// on lance la transformation des &chose; en veritables caracteres
		// sinon markitup restitue &laquo; au lieu de « directement
		// lorsqu'on clique sur l'icone
		include_spip('inc/charsets');
		$json = unicode2charset(html2unicode($json));
		return "\n\nbarre_outils_$type = ".$json . "\n\n $fonctions";		
	}
	
	/**
	 * Transform a variable into its javascript equivalent (recursive)
	 * (depuis ecrire/inc/json, mais modifie pour que les fonctions
	 * js ne soient pas mises dans un string
	 * 
	 * @access private
	 * @param mixed the variable
	 * @return string js script | boolean false if error
	 */
	function json_export($var) {
		$asso = false;
		switch (true) {
			case is_null($var) :
				return 'null';
			case is_string($var) :
				if (strtolower(substr(ltrim($var),0,8))=='function')
					return $var;
				return '"' . addcslashes($var, "\"\\\n\r") . '"';
			case is_bool($var) :
				return $var ? 'true' : 'false';
			case is_scalar($var) :
				return $var;
			case is_object( $var) :
				$var = get_object_vars($var);
				$asso = true;
			case is_array($var) :
				$keys = array_keys($var);
				$ikey = count($keys);
				while (!$asso && $ikey--) {
					$asso = $ikey !== $keys[$ikey];
				}
				$sep = '';
				if ($asso) {
					$ret = '{';
					foreach ($var as $key => $elt) {
						$ret .= $sep . '"' . $key . '":' . Barre_outils::json_export($elt);
						$sep = ',';
					}
					return $ret ."}\n";
				} else {
					$ret = '[';
					foreach ($var as $elt) {
						$ret .= $sep . Barre_outils::json_export($elt);
						$sep = ',';
					}
					return $ret ."]\n";
				}
		}
		return false;
	}
	
}



/**
 * Cette fonction cree la css pour les images
 * des icones des barres d'outils
 * en s'appuyant sur la description des jeux de barres disponibles.
 * 
 * elle cherche une fonction barre_outils_($barre)_icones pour chaque
 * barre et l'appelle si existe.
 * 
 * @return string : declaration css des icones
 */
function barre_outils_css_icones(){
	// recuperer la liste, extraire les icones
	$css = "";
	
	// liste des barres
	if (!$barres = barre_outils_liste()) 
		return null;
		
	// liste des classes css et leur correspondance avec une icone
	$classe2icone = array();
	foreach ($barres as $barre) {
		include_spip('barre_outils/' . $barre);
		if ($f = charger_fonction($barre . '_icones', 'barre_outils', true)) {
			if (is_array($icones = $f())) {
				$classe2icone = array_merge($classe2icone, $icones);
			}
		}
	}
	
	// passer le tout dans un pipeline pour ceux qui ajoutent de simples icones a des barres existantes
	$classe2icone = pipeline('porte_plume_lien_classe_vers_icone',$classe2icone);
	
	// passage en css
	foreach ($classe2icone as $n=>$i) {
		$pos="";
		if (is_array($i)){
			$pos = "background-position:".end($i);
		  $i = reset($i);
		}
		$css .= "\n.markItUp .$n>a>em {background-image:url(".protocole_implicite(url_absolue(find_in_path("icones_barre/$i"))).");$pos}";
	}

	return $css;
}


/**
 * Retourne une instance de Barre_outils
 * cree a partir du type de barre demande
 * 
 * @param string $set : type de barre
 * @return object/false : objet de type barre_outil
 */
function barre_outils_initialiser($set){
	if ($f = charger_fonction($set, 'barre_outils')) {
		// retourne une instance de l'objet Barre_outils
		return $f();
	}
	return false;
}

/**
 * Retourne la liste des barres d'outils connues
 *
 * @return array/false : tableau des noms de barres trouvees
 */
function barre_outils_liste(){
	static $sets = -1;
	if ($sets !== -1) 
		return $sets;
	
	// on recupere l'ensemble des barres d'outils connues
	if (!$sets = find_all_in_path('barre_outils/','.*[.]php')
	or !is_array($sets)) {
		spip_log("[Scandale] Porte Plume ne trouve pas de barre d'outils !");
		$sets = false;
		return $sets;
	}
		
	foreach($sets as $fichier=>$adresse) {
		$sets[$fichier] = substr($fichier,0,-4); // juste le nom
	}
	return $sets;	
}

/**
 * filtre appliquant les traitements SPIP d'un champ (et eventuellement d'un type d'objet) sur un texte
 * (voir la fonction champs_traitements($p) dans : public/references.php)
 * ce mecanisme est a preferer au traditionnel #TEXTE*|propre
 * traitements_previsu() consulte la globale $table_des_traitements et applique le traitement adequat
 * si aucun traitement n'est trouve, alors propre() est applique
 * 
 * @param string $texte : texte source
 * @param string $nom_champ : champ (en majuscules)
 * @param string $type_objet : objet (en minuscules)
 * @return string : texte traite
 */
function traitements_previsu($texte, $nom_champ='', $type_objet='', $connect=null) {
	include_spip('public/interfaces'); // charger les traitements
	safehtml($t);
	global $table_des_traitements;
	if(!strlen($nom_champ) || !isset($table_des_traitements[$nom_champ])) {
		$texte = propre($texte, $connect);
	}
	else {
		include_spip('base/abstract_sql');
		$table = table_objet($type_objet);
		$ps = $table_des_traitements[$nom_champ];
		if(is_array($ps))
			$ps = $ps[(strlen($table) && isset($ps[$table])) ? $table : 0];
		if(!$ps)
			$texte = propre($texte, $connect);
		else
			// remplacer le placeholder %s par le texte fourni
			eval('$texte=' . str_replace('%s', '$texte', $ps) . ';');
	}
	// il faut toujours securiser le texte preivusalise car il peut contenir n'importe quoi
	// et servir de support a une attaque xss ou vol de cookie admin
	// on ne peut donc se fier au statut de l'auteur connecte car le contenu ne vient pas
	// forcement de lui
	return safehtml($texte);
}
?>

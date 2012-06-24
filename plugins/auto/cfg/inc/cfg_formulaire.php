<?php

/**
 * Plugin générique de configuration pour SPIP
 *
 * @license    GNU/GPL
 * @package    plugins
 * @subpackage cfg
 * @category   outils
 * @copyright  (c) toggg, marcimat 2007-2008
 * @link       http://www.spip-contrib.net/
 * @version    $Id: cfg_formulaire.php 46896 2011-04-20 11:05:37Z marcimat@rezo.net $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;



/**
 * la classe cfg represente une page de configuration
 *
 * @package    plugins
 * @subpackage cfg
 */
class cfg_formulaire{

	/**
	 * les parametres des formulaires cfg sont stockes dans cet objet
	 * @var Array 
	 */
	var $param;
	
	/**
	 * l'objet de classe cfg_depot qui assure lecture/ecriture/effacement des config
	 * @var <type> 
	 */
	var $depot = null;

	/**
	 * le fond html utilise , en general pour config simple idem $nom
	 * @var string 
	 */
	var $vue = '';

	/**
	 * l'adresse du fond html (sans l'extension .html)
	 * @var string 
	 */
	var $path_vue = '';

	/**
	 * provient-on d'un formulaire de type CVT (charger/verifier/traiter) dans formulaires/ ?
	 * @var boolean
	 */
	var $depuis_cvt = false;

	/**
	 * compte-rendu des mises a jour
	 * @var Array
	 */
	var $messages = array('message_ok'=>array(), 'message_erreur'=>array(), 'erreurs'=>array());

	/**
	 * les champs trouve dans le fond
	 * @var Array
	 */
	var $champs = array();

	/**
	 * les champs index
	 * @var Array
	 */
	var $champs_id = array();

	/**
	 * leurs valeurs
	 * @var Array
	 */
	var $val = array();

	/**
	 * pour tracer les valeurs modifiees
	 * @var string
	 */
	var $log_modif = '';

	/**
	 * contenu du fichier de formulaire
	 * @var string
	 */
	var $controldata ='';

	/**
	 * stockage du fond compile par recuperer_fond()
	 * @var <type>
	 */
	var $fond_compile = '';

	/**
	 * y a t-il des extensions (classes css 'type_{nom}' ou 'cfg_{nom}' sur champs) a traiter ?
	 * @var Array
	 */
	var $extensions = array();

	/**
	 * Alias pour passer facilement les parametres aux classes appelees
	 * @var Array
	 */
	var $params = array();

	/**
	 * Constructeur de la classe
	 * 
	 * @param string $nom
	 * @param string $cfg_id
	 * @param Array $opt 
	 */
	function cfg_formulaire($nom, $cfg_id = '', $opt = array())
	{
		$this->param = array(
			'afficher_messages' => true, // afficher ce compte rendu ?
			'autoriser' => 'configurer',	// le "faire" de autoriser($faire), par defaut, autoriser_configurer_dist()	
			'autoriser_absence_id' => 'non', // autoriser l'insertion de nouveau contenu dans une table sans donner d'identifiant ?
			'casier' => '', // sous tableau optionel du meta ou va etre stocke le fragment de config
			'cfg_id' => '', // pour une config multiple , l'id courant
			'descriptif' => '', // descriptif
			'depot' => 'metapack', // (ancien 'storage') le depot utilise pour stocker les donnees, par defaut metapack: spip_meta serialise 
			'fichier' => '', // pour storage php, c'est l'adresse du fichier (depuis la racine de spip), sinon ca prend /local/cfg/nom.php
			'gauche' => '', // pour une colonne à gauche
			'head' => '', // partie du fond cfg a inserer dans le head par le pipeline header_prive (todo insert_head?)
			'icone' => '', // lien pour une icone
			'inline' => '', // code qui sera insere apres le contenu du fond (peut servir pour inserer du js)
			'interpreter' => 'oui', // si interpreter vaut 'non', le fond ne sera pas traite comme un fond cfg, mais comme une inclusion simple (pas de recherche des champs de formulaires). Cela permet d'utiliser des #FORMULAIRES_XX dans un fonds/ tout en utilisant la simplicite des parametres <!-- liens=.. --> par exemple.
			'liens' => array(), // liens optionnels sur des sous-config <!-- liens*=xxx -->
			'liens_multi' => array(), // liens optionnels sur des sous-config pour des fonds utilisant un champ multiple  <!-- liens_multi*=xxx -->
			'nom' => '', // le nom du meta (ou autre) ou va etre stocke la config concernee
			'onglet' => 'oui', // cfg doit-il afficher un lien vers le fond sous forme d'onglet dans la page ?exec=cfg
			'presentation' => 'auto', // cfg doit-il encadrer le formulaire tout seul ?
			'refus' => '', // en cas de refus d'autorisation, un message informatif [(#REM) refus=...]
			'table' => '', // nom de la table sql pour storage extra ou table
		);
		$this->param['nom'] = $this->vue = $nom;
		$this->param['cfg_id'] = $cfg_id;

		// exception flagrante : le formulaire 'configurer'
		// si c'est un formulaire generique, le nom et l'id ne sont pas bon.
		if ($this->vue == 'configurer') {
			$this->param['nom'] = $cfg_id;
			$this->param['cfg_id'] = '';
		}
				
		// definition de l'alias params
		$this->params = array(
			'champs' => &$this->champs, 
			'champs_id' => &$this->champs_id,
			'messages' => &$this->messages,
			'val' => &$this->val,
			'param' => &$this->param
		);	
		
		foreach ($opt as $o=>$v) {
			$this->$o = $v;
		}    
		// charger les donnees du fond demande
		$this->charger();
	}
	
	/**
	 * retourne true en cas d'erreur...
	 * 
	 * @return boolean 
	 */
	function erreurs(){
		return $this->messages['erreurs'] || $this->messages['message_erreur'];
	}

	/**
	 * ajoute une erreur sur un champ donne
	 * 
	 * @param string $champ
	 * @param string $message 
	 */
	function ajouter_erreur($champ, $message) {
		$this->messages['erreurs'][$champ] = isset($this->messages['erreurs'][$champ]) 
			? $this->messages['erreurs'][$champ] .= '<br />' . $message
			: $message;
	}
	
	/**
	 * ajoute des erreurs sur les champs indiques dans le tableau
	 * (comme verifier de cvt)
	 * 
	 * @param Array $err
	 * @return boolean 
	 */
	function ajouter_erreurs($err) {
		if (!is_array($err)) return false;
		if (isset($err['message_erreur']) && $err['message_erreur']) 
			$this->messages['message_erreur'][] = $err['message_erreur'];
		if (isset($err['message_ok']) && $err['message_ok']) 	
			$this->messages['message_ok'][] = $err['message_ok'];
		unset($err['message_erreur'], $err['message_ok']);
		if ($err) $this->messages['erreurs'] = $err;		// ou un merge ?? //
		return true;
	}
	
	
	/**
	 * pre-analyser le formulaire,
	 * c'est a dire recuperer les parametres CFG 
	 * et les noms des champs du formulaire	
	 * 
	 * @return boolean 
	 */
	function charger(){
		$ok = true;
		
		// si pas de fichier, rien a charger
		if (!$this->vue) return false;

		// lecture de la vue (fond cfg)
		// il s'agit de recuperer le contenu du fichier
 		if (!$fichier = find_in_path($nom = 'fonds/cfg_' . $this->vue .'.html')){
			if ($fichier = find_in_path($nom = 'formulaires/' . $this->vue .'.html'))
				$this->depuis_cvt = true;
		}
		
		// si pas de fichier, rien a charger
		if (!$fichier) return false;
		
		if (!lire_fichier($fichier, $this->controldata)) {
			$ok = false;
			$this->messages['message_erreur'][] =  _T('cfg:erreur_lecture', array('nom' => $nom));
		} else {
			$this->path_vue = substr($fichier,0,-5);
		}		

		// recherche et stockage des parametres de cfg 
		$this->recuperer_parametres();

		// si le fond ne doit pas etre calcule comme un fond CFG,
		// on s'arrete ici. De cette maniere, CFG ne prendra pas
		// comme des champs a recuperer les champs issus d'un autre formulaire
		// CFG inclu depuis un formulaire CVT via #FORMULAIRE_XX
		if ($this->param['interpreter'] == 'non')
			return true;
			
		// recherche et stockage des noms de champs de formulaire
		if ($err = $this->recuperer_noms_champs()){
			$ok = false;
			$this->messages['message_erreur'][] = $err;
		}
	    
		// charger les champs particuliers si existants
		$this->actionner_extensions('pre_charger');	  
		  
		// creer le storage et lire les valeurs
		$this->param['depot'] = strtolower(trim($this->param['depot']));
		include_spip('inc/cfg_config');
		$this->depot = new cfg_depot($this->param['depot'], $this->params);
		$ok &= $this->lire();

		// charger les champs particuliers si existants
		$this->actionner_extensions('charger');
		
		return $ok;
	}

	/**
	 * Doit controler la validite des valeurs transmises
	 * 
	 * Verifie les valeurs postees.
	 * - stocke les valeurs qui ont changees dans $this->val[$nom_champ] = 'nouvelle_valeur'
	 * - verifie que les types de valeurs attendus sont corrects ($this->verifier_champs_types)
	 * 
	 * retourne les messages d'erreur
	 * @return boolean|string 
	 */
	function verifier() {

		if ($this->erreurs() || !$this->autoriser()) 
				return false;

		// si on a pas poste de formulaire, pas la peine de controler
		// ce qui mettrait de fausses valeurs dans l'environnement
		if  (!_request('_cfg_ok') && !_request('_cfg_delete')) return true;

		// les formulaires CVT ont deja leurs securites
		if (!$this->depuis_cvt) {
			$securiser_action = charger_fonction('securiser_action', 'inc');
			$securiser_action();
		}

		// actions par champs speciaux, avant les tests des nouvelles valeurs
		$this->actionner_extensions('pre_verifier');
		
		// stockage des nouvelles valeurs
		foreach ($this->champs as $name => $def) {
			// enregistrement des valeurs postees
			$oldval = $this->val[$name];
		    $this->val[$name] = _request($name);
		    
		    // tracer les modifications
		    if ($oldval != $this->val[$name]) {
		    	$this->log_modif .= $name . ':' . var_export($oldval, true) . '/' . var_export($this->val[$name], true) .', ';
		    }
		}
	    
		// si pas de changement, pas la peine de continuer
		if (!$this->log_modif && !_request('_cfg_delete')) {
			$this->messages['message_erreur'][] = _T('cfg:pas_de_changement', array('nom' => $this->nom_config()));
			return false;
		}
		
		// verifier la validite des champs speciaux (cfg_xx, type_xx)
		$this->actionner_extensions('verifier');
		
		// stocker le fait que l'on a controle les valeurs
		$this->verifier = true;
	    return !$this->erreurs();
	}
	
	/**
	 * Gere le traitement du formulaire.
	 * 
	 * Si le chargement ou le controle n'ont pas ete fait,
	 * la fonction s'en occupe.
	 *
	 * @return boolean
	 */
	function traiter()
	{
		if (!$this->verifier) $this->verifier();
		
		if ($this->erreurs() || !$this->autoriser()) return false;
	
		if (!_request('_cfg_ok') && !_request('_cfg_delete')) return false;
		
		// les formulaires CVT ont deja leurs securites
		if (!$this->depuis_cvt) {
			$securiser_action = charger_fonction('securiser_action', 'inc');
			$securiser_action();
		}
		
		$this->actionner_extensions('pre_traiter');	
		
		if ($this->erreurs()) return false;		
			
		// suppression
		if (_request('_cfg_delete')) {
			$this->effacer();
		
		// sinon modification
		} else {
			$this->ecrire();
		}

		// pipeline 'cfg_post_edition' ? (quelqu'un utilise ??)
		$this->messages = pipeline('cfg_post_edition',array('args'=>array('nom_config'=>$this->nom_config()),'data'=>$this->messages));

		$this->actionner_extensions('post_traiter');

		// annuler le cache de SPIP
		include_spip('inc/invalideur');
		suivre_invalideur('cfg/' . $this->param['nom'] .
			($this->param['casier'] ? '/' . $this->param['casier'] : '') .
			($this->param['cfg_id'] ? '/' . $this->param['cfg_id'] : ''));		
	}

	/**
	 * Determine l'arborescence ou CFG doit chercher les valeurs deja enregistrees
	 * 
	 * si nom=toto, casier=chose/truc, cfg_id=2, 
	 * cfg cherchera dans #CONFIG{toto/chose/truc/2}
	 *
	 * @return string
	 */
	function nom_config()
	{
	    return $this->param['nom'] . 
	    		($this->param['casier'] ? '/' . $this->param['casier'] : '') .
	    		($this->param['cfg_id'] ? '/' . $this->param['cfg_id'] : '');
	}

	/**
	 * Recherche et stockage
	 * des parametres #REM passes a CFG
	 * 
	 * @deprecated (DEPRECIE)
	 */
	function recuperer_parametres_rem(){
		// cas de #REM (deprecie)
		preg_replace_callback('/(\[\(#REM\) ([a-z0-9_]\w+)(\*)?=)(.*?)\]/sim',
					array(&$this, 'post_params'), $this->controldata);
	}

	/**
	 * cette fonction recherche et stocke les parametres passes a cfg par <!-- param=valeur -->
	 * ces lignes sont alors effacees du code html. Ces proprietes sont lues apres recuperer_fond(),
	 * et interpretent donc les balises spip et les chaines de langues
	 *
	 * si la fonction est appelee 2 fois, les parametres identiques ne seront pas copies
	 * sauf si le parametre est un tableau (<!-- param*=valeur -->), les valeurs seront dupliquees
	 */
	function recuperer_parametres(){

		// pour compatibilite, recuperer l'ancien code #REM
		$this->recuperer_parametres_rem();	
		
		$this->recuperer_fond();
		$this->fond_compile = preg_replace_callback('/(<!-- ([a-z0-9_]\w+)(\*)?=)(.*?)-->/sim',
							array(&$this, 'post_params'), $this->fond_compile);

		// s'il en reste : il y a un probleme !
		// est-ce utile de tester ça ?
		if (preg_match('/<!-- [a-z0-9_]\w+\*?=/', $this->fond_compile)) {
			die('Un parametre CFG n\'a pas pu etre importe depuis '.$this->vue);
		}

		// pour compatibilite avec les anciennes versions (<1.4.1)
		if (isset($this->param['storage'])) 
			$this->param['depot'] = $this->param['storage'];
		
		if ($this->param['depot'] == 'classic')
			$this->param['depot'] = 'meta';
			
		if ($this->param['depot'] == 'extrapack'){
			$this->param['depot'] = 'tablepack';
			$this->param['colonne'] = 'extra';
			$this->param['table'] = 'spip_auteurs';
		}
		
		// definir les parametres qui sont a traiter comme des extensions
		// il faut que le parametre ne soit pas vide et qu'un fichier 
		// /cfg/params/{param}.php existe
		$this->extensions_parametres = array();
		foreach ($this->param as $nom=>$val){
			if ($val) $this->ajouter_extension_parametre($nom);		
		}
	}

	/**
	 * une fonction pour effacer les parametres du code html
	 * ce qui evite de dupliquer les tableaux 
	 * (si on utilisait recuperer_parametres() a la place)
	 */
	function effacer_parametres(){
		$this->fond_compile = preg_replace('/(<!-- ([a-z0-9_]\w+)(\*)?=)(.*?)-->/sim', '', $this->fond_compile);		
	}
	
	/**
	 * Recherche  des noms des champs (y) du formulaire <input type="x" name="y"... />
	 * stockes dans le tableau $this->champs
	 * a l'exception des noms par _cfg_, reserves a ce plugin
	 *
	 * @return string
	 */
	function recuperer_noms_champs(){	
		if (!$this->vue) return;

		// recherche d'au moins un champ de formulaire pour savoir si la vue est valide
		$this->recuperer_fond();
		if (!preg_match_all(
		/*  '#<(?:(select|textarea)|input type="(text|password|checkbox|radio|hidden|file)") name="(\w+)(\[\])?"(?: class="[^"]*?(?:type_(\w+))?[^"]*?(?:cfg_(\w+))?[^"]*?")?( multiple=)?[^>]*?>#ims', */
		  '#<(?:(select|textarea)|input type="(text|password|checkbox|radio|hidden|file)") name="(\w+)(\[\])?"(?: class="([^"]*)")?( multiple=)?[^>]*?>#ims',
						$this->fond_compile, $matches, PREG_SET_ORDER)) {
			return _T('cfg:pas_de_champs_dans', array('nom' => $this->vue));
		}
		
		foreach ($matches as $regs) {
			$name = $regs[3];
			if (substr($name, 0, 5) == '_cfg_') continue;

			$this->champs[$name] = array('balise' => $regs[1]); 
			// input type
		    if ($regs[2]) $this->champs[$name]['type'] = $regs[2];
		    // champs tableau[]
			if ($regs[4]) $this->champs[$name]['tableau'] = true;

			//
			// Extensions et validations des champs
			// via les classes css
			//
			// attention : ordre important : <balise (type="xx")? name="xx" class="xx" multiple="xx" />
			//
			if ($regs[5]) {
				$tcss = explode(' ',trim($regs[5]));
				foreach($tcss as $css){
					// classes css type_xx
					if (substr($css,0,5)=='type_') {
						$this->ajouter_extension($css, $name);
					// classes css cfg_xx
					} elseif (substr($css,0,4)=='cfg_') {
						$this->champs[$name]['cfg'] = substr($css,4); // juste 'id' si classe = cfg_id
						$this->ajouter_extension($css, $name);
					}
				}
			}
			
			// cas particulier automatiques : 
			// * input type file => type de verification : fichier
			if (($regs[2] == 'file') AND (!$this->champs[$name]['cfg'])){
				$this->champs[$name]['cfg'] = 'fichier';
				$this->ajouter_extension('cfg_fichier', $name);	
			}
			
	    }

	    return '';
	}	 
	
	/**
	 * ajoute une extension (classe cfg_xx ou type_xx) 
	 * 
	 * ce qui dit a cfg d'executer des fonctions particulieres
	 * si elles existent : ex: cfg_traiter_cfg_xx()
	 * lors de l'appel de 'actionner_extensions($faire)'
	 *
	 * @param string $ext
	 * @param string $nom
	 */
	function ajouter_extension($ext, $nom){
		if (!is_array($this->extensions[$ext])) $this->extensions[$ext] = array();
		$this->extensions[$ext][] = $nom;	
	}

	/**
	 * ajoute une extension sur un parametre
	 * seulement si un fichier sur ce parametre existe
	 *
	 * @param string $param
	 * @return boolean
	 */
	function ajouter_extension_parametre($param){
		if (in_array($param, $this->extensions_parametres))
			return true;
		
		if (find_in_path('cfg/params/'.$param.'.php')){
			$this->extensions_parametres[] = $param;
			return true;
		}
		return false;
	}
	
	/**
	 * Compiler le fond CFG si ce n'est pas fait
	 * 
	 * @param Array $contexte
	 * @param boolean $forcer
	 * @return string
	 */
	function recuperer_fond($contexte = array(), $forcer = false){

		if (!$this->fond_compile OR $forcer){
			include_spip('inc/presentation'); // offrir les fonctions d'espace prive
			include_spip('public/assembler');
			
			// rendre editable systematiquement
			// sinon, ceux qui utilisent les fonds CFG avec l'API des formulaires dynamiques
			// et mettent des [(#ENV**{editable}|oui) ... ] ne verraient pas leurs variables
			// dans l'environnement vu que CFG ne pourrait pas lire les champs du formulaire

			if ($this->depuis_cvt)
				if (!isset($contexte['editable'])) $contexte['editable'] = true; // plante 1.9.2 !!
		
			// passer cfg_id...
			if (!isset($contexte['cfg_id']) && $this->param['cfg_id']) {
				$contexte['cfg_id'] = $this->param['cfg_id'];
			}
			// passer id aussi
			if (!isset($contexte['id']) && $this->param['cfg_id']) {
				$contexte['id'] = $this->param['cfg_id'];
			}
			// passer 'message_ok', 'message_erreur', 'erreurs'	
			if (!isset($contexte['message_ok']) && $this->messages['message_ok']) {
				$contexte['message_ok'] = join('<br />',$this->messages['message_ok']);
			}
			if (!isset($contexte['message_erreur']) && $this->messages['message_erreur']) {
				$contexte['message_erreur'] = join('<br />',$this->messages['message_erreur']);
			}
			if (!isset($contexte['erreurs']) && $this->messages['erreurs']) {
				$contexte['erreurs'] = $this->messages['erreurs'];
			}

			// cas particulier du formulaire generique 'configurer'
			if ($this->vue == 'configurer') {
				if (!isset($contexte['id'])) {
					$contexte['id'] = $this->param['nom'];
				}
			}
						
			$val = $this->val ? array_merge($contexte, $this->val) : $contexte;
	
			// si on est dans l'espace prive, $this->path_vue est
			// de la forme ../plugins/mon_plugin/fonds/toto, d'ou le replace
			$this->fond_compile = recuperer_fond(
				substr($this->path_vue, strlen(_DIR_RACINE)), $val);
		}
		return $this->fond_compile;
	}

	/**
	 * Verifie les autorisations 
	 * d'affichage du formulaire
	 * (parametre autoriser=faire)
	 *
	 * @staticvar int $autoriser
	 * @return int
	 */
	function autoriser()
	{
		static $autoriser=-1;
		if ($autoriser !== -1) return $autoriser;

		// on peut passer 'oui' ou 'non' directement au parametre autoriser
		if ($this->param['autoriser'] == 'oui')
			return $autoriser = 1;
		if ($this->param['autoriser'] == 'non') {
			$this->messages['message_refus'] = $this->param['refus'];
			return $autoriser = 0;
		}
		// sinon, test de l'autorisation
		// <!-- autoriser=webmestre -->
		// <!-- autoriser=configurer -->
		include_spip('inc/autoriser');
		if (!$autoriser = autoriser($this->param['autoriser'])){
			$this->messages['message_refus'] = $this->param['refus'];
		}
		return $autoriser;
	}

	/**
	 * Log le message passe en parametre
	 * $this->log('message');
	 *
	 * @param string $message
	 */
	function log($message)
	{
		($GLOBALS['auteur_session'] && ($qui = $GLOBALS['auteur_session']['login']))
		|| ($qui = $GLOBALS['ip']);
		spip_log('cfg (' . $this->nom_config() . ') par ' . $qui . ': ' . $message);
	}

	/**
	 * lit les donnees depuis le depot
	 * 
	 * @return boolean
	 */
	function lire(){
		list ($ok, $val, $messages) = $this->depot->lire($this->params);
		if ($messages) $this->messages = $messages;
		if ($ok) {
			$this->val = $val;	
		} else {
			$this->messages['message_erreur'][] = _T('cfg:erreur_lecture', array('nom' => $this->nom_config()));
		}
		return $ok;
	}
	
	
	/**
	 * Ecrit les donnees dans le depot
	 *
	 * @return string
	 */
	function ecrire() {
		list ($ok, $val, $messages) = $this->depot->ecrire($this->params);
		if ($messages) $this->messages = $messages;
		if ($ok){
			$this->val = $val;
			$this->messages['message_ok'][] = $msg = _T('cfg:config_enregistree', array('nom' => $this->nom_config()));
		} else {
			$this->messages['message_erreur'][] = $msg =  _T('cfg:erreur_enregistrement', array('nom' => $this->nom_config()));
		}
		$this->log($msg . ' ' . $this->log_modif);
		return $msg;
	}

	/**
	 * Efface les donnees dans le depot
	 *
	 * dans le cas d'une suppression, il faut vider $this->val qui
	 * contient encore les valeurs du formulaire, sinon elles sont
	 * passees dans le fond et le formulaire garde les informations
	 * d'avant la suppression
	 *
	 * @return string
	 */
	function effacer(){
		list ($ok, $val, $messages) = $this->depot->effacer($this->params);
		if ($messages) $this->messages = $messages;
		if ($ok) {
			$this->val = $val;
			$this->messages['message_ok'][] = $msg = _T('cfg:config_supprimee', array('nom' => $this->nom_config()));
		} else {
			$this->messages['message_erreur'][] = $msg = _T('cfg:erreur_suppression', array('nom' => $this->nom_config()));
		}
		$this->log($msg);	
		return $msg;	
	}

	/**
	 * Fabriquer les balises des champs d'apres un modele fonds/cfg_<driver>.html
	 * $contexte est un tableau (nom=>valeur)
	 * qui sera enrichi puis passe a recuperer_fond
	 *
	 * @param Array $contexte
	 * @return string
	 */
	function formulaire($contexte = array())
	{
		if (!$this->path_vue)
			return '';

		if (!$this->depuis_cvt)
			$contexte['_cfg_'] = $this->creer_hash_cfg();
	
		// recuperer le fond avec le contexte
		// forcer le calcul.
		$this->recuperer_fond($contexte, true);
		$this->recuperer_parametres();
		//$this->effacer_parametres(); // pour enlever les <!-- param=valeur --> ... sans dedoubler le contenu lorsque ce sont des tableau (param*=valeur)
		return $this->fond_compile;
	}
	
	
	/**
	 *
	 * @param string $action
	 * @return string
	 */
	function creer_hash_cfg($action=''){
		include_spip('inc/securiser_action');
	    $arg = 'cfg0.0.0-' . $this->param['nom'] . '-' . $this->vue;
		return 
			'?cfg=' . $this->vue .
			'&cfg_id=' . $this->param['cfg_id'] .
		    '&arg=' . $arg .
		    '&hash=' .  calculer_action_auteur($action . '-' . $arg);		
	}
	
	
	/**
	 * teste et charge les points d'entrees de CFG a travers certaines actions
	 *
	 * <ol>
	 * <li> : fonctions generales cfg_{nom}_{action}</li>
	 * <li> : actions sur les types de champs particuliers
	 *     notifies par 'type_XX' ou 'cfg_YY' sur les classes css
	 *     s'ils existent dans /cfg/classes/ par des fonctions
	 *     cfg_{action}_{classe}</li>
	 * <li> : actions en fonctions des parametres du formulaire
	 *     s'ils existent dans /cfg/params/ par des fonctions
	 *     cfg_{action}_{parametre}</li>
	 * </ol>
	 *
	 * les actions possibles sont :
	 * - pre_charger, charger,
	 * - pre_verifier, verifier,
	 * - pre_traiter, post_traiter
	 *
	 * @param string $action
	 */
	function actionner_extensions($action){
		// 1 - general : on transmet l'instance de cfg_formulaire
		if (function_exists($f = 'cfg_' . $this->vue . '_' . $action)) {
			$res = $f($this);
			// compat ascendante (1.7 a 1.10.2) : verifier retournait un array comme cvt
			// il faut envoyer le resultat dans la fonction d'ajout des erreurs
			if ($action == 'verifier' AND is_array($res))
				$this->ajouter_erreurs($res);
		} 
		// 2 - type de champ : on transmet le nom du champ et l'instance de cfg_formulaire
		if ($this->extensions) {
			foreach ($this->extensions as $type => $champs){
				// si un fichier de ce type existe, on lance la fonction 
				// demandee pour chaque champs possedant la classe css en question
				if (include_spip('cfg/classes/'.$type)) {
					foreach ($champs as $champ){
						if (function_exists($f = 'cfg_' . $action . '_' . $type)){ // absence possible normale
							$f($champ, $this);
						}
					}
				}	
			}
		}
		// 3 - parametre : on transmet la valeur du parametre et l'instance de cfg_formulaire
		if ($this->extensions_parametres){
			foreach ($this->extensions_parametres as $param){
				if (include_spip('cfg/params/'.$param)) {
					if (function_exists($f = 'cfg_' . $action . '_param_' . $param)){ // absence possible normale
						// artillerie lourde on passe
						// la valeur et la classe
						$f($this->param[$param], $this);						
					}
				}
			}
		}
	}
	
	/**
	 *callback pour interpreter les parametres objets du formulaire
	 * commun avec celui de set_vue()
	 *
	 * Parametres :
	 * - $regs[2] = 'parametre'
	 * - $regs[3] = '*' ou ''
	 * - $regs[4] = 'valeur'
	 *
	 * Lorsque des parametres sont passes dans le formulaire
	 * par <!-- param=valeur --><br>
	 * stocker $this->param['parametre']=valeur
	 *
	 * Si <!-- param*=valeur --><br>
	 * Stocker $this->param['parametre'][]=valeur
	 *
	 * @param Array $regs
	 * @return string
	 */
	function post_params($regs) {

		// $regs[3] peut valoir '*' pour signaler un tableau
		$regs[4] = trim($regs[4]);
		
		if (empty($regs[3])) {
		    $this->param[$regs[2]] = $regs[4];
		} elseif (is_array($this->param[$regs[2]])) {
		    $this->param[$regs[2]][] = $regs[4];
		}
		// plus besoin de garder ca
		return '';
	}
}

?>

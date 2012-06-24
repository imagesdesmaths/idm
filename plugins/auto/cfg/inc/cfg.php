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
 * @version    $Id: cfg.php 38187 2010-05-14 18:31:13Z esj@rezo.net $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;



/**
 * Renvoie la liste des configurations disponibles dans le path
 * ou dans le dossier donne en argument
 * 
 * @param string $dir
 * @return Array
 */
function liste_cfg($dir='') {
	// Faire la liste des elements qui ont un cfg ; ca peut etre des plugins
	// mais aussi des squelettes ou n'importe quoi
	$liste = array();
	// tous les repertoires
	if (!$dir){
		foreach (creer_chemin() as $dir) {
			$liste = array_merge($liste, preg_files($d=$dir.'fonds/', $d.'cfg_[^/]*[.]html$'));
		}
	// ou seulement celui demande
	} else {	
		$dir = rtrim(rtrim($dir),'/').'/';
		$liste = preg_files($d=$dir.'fonds/', $d.'cfg_[^/]*[.]html$');
	}

	if ($liste) {
		$l = array();
		foreach($liste as $cfg) {
			$fonds = substr(basename($cfg,'.html'),4);
			$l[$fonds] = $cfg;
		}
		ksort($l);
		return $l;
	}
}

/**
 * Renvoie une icone avec un lien vers la page de configuration d'un repertoire donné
 * 
 * @param string $dir
 * @return string
 */
function icone_lien_cfg($dir, $script='cfg') {
	$ret = '';
	if ($onglets = lister_onglets_cfg($dir, $script)){
		foreach ($onglets as $fonds=>$ong){
			if ($ong['afficher'])
				$ret .= '<a href="'.$ong['url'].'">'
					.'<img src="'._DIR_PLUGIN_CFG.'cfg-16.png"
						width="16" height="16"
						alt="'._T('icone_configuration_site').' '.$fonds.'"
						title="'._T('icone_configuration_site').' '.$fonds.'"
					/></a>';					
		}
	}

	return $ret;
}



/**
 * retourne un tableau contenant une liste de fonds cfg et leurs parametres
 * d'onglet (oui/non/titre_parent), plus quelques autres parametres (url, titre, icone),
 * pour un repertoire donne (sinon tout le path)
 * 
 * @param string $dir
 * @return string
 */
function lister_onglets_cfg($dir='', $script='cfg'){
	$onglets = array();
	
	// scruter les onglets affichables
	if ($l = liste_cfg($dir)) {
		foreach($l as $fonds => $cfg) {

			if (!isset($onglets[$fonds])) 
				$onglets[$fonds] = array();
			$args = array();
			$args['afficher'] = false;
			
			// On va chercher la config cible
			// et on regarde ses donnees pour faire l'onglet
			// seulement si l'onglet doit etre affiche
			include_spip('inc/cfg');
			$tmp = new cfg($fonds);

			if ($tmp->autoriser()){
				$args['onglet'] = $tmp->form->param['onglet'];
				$args['url'] = generer_url_ecrire($script, 'cfg='.$fonds);
				// titre
				if (!$args['titre'] = $tmp->form->param['titre'])
					$args['titre'] = $fonds;
				// icone	
				$path = dirname(dirname($cfg));	
				$args['icone'] = '';
				if ($tmp->form->param['icone'])
					$args['icone'] = $path.'/'.$tmp->form->param['icone'];
				else if (file_exists($path.'/plugin.xml'))
					$args['icone'] = 'plugin-24.gif';
				else
					$args['icone'] = _DIR_PLUGIN_CFG.'cfg-doc-22.png';	
				
				// l'afficher ?
				if ($tmp->form->param['onglet'] == 'oui')
					$args['afficher'] = true;
			}
			
			$onglets[$fonds] = array_merge($args, $onglets[$fonds]); // conserver les donnees deja presentes ('enfant_actif')
		}
	}
	return $onglets;	
}
	


/**
 * la classe cfg represente une page de configuration
 *
 * @package    plugins
 * @subpackage cfg
 */
class cfg
{
	var $form; // la classe cfg_formulaire
	
	/**
	 *
	 * @param string $nom
	 * @param string $cfg_id
	 * @param Array $opt
	 */
	function cfg($nom, $cfg_id = '', $opt = array()) {
		include_spip('inc/cfg_formulaire');
		$this->form = new cfg_formulaire($nom, $cfg_id, $opt);
	}

	/**
	 * Controller les droits pour traiter le formulaire de config
	 *
	 * @return int # 0 ou 1
	 */
	function autoriser()  {return $this->form->autoriser(); }
	
	/**
	 *
	 * @return boolean
	 */
	function traiter()  {return $this->form->traiter();}
	
	/**
	 *
	 * @return string
	 */
	function get_titre(){ return $this->form->param['titre'];}
	
	/**
	 *
	 * @return string
	 */
	function get_nom()  { return $this->form->param['nom'];}
	
	/**
	 *
	 * @return string
	 */
	function get_boite(){ 
		if (!(($titre = $this->form->param['titre']) && ($boite = $this->form->param['boite']))){
			$boite=($titre)?$titre: _T('icone_configuration_site') . ' ' . $this->form->param['nom'];
		}
		return $boite;
	}

	/**
	 * pour pouvoir testé si la presentation des formulaires doit etre appliquee ou non
	 * m'est avis que ca devrait virer cette 'presentation=auto'...
	 * c'est comme 'rediriger', il n'y a que le plugin 'autorite' qui l'utilise
	 * 
	 * @return string
	 */
	function get_presentation() { return $this->form->param['presentation'];	}
	
	/**
	 * Affiche la boite d'info des liens vers les autres fonds CFG
	 *
	 * Les liens sont definis par la variable liens
	 * <code><!-- liens*=moncfg --></code>
	 * s'il y a une chaine de langue 'moncfg', le texte sera traduit
	 * ou
	 * <code><!-- liens*=prefixe_plugin:moncfg --></code>
	 * pour utiliser la chaine de langue de prefixe_plugin
	 *
	 * @return string
	 */
	function liens()
	{
		$return = '';
		// liens simples
		foreach ($this->form->param['liens'] as $lien) {
			$nom = _T($lien);
			$lien =  array_pop(explode(':',$lien)); // ne garder que la derniere partie de la chaine de langue
			$return .= ($l = $this->generer_lien($lien, $nom)) ? "<li>$l</li>\n" : "";
		}
		return ($return)?"<ul>$return</ul>":'';
	}


	/**
	 * Affiche un lien vers le fond dont le nom ($lien)
	 * est passe en parametre
	 * a condition que le fichier fonds/cfg_$lien.html existe
	 *
	 * @param string $lien
	 * @param string $nom
	 * @return string
	 */
	function generer_lien($lien, $nom='')
	{
		// nom est une chaine, pas une cle de tableau.
		if (empty($nom) OR !is_string($nom)) $nom = $lien;
		if (!find_in_path('fonds/cfg_'.$lien.'.html')) return "";
		
		// si c'est le lien actif, pas de <a>
		if (_request('cfg') == $lien) 
			return "$nom\n";
		else
			return "<a href='" . generer_url_ecrire("cfg","cfg=$lien") . "'>$nom</a>\n"; // &cfg_id= <-- a ajouter ?
	}
	
	
	/**
	 * Les liens multi sont appelles par liens_multi*=nom_du_fond
	 * a condition que le fichier fonds/cfg_$lien.html existe
	 *
	 * @return string
	 */
	function liens_multi(){
		// liens multiples
		foreach ($this->form->param['liens_multi'] as $lien) {
			$nom = _T($lien);
			$lien =  array_pop(explode(':',$lien)); // ne garder que la derniere partie de la chaine de langue
			$return .= ($l = $this->generer_lien_multi($lien, $nom)) ? "<li>$l</li>\n" : "";
		}
		return ($return)?"<ul>$return</ul>":'';
	}

	/**
	 *
	 * @param string $lien
	 * @param string $nom
	 * @return string
	 */
	function generer_lien_multi($lien, $nom=''){
		// nom est une chaine, pas une cle de tableau.
		if (empty($nom) OR !is_string($nom)) $nom = $lien;
		if (!find_in_path('fonds/cfg_'.$lien.'.html')) return "";
		
		$dedans = '';
		if (($exi = lire_config($lien)) && is_array($exi)) {
			foreach ($exi as $compte => $info) {
				$lid = $lien . "_" . $compte;
				$dedans .= "\n<label for='$lid'>$compte</label>\n"
						.  "<input type='image' id='$lid' name='cfg_id' value='$compte' "
						.  "src='".find_in_path('images/triangle.gif')."' style='vertical-align: text-top;'/><br />\n";
			}
		}
		// On ajoute un bouton 'nouveau'
		return    "<form method='get' action='".generer_url_ecrire('')."'><div>\n"
				. "<h4>$nom</h4>\n"
				. "<input type='hidden' name='exec' value='cfg' />\n"
				. "<input type='hidden' name='cfg' value='$lien' />\n"
				. "<label for='$lien" . "_'>" . _T('cfg:nouveau') . "</label>\n"
				. "<input type='image' id='$lien" . "_' name='nouveau' value='1' "
				. "src='".find_in_path('images/creer.gif')."' style='vertical-align: text-top;'/><br />\n" 
				. $dedans
				. "\n</div></form>\n";
	
	}
	
	/**
	 * Affiche la liste des onglets de CFG
	 *
	 * Recupere les fonds CFG et analyse ceux-ci
	 * - si onglet=oui : affiche l'onglet (valeur par defaut)
	 * - si onglet=non : n'affiche pas l'onglet
	 * - si onglet=fond_cfg_parent : n'affiche pas l'onglet, mais 'exposera'
	 * l'element parent indique (sous entendu que
	 * le parent n'a pas 'onglet=non' sinon rien ne sera expose...
	 *
	 * @return string # Le code HTML
	 */
	function barre_onglets(){
		
		// determiner les onglets a cacher et a mettre en surbrillance
		if ($onglets = lister_onglets_cfg()){
			foreach ($onglets as $fonds=>$ong){
				$o = $ong['onglet'];

				// onglet actif
				if ($o == 'oui')	
					$onglets[$fonds]['actif'] = ($fonds == _request('cfg'));
				// rendre actif un parent si l'enfant est actif (onglet=nom_du_parent
				// (/!\ ne pas le desactiver s'il a deja ete mis actif)
				if ($o && $o!='oui' && $o!='non'){
					if (!isset($onglets[$o])) 
						$onglets[$o]=array();
					
					if (!isset($onglets[$o]['enfant_actif'])) 
						$onglets[$o]['enfant_actif']=false;
						
					$onglets[$o]['enfant_actif'] = ($onglets[$o]['enfant_actif'] OR $fonds == _request('cfg'));
				}
			}
		}

		// retourner le code des onglets selectionnes
		$res = "";
		if ($onglets) {
			$res = debut_onglet();
			$n = -1;
			foreach ($onglets as $titre=>$args){
				if ($args['afficher']){
					// Faire des lignes s'il y en a effectivement plus de 6
					if (!(++$n%6) && ($n>0))
						$res .= fin_onglet().debut_onglet();
						
					$res .= onglet(
							$args['titre'], 
							$args['url'], 
							'cfg', 
							($args['actif'] || $args['enfant_actif']), 
							$args['icone']);
				}	
			}
			
			$res .= fin_onglet();
			
		}
		return $res;
	}
	

	/**
	 * affiche le descriptif du formulaire
	 *
	 * @return string
	 */
	function descriptif(){
		if ($d = $this->form->param['descriptif'])
			return propre($d);	
	}
	
	/**
	 * affiche une colonne à gauche
	 *
	 * @return string
	 */
	function gauche(){
		if ($d = $this->form->param['gauche'])
			return propre($d);	
	}
	
	/**
	 * affiche le message en cas d'acces interdit
	 *
	 * @return string
	 */
	function acces_refuse(){
		include_spip('inc/minipres');
		return minipres(_T('info_acces_refuse'), 
			$this->form->param['refus']
				? $this->form->param['refus']
				: " (cfg {$this->form->param[nom]} - {$this->form->vue} - {$this->form->param[cfg_id]})");
	}
	
	/**
	 * afficher les messages de cfg
	 *
	 * @return string
	 */
	function messages(){
		$m = $this->form->messages; $messages = array();
		if (count($m['message_ok'])) 		$messages[] = join('<br />', $m['message_ok']);
		if (count($m['message_erreur'])) 	$messages[] = join('<br />', $m['message_erreur']);
		if (count($m['erreurs'])) 			$messages[] = join('<br />', $m['erreurs']);
		
		if ($messages = trim(join('<br />', $messages))) {
			return propre($messages);
		}
		return '';
	}
	
	/**
	 * affichage du formulaire (ou a defaut du texte 'choisir le module a configurer')
	 * 
	 * @return string
	 */
	function formulaire() {
		$retour = "";	
		if (!$formulaire = $this->form->formulaire()) {
			// Page appellee sans formulaire valable
			$retour .= "<img src='"._DIR_PLUGIN_CFG.'cfg.png'."' style='float:right' alt='' />\n";
			$retour .=  "<h3>" . _T("cfg:choisir_module_a_configurer") . "</h3>";
		} else {
			$retour .= $formulaire;
		}
		return $retour;
	}
}

?>

<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Romy Tetue
 * Licence GPL
 *
 */

// recuperer le nom du serveur,
// mais pas si c'est un serveur specifique (pour, connexion)
// attention, en SPIP 2.1, on recupere 'POUR' et non plus 'pour' comme en 2.0
// @param array $p, AST positionne sur la balise
// @return string nom de la connexion
function get_nom_serveur($p) {
	if (isset($p->boucles[$p->id_boucle])) {
		$s = $p->boucles[$p->id_boucle]->sql_serveur;
		if ($serveur = strtolower($s)
			AND $serveur!='pour'
			AND $serveur!='condition') {
				return $s;
		}
	}
	return "";
}

//
// #URL_ACTION_AUTEUR{converser,arg,redirect} -> ecrire/?action=converser&arg=arg&hash=xxx&redirect=redirect
//
// http://doc.spip.org/@balise_URL_ACTION_AUTEUR_dist
function balise_URL_ACTION_AUTEUR($p) {
	$p->descr['session'] = true;

	// si serveur externe, ce n'est pas possible
	if (get_nom_serveur($p)) {
		$p->code = 'generer_url_public("404")';
		return $p;
	}

	$p->code = interprete_argument_balise(1,$p);
	$args = interprete_argument_balise(2,$p);
	if (!$args)
		$args = "''";
	$p->code .= ",".$args;
	$redirect = interprete_argument_balise(3,$p);
	if ($redirect != "''" && $redirect!==NULL)
		$p->code .= ",".$redirect;

	$p->code = "generer_action_auteur(" . $p->code . ")";
	$p->interdire_scripts = false;
	return $p;
}
//
// #URL_ECRIRE{naviguer} -> ecrire/?exec=naviguer
//
// http://doc.spip.org/@balise_URL_ECRIRE_dist
function balise_URL_ECRIRE($p) {

	// si serveur externe, ce n'est pas possible
	if (get_nom_serveur($p)) {
		$p->code = 'generer_url_public("404")';
		return $p;
	}

	$code = interprete_argument_balise(1,$p);
	if (!$code)
		$fonc = "''";
	else{
		if (preg_match("/^'[^']*'$/", $code))
			$fonc = $code;
		else {$code = "(\$f = $code)"; $fonc = '$f';}
		$args = interprete_argument_balise(2,$p);
		if ($args != "''" && $args!==NULL)
			$fonc .= ',' . $args;
	}
	$p->code = 'generer_url_ecrire(' . $fonc .')';
	if (function_exists('tester_url_ecrire'))
		if ($code) 
			$p->code = "(tester_url_ecrire($code) ?" . $p->code .'  : "")';
	#$p->interdire_scripts = true;
	return $p;
}



// surplus de #URL_PAGE pour prendre en compte les boucles POUR et CONDITION
/* // ceci n'est pas suffisant car il faudrait traiter les autres types aussi
function generer_generer_url_pour($type, $code) {return 'generer_url_public(' . $code .')';}
function generer_generer_url_condition($type, $code) {return 'generer_url_public(' . $code .')';}
*/
function balise_URL_PAGE($p) {

	$p->code = interprete_argument_balise(1,$p);
	$args = interprete_argument_balise(2,$p);
	if ($args != "''" && $args!==NULL)
		$p->code .= ','.$args;

	// autres filtres (???)
	array_shift($p->param);

	if ($p->id_boucle
	AND $s = get_nom_serveur($p)) {

		if (!$GLOBALS['connexions'][$s]['spip_connect_version']) {
			$p->code = "404";
		} else {
			// si une fonction de generation des url a ete definie pour ce connect l'utiliser
			// elle devra aussi traiter le cas derogatoire type=page
			if (function_exists($f = 'generer_generer_url_'.$s)){
				$p->code = $f('page', $p->code, $s);
				return $p;
			}
			$p->code .=  ", 'connect=" .  addslashes($s) . "'";
		}
	}

	$p->code = 'generer_url_public(' . $p->code .')';
	#$p->interdire_scripts = true;
	return $p;
}


/**
 * #SET
 * Affecte une variable locale au squelette
 * #SET{nom,valeur}
 *
 * SURCHARGE DU CORE :
 * 		Affecte un filtre a une variable locale au squelette
 * 		#SET{nom,filtre,param1,param2,...,paramN}
 *
 * @param object $p : objet balise
 * @return ""
**/
/*
function balise_SET($p){
	$_code = array();

	$n=1;
	while ($_v = interprete_argument_balise($n++,$p))
		$_code[] = $_v;

	$_nom = array_shift($_code);
	$_valeur = array_shift($_code);
	if ($_nom AND $_valeur AND count($_code)) {
		$filtre = str_replace("'", "", strtolower($_valeur));
		$f = chercher_filtre($filtre);
		$p->code = "vide(\$Pile['vars'][$_nom]=$f(". join(', ',$_code)."))";
	} elseif ($_nom AND $_valeur)
		$p->code = "vide(\$Pile['vars'][$_nom] = $_valeur)";
	else
		$p->code = "''";

	$p->interdire_scripts = false; // la balise ne renvoie rien
	return $p;
}
*/


/**
 * Empile un element dans un tableau declare par #SET{tableau,#ARRAY}
 * #SET_PUSH{tableau,valeur}
 *
 * @param object $p : objet balise
 * @return ""
**/
function balise_SET_PUSH_dist($p){
	$_nom = interprete_argument_balise(1,$p);
	$_valeur = interprete_argument_balise(2,$p);

	if ($_nom AND $_valeur)
		// si le tableau n'existe pas encore, on le cree
		// on ajoute la valeur ensuite (sans passer par array_push)
		$p->code = "vide((\$cle=$_nom)
			. (is_array(\$Pile['vars'][\$cle])?'':\$Pile['vars'][\$cle]=array())
			. (\$Pile['vars'][\$cle][]=$_valeur))";
	else
		$p->code = "''";

	$p->interdire_scripts = false; // la balise ne renvoie rien
	return $p;
}

/**
 * Si 3 arguments : Cree un tableau nom_tableau de t1 + t2
 * #SET_MERGE{nom_tableau,t1,t2}
 * #SET_MERGE{nom_tableau,#GET{tableau},#ARRAY{cle,valeur}}
 *
 * Si 2 arguments : Merge t1 dans nom_tableau
 * #SET_MERGE{nom_tableau,t1}
 * #SET_MERGE{nom_tableau,#GET{tableau}}
 *
 * @param object $p : objet balise
 * @return ""
**/
function balise_SET_MERGE_dist($p){
	$_nom = interprete_argument_balise(1,$p);
	$_t1 = interprete_argument_balise(2,$p);
	$_t2 = interprete_argument_balise(3,$p);

	if ($_nom AND $_t1 AND !$_t2)
		// 2 arguments : merge de $_nom et $_t1 dans $_nom
		// si le tableau n'existe pas encore, on le cree
		$p->code = "vide((\$cle=$_nom)
			. (is_array(\$Pile['vars'][\$cle])?'':\$Pile['vars'][\$cle]=array())
			. (is_array(\$new=$_t1)?'':\$new=array(\$new))
			. (\$Pile['vars'][\$cle] = array_merge(\$Pile['vars'][\$cle],\$new)))";
	elseif ($_nom AND $_t1 AND $_t2)
		// 3 arguments : merge de $_t1 et $_t2 dans $_nom
		// si le tableau n'existe pas encore, on le cree
		$p->code = "vide((\$cle=$_nom)
			. (is_array(\$Pile['vars'][\$cle])?'':\$Pile['vars'][\$cle]=array())
			. (is_array(\$new1=$_t1)?'':\$new1=array(\$new1))
			. (is_array(\$new2=$_t2)?'':\$new2=array(\$new2))
			. (\$Pile['vars'][\$cle] = array_merge(\$new1,\$new2)))";
	else
		$p->code = "''";

	$p->interdire_scripts = false; // la balise ne renvoie rien
	return $p;
}

/**
 * Balise #COMPTEUR associee au critere compteur
 *
 * @param unknown_type $p
 * @return unknown
 */
function balise_COMPTEUR_dist($p) {
	calculer_balise_criteres('compteur', $p);
	if ($p->code=="''")
		calculer_balise_criteres('compteur', $p, "compteur_left");
	return $p;
}

/** Balise #SOMME associee au critere somme */
function balise_SOMME_dist($p) {
	return calculer_balise_criteres('somme', $p);
}

/** Balise #COMPTE associee au critere compte */
function balise_COMPTE_dist($p) {
	return calculer_balise_criteres('compte', $p);
}

/** Balise #MOYENNE associee au critere moyenne */
function balise_MOYENNE_dist($p) {
	return calculer_balise_criteres('moyenne', $p);
}

/** Balise #MINIMUM associee au critere moyenne */
function balise_MINIMUM_dist($p) {
	return calculer_balise_criteres('minimum', $p);
}

/** Balise #MAXIMUM associee au critere moyenne */
function balise_MAXIMUM_dist($p) {
	return calculer_balise_criteres('maximum', $p);
}

/** Balise #STATS associee au critere stats
 * #STATS{id_article,moyenne}
 */
function balise_STATS_dist($p) {
	if (isset($p->param[0][2][0])
	AND $nom = ($p->param[0][2][0]->texte)) {
		return calculer_balise_criteres($nom, $p, 'stats');
	}
	return $p;
}

function calculer_balise_criteres($nom, $p, $motif="") {
	$p->code = "''";
	$motif = $motif ? $motif : $nom;
	if (isset($p->param[0][1][0])
	AND $champ = ($p->param[0][1][0]->texte)) {
		return rindex_pile($p, $nom."_$champ", $motif);
	}
  return $p;
}



/**
 * #TRI{champ[,libelle]}
 * champ prend < ou > pour afficher le lien de changement de sens
 * croissant ou decroissant
 *
 * @param unknown_type $p
 * @param unknown_type $liste
 * @return unknown
 */
function balise_TRI_dist($p, $liste='true') {
	$b = $p->nom_boucle ? $p->nom_boucle : $p->descr['id_mere'];

	// s'il n'y a pas de nom de boucle, on ne peut pas trier
	if ($b === '') {
		erreur_squelette(
			_T('zbug_champ_hors_boucle',
				array('champ' => '#TRI')
			), $p->id_boucle);
		$p->code = "''";
		return $p;
	}
	$boucle = $p->boucles[$b];

	// s'il n'y a pas de tri_champ, c'est qu'on se trouve
	// dans un boucle recursive ou qu'on a oublie le critere {tri}
	if (!isset($boucle->modificateur['tri_champ'])) {
		erreur_squelette(
			_T('zbug_tri_sans_critere',
				array('champ' => '#TRI')
			), $p->id_boucle);
		$p->code = "''";
		return $p;
	}

	$_champ = interprete_argument_balise(1,$p);
	// si pas de champ, renvoyer le critere de tri utilise
	if (!$_champ){
		$p->code = $boucle->modificateur['tri_champ'];
		return $p;
	}

	$_libelle = interprete_argument_balise(2,$p);
	$_libelle = $_libelle?$_libelle:$_champ;

	$_class = interprete_argument_balise(3,$p);
	// si champ = "<" c'est un lien vers le tri croissant : 1<2<3<4 ... ==> 1
	// si champ = ">" c'est un lien vers le tri decroissant :.. 4>3>2>1 == -1
	$_issens = "in_array($_champ,array('<','>'))";
	$_sens = "(strpos('> <',$_champ)-1)";

	$_variable = "((\$s=$_issens)?'sens':'tri').".$boucle->modificateur['tri_nom'];
	$_url = "parametre_url(self(),$_variable,\$s?$_sens:$_champ)";
	$_on = "\$s?(".$boucle->modificateur['tri_sens']."==$_sens".'):('.$boucle->modificateur['tri_champ']."==$_champ)";

	$p->code = "lien_ou_expose($_url,$_libelle,$_on".($_class?",$_class":"").")";
	//$p->code = "''";
	$p->interdire_scripts = false;
	return $p;
}

/**
 * Generer un bouton d'action en post, ajaxable
 * a utiliser a la place des liens action_auteur, sous la forme
 * #BOUTON_ACTION{libelle,url}
 * ou
 * #BOUTON_ACTION{libelle,url,ajax} pour que l'action soit ajax comme un lien class='ajax'
 * ou
 * #BOUTON_ACTION{libelle,url,ajax,message_confirmation} pour utiliser un message de confirmation
 * ou
 * #BOUTON_ACTION{libelle,url,ajax,'',info} pour inserer une bulle d'information
 *
 * @param unknown_type $p
 * @return unknown
 */
function balise_BOUTON_ACTION($p){

	$_label = interprete_argument_balise(1,$p);
	if (!$_label) $_label="''";

	$_url = interprete_argument_balise(2,$p);
	if (!$_url) $_url="''";

	$_class = interprete_argument_balise(3,$p);
	if (!$_class) $_class="''";

	$_confirm = interprete_argument_balise(4,$p);
	if ((!$_confirm) OR ($_confirm=="''")) { $_onclick=''; }
	else $_onclick = " onclick=\'return confirm(\"' . attribut_html($_confirm) . '\");\'";

	$_title = interprete_argument_balise(5,$p);
	if (!$_title) $_title="''";
	else $_title = "' title=\'' . $_title . '\''";

	$p->code = "'<form class=\'bouton_action_post ' . $_class . '\' method=\'post\' action=\'' . (\$u=$_url) . '\'>'
. '<div>' . form_hidden(\$u)
. '<button type=\'submit\' class=\'submit\' $_onclick' . $_title . '>' . $_label . '</button>'
. '</div></form>'";
	$p->interdire_scripts = false;
	return $p;
}

/**
 * Generer n'importe quel info pour un objet : #INFO_TITRE{article, #ENV{id_article}}
 * Utilise la fonction generer_info_entite(), se reporter a sa documentation
 */
function balise_INFO__dist($p){
	$info = $p->nom_champ;
	$type_objet = interprete_argument_balise(1,$p);
	$id_objet = interprete_argument_balise(2,$p);
	if ($info === 'INFO_' or !$type_objet or !$id_objet) {
		$msg = _T('zbug_balise_sans_argument', array('balise' => ' INFO_'));
		erreur_squelette($msg, $p);
		$p->interdire_scripts = false;
		return $p;
	} elseif ($f = charger_fonction($nom, 'balise', true)) {
		return $f($p);
	}else {
		$p->code = champ_sql($info, $p);
		if (strpos($p->code, '@$Pile[0]') !== false) {
			$info = strtolower(substr($info,5));
			$p->code = "generer_info_entite($id_objet, $type_objet, '$info')";
		}
		$p->interdire_scripts = false;
		return $p;
	}
}


/**
 * Savoir si on objet est publie ou non
 *
 * @param <type> $p
 * @return <type>
 */
function balise_PUBLIE_dist($p) {

	$type = $p->type_requete;

	$_statut = champ_sql('statut',$p);


	$_texte = champ_sql('texte', $p);
	$_descriptif = "''";

	switch ($type){
		case 'articles':
			$p->code = "$_statut=='publie'";
			if ($GLOBALS['meta']["post_dates"] == 'non'){
				$_date_pub = champ_sql('date',$p);
				$p->code .= "AND $_date_pub<quete_date_postdates()";
			}
			break;
		case 'auteurs':
			$_id = champ_sql('id_auteur',$p);
			$p->code = "sql_countsel('spip_articles AS AR JOIN spip_auteurs_articles AS AU ON AR.id_article=AU.id_article',
				'AU.id_auteur=intval('.$_id.') AND AR.statut=\'publie\''"
				.(($GLOBALS['meta']['post_dates'] == 'non')?".' AND AR.date<'.sql_quote(quete_date_postdates())":'')
			.")>0";
			break;
		// le cas des documents prend directement en compte la mediatheque
		// car le fonctionnement par defaut de SPIP <=2.0 est trop tordu et insatisfaisant
		case 'documents':
			$p->code = "$_statut=='publie'";
			if ($GLOBALS['meta']["post_dates"] == 'non'){
				$_date_pub = champ_sql('date_publication',$p);
				$p->code .= "AND $_date_pub<quete_date_postdates()";
			}
			break;
		default:
			$p->code = "($_statut=='publie'?' ':'')";
			break;
	}

	$p->code = "((".$p->code.")?' ':'')";

	#$p->interdire_scripts = true;
	return $p;
}


/**
 * Implementation securisee du saut en avant
 * pour la balise #SAUTER
 *
 * @param resource $res
 * @param int $pos
 * @param int $nb
 * @param int $total
 */
function spip_bonux_sauter(&$res, &$pos, $nb, $total){
	// pas de saut en arriere qu'on ne sait pas faire sans sql_seek
	if (($nb=intval($nb))<=0) return;

	$saut = $pos + $nb;
	// si le saut fait depasser le maxi, on libere et on sort
	if ($saut>=$total) {sql_free($res); return;}

	if (sql_seek($res, $saut))
		$pos += $nb;
	else
		while ($pos<$saut AND sql_fetch($res))
			$pos++;
	return;
}

/**
 * #SAUTER{n} permet de sauter n resultats dans une boucle
 * n>0
 *
 * @param <type> $p
 * @return <type>
 */
function balise_SAUTER_dist($p){
	$_nb = interprete_argument_balise(1,$p);
	$_compteur = "\$Numrows['".$p->id_boucle."']['compteur_boucle']";
	$_max = "\$Numrows['".$p->id_boucle."']['total']";

	$p->code = "spip_bonux_sauter(\$result,$_compteur,$_nb,$_max)";
	$p->interdire_scripts = false;
	return $p;
}

/**
 * Produire un fichier statique a partir d'un squelette dynamique
 * Permet ensuite a apache de le servir en statique sans repasser
 * par spip.php a chaque hit sur le fichier
 * le format css ou js doit etre passe dans options['format']
 *
 * @param string $fond
 * @param array $contexte
 * @param array $options
 * @param string $connect
 * @return string
 */
function produire_fond_statique($fond, $contexte=array(), $options = array(), $connect=''){
	// recuperer le code CSS produit par le squelette
	$options['raw'] = true;
	$cache = recuperer_fond($fond,$contexte,$options,$connect);
  $extension = $options['format'];

  // calculer le nom de la css
	$dir_var = sous_repertoire (_DIR_VAR, 'cache-'.$extension);
	$filename = $dir_var . $extension."dyn-".md5($fond.serialize($contexte).$connect) .".$extension";

  if (!file_exists($filename)
	  OR filemtime($filename)<$cache['lastmodified']){

	  $contenu = $cache['texte'];
	  // passer les urls en absolu si c'est une css
	  if ($extension=="css")
	    $contenu = urls_absolues_css($contenu, generer_url_public($fond));

    $comment = "/*\n * #PRODUIRE_".strtoupper($extension)."_FOND{fond=$fond";
    foreach($contexte as $k=>$v)
	    $comment .= ",$k=$v";
    $comment .="}\n * le ".date("Y-m-d H:i:s")."\n */\n";
	  // et ecrire le fichier
    ecrire_fichier($filename,$comment.$contenu);
  }

  return $filename;
}

function produire_css_fond($fond, $contexte=array(), $options = array(), $connect=''){
	$options['format'] = "css";
  return produire_fond_statique($fond, $contexte, $options, $connect);
}
function produire_js_fond($fond, $contexte=array(), $options = array(), $connect=''){
	$options['format'] = "js";
  return produire_fond_statique($fond, $contexte, $options, $connect);
}

/**
 * #PRODUIRE_CSS_FOND
 * generer un fichier css statique a partir d'un squelette de CSS
 * utilisable en
 *
 * <link rel="stylesheet" type="text/css" href="#PRODUIRE_CSS_FOND{fond=css/macss,couleur=ffffff}" />
 * la syntaxe de la balise est la meme que celle de #INCLURE
 *
 * @param object $p
 * @return object
 */
function balise_PRODUIRE_CSS_FOND_dist($p){
	$balise_inclure = charger_fonction('INCLURE','balise');
	$p = $balise_inclure($p);

	$p->code = str_replace('recuperer_fond(','produire_css_fond(',$p->code);

	return $p;
}
/**
 * #PRODUIRE_JS_FOND
 * generer un fichier js statique a partir d'un squelette de JS
 * utilisable en
 *
 * <script type="text/javascript" src="#PRODUIRE_JS_FOND{fond=js/monscript}" ></script>
 * la syntaxe de la balise est la meme que celle de #INCLURE
 *
 * @param object $p
 * @return object
 */
function balise_PRODUIRE_JS_FOND_dist($p){
	$balise_inclure = charger_fonction('INCLURE','balise');
	$p = $balise_inclure($p);

	$p->code = str_replace('recuperer_fond(','produire_js_fond(',$p->code);

	return $p;
}

?>

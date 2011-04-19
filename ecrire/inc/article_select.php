<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/autoriser'); // necessaire si appel de l'espace public

// Recupere les donnees d'un article pour composer un formulaire d'edition
// (utilise par exec/article_edit)
// id_article = numero d'article existant
// id_rubrique = ou veut-on l'installer (pas obligatoire)
// lier_trad = l'associer a l'article numero $lier_trad
// new=oui = article a creer si on valide le formulaire
// http://doc.spip.org/@inc_article_select_dist
function inc_article_select_dist($id_article, $id_rubrique=0, $lier_trad=0, $id_version=0) {
	global $connect_id_rubrique, $spip_lang; 

	if (is_numeric($id_article)) {

// marquer le fait que l'article est ouvert en edition par toto a telle date
// une alerte sera donnee aux autres redacteurs sur exec=articles
		if ($GLOBALS['meta']['articles_modif'] != 'non') {
			include_spip('inc/drapeau_edition');
			signale_edition ($id_article,  $GLOBALS['visiteur_session'], 'article');
		}
		$row = sql_fetsel("*", "spip_articles", "id_article=$id_article");
	// si une ancienne revision est demandee, la charger
	// en lieu et place de l'actuelle ; attention les champs
	// qui etaient vides ne sont pas vide's. Ca permet de conserver
	// des complements ajoutes "orthogonalement", et ca fait un code
	// plus generique.
		if ($id_version) {
			include_spip('inc/revisions');
			if ($textes = recuperer_version($id_article, $id_version)) {
				foreach ($textes as $champ => $contenu)
					$row[$champ] = $contenu;
			}
		}
		return $row;
	}

	// id_article non numerique, c'est une demande de creation.
	// Si c'est une demande de nouvelle traduction, init specifique
	if ($lier_trad){
		$row = article_select_trad($lier_trad, $id_rubrique);
		$row['statut'] = ''; // le nouvel article n'a pas encore de statut !
	}
	else {
		$row['titre'] = '';//filtrer_entites(_T('info_nouvel_article'));
		//$row['onfocus'] = " onfocus=\"if(!antifocus){this.value='';antifocus=true;}\"";
		$row['id_rubrique'] = $id_rubrique;
	}

	// appel du script a la racine, faut choisir 
	// admin restreint ==> sa premiere rubrique
	// autre ==> la derniere rubrique cree
	if (!$row['id_rubrique']) {
		if ($connect_id_rubrique)
			$row['id_rubrique'] = $id_rubrique = $connect_id_rubrique[0]; 
		else {
			$row_rub = sql_fetsel("id_rubrique", "spip_rubriques", "", "", "id_rubrique DESC", 1);
			$row['id_rubrique'] = $id_rubrique = $row_rub['id_rubrique'];
		}
		if (!autoriser('creerarticledans','rubrique',$row['id_rubrique'] )){
			// manque de chance, la rubrique n'est pas autorisee, on cherche un des secteurs autorises
			$res = sql_select("id_rubrique", "spip_rubriques", "id_parent=0");
			while (!autoriser('creerarticledans','rubrique',$row['id_rubrique'] ) && $row_rub = sql_fetch($res)){
				$row['id_rubrique'] = $row_rub['id_rubrique'];
			}
		}
	}

	// recuperer le secteur, pour affecter les bons champs extras
	if (!$row['id_secteur']) {
		$row_rub = sql_getfetsel("id_secteur", "spip_rubriques", "id_rubrique=" . sql_quote($id_rubrique));
		$row['id_secteur'] = $row_rub;
	}

	return $row;
}

//
// Si un article est demande en creation (new=oui) avec un lien de trad,
// on initialise les donnees de maniere specifique
//
// http://doc.spip.org/@article_select_trad
function article_select_trad($lier_trad, $id_rubrique=0) {
	// Recuperer les donnees de l'article original
	$row = sql_fetsel("*", "spip_articles", "id_article=$lier_trad");
	if ($row) {
		$row['titre'] = filtrer_entites(_T('info_nouvelle_traduction')).' '.$row["titre"];

	} else $row = array();
	if ($id_rubrique) {
		$row['id_rubrique'] = $id_rubrique;
		return $row;
	}
	$id_rubrique = $row['id_rubrique'];
	// Regler la langue, si possible, sur celle du redacteur
	// Cela implique souvent de choisir une rubrique ou un secteur
	if (in_array($GLOBALS['spip_lang'],
	explode(',', $GLOBALS['meta']['langues_multilingue']))) {
		// Si le menu de langues est autorise sur les articles,
		// on peut changer la langue quelle que soit la rubrique
		// donc on reste dans la meme rubrique
		if ($GLOBALS['meta']['multi_articles'] == 'oui') {
			$row['id_rubrique'] = $row['id_rubrique']; # explicite :-)
		}
		else if ($GLOBALS['meta']['multi_rubriques'] == 'oui') {
			// Sinon, chercher la rubrique la plus adaptee pour
			// accueillir l'article dans la langue du traducteur
			if ($GLOBALS['meta']['multi_secteurs'] == 'oui') {
				$id_parent = 0;
			} else {
				// on cherche une rubrique soeur dans la bonne langue
				$row_rub = sql_fetsel("id_parent", "spip_rubriques", "id_rubrique=$id_rubrique");

				$id_parent = $row_rub['id_parent'];
			}
			$row_rub = sql_fetsel("id_rubrique", "spip_rubriques", "lang='".$GLOBALS['spip_lang']."' AND id_parent=$id_parent");
			if ($row_rub)
				$row['id_rubrique'] = $row_rub['id_rubrique'];
		}
	}
	return $row;
}

?>

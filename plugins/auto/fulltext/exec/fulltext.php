<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/headers');

include_spip('inc/fulltext_exec');
include_spip('inc/presentation');

function exec_fulltext()
{
	pipeline('exec_init',array('args'=>array('exec'=>'fulltext'),'data'=>''));

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page("Fulltext", "accueil", "accueil");

	echo debut_gauche("",true);

	echo creer_colonne_droite("", true);

	echo pipeline('affiche_droite',array('args'=>array('exec'=>'fulltext'),'data'=>''));

	echo "<img src='".find_in_path('fulltext.png')."' />\n";

	echo propre(_T('fulltext:liste_tables_connues')." [->http://www.spip-contrib.net/Fulltext].");

	echo debut_droite("", true);


	include_spip('inc/autoriser');
	if(!autoriser('webmestre'))
		die(_T('fulltext:reserve_webmestres'));

	// on va chercher les tables avec liste_des_champs()
	include_spip('inc/rechercher');
	include_spip('base/abstract_sql');
	$tables = liste_des_champs();

	// Requette creer tous
	if (_request('creer') == 'tous') 
		Fulltext_creer_tous($tables);
	
	// Parcour des tables retournee
	foreach($tables as $table => $vals) {
		
		// Affichage du nom de la table
		$count = sql_countsel(table_objet_sql($table));
		echo "<h3>$table ($count)</h3>\n";
		
		// On ne fait rien si le moteur de la table n'est pas MyISAM (on propose une conversion)
		if (!$engine = Fulltext_trouver_engine_table($table) OR strtolower($engine) != 'myisam') {
			if (_request('myisam') == $table OR _request('myisam') == 'tous') {
				echo Fulltext_conversion_myisam($table);
			} else if ($engine) {
				echo "<p>"._T('fulltext:table_format')." '".$engine."'; "._T('fulltext:il_faut_myisam').".</p>\n";
				echo "<p><a href='" . generer_url_ecrire(_request('exec'), 'myisam='.$table)."'>"._T('fulltext:convertir_myisam')."</a></p>\n";
				$myisam++;
			} else {
				echo "<p>"._T('fulltext:table_non_reconnue').".</p>";
			}
		} else {
		
			// Differente requette possible	
			// Creer un index
			if ($table == _request('table') AND $nom = _request('nom') AND preg_match(',^[a-z_0-9]+$,', "$nom$table"))
				echo Fulltext_creer_index($table, $nom, array_keys($vals));
			
			// Regenerer un index
			if (_request('regenerer') == $table OR _request('regenerer') == 'tous')
				echo Fulltext_regenerer_index($table);
			
			// Reinitialiser les documents
			if (_request('reinitialise') == $table OR _request('reinitialise') == 'tous')
				echo Fulltext_reinitialiser_document();
				
			// Recuperation des index deja existant
			$keys = fulltext_keys($table);

			// Verification des index existants + suppression en cas de requette
			if ($keys) {
				foreach($keys as $key=>$def) {
					echo "<dt>$key".'<a href="'.generer_url_ecrire(_request('exec'), 'supprimer='.$table.'&index='.$key).'" title="'._T('fulltext:supprimer').'">
                            <img src="'.(find_in_path('images/croix-rouge.gif')).'" alt="'._T('fulltext:supprimer').'"></a>';
					if (_request('supprimer') == $table AND _request('index') == $key) {
						echo Fulltext_supprimer_index($table, $key).'</dt>';
						continue;
					}
					echo "</dt><dd>$def</dd>\n";
				}
			} else
				if (!(_request('creer') == 'tous'))
					echo "<p>"._T('fulltext:pas_index')."</p>\n";
					
			// Rafraichissement des index deja existant
			$keys = fulltext_keys($table);

			// Liens pour creer des index
			$champs = array_keys($vals);
			asort($vals); // le champ de titre est celui qui a le poids le plus eleve
			$champs2 = array_keys($vals);
			$champ_titre = array_pop($champs2);
			if (!isset($keys[$champ_titre])) {
				echo Fulltext_lien_creer_index($table, $champs, $champ_titre);
				$n++;
			}
			if (!isset($keys['tout'])) {
				echo Fulltext_lien_creer_index($table, $champs, 'tout');
				$n++;
			}
		}
	}

	// S'il y a des index a creer les proposer
	if ($n
	AND !(_request('creer') == 'tous')) {
		$url = generer_url_ecrire(_request('exec'), 'creer=tous');
		echo "<p><b><a href='$url'>"._T('fulltext:creer_tous')."</a></b></p>\n";
	}

	if ($myisam) {
		$url = generer_url_ecrire(_request('exec'), 'myisam=tous');
		echo "<p><b><a href='$url'>"._T('fulltext:convertir_toutes')."</a></b></p>\n";
	}

	$url = generer_url_ecrire(_request('exec'), 'regenerer=tous');
	echo "<p><b><a href='$url'>"._T('fulltext:regenerer_tous')."</a></b></p>\n";

	$url = generer_url_ecrire(_request('exec'), 'reinitialise=document');
	echo "<p><b><a href='$url'>"._T('fulltext:reinitialise_index_doc')."</a></b></p>\n";
	
	// charset site
	$charset = strtolower(str_replace('-','',$GLOBALS['meta']['charset']));
	$necessite_conversion = false;
	
	// signaler les incoherences de charset site/tables qui plantent les requetes avec accents...
	// ?exec=convert_sql_utf8 => conversion base | ?exec=convert_utf8 => conversion site
	$data =  sql_fetch(sql_query("SHOW CREATE TABLE ".table_objet_sql($table)));
	preg_match(',DEFAULT CHARSET=([^\s]+),', $data["Create Table"], $match);
	$charset_table = strtolower(str_replace('-','',$match[1]));
	$charset_table = preg_replace(',^latin1$,', 'iso88591', $charset_table);
	if ($charset_table != '' AND $charset != $charset_table) {
		$modif = (substr($charset, 0, 3) == 'iso' ? 'convert_utf8' : 'convert_sql_utf8');
		$url = generer_url_ecrire($modif);
		echo "<p>"._T('fulltext:incoherence_charset')."<b><a href='$url'>"._T('fulltext:convertir_utf8')."</a></b></p>\n";
	}

	echo fin_gauche(), fin_page();

}


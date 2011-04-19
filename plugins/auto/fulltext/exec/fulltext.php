<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/headers');


function Fulltext_trouver_engine_table($table) {
	if ($s = sql_query("SHOW CREATE TABLE ".table_objet_sql($table), $serveur)
	AND $t = sql_fetch($s)
	AND $create = array_pop($t)
	AND preg_match('/\bENGINE=([^\s]+)/', $create, $engine))
		return $engine[1];
}

function Fulltext_index($table, $champs, $nom=null) {
	if (!$nom)
		list(,$nom) = each($champs);

	$trouver_table = charger_fonction('trouver_table', 'base');
	$desc = $trouver_table(table_objet($table));

	foreach ($champs as $i=>$f) {
		if (preg_match(',^(tiny|long|medium)?text\s,i', $desc['field'][$f]))
			$champs[$i] = "`$f`";
		else
			unset($champs[$i]);
	}

	return "`$nom` (".join(',', $champs).')';
}

function Fulltext_lien_creer_index($table, $champs, $nom=null) {
	if (_request('creer') == 'tous') {
		return Fulltext_creer_index($table, $nom, $champs);
	}

	$url = generer_url_ecrire(_request('exec'),
		'table='.$table.'&nom='.$nom
	);
	return "<p><a href='$url'>Cr&#233;er l'index ".Fulltext_index($table,$champs,$nom)."</a></p>\n";
}

function Fulltext_creer_index($table, $nom, $vals) {
	$keys = fulltext_keys($table);
	if ($nom == 'tout')
		$index = Fulltext_index($table, $vals , 'tout');
	else
		$index = Fulltext_index($table,array($nom), $nom);

	if ($table == 'document' && $nom == 'tout') {
    // On initialise l'indexation du contenu des documents
    sql_query("UPDATE spip_documents SET contenu='', extrait='non'");
  }

	if (!$s = sql_alter("TABLE ".table_objet_sql($table)
	." ADD FULLTEXT ".$index))
		return "<strong>"._T('spip:erreur')." ".mysql_errno()." ".mysql_error()."</strong><pre>$query</pre><p />\n";
  sql_optimize(table_objet_sql($table));

	$keys = fulltext_keys($table);
	if (isset($keys[$nom]))
		return "<p><strong>"._T('fulltext:fulltext_cree')." : $keys[$nom]</strong></p>";
	else
		return "<p><strong>"._T('spip:erreur').".</strong></p>\n";

}

function Fulltext_supprimer_index($table, $nom='tout') {
	if (!$s = sql_alter("TABLE ".table_objet_sql($table)." DROP INDEX ".$nom)) {
		return "<p><strong>"._T('spip:erreur')." ".mysql_errno()." ".mysql_error()."</strong><pre>$query</pre></p>\n";
	} else {
		if ($table == 'document' && $nom == 'tout') {
			// Plus besoin des donnees extraites des fichiers
			sql_query("UPDATE spip_documents SET contenu='', extrait='n/a'");
		}
    return " <strong>=> "._T('fulltext:index_supprime')."</strong>\n";
	}
}

function Fulltext_regenerer_index($table) {
  if (count($keys = fulltext_keys($table)) > 0) {
      foreach ($keys as $key=>$vals) {
        if (!$s = sql_alter("TABLE ".table_objet_sql($table)." DROP INDEX ".$key))
    	    return "<p><strong>"._T('spip:erreur')." ".mysql_errno()." ".mysql_error()."</strong><pre>$query</pre></p>\n";
    	if (!$s = sql_alter("TABLE ".table_objet_sql($table)." ADD FULLTEXT ".$key." (".$vals.")"))
    	    return "<strong>"._T('spip:erreur')." ".mysql_errno()." ".mysql_error()."</strong><pre>$query</pre><p />\n";
        sql_optimize(table_objet_sql($table));
      }
      return "<p><strong>"._T('fulltext:index_regenere')."</strong></p>";
  }
}

function Fulltext_reinitialiser_document() {
  sql_updateq("spip_documents", array('contenu' => '', 'extrait' => 'non'), "extrait='err'");
  return "<p><strong>"._T('fulltext:index_reinitialise')."</strong></p>";
}

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

	// Creer un index ?
	if ($table = _request('table')
	AND $nom = _request('nom')
	AND preg_match(',^[a-z_0-9]+$,', "$nom$table")) {
		echo Fulltext_creer_index($table, $nom, array_keys($tables[$table]));
	}

  // charset site
  $charset = strtolower(str_replace('-','',$GLOBALS['meta']['charset']));
  $necessite_conversion = false;

	foreach($tables as $table => $vals) {
    // charset table
    $data =  sql_fetch(sql_query("SHOW CREATE TABLE ".table_objet_sql($table)));
    preg_match(',DEFAULT CHARSET=([^\s]+),', $data["Create Table"], $match);
    $charset_table = strtolower(str_replace('-','',$match[1]));
    $charset_table = preg_replace(',^latin1$,', 'iso88591', $charset_table);
    if ($charset_table != '' AND $charset != $charset_table) $necessite_conversion = true;
    $keys = fulltext_keys($table);

		$count = sql_countsel(table_objet_sql($table));
		echo "<h3>$table ($count)</h3>\n";

    if (_request('regenerer') == $table OR _request('regenerer') == 'tous')
        echo Fulltext_regenerer_index($table);

	 if (_request('reinitialise') == $table OR _request('reinitialise') == 'tous')
        echo Fulltext_reinitialiser_document();

		if (!$engine = Fulltext_trouver_engine_table($table)
		OR strtolower($engine) != 'myisam') {
			if (_request('myisam') == $table
			OR _request('myisam') == 'tous') {
				$s = sql_alter("TABLE ".table_objet_sql($table)." ENGINE=MyISAM");
				if (!$s)
					echo "<p><strong>"._T('spip:erreur')." ".mysql_errno().' '.mysql_error()."</strong></p>\n";
				else
					echo "<p><strong>"._T('fulltext:table_convertie')."</strong></p>\n";
			} else if ($engine) {
				echo "<p>"._T('fulltext:table_format')." '".$engine."'; "._T('fulltext:il_faut_myisam').".</p>\n";
				echo "<p><a href='" . generer_url_ecrire(_request('exec'), 'myisam='.$table)."'>"._T('fulltext:convertir_myisam')."</a></p>\n";
				$myisam++;
			} else {
				echo "<p>"._T('fulltext:table_non_reconnue').".</p>";
			}
		} else {
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

			$champs = array_keys($vals);

			// le champ de titre est celui qui a le poids le plus eleve
			asort($vals);
			$champs2 = array_keys($vals);
			$champ_titre = array_pop($champs2);
			if (!isset($keys[$champ_titre])) {
				echo Fulltext_lien_creer_index($table, array($champ_titre), $champ_titre);
				$n ++;
			}
			if (!isset($keys['tout'])) {
				echo Fulltext_lien_creer_index($table, $champs, 'tout');
				$n ++;
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

  // signaler les incoherences de charset site/tables qui plantent les requetes avec accents...
  // ?exec=convert_sql_utf8 => conversion base | ?exec=convert_utf8 => conversion site
  if ($necessite_conversion) {
    $modif = (substr($charset, 0, 3) == 'iso' ? 'convert_utf8' : 'convert_sql_utf8');
    $url = generer_url_ecrire($modif);
    echo "<p>"._T('fulltext:incoherence_charset')."<b><a href='$url'>"._T('fulltext:convertir_utf8')."</a></b></p>\n";
  }

	echo fin_gauche(), fin_page();

}


<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/headers');


function Fulltext_trouver_engine_table($table) {
	if ($s = spip_query("SHOW CREATE TABLE ".table_objet_sql($table), $serveur)
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
		if (preg_match(',^(tiny|long)?text\s,i', $desc['field'][$f]))
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

	if (!$s = spip_query($query = "ALTER TABLE ".table_objet_sql($table)
	." ADD FULLTEXT ".$index))
		return "<strong>Erreur ".mysql_errno()." ".mysql_error()."</strong><pre>$query</pre><p />\n";

	$keys = fulltext_keys($table);
	if (isset($keys[$nom]))
		return "<p><strong>FULLTEXT cr&#233;&#233; : $keys[$nom]</strong></p>";
	else
		return "<p><strong>Erreur.</strong></p>\n";

}

function Fulltext_supprimer_index($table, $nom='tout') {
	if (!$s = spip_query($query = "ALTER TABLE ".table_objet_sql($table)." DROP INDEX ".$nom))
		return "<p><strong>Erreur suppression index ".mysql_errno()." ".mysql_error()."</strong><pre>$query</pre></p>\n";
  else
    return " <strong>=> index supprim&eacute;</strong>\n";
}

function Fulltext_regenerer_index($table) {
  if (count($keys = fulltext_keys($table)) > 0) {
      foreach ($keys as $key=>$vals) {
        if (!$s = spip_query($query = "ALTER TABLE ".table_objet_sql($table)." DROP INDEX ".$key))
    	    return "<p><strong>Erreur suppression index ".mysql_errno()." ".mysql_error()."</strong><pre>$query</pre></p>\n";
    	if (!$s = spip_query($query = "ALTER TABLE ".table_objet_sql($table)." ADD FULLTEXT ".$key." (".$vals.")"))
    	    return "<strong>Erreur ".mysql_errno()." ".mysql_error()."</strong><pre>$query</pre><p />\n";
      }
      return "<p><strong>index de la table $table r&#233;g&#233;n&#233;r&#233;s</strong></p>";
  }
}

function exec_fulltext()
{
	pipeline('exec_init',array('args'=>array('exec'=>'fulltext'),'data'=>''));

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page("Fulltext", "accueil", "accueil");

	echo debut_gauche("",true);

	echo creer_colonne_droite("", true);

	echo pipeline('affiche_droite',array('args'=>array('exec'=>'fulltext'),'data'=>''));

	echo propre("Voici la liste des tables connues de la recherche. Vous pouvez y ajouter des &#233;l&#233;ments FULLTEXT, cf. documentation &#224; l'adresse [->http://www.spip-contrib.net/Fulltext].");

	echo debut_droite("", true);


	include_spip('inc/autoriser');
	//if(!autoriser('webmestre'))
		//die("Page r&#233;serv&#233;e aux webmestres");

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

	foreach($tables as $table => $vals) {
		$keys = fulltext_keys($table);

		$count = sql_countsel('spip_'.table_objet($table));
		echo "<h3>$table ($count)</h3>\n";
		
    if (_request('regenerer') == $table OR _request('regenerer') == 'tous')
        echo Fulltext_regenerer_index($table);

		if (!$engine = Fulltext_trouver_engine_table($table)
		OR strtolower($engine) != 'myisam') {
			if (_request('myisam') == $table
			OR _request('myisam') == 'tous') {
				$s = spip_query("ALTER TABLE ".table_objet_sql($table)." ENGINE=MyISAM");
				if (!$s)
					echo "<p><strong>".mysql_errno().' '.mysql_error()."</strong></p>\n";
				else
					echo "<p><strong>table convertie en MyISAM</strong></p>\n";
			} else if ($engine) {
				echo "<p>Cette table est au format '".$engine."'; il faut MyISAM.</p>\n";
				echo "<p><a href='" . generer_url_ecrire(_request('exec'), 'myisam='.$table)."'>Convertir en MyISAM</a></p>\n";
				$myisam++;
			} else {
				echo "<p>table non reconnue.</p>";
			}
		} else {

			if ($keys) {
				foreach($keys as $key=>$def)
					echo "<dt>$key".'<a href="'.generer_url_ecrire(_request('exec'), 'supprimer='.$table.'&index='.$key).'" title="Supprimer">
                            <img src="'.(find_in_path('images/croix-rouge.gif')).'" alt="Supprimer"></a>';
                if (_request('supprimer') == $table AND _request('index') == $key) {
                    echo Fulltext_supprimer_index($table, $key).'</dt>';
                    continue;
                } 
                echo "</dt><dd>$def</dd>\n";
			} else
				if (!(_request('creer') == 'tous'))
					echo "<p>Pas d'index FULLTEXT</p>\n";

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
		echo "<p><b><a href='$url'>Cr&#233;er tous les index FULLTEXT sugg&#233;r&#233;s</a></b></p>\n";
	}

	if ($myisam) {
		$url = generer_url_ecrire(_request('exec'), 'myisam=tous');
		echo "<p><b><a href='$url'>Convertir toutes les tables en MyISAM</a></b></p>\n";
	}
  
  $url = generer_url_ecrire(_request('exec'), 'regenerer=tous');
  echo "<p><b><a href='$url'>R&#233;g&#233;n&#233;rer tous les index FULLTEXT</a></b></p>\n";

	echo fin_gauche(), fin_page();

}

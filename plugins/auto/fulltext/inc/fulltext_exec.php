<?php

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
		else if (preg_match(',^varchar.*\s,i', $desc['field'][$f]))
			$champs[$i] = "`$f`";
		else
			unset($champs[$i]);
	}

	return "`$nom` (".join(',', $champs).")";
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

function Fulltext_lien_creer_index($table, $champs, $nom=null) {
	$url = generer_url_ecrire(_request('exec'),
		'table='.$table.'&nom='.$nom
	);
	return "<p><a href='$url'>Cr&#233;er l'index ".Fulltext_index($table,$champs,$nom)."</a></p>\n";
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

function Fulltext_creer_tous($tables = false) {
	if(!$tables) { // Si les tables ne sont pas donn�e, on va les chercher
		include_spip('inc/rechercher');
		include_spip('base/abstract_sql');
		$tables = liste_des_champs();
	}
	
	foreach($tables as $table => $vals) {
		// Modification automatique de la table sur le moteur MyISAM
		if (!$engine = Fulltext_trouver_engine_table($table) OR strtolower($engine) != 'myisam')
			Fulltext_conversion_myisam($table);
			
		$keys = fulltext_keys($table); // Liste des index existant
			
		$champs = array_keys($vals);
		asort($vals); // le champ de titre est celui qui a le poids le plus eleve
		$champs2 = array_keys($vals);
		$champ_titre = array_pop($champs2);
		if (!isset($keys[$champ_titre])) {
			Fulltext_creer_index($table, $champ_titre, $champs);
		}
		if (!isset($keys['tout'])) {
			Fulltext_creer_index($table, 'tout', $champs);
		}
	}
}

function Fulltext_conversion_myisam($table) {
	if (!sql_alter("TABLE ".table_objet_sql($table)." ENGINE=MyISAM"))
		return "<p><strong>"._T('spip:erreur')." ".mysql_errno().' '.mysql_error()."</strong></p>\n";
	else
		return "<p><strong>"._T('fulltext:table_convertie')."</strong></p>\n";
}


?>
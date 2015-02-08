<?php

function balise_SET__dist($p) {
	$champ = $p->nom_champ;
	if ($f = charger_fonction($champ, 'balise', true))
		return $f($p);
	$code = champ_sql($champ, $p);
	if (strpos($code, '@$Pile[0]') !== false) {
		// le champ est absent de la base, on peut calculer la balise
		preg_match(",^SET_([A-Z_]+)?$,i", $champ, $filtre);
		$filtre = strtolower($filtre[1]);
		$filtre2 = chercher_filtre($filtre);
		if (!$filtre2) {
			$msg = array('zbug_erreur_filtre', array('filtre' => $filtre));
			erreur_squelette($msg, $p);
		} else {
			$nom = interprete_argument_balise(1,$p);
			if (!$nom) {
				$err_b_s_a = array('zbug_balise_sans_argument', array('balise' => $champ));
				erreur_squelette($err_b_s_a, $p);
			} else {
				$i = 1; $args = array();
				while(($a = interprete_argument_balise(++$i,$p)) != NULL) $args[] = $a;
				$get = function_exists('balise_GET') ? 'balise_GET' : 'balise_GET_dist';
				$q = $p; $q->param[0] = array($q->param[0][0], $q->param[0][1]);
				$get = $get($q);
				$filtre2 .= '('.$get->code.','.join(",", $args).')';
				$p->code = "vide(\$Pile['vars'][$nom] = $filtre2)";
			}
		}
	} else 
		// puisque le champ est present dans la base, on le renvoie
		$p->code = champ_sql($champ, $p);
	$p->interdire_scripts = false; // la balise ne renvoie rien
	return $p;
}

?>
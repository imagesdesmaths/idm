<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Validation d'un numero ISBN 
 *
 * d apres https://fr.wikipedia.org/wiki/Numéro_ISBN
 * ISBN-13 : longeur totale 13 caracteres divises en 5 segments de la forme G - A - B - C - K
 *           G:  3 caracteres (978 ou 979)
 *           A:  de 1 a 5 caracteres (code de la zone geographique)
 *           B:  de 1 a 7 caracteres (code de l editeur)
 *           C:  de 1 a 6 caracteres, completes eventuellement par des 0 afin que le total-G soit egal a 10 caracteres (code du livre)
 *           K:  1 caractere entre 0 et 9 (cle de controle calculee d apres les autres chiffres)
 *           ex: 978-2-1234-5680-3
 * ISBN-10 : longeur totale 10 caracteres divises en 4 segments de la forme A -B -C -K
 *           A, B, C : idem ISBN-13
 *           K:  1 caractere entre 0 et 9, ou X (cle de controle calculee d apres les autres chiffres)
 *           ex: 2-1234-5680-X
 * 
 * Avec un numero ISBN comportant des tirets, on pourrait utiliser une regex
 * pour verifier que chaque segment comporte le nombre adequat de caracteres.
 * Cependant ca ne permet pas d indiquer precisement la nature de l erreur.
 * La regex au cas ou : "/^(97[89][- ]){0,1}[0-9]{1,5}[- ][0-9]{1,7}[- ][0-9]{1,6}[- ][0-9X]$/"
 * 
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
 
function verifier_isbn_dist($valeur, $options=array()){

	// dans tous les cas, on doit avoir 10 ou 13 caracteres (en enlevant les tirets)
	$val['nb'] = $nb = strlen(preg_replace('/-/', '', $valeur));
	if (!preg_match("/10|13/", $nb)) {
		return _T('verifier:erreur_isbn_nb_caracteres', $val);
	}

	// un numero ISBN-13 ne peut pas se terminer par X
	else if (preg_match("/^97[89].*X$/", $valeur)) {
		return _T('verifier:erreur_isbn_13_X'); 
	}

	// s il y a le bon nombre de caracteres, on verifie qu il soient bien agences
	else {

		// si le numero ISBN est decompose en segments par des tirets, verifier chaque segment
		if (preg_match("/-/", $valeur)){

			// d'abord on recupere les valeurs de chaque segment
			$segments = explode("-", $valeur);
			$val['nb'] = count($segments);
			// ISBN-13
			if ($val['nb'] == 5) {
				$isbn = 13;
				$G = $segments[0];
				$A = $segments[1];
				$B = $segments[2];
				$C = $segments[3];
				$K = $segments[4];
			}
			// ISBN-10
			else if ($val['nb'] == 4) {
				$isbn = 10;
				$A = $segments[0];
				$B = $segments[1];
				$C = $segments[2];
				$K = $segments[3];
			}
			// nombre de segments incorrect (on ne sait jamais)
			else {
				return _T('verifier:erreur_isbn_nb_segments', $val);
			}

			// puis ensuite, on verifie leur conformite
			// G : 978 ou 979
			if ($G AND !preg_match("/97[89]/", $G)) {
				return _T('verifier:erreur_isbn_G');
			}
			// A, B et C doivent contenir des chiffres
			foreach (array($A,$B,$C) as $segment){
				$val['segment'] = $segment;
				if (!is_numeric($segment))
					return _T('verifier:erreur_isbn_segment_lettre', $val);
			}
			// A (code zone geographique) : 5 caracteres max
			if ($nbA = strlen($A) AND $nbA > 5) {
				$val['nb'] = $nbA - 5;
				$val['segment'] = $A;
				return _T('verifier:erreur_isbn_segment', $val);
			}
			// B (code editeur) : 7 caracteres max
			if ($nbB = strlen($B) AND $nbB > 7) {
				$val['nb'] = $nbB - 7;
				$val['segment'] = $B;
				return _T('verifier:erreur_isbn_segment', $val);
			}
			// C (code livre) : 6 caracteres max
			if ($nbC = strlen($C) AND $nbC > 6) {
				$val['nb'] = $nbC - 6;
				$val['segment'] = $C;
				return _T('verifier:erreur_isbn_segment', $val);
			}
			// K (cle de controle) : 1 caractere max
			if ($nbK = strlen($K) AND $nbK > 1) {
				$val['nb'] = $nbK - 1;
				$val['segment'] = $K;
				return _T('verifier:erreur_isbn_segment', $val);
			}
		}

		// si le numero ISBN n a pas de tiret, on verifie au moyen d une regex
		else {
			// verification generique [978 ou 979] [9 chiffres] [1 chiffre ou lettre X]
			if (!preg_match("/^(97[89]){0,1}[0-9]{1,9}[0-9X]$/", $valeur))
				return _T('verifier:erreur_isbn');
		}
	}

	return '';
}

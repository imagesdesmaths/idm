<?php

/**
 * Déclaration systématiquement chargées
 *
 * @package SPIP\Saisies
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;


if (!function_exists('_T_ou_typo')){
	/**
	 * une fonction qui regarde si $texte est une chaine de langue
	 * de la forme <:qqch:>
	 * si oui applique _T()
	 * si non applique typo() suivant le mode choisi
	 *
	 * @param mixed $valeur
	 *     Une valeur à tester. Si c'est un tableau, la fonction s'appliquera récursivement dessus.
	 * @param string $mode_typo
	 *     Le mode d'application de la fonction typo(), avec trois valeurs possibles "toujours", "jamais" ou "multi".
	 * @return mixed
	 *     Retourne la valeur éventuellement modifiée.
	 */
	function _T_ou_typo($valeur, $mode_typo='toujours') {
		// Si la valeur est bien une chaine (et pas non plus un entier déguisé)
		if (is_string($valeur) and !intval($valeur)){
			// Si la chaine est du type <:truc:> on passe à _T()
			if (preg_match('/^\<:(.*?):\>$/', $valeur, $match)) 
				$valeur = _T($match[1]);
			// Sinon on la passe a typo()
			else {
				if (!in_array($mode_typo, array('toujours', 'multi', 'jamais')))
					$mode_typo = 'toujours';
			
				if ($mode_typo == 'toujours' or ($mode_typo == 'multi' and strpos($valeur, '<multi>') !== false)){
					include_spip('inc/texte');
					$valeur = typo($valeur);
				}
			}
		}
		// Si c'est un tableau, on reapplique la fonction récursivement
		elseif (is_array($valeur)){
			foreach ($valeur as $cle => $valeur2){
				$valeur[$cle] = _T_ou_typo($valeur2, $mode_typo);
			}
		}

		return $valeur;
	}
}


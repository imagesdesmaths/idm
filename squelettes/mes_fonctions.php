<?php 

function trunctext($texte, $longeur_max) {
if (strlen($texte) > $longeur_max)
    {
    $texte = substr($texte, 0, $longueur_max);
    $dernier_espace = strrpos($texte, " ");
    $texte = substr($texte, 0, $dernier_espace)."...";
    }

    return $texte;
}

function autoriser_previsualiser($faire, $type, $id, $qui, $opt) {
	return true;
}

?>

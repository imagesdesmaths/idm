<?php 

function trunctext($texte, $longeur_max) {
    if (strlen($texte) > $longeur_max)
    {
    $texte = substr($texte, 0, $longeur_max);
    $dernier_espace = strrpos($texte, " ");
    $texte = substr($texte, 0, $dernier_espace)."...";
    }

    return $texte;
}

?>

<?php

use \jin\lang\ColorTools;


function filtre_color_dominant($v) {
    return ColorTools::toHex(ColorTools::imageDominant($v));
}
function filtre_color_visible_over($v) {
    return ColorTools::toHex(ColorTools::visibleOver($v, true));
}

function filtre_slug($v) {
    return preg_replace('/[^a-z\d]+/i', '-', strtolower($v));
}

function filtre_trunctext($texte, $longeur_max) {
    if (strlen($texte) > $longeur_max)
    {
        $texte = substr($texte, 0, $longeur_max);
        $dernier_espace = strrpos($texte, " ");
        $texte = substr($texte, 0, $dernier_espace)."...";
    }
    return $texte;
}

function balise_RUBRIQUE_SPECIAL($p) { $p->code = RUBRIQUE_SPECIAL; return $p; }
function balise_RUBRIQUE_TRIBUNES($p) { $p->code = RUBRIQUE_TRIBUNES; return $p; }
function balise_RUBRIQUE_DEBAT_DU_18($p) { $p->code = RUBRIQUE_DEBAT_DU_18; return $p; }
function balise_RUBRIQUE_DEFIS_DES_MATHS($p) { $p->code = RUBRIQUE_DEFIS_DES_MATHS; return $p; }
function balise_RUBRIQUE_REVUE_DE_PRESSE($p) { $p->code = RUBRIQUE_REVUE_DE_PRESSE; return $p; }
function balise_RUBRIQUE_EVENEMENTS($p) { $p->code = RUBRIQUE_EVENEMENTS; return $p; }
function balise_RUBRIQUE_FIGURES_SANS_PAROLES($p) { $p->code = RUBRIQUE_FIGURES_SANS_PAROLES; return $p; }

function balise_ARTICLE_IMAGES_DU_JOUR($p) { $p->code = ARTICLE_IMAGES_DU_JOUR; return $p; }
function balise_ARTICLE_PRESENTATION($p) { $p->code = ARTICLE_PRESENTATION; return $p; }
function balise_ARTICLE_EQUIPE($p) { $p->code = ARTICLE_EQUIPE; return $p; }
function balise_ARTICLE_FONCTIONNEMENT($p) { $p->code = ARTICLE_FONCTIONNEMENT; return $p; }
function balise_ARTICLE_PARTENAIRES($p) { $p->code = ARTICLE_PARTENAIRES; return $p; }
function balise_ARTICLE_DEVENIR_CONTRIBUTEUR($p) { $p->code = ARTICLE_DEVENIR_CONTRIBUTEUR; return $p; }
function balise_ARTICLE_MENTIONS_LEGALES($p) { $p->code = ARTICLE_MENTIONS_LEGALES; return $p; }

function balise_MOT_FEATURED($p) { $p->code = MOT_FEATURED; return $p; }
function balise_MOT_PISTE_VERTE($p) { $p->code = MOT_PISTE_VERTE; return $p; }
function balise_MOT_PISTE_BLEUE($p) { $p->code = MOT_PISTE_BLEUE; return $p; }
function balise_MOT_PISTE_ROUGE($p) { $p->code = MOT_PISTE_ROUGE; return $p; }
function balise_MOT_PISTE_NOIRE($p) { $p->code = MOT_PISTE_NOIRE; return $p; }
function balise_MOT_HORS_PISTE($p) { $p->code = MOT_HORS_PISTE; return $p; }
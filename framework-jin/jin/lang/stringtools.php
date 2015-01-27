<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\lang;

/** Boite à outils pour les chaînes de caractères
 *
 *  @auteur     Loïc Gerard
 *  @version    0.0.1
 *  @check      24/04/2014
 *  @maj        12/06/2014 : [Loïc Gerard] Correction de la méthode firstCarToUpperCase()
 */
class StringTools {
    //----------------------------------------------------------------------------------------------------
    //Méthodes diverses

    /** Retourne la longueur de la chaîne de caractères
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return integer                     Longueur de la chaîne
     */
    public static function len($chaine) {
        return strlen($chaine);
    }


    //----------------------------------------------------------------------------------------------------
    //Méthodes de reconstruction de chaîne

    /** Permet de reconstituer une chaîne de caractère à partir d'un tableau de chaînes
     *
     *  @param  array   $pieces             Tableau de chaînes de caractères
     *  @param  string  $glue               [optionel] Caractère de séparation des éléments reconstitués (Chaîne vide par défaut)
     *  @return array
     */
    public static function implode(array $pieces, $glue = '') {
        return implode($glue, $pieces);
    }


    //----------------------------------------------------------------------------------------------------
    //Méthodes de recherche

    /** Teste si la chaine contient une sous-châine spécifiée
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $recherche              Chaîne recherchée
     *  @param  boolean $nocase                 [optionel] Ne pas prendre en compte la casse (FALSE par défaut)
     *  @return boolean                     TRUE si la chaîne contient la sous-chaîne
     */
    public static function contains($chaine, $recherche, $nocase = false) {
        if (self::firstIndexOf($chaine, $recherche, $nocase) == -1)
            return false;
        return true;
    }


    /** Teste si la chaîne débute par le préfixe indiqué
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $prefixe                Préfixe à tester
     *  @param  boolean $nocase                 [optionel] Ne pas prendre en compte la casse (FALSE par défaut)
     *  @return boolean                     TRUE si la chaîne débute par le préfixe indiqué
     */
    public static function startsWith($chaine, $prefixe, $nocase = false) {
        if ($nocase) {
            return strtolower(substr($chaine, 0, strlen($prefixe))) == strtolower($prefixe);
        } else {
            return substr($chaine, 0, strlen($prefixe)) == $prefixe;
        }
    }


    /** Teste si la chaîne finit par le suffixe indiqué
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $suffixe                    Suffixe à tester
     *  @param  boolean $nocase                 [optionel] Ne pas prendre en compte la casse (FALSE par défaut)
     *  @return boolean                     TRUE si la chaîne finit par le suffixe indiqué
     */
    public static function endsWith($chaine, $suffixe, $nocase = false) {
        $l = strlen($suffixe);
        if ($nocase) {
            return strtolower(substr($chaine, strlen($chaine) - $l, $l)) == strtolower($suffixe);
        } else {
            return substr($chaine, strlen($chaine) - $l, $l) == $suffixe;
        }
    }


    /** Cherche la première occurence d'une sous-chaîne dans la chaîne en commençant à l'index spécifié. Retourne -1 si aucune occurence n'est trouvée
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $recherche              Chaîne à rechercher
     *  @param  boolean $nocase                 [optionel] Ne pas prendre en compte la casse (FALSE par défaut)
     *  @param  integer $startIndex             [optionel] Index à partir duquel commencer la recherche (0 par défaut)
     *  @return integer                     Position de la chaîne recherchée, -1 si aucune occurence n'est trouvée
     */
    public static function firstIndexOf($chaine, $recherche, $nocase = false, $startIndex = 0) {
        if ($nocase) {
            $f = stripos($chaine, $recherche, $startIndex);
        } else {
            $f = strpos($chaine, $recherche, $startIndex);
        }

        if ($f === false) {
            return -1;
        } else {
            return $f;
        }
    }


    /** Cherche la dernière occurence d'une sous-chaîne dans la chaîne en limitant la recherche à l'index spécifié.
     *  Retourne -1 si aucune occurence n'est trouvée
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $recherche              Chaîne à rechercher
     *  @param  boolean $nocase                 [optionel] Ne pas prendre en compte la casse (FALSE par défaut)
     *  @param  integer $endIndex               [optionel] Index limitant la recherche (Par défaut la recherche débute à la fin de la chaîne)
     *  @return integer                     Position de la chaîne recherchée, -1 si aucune occurence n'est trouvée
     */
    public static function lastIndexOf($chaine, $recherche, $nocase = false, $endIndex = false) {
        if ($nocase) {
            $f = strripos($chaine, $recherche, $endIndex);
        } else {
            $f = strrpos($chaine, $recherche, $endIndex);
        }
        if ($f === false) {
            return -1;
        } else {
            return $f;
        }
    }


    /** Analyse la chaîne pour trouver lex expressions qui correspondent à l'expression régulière fournie
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $regex                  Expression régulière
     *  @param  integer $startIndex             [optionel] Index où débuter la recherche (0 par défaut)
     *  @return array[] Tableau de tableaux.<br>0=> Chaîne identifiée<br>1=> Index dans la chaîne
     */
    public static function getMatches($chaine, $regex, $startIndex = 0) {
        $matches = array();
        preg_match_all($regex, $chaine, $matches, PREG_OFFSET_CAPTURE, $startIndex);

        return $matches[0];
    }


    //----------------------------------------------------------------------------------------------------
    //Méthodes d'extraction

    /** Retourne le caractère à l'index spécifié
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  integer $index                  Index
     *  @return string                      Caractère trouvé à l'index spécifié
     */
    public static function charAt($chaine, $index) {
        return substr($chaine, $index, 1);
    }


    /** Retourne une portion de chaîne
     *
     *  @param  string  $chaine             Chaîne de caractères
     *  @param  integer $index              Index à partir duquel prélever la sous-chaîne
     *  @param  integer $length                 [optionel] Longueur de la chaîne à prélever. (Par défaut correspondra à toute la fin de la chaîne)
     *  @return string                  Portion de chaîne
     */
    public static function substring($chaine, $index, $length = false) {
        return substr($chaine, $index, $length);
    }


    /** Retourne la sous-chaîne de caractères au début de la chaîne
     *
     *  @param  string  $chaine                     Chaîne de caractère
     *  @param  integer $nb                     Nombre de caractères à retourner
     *  @return string                          Sous chaîne de caractères
     */
    public static function left($chaine, $nb) {
        return substr($chaine, 0, $nb);
    }


    /** Retourne la sous-chaîne de caractères à la fin de la chaîne
     *
     *  @param  string  $chaine                     Chaîne de caractère
     *  @param  integer $nb                     Nombre de caractères à retourner
     *  @return string                          Sous chaîne de caractères
     */
    public static function right($chaine, $nb) {
        return substr($chaine, strlen($chaine) - $nb, $nb);
    }


    /** Coupe la chaîne en un tableau
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $delimiter              [optionel] Caractère ou chaîne utilisée pour découper le tableau. (Si la chaîne est vide ou non fournie la chaîne sera découpée pour chaque caractère)
     *  @return array                       Tableau de chaînes de caractères
     */
    public static function explode($chaine, $delimiter = '') {
        if ($delimiter == '') {
            return str_split($chaine);
        } else {
            return explode($delimiter, $chaine);
        }
    }


    //----------------------------------------------------------------------------------------------------
    //Méthodes de remplacement

    /** Remplace les occurences de la sous-chaîne dans la chaîne
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $search                 Chaine à rechercher
     *  @param  string  $replacement                Chaine de remplacement
     *  @param  boolean $nocase                 [optionel] Ne pas tenir compte de la casse (FALSE par défaut)
     *  @return string                      Chaîne de caractère modifiée
     */
    public static function replaceAll($chaine, $search, $replacement, $nocase = false) {
        if ($nocase) {
            return str_replace($search, $replacement, $chaine);
        } else {
            return str_ireplace($search, $replacement, $chaine);
        }
    }


    /** Remplace la première occurence de la sous-chaîne dans la chaîne
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $search                 Chaine à rechercher
     *  @param  string  $replacement                Chaine de remplacement
     *  @param  boolean $nocase                 [optionel] Ne pas tenir compte de la casse (FALSE par défaut)
     *  @return string                      Chaîne de caractère modifiée
     */
    public static function replaceFirst($chaine, $search, $replacement, $nocase = false) {
        $search = self::replaceAll($search, '/', '\/');

        if ($nocase) {
            return preg_replace('/' . $search . '/i', $replacement, $chaine, 1);
        } else {
            return preg_replace('/' . $search . '/', $replacement, $chaine, 1);
        }
    }


    /** Remplace la dernière occurence de la sous-chaîne dans la chaîne
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $search                 Chaine à rechercher
     *  @param  string  $replacement                Chaine de remplacement
     *  @param  boolean $nocase                 [optionel] Ne pas tenir compte de la casse (FALSE par défaut)
     *  @return string                      Chaîne de caractère modifiée
     */
    public static function replaceLast($chaine, $search, $replacement, $nocase = false) {
        if ($nocase) {
            $pos = strripos($chaine, $search);
        } else {
            $pos = strrpos($chaine, $search);
        }

        if ($pos !== false)
            return substr_replace($chaine, $replacement, $pos, strlen($search));
        return $chaine;
    }


    /** Analyse la chaîne et remplace toutes les expressions qui correspondent à l'expression régulière fournie
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $regex                  Expression régulière
     *  @param  string  $replacement                Chaîne de remplacement
     *  @return string                      Chaîne de caractère modifiée
     */
    public static function replaceAllMatches($chaine, $regex, $replacement) {
        return preg_replace($regex, $replacement, $chaine);
    }


    /** Analyse la chaîne et remplace toutes lla première expressions qui correspond à l'expression régulière fournie
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $regex                  Expression régulière
     *  @param  string  $replacement                Chaîne de remplacement
     *  @return string                      Chaîne de caractère modifiée
     */
    public static function replaceFirstMatch($chaine, $regex, $replacement) {
        return preg_replace($regex, $replacement, $chaine, 1);
    }


    //----------------------------------------------------------------------------------------------------
    //Méthodes de formattage

    /** Met la chaîne en minuscules
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne en minuscules
     */
    public static function toLowerCase($chaine) {
        return strtolower($chaine);
    }


    /** Met la chaîne en majuscules
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne en majuscules
     */
    public static function toUpperCase($chaine) {
        return strtoupper($chaine);
    }


    /** Met le premier caractère de la chaîne en majuscule
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne avec le premier caractère en majuscule
     */
    public static function firstCarToUpperCase($chaine) {
        return ucfirst($chaine);
    }


    /** Formate une chaîne en lui passant un tableau de correspondances.
     *  Les mots clés sont à insérer sous la forme %cle%.
     *  Le système va recherche les clés dans le tableau fourni correspondants aux mots clés détectés.
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  array   $correspondances            Clés à remplacer. (Tableau associatif obligatoirement)
     *  @return string                      Chaîne formatée
     */
    public static function format($chaine, $correspondances) {
        foreach ($correspondances as $cle => $valeur) {
            $chaine = str_replace('%' . $cle, $valeur, $chaine);
        }
        return $chaine;
    }


    /** Effectue une cesure d'une chaîne en respectant les mots
     *
     *  @param  string  $chaine             Chaîne de caractères
     *  @param  integer $longueur           Longueur de la ligne en nombre de caractères
     *  @param  string  $cesure             [optionel] Chaîne utilisée pour effectuer le retour à la ligne (balise BR par défaut)
     *  @param  integer $hauteur            [optionel] Nombre maximal de lignes (-1 par défaut, c'est à dire pas de maximum)
     *  @param  string  $suffixe            [optionel] Suffixe à afficher si le texte dépasse le nombre de lignes maximal.
     *  @return string                  Chaîne formatée
     */
    public static function wordWrap($chaine, $longueur, $cesure = '<br/>', $hauteur = -1, $suffixe = '') {
        $chaine = self::removeHtmlTags($chaine);
        $chaine = wordwrap($chaine, $longueur, $cesure);
        $elements = self::explode($chaine, $cesure);
        if (count($elements) + 1 > $hauteur && $hauteur != -1) {
            $chaine = '';
            for ($i = 0; $i <= $hauteur; $i++) {
                $chaine .= $elements[$i];
                if ($i > 0 && $i < ($hauteur)) {
                    $chaine .= $cesure;
                } else if ($i == ($hauteur)) {
                    $chaine .= $suffixe;
                }
            }
        }
        return $chaine;
    }


    //----------------------------------------------------------------------------------------------------
    //Méthodes d'encode/décode

    /** Supprime les espaces blancs en début et fin de chaîne
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractère modifiée
     */
    public static function deleteWhiteSpaces($chaine) {
        return trim($chaine);
    }


    /** Encode au format uuencode
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractères encodée
     */
    public static function uuEncode($chaine) {
        return convert_uuencode($chaine);
    }


    /** Décode du format uuencode
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractères décodée
     */
    public static function uuDecode($chaine) {
        return convert_uudecode($chaine);
    }


    /** Encode au format HTML
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  boolean $specialcars                [optionel] Si TRUE, encode également les caractères spéciaux (&, ; ...) (TRUE par défaut)
     *  @return string                      Chaîne encodée
     */
    public static function htmlEncode($chaine, $specialcars = true) {
        if ($specialcars)
            $chaine = htmlspecialchars($chaine);
        return htmlentities($chaine);
    }


    /** Décode une chaîne au format HTML
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  boolean $specialcars                [optionel] Si TRUE, décode également les caractères spéciaux (&, ; ...) (TRUE par défaut)
     *  @return string                      Chaîne décodée
     */
    public static function htmlDecode($chaine, $specialcars = true) {
        if ($specialcars)
            $chaine = htmlspecialchars_decode($chaine);
        return html_entity_decode($chaine);
    }


    /** Génère une valeur de hashage
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @param  string  $algo                   [optionel] Algorithme à utiliser. (md5 par défaut)
     *  @return string                      Valeur de hashage
     */
    public static function hashCode($chaine, $algo = 'md5') {
        return hash($algo, $chaine);
    }


    /**
     * Génère une valeur de hashage avec une clé utilisée pour générer la variance HMAC de l'empreinte numérique.
     * @param string $chaine    Châine de caractères à hasher
     * @param string $key   Clé de variance
     * @param string $algo  [optionel]  Algorithme à utiliser. (md5 par défaut)
     * @return string
     */
    public static function hmac($chaine, $key, $algo = 'md5') {
        return hash_hmac($algo, $chaine, $key);
    }


    /** Supprime toutes les balises HTML
     *
     *  @param  string  $chaine                 Chaîne de caractère
     *  @return string                      Chaîne de caractère nettoyée
     */
    public static function removeHtmlTags($chaine) {
        return strip_tags($chaine);
    }


    /** Nettoie la chaîne de caractère de tous les caractères spéciaux
     *
     *  @param  string  $chaine                 Chaîne de caractère
     *  @return string                      Chaîne de caractère nettoyée
     */
    public static function clean($chaine) {
        $chaine = StringTools::removeHtmlTags($chaine);
        setlocale(LC_CTYPE, 'fr_FR.UTF-8');
        $chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
        $chaine = str_replace(' ', '-', $chaine);
        $chaine = strtolower($chaine);
        $chaine = trim($chaine, '-');
        $chaine = preg_replace('/[^\w-]/', '', $chaine);
        $chaine = preg_replace('/-+/', '-', $chaine);

        return $chaine;
    }


    /** Encode la chaîne au format URL
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractères encodée
     */
    public static function urlEncode($chaine) {
        return urlencode($chaine);
    }


    /** Décode une chaîne au format Url
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractère décodée
     */
    public static function urlDecode($chaine) {
        return urldecode($chaine);
    }


    /** Encode une chaîne ISO8859-1 au format utf8
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractères encodée
     */
    public static function utf8Encode($chaine) {
        return utf8_encode($chaine);
    }


    /** Encode une chaîne utf8 au format ISO8859-1
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractères décodée
     */
    public static function utf8Decode($chaine) {
        return utf8_decode($chaine);
    }


    /** Encode une chaîne en MIME base64
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractères encodée
     */
    public static function base64Encode($chaine) {
        return base64_encode($chaine);
    }


    /** Décode une chaîne en MIME base64
     *
     *  @param  string  $chaine                 Chaîne de caractères
     *  @return string                      Chaîne de caractères décodée
     */
    public static function base64Decode($chaine) {
        return base64_decode($chaine);
    }

}
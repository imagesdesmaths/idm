<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/*
 * Liste tous les traitements configurables (ayant une description)
 *
 * @return array Un tableau listant des saisies et leurs options
 */
function traitements_lister_disponibles(){
    static $traitements = null;

    if (is_null($traitements)){
        $traitements = array();
        $liste = find_all_in_path('traiter/', '.+[.]yaml$');
		ksort($liste);
		
        if (count($liste)){
            foreach ($liste as $fichier=>$chemin){
                $type_traitement = preg_replace(',[.]yaml$,i', '', $fichier);
                $dossier = str_replace($fichier, '', $chemin);
                // On ne garde que les traitements qui ont bien la fonction
                if (charger_fonction($type_traitement, 'traiter', true)
                    and (
                        is_array($traitement = traitements_charger_infos($type_traitement))
                    )
                ){
                    $traitements[$type_traitement] = $traitement;
                }
            }
        }
    }

    return $traitements;
}

/**
 * Charger les informations contenues dans le yaml d'un traitement
 *
 * @param string $type_saisie Le type de la saisie
 * @return array Un tableau contenant le YAML décodé
 */
function traitements_charger_infos($type_traitement){
    include_spip('inc/yaml');
    $fichier = find_in_path("traiter/$type_traitement.yaml");
    $traitement = yaml_decode_file($fichier);

    if (is_array($traitement)) {
        $traitement += array('titre' => '', 'description' => '', 'icone' => '');
        $traitement['titre'] = $traitement['titre'] ? _T_ou_typo($traitement['titre']) : $type_traitement;
        $traitement['description'] = $traitement['description'] ? _T_ou_typo($traitement['description']) : '';
        $traitement['icone'] = $traitement['icone'] ? find_in_path($traitement['icone']) : '';
    }
    return $traitement;
}

/*
 * Liste tous les types d'échanges (export et import) existant pour les formulaires
 *
 * @return array Retourne un tableau listant les types d'échanges
 */
function echanges_formulaire_lister_disponibles(){
    // On va chercher toutes les fonctions existantes
    $liste = find_all_in_path('echanger/formulaire/', '.+[.]php$');
    $types_echange = array('exporter'=>array(), 'importer'=>array());
    if (count($liste)){
        foreach ($liste as $fichier=>$chemin){
            $type_echange = preg_replace(',[.]php$,i', '', $fichier);
            $dossier = str_replace($fichier, '', $chemin);
            // On ne garde que les échanges qui ont bien la fonction
            if ($f = charger_fonction('exporter', "echanger/formulaire/$type_echange", true)){
                $types_echange['exporter'][$type_echange] = $f;
            }
            if ($f = charger_fonction('importer', "echanger/formulaire/$type_echange", true)){
                $types_echange['importer'][$type_echange] = $f;
            }
        }
    }
    return $types_echange;
}

/*
 * Génère le nom du cookie qui sera utilisé par le plugin lors d'une réponse
 * par un visiteur non-identifié.
 *
 * @param int $id_formulaire L'identifiant du formulaire
 * @return string Retourne le nom du cookie
 */
function formidable_generer_nom_cookie($id_formulaire){
    return $GLOBALS['cookie_prefix'].'cookie_formidable_'.$id_formulaire;
}

/*
 * Vérifie si le visiteur a déjà répondu à un formulaire
 *
 * @param int $id_formulaire L'identifiant du formulaire
 * @param string $choix_identification Comment verifier une reponse. Priorite sur 'cookie' ou sur 'id_auteur'
 * @param string $anonymisation : vaut '' si le formulaire n'est pas anonymisé, sinon c'est la variable d'anonymisation
 * @return unknown_type Retourne un tableau contenant les id des réponses si elles existent, sinon false
 */
function formidable_verifier_reponse_formulaire($id_formulaire, $choix_identification='cookie', $anonymisation=''){
    global $auteur_session;
    $id_auteur = $auteur_session ? intval($auteur_session['id_auteur']) : 0;
    $nom_cookie = formidable_generer_nom_cookie($id_formulaire);
    $cookie = isset($_COOKIE[$nom_cookie]) ? $_COOKIE[$nom_cookie] : false;

    $anonymiser = ($anonymisation == '') ? false : true;
    if ($anonymiser) $anonymiser_variable = $anonymisation;

    // traitement de l'anonymisation
    if ($anonymiser) {
        // mod de l'id_auteur
        $variables_anonymisation =
                $GLOBALS['formulaires']['variables_anonymisation'][$anonymiser_variable];
        $id = eval("return $variables_anonymisation;");
        $id_auteur = formidable_scramble($id, $id_formulaire);
    }
    // ni cookie ni id, on ne peut rien faire
    if (!$cookie and !$id_auteur) {
        return false;
    }

    // priorite sur le cookie
    if ($choix_identification == 'cookie' or !$choix_identification) {
        if ($cookie)
            $where = '(cookie='.sql_quote($cookie).($id_auteur ? ' OR id_auteur='.$id_auteur.')' : ')');
        else
            $where = 'id_auteur='.$id_auteur;
    }

    // sinon sur l'id_auteur
    else {
        if ($id_auteur)
            $where = 'id_auteur='.$id_auteur;
        else
            $where = '(cookie='.sql_quote($cookie).($id_auteur ? ' OR id_auteur='.$id_auteur.')' : ')');
    }

    $reponses = sql_allfetsel(
        'id_formulaires_reponse',
        'spip_formulaires_reponses',
        array(
            array('=', 'id_formulaire', intval($id_formulaire)),
            array('=', 'statut', sql_quote('publie')),
            $where
        ),
        '',
        'date'
    );

    if (is_array($reponses))
        return array_map('reset', $reponses);
    else
        return false;
}

/*
 * Génère la vue d'analyse de toutes les réponses à une saisie
 *
 * @param array $saisie Un tableau décrivant une saisie
 * @param array $env L'environnement, contenant normalement la réponse à la saisie
 * @return string Retour le HTML des vues
 */
function formidable_analyser_saisie($saisie, $valeurs=array(), $reponses_total=0, $format_brut=false) {
    // Si le paramètre n'est pas bon ou que c'est un conteneur, on génère du vide
    if (!is_array($saisie) or (isset($saisie['saisies']) and $saisie['saisies']))
        return '';

    $contexte = array('reponses_total'=>$reponses_total);

    // On sélectionne le type de saisie
    $contexte['type_saisie'] = $saisie['saisie'];

    // Peut-être des transformations à faire sur les options textuelles
    $options = $saisie['options'];
    foreach ($options as $option => $valeur){
        $options[$option] = _T_ou_typo($valeur, 'multi');
    }

    // On ajoute les options propres à la saisie
    $contexte = array_merge($contexte, $options);

    // On récupère toutes les valeurs du champ
    if (isset($valeurs[$contexte['nom']]) and $valeurs[$contexte['nom']] and is_array($valeurs[$contexte['nom']])){
        $contexte['valeurs'] = $valeurs[$contexte['nom']];
    }
    else{
        $contexte['valeurs'] = array();
    }

    // On génère la saisie
    if ($format_brut) {
        return analyser_saisie($contexte);
    } else {
        return recuperer_fond(
            'saisies-analyses/_base',
            $contexte
        );
    }
}

/*
 * Renvoie une ligne de réponse sous la forme d'un tableau
 *
 * @param array $saisie Un tableau décrivant une saisie
 * @return array Tableau contenant une ligne
 */
function analyser_saisie($saisie) {
    if (!isset($saisie['type_saisie']) or $saisie['type_saisie'] == '')
        return '';

    $ligne = array();

    switch($saisie['type_saisie']) {
        case 'selecteur_rubrique' :
        case 'selecteur_rubrique_article' :
        case 'selecteur_article' :
            $ligne['plein'] = count(array_filter($saisie['valeurs']));
            $ligne['vide'] = count(array_diff_key($saisie['valeurs']
                , array_filter($saisie['valeurs'])));
        break;
        case 'radio' :
        case 'selection' :
        case 'selection_multiple' :
        case 'choix_couleur':
        case 'checkbox' :
            $stats = array();
            foreach($saisie['valeurs'] as $valeur) {
                if (is_array($valeur)) {
                    foreach($valeur as $choix) {
                        if (isset($stats["choix-$choix"]))
                            $stats["choix-$choix"]++;
                        else $stats["choix-$choix"] = 1;
                    }
                } else {
                    if (isset($stats["choix-$valeur"]))
                            $stats["choix-$valeur"]++;
                        else $stats["choix-$valeur"] = 1;
                }
            }
            $datas = is_string($saisie['datas'])
                ? saisies_chaine2tableau(saisies_aplatir_chaine($saisie['datas']))
                : $saisie['datas'];
            foreach($datas as $key => $val) {
                $nb = (isset($stats["choix-$key"]))
                    ? $stats["choix-$key"]
                    : 0;
                $ligne[$val] = $nb;
            }
        break;
        case 'destinataires' :
            $stats = array();
            foreach($saisie['valeurs'] as $valeur) {
                foreach($valeur as $choix) {
                    if (isset($stats["choix-$choix"]))
                        $stats["choix-$choix"]++;
                    else $stats["choix-$choix"] = 1;
                }
            }
            foreach($stats as $key => $val) {
                $key = str_replace('choix-', '', $key);
                if ($key == '') $key = '<valeur vide>';
                $auteur = sql_getfetsel('nom','spip_auteurs',"id_auteur=$key");
                $ligne[$auteur] = $val;
            }
        break;
    }

    $vide = 0;
    foreach($saisie['valeurs'] as $valeur) {
        if ($valeur == '') $vide++;
        switch($saisie['type_saisie']) {
            case 'case' :
            case 'oui_non' :
                if(isset($ligne['oui']) == false) $ligne['oui'] = 0;
                if(isset($ligne['non']) == false) $ligne['non'] = 0;
                if ($valeur) $ligne['oui']++; else $ligne['non']++;
            break;
            case 'input' :
            case 'hidden' :
            case 'explication' :
            break;
        }
    }
    $ligne['sans_reponse'] = $vide;
    $ligne['header'] = $saisie['label'] != ''
        ? $saisie['label']
        : $saisie['type_saisie'];

    return $ligne;
}


/**
 * Tente de déserialiser un texte
 *
 * Si le paramètre est un tableau, retourne le tableau,
 * Si c'est une chaîne, tente de la désérialiser, sinon
 * retourne la chaîne.
 *
 * @filtre
 *
 * @param string|array $texte
 *     Le texte (possiblement sérializé) ou un tableau
 * @return array|string
 *     Tableau, texte désérializé ou texte
**/
function filtre_tenter_unserialize_dist($texte) {
    if (is_array($texte)) {
        return $texte;
    }
    if ($tmp = @unserialize($texte)) {
        return $tmp;
    }
    return $texte;
}


/**
 * Retourne un texte du nombre de réponses
 *
 * @param int $nb
 *     Nombre de réponses
 * @return string
 *     Texte indiquant le nombre de réponses
**/
function titre_nb_reponses($nb) {
    if (!$nb) return _T('formidable:reponse_aucune');
    if ($nb == 1) return _T('formidable:reponse_une');
    return _T('formidable:reponses_nb', array('nb' => $nb));
}

/**
 * Transforme le hash MD5 en une valeur numérique unique
 *
 * trouvé ici : http://stackoverflow.com/questions/1422725/represent-md5-hash-as-an-integer
 * @param string $hex_str La valeur alphanumérique à transformer
 * @return string Valeur numérique
*/
function md5_hex_to_dec($hex_str) {
    $arr = str_split($hex_str, 4);
    foreach ($arr as $grp) {
        $dec[] = str_pad(hexdec($grp), 5, '0', STR_PAD_LEFT);
    }

    /* on s'assure que $result ne commence pas par un zero */
    $result = implode('', $dec);
    for ($cpt = 0 ; $cpt < strlen($result) ; $cpt++) {
        if ($result[$cpt] != '0') break;
    }
    $result = substr($result, $cpt);
    return $result;
}

/**
 * Transforme un login en une valeur numérique de 19 caractères
 *
 * NOTE: il devient impossible de retrouver la valeur d'origine car le HASH
 * est coupé à 19cars et est donc incomplet. L'unicité n'est pas garantie mais
 * les chances pour que deux logins tombent sur le même HASH sont de 1 sur
 * 10 milliards de milliards
 * A la fin, on recherche et supprime les éventuels zéros de début
 * @param string $login Login à transformer
 * @param string $id_form ID du formulaire concerné
 * @param string $passwd Chaîne 'secrète' ajoutée au login et id_formulaire pour éviter
 *  les recoupements d'identité entre plusieurs formulaires
 * @return string Un nombre de 19 chiffres
*/
function formidable_scramble($login, $id_form, $passwd = '') {
    if ($passwd == '')
        $passwd = $GLOBALS['formulaires']['passwd']['interne'];
    $login_md5 = md5("$login$passwd$id_form");
    $login_num = md5_hex_to_dec($login_md5);
    $login_num = substr($login_num, 0, 19);

    return $login_num;
}

?>

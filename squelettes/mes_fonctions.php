
<?php 

function trunctext($texte, $longeur_max)
{
    if (strlen($texte) > $longeur_max)
    {
    $texte = substr($texte, 0, $longeur_max);
    $dernier_espace = strrpos($texte, " ");
    $texte = substr($texte, 0, $dernier_espace)."...";
    }

    return $texte;
}

function critere_compteur_publie($idb, &$boucles, $crit){
 $op='';
 $boucle = &$boucles[$idb];
 $params = $crit->param;
 $type = array_shift($params);
 $type = $type[0]->texte;
 if(preg_match(',^(\w+)([<>=])([0-9]+)$,',$type,$r)){
     $type=$r[1];
     $op=$r[2];
     $op_val=$r[3];
 }
 $type_id = 'compt.id_'.$type;
 $type_requete = $boucle->type_requete;
 $id_table = $boucle->id_table . '.' . $boucle->primary;
 $boucle->select[]= 'COUNT('.$type_id.') AS compteur_'.$type;
 $boucle->from['compt']="spip_".$type;
 $boucle->where[]= array("'='", "'".$id_table."'", "'compt.".$boucle->primary."'");
 $boucle->where[]= array("'='", "'compt.statut'" , "'\"publie\"'"); 
 $boucle->group[]=$id_table;
 if ($op)
     $boucle->having[]= array("'".$op."'", "'compteur_".$type."'",$op_val);

} 

function balise_COMPTEUR_FORUM_dist($p) {
   $p->code = '$Pile[$SP][\'compteur_forum\']';
   $p->interdire_scripts = false;
   return $p;
} 

?>

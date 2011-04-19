<?php

// {portrait}
function critere_portrait($idb, &$boucles) {
  $boucle = &$boucles[$idb];
  $table = $boucle->id_table;
  $not = $param->not;
  if ($not) 
	$boucle->where[] = "'$table.hauteur <= $table.largeur'";
  else
	$boucle->where[] = "'$table.hauteur > $table.largeur'";
}

// {paysage}
function critere_paysage($idb, &$boucles) {
  $boucle = &$boucles[$idb];
  $table = $boucle->id_table;
  $not = $param->not;
  if ($not) 
	$boucle->where[] = "'$table.largeur <= $table.hauteur'";
  else 
	$boucle->where[] = "'$table.largeur > $table.hauteur'";
}

// {carre}
function critere_carre($idb, &$boucles) {
  $boucle = &$boucles[$idb];
  $table = $boucle->id_table;
  $not = $param->not;
  if ($not) 
	$boucle->where[] = "'$table.largeur != $table.hauteur'";
  else
	$boucle->where[] = "'$table.largeur = $table.hauteur'";
}

?>
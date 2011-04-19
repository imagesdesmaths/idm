<?php
function balise_AIDE_RECHERCHE($p) {
	if (!function_exists('recuperer_fond')) include_spip('public/assembler');
  //    $arg = interprete_argument_balise(1, $p);
    $mess_aide = str_replace("'","\'",recuperer_fond('aide_recherche', array('lang'=>$GLOBALS['spip_lang'])));
    $p->code = "'$mess_aide'";
    $p->statut = 'html';
    return $p;
}

?>
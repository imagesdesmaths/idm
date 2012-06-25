<?php

// fonctions bientot obsoletes sous SPIP3 (ancienne façon de faire des formulaires SPIP)
// a bientot remplacer par CVT

function cs_ajax_outil_greffe($idom, $corps)	{
	// en fait, ajax uniquement si une modif est demandee...
	return _request('modif')=='oui'
		?'<div class="cs_modif_ok">&gt;&nbsp;'._T('couteauprive:vars_modifiees')."&nbsp;&lt;</div>$corps"
		:"\n<div id='$idom'>$corps\n</div>\n";
}

include_spip('inc/actions');
if(!function_exists('ajax_action_auteur')) {

	// Retourne un formulaire d'execution de $action sur $id,
	// revenant a l'envoyeur $script d'arguments $args.
	// Utilise Ajax si dispo, en ecrivant le resultat dans le innerHTML du noeud
	// d'attribut  id = $action-$id (cf. AjaxSqueeze dans layer.js)
	function ajax_action_auteur($action, $id, $script, $args='', $corps=false, $args_ajax='', $fct_ajax='') {
		if (strpos($args,"#")===FALSE)
			$ancre = "$action-" . intval($id);
		else
			list($args, $ancre) = explode("#",$args);
		// Formulaire (POST)
		// methodes traditionnelle et ajax a unifier...
		if (is_string($corps)) {
			// Methode traditionnelle
			if (_SPIP_AJAX !== 1)
				return redirige_action_post($action, $id, $script, "$args#$ancre", $corps);
			// Methode Ajax
			else {
				if ($args AND !$args_ajax) $args_ajax = "&$args";
				if (isset($_GET['var_profile'])) $args_ajax .= '&var_profile=1';
				return redirige_action_post($action, $id, $action, "script=$script$args_ajax",
					$corps, (" onsubmit=" . ajax_action_declencheur('this', $ancre, $fct_ajax)));
	
			}
		}
		// Lien (GET)
		else {
			$href = redirige_action_auteur($action,	$id, $script, "$args#$ancre", false);
			if ($args AND !$args_ajax) $args_ajax = "&$args";
			if (isset($_GET['var_profile'])) $args_ajax .= '&var_profile=1';
			$ajax = redirige_action_auteur($action, $id, $action, "script=$script$args_ajax");
			$cli = array_shift($corps);
			return "<a href='$href'\nonclick=" .  ajax_action_declencheur($ajax, $ancre, $fct_ajax)
				. ">" . (!$corps ?  $cli : ("\n<span" . $corps[0] . ">$cli</span>")) . "</a>";
		}
	}
	
	function ajax_action_declencheur($request, $noeud, $fct_ajax='') {
		if (strpos($request, 'this') !== 0)
			$request = "'".$request."'";
		return '"return AjaxSqueeze2(' . $request . ",'" . $noeud . "'," . ($fct_ajax ? $fct_ajax : "''") . ',event)"';
	}

}
?>
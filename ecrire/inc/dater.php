<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/presentation');
include_spip('inc/texte');
include_spip('inc/actions');
include_spip('inc/date');

// http://doc.spip.org/@inc_dater_dist
function inc_dater_dist($id, $flag, $statut, $type, $script, $date, $date_redac='')
{
	global $spip_lang_left, $spip_lang_right, $debut_date_publication;

	if (preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2})( ([0-9]{2}):([0-9]{2}))?/", $date_redac, $regs)) {
		$annee_redac = $regs[1];
		$mois_redac = $regs[2];
		$jour_redac = $regs[3];
		$heure_redac = $regs[5];
		$minute_redac = $regs[6];
		if ($annee_redac > 4000) $annee_redac -= 9000;
	} else $annee_redac = $mois_redac = $jour_redac = 0;

	$possedeDateRedac= ($annee_redac + $mois_redac + $jour_redac);

	if (preg_match("/([0-9]{4})-([0-9]{2})-([0-9]{2})( ([0-9]{2}):([0-9]{2}))?/", $date, $regs)) {
		$annee = $regs[1];
		$mois = $regs[2];
		$jour = $regs[3];
		$heure = $regs[5];
		$minute = $regs[6];
	}

  if ($flag) {

		include_spip('inc/autoriser');
		if (autoriser('dater',$type,$id,null,array('statut'=>$statut))) {

			$js = " onchange=\"findObj_forcer('valider_date').style.visibility='visible';\"";

			$invite =  "<b><span class='verdana1'>"
			. _T('texte_date_publication_article')
			. '</span> '
			.  majuscules(affdate($date))
			.  "</b>"
			. aide('artdate');

			$masque =
				afficher_jour($jour, "name='jour' id='jour' $js", false)
			. afficher_mois($mois, "name='mois' id='mois' $js", false)
			. afficher_annee($annee, "name='annee' id='annee' $js", $debut_date_publication)
			. (($type != 'article')
				 ? ''
				 : (' - '
				. afficher_heure($heure, "name='heure' id='heure' $js")
						. afficher_minute($minute, "name='minute' id='minute' $js")))
				. "&nbsp;\n";

			$res = "<div style='margin: 5px; margin-$spip_lang_left: 20px;'>"
			.  ajax_action_post("dater",
						"$id/$type",
						$script,
						"id_$type=$id",
						$masque,
						_T('bouton_changer'),
								 " class='visible_au_chargement' id='valider_date'", "",
						"&id=$id&type=$type")
			.  "</div>";

			$res = block_parfois_visible('datepub', $invite, $res, 'text-align: left');

		} else {
			if ($type == 'article')
				$res = "\n<div style='padding-$spip_lang_left:7px;'><b> <span class='verdana1'>"
				. _T('texte_date_creation_article')
				. "</span>\n"
				. majuscules(affdate($date))."</b>".aide('artdate')."</div>";
			else
				$res = "\n<div style='text-align:center;'><b>"
				. majuscules(affdate($date))."</b></div>";
		}

		if (($type == 'article')
		AND ($GLOBALS['meta']["articles_redac"] != 'non'
			OR $possedeDateRedac)) {
			if ($possedeDateRedac)
				$date_affichee = majuscules(affdate($date_redac))
	#			." " ._T('date_fmt_heures_minutes', array('h' =>$heure_redac, 'm'=>$minute_redac))
				;
			else
				$date_affichee = majuscules(_T('jour_non_connu_nc'));

			$js = "\"findObj_forcer('valider_date_redac').style.visibility='visible';\"";

			$invite = "<b>"
			. "<span class='verdana1'>"
			. majuscules(_T('texte_date_publication_anterieure'))
			. '</span> '
			. $date_affichee
			. " "
			. aide('artdate_redac')
			.  "</b>";

			$masque =
				"<div style=''>" .
				'<input type="radio" name="avec_redac" value="non" id="avec_redac_on"' .
				($possedeDateRedac ? '' : ' checked="checked"') .
				" onclick=$js" .
				' /> <label for="avec_redac_on">'.
				_T('texte_date_publication_anterieure_nonaffichee').
				'</label>' .
				'<br /><input type="radio" name="avec_redac" value="oui" id="avec_redac_off"' .
				(!$possedeDateRedac ? '' : ' checked="checked"') .
				" onclick=$js /> <label for='avec_redac_off'>" .
				_T('bouton_radio_afficher').
				' :</label> ' .
				afficher_jour($jour_redac, "name='jour_redac' id='jour_redac' onchange=$js", true) .
				afficher_mois($mois_redac, "name='mois_redac' id='mois_redac' onchange=$js", true) .
				"<input type='text' name='annee_redac' id='annee_redac' value='".$annee_redac."' size='5' maxlength='4' onclick=$js />" .
				'<div style="text-align: center; width: 80%;">' .
				afficher_heure($heure_redac, "name='heure_redac' id='heure_redac' onchange=$js", true) .
				afficher_minute($minute_redac, "name='minute_redac' id='minute_redac' onchange=$js", true) .
				"</div></div>";


			$masque =  "<div style='margin: 5px; margin-$spip_lang_left: 20px;'>" .
				ajax_action_post("dater",
						 "$id/$type",
						 $script,
						 "id_$type=$id",
						 $masque,
						 _T('bouton_changer'),
						 " style='float:$spip_lang_right;margin-top:-2em;position:relative;' class='visible_au_chargement' id='valider_date_redac'", "",
						 "&id=$id&type=$type")
						 ."<div class='nettoyeur'></div>"
			. '</div>';

			$res .= block_parfois_visible('dateredac', $invite, $masque, 'text-align: left');
		}
	} else {

		$res = "<div style='text-align:center;'><b> <span class='verdana1'>"
			. (($statut == 'publie' OR $type != 'article')
			? _T('texte_date_publication_article')
			: _T('texte_date_creation_article'))
		. "</span> "
		.  majuscules(affdate($date))."</b>".aide('artdate')."</div>";

		if ($possedeDateRedac) {
			$res .= "<div style='text-align:center;'><b><span class='verdana1'>"
			. _T('texte_date_publication_anterieure')
			. "</span> "
			. ' : '
			. majuscules(affdate($date_redac))
			. "</b>"
			. aide('artdate_redac')
			. "</div>";
		}
  }

  return ajax_action_greffe("dater", $id, $res);
}

?>

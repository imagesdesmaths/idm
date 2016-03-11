<?php

// module inclu dans la description de l'outil en page de configuration

include_spip('inc/actions');

function spip_log_ligne($f, $id=0) {
	$t = filemtime($f); $b = basename($f);
	$c = $t<time()-(28*24*3600)?" checked='checked'":'';
	$t = date_relative(date('Y-m-d H:i:s', $t));
	$n = $id?"log.$id":$b;
	$n = cs_lien(generer_url_ecrire('action_rapide',"arg=spip_log|liste_objets&script=foo&log=$b"), $n);
	if(!$id) $n .= " <small class='time'>($t)</small>";
	return "<label><input type='checkbox' value=\"$b\" name='logs[]' $c/>$n</label>";
}

function spip_log_action_rapide($actif) {
	if(!defined('_SPIP30000')) return '';
	if(!$actif) return str_replace(':','',couteauprive_T('fichiers_vider'));
	include_spip('public/assembler'); // pour recuperer_fond()
	$fichiers = preg_files(_DIR_LOG.'.*[.]log([.]\d+)?$');
	foreach ($fichiers as $f) if(preg_match(',[.]log$,', $f)) {
		$r = spip_log_ligne($f); $b = basename($f); $i = 0;
		while(in_array($f.'.'.++$i, $fichiers)) $r .= spip_log_ligne("$f.$i", $i);
		$res[filemtime($f)] = $r;
	}
	krsort($res);
	return (!count($res) ? couteauprive_T('spip_log_introuvables')
		:ajax_action_rapide_simple('supprime_logs', join("<br/>\n",$res), 'couteauprive:fichiers_vider', 'couteauprive:fichiers_detectes'))
	  . bouton_actualiser_action_rapide();
}

// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function spip_log_supprime_logs_action($logs=false) {
	if(!$logs) $logs = _request('logs');
	spip_log('### Suppression demandee : ' . print_r($logs, 1));
	if(!is_array($logs) || !count($logs)) return;
	foreach($logs as $l)
		supprimer_fichier(_DIR_LOG.$l);
}

// Fonction appelee par exec/action_rapide : ?exec=action_rapide&arg=spip_log|liste_objets (pipe obligatoire)
// Permet de voir les logs (SPIP >= 3.0)
function spip_log_liste_objets_exec() {
	$log = _request('log');
/*	if($s=_request('suppr')) {
		spip_log_supprime_logs_action(array($log));
		include_spip('inc/headers');
		redirige_par_entete(parametre_url(self(),'suppr','','&'));
	}*/
	include_spip('inc/pipelines'); // f_jQuery()
	include_spip('inc/commencer_page'); // init_head()
	echo '<html><head>'.f_jQuery(init_head(couteauprive_T('spip_log:nom')))
		.'<meta http-equiv="Content-Type" content="text/html; charset='.$GLOBALS['meta']['charset'].'" /></head><body style="text-align:center">'
		.(recuperer_fond('fonds/spip_log', array('log'=>_DIR_LOG.$log, 'sens_lecture_log'=>_request('sens_lecture_log'), 'tri_lecture_log'=>_request('tri_lecture_log'), 'debut_lecture_log'=>_request('debut_lecture_log') )))
		.'</body></html>';
}


function spip_log_phraser($log) {
	$pre = array(
		'hs'=>_LOG_HS,
		'alerte'=>_LOG_ALERTE_ROUGE,
		'critique'=>_LOG_CRITIQUE,
		'erreur'=>_LOG_ERREUR,
		'warning'=>_LOG_AVERTISSEMENT,
		'!info'=>_LOG_INFO_IMPORTANTE,
		'info'=>_LOG_INFO,
		'debug'=>_LOG_DEBUG, 
		'trace'=>8);
	if ($contenu = spip_file_get_contents($log)) {
		$contenu = preg_split('/[\r\n]+/', $contenu);
		$res = array();
		foreach($contenu as $l) {
			preg_match('#^(.*:\d\d)\s(.*?)\s\(pid\s(.*?)\)\s(.*)$#i', $l = trim($l), $matches);
			if (!$matches[1]) {
				// Ce n'est pas une nouvelle ligne mais la suite du texte de la ligne en cours
				if($c = count($res)) $res[$c - 1]['texte'] .= "\n" . $l;
					else $res[] = array('texte' => $l);
			}
			else {
				$ligne['datelog'] = date('Y-m-d H:i:s', strtotime($matches[1]));
				$ligne['ip'] = trim($matches[2]);
				$ligne['pid'] = trim($matches[3]);
				if(strncmp($matches[4],':P',2)==0) {
					// syntaxe par defaut
					preg_match('#^:([bipru]*):([^:]*):\s(.*)$#Smi', $matches[4], $matches);
					$ligne['hit'] = _T(strtolower(trim($matches[1]))=='pri'?'item_oui':'item_non');
					$grav = strtolower(trim($matches[2]));
					$ligne['texte'] = trim($matches[3]);
				} else {
					// syntaxe etendue
					preg_match('#^(.*?:L\d+:.*?\(\))::([bipru]*):([^:]*):\s(.*)$#Smi', $matches[4], $matches);
					$ligne['hit'] = _T(strtolower(trim($matches[2]))=='pri'?'item_oui':'item_non');
					$grav = strtolower(trim($matches[3]));
					$ligne['texte'] = '<b>'.trim($matches[1]).'</b><br />'.trim($matches[4]);
				}
				$ligne['gravite'] = $pre[$grav].'.&nbsp;'.$grav;
				$res[] = $ligne;
			}
		}
	}
	return $res;
}


?>
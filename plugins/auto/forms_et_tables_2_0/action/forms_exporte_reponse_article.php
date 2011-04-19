<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * © 2005,2006 - Distribue sous licence GNU/GPL
 *
 */
include_spip('inc/forms');
include_spip('inc/texte');

function action_forms_exporte_reponse_article(){
	$id_donnee = _request('arg');
	$hash = _request('hash');
	$id_auteur = _request('id_auteur');
	$redirect = _request('redirect');
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_exporte_reponse_article-$id_donnee",$hash,$id_auteur)==TRUE){
		// preparer l'article
		$id_article = 0;
		$res = spip_query("SELECT * FROM spip_forms_donnees AS r LEFT JOIN spip_forms AS f ON f.id_form = r.id_form WHERE r.id_donnee="._q($id_donnee));
		if ($row=spip_fetch_array($res)){
			$id_form = $row['id_form'];
			$titre = _T("forms:reponse",array('id_reponse'=>$id_donnee));
			$soustitre = $row['titre'];
			$date = $row['date'];
			list($lib,$values,$urls) = 	Forms_extraire_reponse($id_donnee);
			$texte = "";
			$res = spip_query("SELECT * FROM spip_forms_champs AS forms WHERE id_form="._q($id_form)." ORDER BY rang");
			while ($row = spip_fetch_array($res)){
				$titre = $row['titre'];
				$champ = $row['champ'];
				$type = $row['type'];
				if (!isset($values[$champ])){
					switch ($type){
						case 'textestatique':	$texte .= "\n{{{$titre}}}\n\n";	break;
						case 'separateur':	$texte .= "\n{{{{$titre}}}}\n\n";	break;
					}
				}
				else {
					$s = '';
					if (count($values[$champ])>1) $s = "\n-* ";
					foreach ($values[$champ] as $id=>$valeur){
						$valeur = typo($valeur);
						if(strlen($s)) $s .= "\n-* ";
						if ($lien = $urls[$champ][$id])
							$s .= "[$valeur -> $lien]";
						else
							$s .= $valeur;
					}
					switch ($type){
						case 'texte':	$texte .= "\n{{{$titre}}}\n_ $s\n";	break;
						case 'url':	$texte .= "_ {{{$titre}}} : [$s -> $s]\n";	break;
						case 'email':	$texte .= "_ {{{$titre}}} : [$s -> mailto:$s]\n";	break;
						default:
							$texte .= "_ {{{$titre}}} : $s\n";	break;
					}
				}
			}
			// creer un article
			include_spip('base/abstract_sql');
			//adapatation SPIP2
			/*$id_article = spip_abstract_insert("spip_articles",
			"(titre,soustitre,texte,date,statut)",
			"("._q($titre).","._q($soustitre).","._q($texte).","._q($date).",'prepa')");*/
			$id_article = sql_insert("spip_articles",
			"(titre,soustitre,texte,date,statut)",
			"("._q($titre).","._q($soustitre).","._q($texte).","._q($date).",'prepa')");
			if ($id_article!=0){
				spip_query("UPDATE spip_forms_donnees SET id_article_export=$id_article WHERE id_donnee="._q($id_donnee));
			}
		}
		if ($id_article!=0)
			redirige_par_entete(generer_url_ecrire('articles_edit',"id_article=$id_article",true));
		else
			redirige_par_entete($redirect);
	}
	else
		redirige_par_entete($redirect);
}
?>
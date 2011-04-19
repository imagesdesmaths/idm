<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2009                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/presentation');

function exec_documents_edit_dist()
{
	exec_documents_edit_args(intval(_request('id_document')),_request('parent'),_request('new'));
}

/**
 * Edition d'un document
 * parent est de la forme id_objet|objet (ex : 123|article)
 *
 * @param int $id_document
 * @param string $parent
 * @param string $new
 */
function exec_documents_edit_args($id_document, $parent, $new){

	$row = false;
	if (!( ($new!='oui' AND (!autoriser('voir','document',$id_document) OR !autoriser('modifier','document', $id_document)))
	       OR ($new=='oui' AND !autoriser('creer','document')) )) {
		if ($new != "oui")
			$row = sql_fetsel("*", "spip_documents", "id_document=$id_document");
		else $row = true;
	}
	if (!$row) {
		include_spip('inc/minipres');
		echo minipres();
	}
	else
		documents_edit_ok($row, $id_document, $parent, $new);
}

function documents_edit_ok($row, $id_document, $parent, $new)
{

	if (defined('_AJAX') AND _AJAX){
		$contexte = array(
		'redirect'=>'',//generer_url_ecrire("portfolio"),
		'new'=>$new == "oui"?$new:$id_document,
		'parent'=>$parent,
		'config_fonc'=>'documents_edit_config',
		'fichier'=>$row['fichier']
		);

		include_spip('inc/actions');
		// faire le retour ajax et le passer dans le pipeline "document_edit"
		// (sans s a document, pour preparer la migration vers l'extension medias de SPIP core)
		ajax_retour(
			pipeline('affiche_milieu',
				array('args'=>array('exec'=>'document_edit','id_document'=>$id_document),
				'data'=>recuperer_fond("prive/editer/document_popup", $contexte))
			)
		);
		return;
	}

	if ($new != 'oui') {
		$id_document=$row['id_document'];
		$titre=$row['titre']?$row['titre']:basename($row['fichier']);
		$statut=$row['statut'];
	}
	else {
		$titre = "";
		$statut = "prop";
	}

	$commencer_page = charger_fonction('commencer_page', 'inc');
	pipeline('exec_init',array('args'=>array('exec'=>'documents_edit','id_document'=>$id_document),'data'=>''));

	echo $commencer_page(_T('medias:titre_page_documents_edit', array('titre' => $titre)), "naviguer", "documents");

	echo debut_gauche('', true);
	$boite = pipeline ('boite_infos', array('data' => '',
		'args' => array(
			'type'=>'document',
			'id' => $id_document,
			'row' => $row
		)
	));

	echo debut_boite_info(true). $boite . fin_boite_info(true);
	
	echo recuperer_fond("prive/navigation/documents_edit",array('id_document'=>$id_document));
	echo pipeline('affiche_gauche',array('args'=>array('exec'=>'documents_edit','id_document'=>$id_document),'data'=>''));
	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite',array('args'=>array('exec'=>'documents_edit','id_document'=>$id_document),'data'=>''));
	echo debut_droite('', true);

	$redirect = _request('redirect') ? _request('redirect') : generer_url_ecrire("portfolio");
	$contexte = array(
	'icone_retour'=>$new=='oui'?'':icone_inline(_T('icone_retour'),$redirect, find_in_path("images/document-24.png"), "rien.gif",$GLOBALS['spip_lang_left']),
	'redirect'=>_request('redirect',''),//generer_url_ecrire("portfolio"),
	'titre'=>$titre,
	'new'=>$new == "oui"?$new:$id_document,
	'parent'=>$parent,
	'config_fonc'=>'documents_edit_config'
	);

	$milieu = recuperer_fond("prive/editer/document", $contexte);
	echo pipeline('affiche_milieu',array('args'=>array('exec'=>'documents_edit','id_document'=>$id_document),'data'=>$milieu));

	echo fin_gauche(), fin_page();

}

?>

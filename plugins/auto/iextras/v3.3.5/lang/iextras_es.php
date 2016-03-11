<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/iextras?lang_cible=es
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'action_associer' => 'gestionar este campo',
	'action_associer_title' => 'Gestionar la presentación de este campo adicional',
	'action_desassocier' => 'desasociar',
	'action_desassocier_title' => 'Dejar de gestionar la presentación de este campo adicional',
	'action_descendre' => 'descender',
	'action_descendre_title' => 'Desplazar el campo una fila hacia abajo',
	'action_modifier' => 'modificar',
	'action_modifier_title' => 'Modificar la configuración del campo adicional',
	'action_monter' => 'subir',
	'action_monter_title' => 'Subir el campo una afila hacia arriba',
	'action_supprimer' => 'eliminar',
	'action_supprimer_title' => 'Eliminar totalmente el campo de la base de datos',

	// C
	'caracteres_autorises_champ' => 'Caracteres posibles: letras sin acento, cifras, - y _',
	'caracteres_interdits' => 'Algunos caracteres utilizados no son adecuados para este campo.',
	'champ_deja_existant' => 'Un campo homónimo ya existe para esta tabla. ',
	'champ_sauvegarde' => '¡Campo adicional guardado!',
	'champs_extras' => 'Campos Adicionales',
	'champs_extras_de' => 'Campos Adicionales de: @objet@',

	// E
	'erreur_action' => 'Acción @action@ desconocida.',
	'erreur_enregistrement_champ' => 'Problema de creación de campo adicional. ',

	// I
	'icone_creer_champ_extra' => 'Crear un nuevo campo adicional ',
	'info_description_champ_extra' => 'Esta página permite administrar campos adicionales, es decir, campos adicionales en la tablas de SPIP, tomados en cuenta en los formularios de edición.',
	'info_description_champ_extra_creer' => 'Puede crear nuevos campos que se mostrarán sobre esta página, en el cuadro «Lista de campos extras», así como en los formularios.', # MODIF
	'info_description_champ_extra_presents' => 'Finalmente, si los campos ya existen en vuestra base de datos, pero no están declarados (por un plugin o un juego de esqueletos), puede pedir a este plugin que los administre. Estos campos, si los hay, aparecen en el cuadro «Lista de los campos no administrados».',
	'info_modifier_champ_extra' => 'Modificar campo adicional',
	'info_nouveau_champ_extra' => 'Nuevo campo adicional',
	'info_saisie' => 'Entrada:',

	// L
	'label_attention' => 'Explicaciones muy importantes',
	'label_champ' => 'Nombre del campo',
	'label_class' => 'Clases CSS',
	'label_datas' => 'Lista de valores',
	'label_explication' => 'Explicaciones de la entrada',
	'label_label' => 'Etiqueta de la entrada',
	'label_obligatoire' => '¿Campo obligatorio?',
	'label_rechercher' => 'Búsqueda',
	'label_rechercher_ponderation' => 'Ponderación de búsqueda',
	'label_restrictions_auteur' => 'Por autor',
	'label_restrictions_branches' => 'Por rama',
	'label_restrictions_groupes' => 'Por grupo',
	'label_restrictions_secteurs' => 'Por sector',
	'label_saisie' => 'Tipo de entrada',
	'label_sql' => 'Definición SQL',
	'label_table' => 'Objeto',
	'label_traitements' => 'Tratamientos automáticos',
	'label_versionner' => 'Versionar el contenido del campo',
	'legend_declaration' => 'Declaración',
	'legend_options_saisies' => 'Opciones de la entrada',
	'legend_options_techniques' => 'Técnica',
	'legend_restriction' => 'Restricción',
	'legend_restrictions_modifier' => 'Modificar la entrada',
	'legend_restrictions_voir' => 'Ver la entrada',
	'liste_des_extras' => 'Lista de campos adicionales',
	'liste_des_extras_possibles' => 'Lista de campos no administrados',
	'liste_objets_applicables' => 'Lista de objetos editoriales',

	// N
	'nb_element' => '1 elemento',
	'nb_elements' => '@nb@ elementos',

	// P
	'precisions_pour_attention' => 'Para algo muy importante a indicar.
¡Utilizar con mucha moderación!
Puede ser una cadena de idioma «plugin:cadena».',
	'precisions_pour_class' => 'Añadir las clases CSS sobre el elemento, separados por un espacio. Ejemplo: "inserer_barre_edition" para un blog con el plugin Porte Plume',
	'precisions_pour_datas' => 'Algunos tipos de campo solicitan una lista de valores acceptados: indíquelos uno por línea, seguidos por una coma y una descripción. Una líena vacía para el valor por defecto. La descripción puede ser una cadena de idioma. ',
	'precisions_pour_explication' => 'Puede dar más información sobre la entrada. 
Puede ser una cadena de idioma «plugin:cadena».',
	'precisions_pour_label' => 'Puede ser una cadena de idioma «plugin:cadena».',
	'precisions_pour_nouvelle_saisie' => 'Permite cambiar el tipo de entrada utilizada para este campo',
	'precisions_pour_nouvelle_saisie_attention' => '¡Tenga cuidado! Un cambio de tipo de entrada pierde las opciones de configuración de la entrada actual que no son comunes con la nueva entrada.',
	'precisions_pour_rechercher' => '¿Incluir este campo en el motor de búsqueda?',
	'precisions_pour_rechercher_ponderation' => 'SPIP pondera una búsqueda en una columna por un coeficient
Esto permite poner en relieve las columnas más importantes (las que aluden al título, por ejemplo), respecto a otras que lo son menos.
El coeficiente aplicado sobre los campos extras es 2 por defecto. Para que se haga una idea, tenga en cuenta que SPIP utiliza 8 para el título, 1 para el texto.',
	'precisions_pour_restrictions_branches' => 'Identificadores de ramas para restringir (separador «:»)',
	'precisions_pour_restrictions_groupes' => 'Identificadores de grupos para restringir (separador «:»)',
	'precisions_pour_restrictions_secteurs' => 'Identificadores de sectores para restringir (separador «:»)',
	'precisions_pour_saisie' => 'Mostrar una entrada de tipo:',
	'precisions_pour_traitements' => 'Aplicar automáticamente un tratamiento para la etiqueta #NOM_DU_CHAMP resultante:',
	'precisions_pour_versionner' => 'El versionado se aplicará únicamente si el plugin «revisiones» está activo y si el objeto editorial del campo está en sí mismo versionado',

	// R
	'radio_restrictions_auteur_admin' => 'Solamente los administradores', # MODIF
	'radio_restrictions_auteur_aucune' => 'Todo el mundo puede',
	'radio_restrictions_auteur_webmestre' => 'Solamente los webmasters',
	'radio_traitements_aucun' => 'Ninguno',
	'radio_traitements_raccourcis' => 'Tratamientos de atajos SPIP (propre)',
	'radio_traitements_typo' => 'Tratamientos de tipografía únicamente (tipo)',

	// S
	'saisies_champs_extras' => 'De «Campos Adicionales»',
	'saisies_saisies' => 'De «Entradas»',
	'supprimer_reelement' => '¿Eliminar este campo?',

	// T
	'titre_iextras' => 'Campos Adicionales',
	'titre_page_iextras' => 'Campos Adicionales',

	// V
	'veuillez_renseigner_ce_champ' => '¡Rellene por favor este campo!'
);

?>

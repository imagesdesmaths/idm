<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\form;

use jin\lang\ArrayTools;
use jin\dataformat\Json;
use jin\lang\StringTools;
use jin\output\components\form\AttachementFile;
use jin\log\Debug;
use jin\filesystem\File;

/** Gestion souple de formulaires
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check
 */
class DForm {

    /**
     *
     * @var array   Champs contenus dans le formulaire
     */
    private $fields = array();

    /**
     *
     * @var array   Champs pièce jointe contenus dans le formulaire
     */
    private $attachementFields = array();

    /**
     *
     * @var string  Classe erreur appliquée aux composants ayant généré une erreur de validation
     */
    private $errorClassName = 'error';

    /**
     * Ajout d'un champ
     * @param mixed $field   Accepte soit une chaîne de caractères définissant l'identifiant du champ, soit un composant de type FormComponent
     * @param string|array $defaultValue   Valeur par défaut. Tableau de données pour les composants pouvant supporter plusieurs valeurs. (Ex. COMBO)
     * @param string $dataSourceColumn	Si le DForm est lié à une dataSource, précise dans quel champ rechercher les données
     * @param string $validateurs   Structure JSON définissant les validateurs à utiliser. Ex : {"notnull":"","numrange":{"minValue":0,"maxValue":100}}
     * @return boolean	Succès ou echec
     * @throws \Exception
     */
    public function addField($field, $defaultValue = null, $dataSourceColumn = null, $validateurs = null) {
	//Pour gérer les composants
	if (is_string($field)) {
	    $fieldName = $field;
	} else {
	    $fieldName = $field->getName();
	}


	//Teste si le champ n'existe pas déjà
	if (ArrayTools::isKeyExists($this->fields, $fieldName)) {
	    throw new \Exception('Impossible d\'ajouter le champ' . $fieldName . ' : celui ci est déjà défini dans le DForm');
	    return false;
	}


	//Ajout des validateurs
	$validat = array();
	if ($validateurs) {
	    $jsonV = Json::decode($validateurs);
	    if (!is_null($validateurs) && is_null($jsonV)) {
		throw new \Exception('Le format JSon fourni pour les validateurs n\'est pas conforme : ' . Json::getLastErrorVerbose());
		return false;
	    }
	    foreach ($jsonV as $key => $value) {
		$className = 'jin\output\form\validators\\' . StringTools::firstCarToUpperCase($key);
		$c = new $className($value);
		$validat[] = $c;
	    }
	}

	//Finalisation
	$newline = array('defaultValue' => $defaultValue, 'dataSourceColumn' => $dataSourceColumn, 'validateurs' => $validat, 'errors' => array(), 'value' => null);
	if (!is_string($field)) {
	    $newline['component'] = $field;
	}
	$this->fields[$fieldName] = $newline;


	return true;
    }

    /**
     * Ajout d'un champ de type AttachementFile
     * @param \jin\output\components\form\AttachementFile $fileComponent    Composant AttachementFile
     * @param type $uploadFolder    Dossier de destination (chemin absolu) ou nom forcé de fichier
     * @param type $validateurs	    Structure JSON définissant les validateurs de type FILE à utiliser. Ex : {"notnull":"","minsize":{"minsize":2000}}
     * @return boolean
     * @throws \Exception
     */
    public function addAttachementField(AttachementFile $fileComponent, $uploadFolder, $validateurs = null) {
	$fieldName = $fileComponent->getName();

	//Teste si le champ n'existe pas déjà
	if (ArrayTools::isKeyExists($this->attachementFields, $fieldName)) {
	    throw new \Exception('Impossible d\'ajouter la pièce jointe ' . $fieldName . ' : celle ci est déjà définie dans le DForm');
	    return false;
	}

	$validat = array();
	if ($validateurs) {
	    $jsonV = Json::decode($validateurs);
	    if (!is_null($validateurs) && is_null($jsonV)) {
		throw new \Exception('Le format JSon fourni pour les validateurs n\'est pas conforme : ' . Json::getLastErrorVerbose());
		return false;
	    }
	    foreach ($jsonV as $key => $value) {
		$className = 'jin\output\form\validators\file\\' . StringTools::firstCarToUpperCase($key);
		$c = new $className($value);
		$validat[] = $c;
	    }
	}

	//Finalisation
	$newline = array('outputfile' => '', 'component' => $fileComponent, 'validateurs' => $validat, 'errors' => array(), 'uploadfolder' => $uploadFolder);
	$this->attachementFields[$fieldName] = $newline;
    }

    /**
     * Supprime les fichiers attachés transférés sur le serveur
     */
    public function deleteAttachementFiles() {
	foreach ($this->attachementFields as $fieldName => $v) {
	    if ($v['outputfile'] != '' && file_exists($v['outputfile'])) {
		$f = new File($v['outputfile']);
		$f->delete();
	    }
	}
    }

    /**
     * Permet de tester la validité des valeurs du formulaire
     * @return boolean	TRUE si le formulaire est valide
     */
    public function isValid() {
	$valide = true;

	//On passe dans les champs de type FIELD
	foreach ($this->fields as $fieldName => $v) {

	    //Champs standard
	    //On réinitialise les erreurs
	    $this->fields[$fieldName]['errors'] = array();

	    //On détermine la nouvelle valeur
	    if(isset($_POST[$fieldName])){
		$this->fields[$fieldName]['value'] = $_POST[$fieldName];
	    }else{
		$this->fields[$fieldName]['value'] = '';
	    }


	    //erreurs de niveau 2
	    $errors = array();
	    //Erreurs de niveau 1
	    $priorErrors = array();

	    //On passe par tous les validateurs pour checker la valeur
	    foreach ($v['validateurs'] as $v) {
		$vv = $v->isValid($this->fields[$fieldName]['value']);
		if (!$vv) {
		    $valide = false;
		    if ($v->isPrior()) {
			$priorErrors = ArrayTools::merge($priorErrors, $v->getErrors());
		    } else {
			$errors = ArrayTools::merge($errors, $v->getErrors());
		    }
		}
	    }

	    //On prend en considération les erreurs de niveau 1 ou 2 en fonction
	    if (ArrayTools::length($priorErrors) > 0) {
		$this->fields[$fieldName]['errors'] = $priorErrors;
	    } else {
		$this->fields[$fieldName]['errors'] = $errors;
	    }
	}

	//ON PASSE DANS LES PIECES JOINTES
	foreach ($this->attachementFields as $fieldName => $v) {
	    $val = '';
	    if (isset($_FILES[$fieldName])) {
		$val = $_FILES[$fieldName];
	    }
	    //On réinitialise les erreurs
	    $this->attachementFields[$fieldName]['errors'] = array();

	    //erreurs de niveau 2
	    $errors = array();
	    //Erreurs de niveau 1
	    $priorErrors = array();

	    //On passe par tous les validateurs pour checker la valeur
	    foreach ($v['validateurs'] as $v) {

		$vv = $v->isValid($val);
		if (!$vv) {
		    $valide = false;
		    if ($v->isPrior()) {
			$priorErrors = ArrayTools::merge($priorErrors, $v->getErrors());
		    } else {
			$errors = ArrayTools::merge($errors, $v->getErrors());
		    }
		}
	    }

	    //On prend en considération les erreurs de niveau 1 ou 2 en fonction
	    if (ArrayTools::length($priorErrors) > 0) {
		$this->attachementFields[$fieldName]['errors'] = $priorErrors;
	    } else {
		$this->attachementFields[$fieldName]['errors'] = $errors;
	    }
	}

	//SI tout est valide : enregistrer les pièces jointes
	if ($valide) {
	    foreach ($this->attachementFields as $fieldName => $v) {
		
		if (isset($_FILES[$fieldName]) && !empty($_FILES[$fieldName]['name'])) {
		    if(StringTools::right($v['uploadfolder'], 1) != '/'){
			//Nom de fichier forcé
			$uploadfile = $v['uploadfolder'];
		    }else{
			//On conserve le nom du fichier originel
			$uploadfile = $v['uploadfolder'] . basename($_FILES[$fieldName]['name']);
		    }
		    $this->attachementFields[$fieldName]['value'] = array(
			'filename' => $_FILES[$fieldName]['name'],
			'path' => $uploadfile
		    );
		    
		    if (!move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadfile)) {
			throw new \Exception('Erreur de transfert du fichier joint ' . $fieldName);
		    } else {
			$this->attachementFields[$fieldName]['outputfile'] = $uploadfile;
		    }
		}
	    }
	}

	return $valide;
    }

    /**
     * Retourne la valeur actuelle d'un champ
     * @param string $fieldName	Identifiant du champ ou du composant
     * @return string
     */
    public function getFieldValue($fieldName) {
	if(isset($this->fields[$fieldName])) {
	    if (isset($_FILES[$fieldName])) {
		//Cas particulier AttachementFile
		return $this->fields[$fieldName]['value'];
	    } else if(!isset($this->fields[$fieldName]['value']) && !empty($_POST)) {
		//cas particulier checkbox
		return array();
	    }else if(isset($this->fields[$fieldName]['value'])) {
		return $this->fields[$fieldName]['value'];
	    } else {
		return $this->fields[$fieldName]['defaultValue'];
	    }
	}else if(isset($this->attachementFields[$fieldName])){
	    return $this->attachementFields[$fieldName]['value'];
	}
	return '';
    }

    /**
     * Retourne l'erreur formattée d'un champ (nécessite l'appel à isValid au préalable)
     * @param string $fieldName	Identifiant du champ ou du composant
     * @param string $globalFormat  Template d'affichage autour des erreurs. %texte% est le mot clé permettant de spécifier où positionner les items générés
     * @param string $itemFormat	Template d'affichage de chaque erreur. %texte% est le mot clé permettant de spécifier ou positionner le texte de l'erreur
     * @return string
     */
    public function getFieldError($fieldName, $globalFormat = '<div class="error">%texte%</div>', $itemFormat = '<span>%texte%</span>') {
	if (isset($this->fields[$fieldName])) {
	    if (ArrayTools::length($this->fields[$fieldName]['errors']) > 0) {
		$toadd = '';
		foreach ($this->fields[$fieldName]['errors'] as $err) {
		    $toadd .= StringTools::replaceFirst($itemFormat, '%texte%', $err);
		}
		return StringTools::replaceFirst($globalFormat, '%texte%', $toadd);
	    }
	} else if (isset($this->attachementFields[$fieldName])) {
	    if (ArrayTools::length($this->attachementFields[$fieldName]['errors']) > 0) {
		$toadd = '';
		foreach ($this->attachementFields[$fieldName]['errors'] as $err) {
		    $toadd .= StringTools::replaceFirst($itemFormat, '%texte%', $err);
		}
		return StringTools::replaceFirst($globalFormat, '%texte%', $toadd);
	    }
	}
	return '';
    }

    /**
     * Retourne si un champ est en erreur ou non (nécessite l'appel à isValid au préalable)
     * @param string $fieldName Identifiant du champ
     * @return boolean|null TRUE si la validation du champ a rencontré une erreur
     */
    public function isFieldError($fieldName) {
	if (isset($this->fields[$fieldName])) {
	    if (ArrayTools::length($this->fields[$fieldName]['errors']) > 0) {
		return true;
	    } else {
		return false;
	    }
	} else if (isset($this->attachementFields[$fieldName])) {
	    if (ArrayTools::length($this->attachementFields[$fieldName]['errors']) > 0) {
		return true;
	    } else {
		return false;
	    }
	} else {
	    return null;
	}
    }

    /**
     * Retourne les erreurs d'un champ sous forme de tableau
     * @param string $fieldName	Identifiant du champ ou du composant
     * @return array
     */
    public function getFieldErrorInArray($fieldName) {
	if (isset($this->fields[$fieldName])) {
	    return $this->fields[$fieldName]['errors'];
	} else if (isset($this->attachementFields[$fieldName])) {
	    return $this->attachementFields[$fieldName]['errors'];
	}
	return array();
    }
    
    
    /**
     * Force une erreur dans un composant du formulaire
     * @param string $fieldName	Nom du champ
     * @param string $errorTxt	Erreur à forcer
     * @throws \Exception
     */
    public function setFieldError($fieldName, $errorTxt){
	if (isset($this->fields[$fieldName])) {
	    $this->fields[$fieldName]['errors'][] = $errorTxt;
	} else if (isset($this->attachementFields[$fieldName])) {
	    $this->attachementFields[$fieldName]['errors'][] = $errorTxt;
	}else{
	    throw new \Exception('Le champ '.$fieldName.' n\'existe pas');
	}
    }

    /**
     * Force la valeur d'un champ
     * @param string $fieldName	Identifiant du champ ou du composant
     * @param mixed $value
     */
    public function forceFieldValue($fieldName, $value) {
	$this->fields[$fieldName]['value'] = $value;
    }

    /**
     * Permet d'effectuer le rendu d'un champ de type component.
     * @param string $fieldName	Identifiant du champ ou du composant
     * @param string $globalFormat  Template d'affichage autour des erreurs. %texte% est le mot clé permettant de spécifier où positionner les items générés
     * @param string $itemFormat    Template d'affichage de chaque erreur. %texte% est le mot clé permettant de spécifier ou positionner le texte de l'erreur
     * @return type
     * @throws \Exception
     */
    public function renderComponentField($fieldName, $globalErrorFormat = '<div class="error">%texte%</div>', $itemErrorFormat = '<span>%texte%</span>') {
	if (isset($this->fields[$fieldName]['component'])) {
	    //Champ de type field
	    $this->fields[$fieldName]['component']->setValue($this->fields[$fieldName]['value']);
	    $this->fields[$fieldName]['component']->setDefaultValue($this->fields[$fieldName]['defaultValue']);
	    $this->fields[$fieldName]['component']->setError($this->getFieldError($fieldName, $globalErrorFormat, $itemErrorFormat));
	    if ($this->isFieldError($fieldName)) {
		$this->fields[$fieldName]['component']->addClass($this->errorClassName);
	    } else {
		$this->fields[$fieldName]['component']->removeClass($this->errorClassName);
	    }

	    return $this->fields[$fieldName]['component']->render();
	} else if (isset($this->attachementFields[$fieldName]['component'])) {
	    //Champ de type attachementField
	    $this->attachementFields[$fieldName]['component']->setError($this->getFieldError($fieldName, $globalErrorFormat, $itemErrorFormat));
	    if ($this->isFieldError($fieldName)) {
		$this->attachementFields[$fieldName]['component']->addClass($this->errorClassName);
	    } else {
		$this->attachementFields[$fieldName]['component']->removeClass($this->errorClassName);
	    }

	    return $this->attachementFields[$fieldName]['component']->render();
	} else {
	    throw new \Exception('Le champ ' . $fieldName . ' n\'existe pas ou n\'est pas lié à un composant');
	    return;
	}
    }

    /**
     * Retourne les données issues du formulaire sous forme de tableau
     * @param boolean $withAttachementsFields	[optionel] Définit si on souhaite voir apparaitre les données sur les pièces jointes (TRUE par défaut)
     * @param boolean $withStandardFields   [optionel] Définit si on souhaite voir apparaître les données des champs standard. (TRUE par défaut)
     * @return type
     */
    public function getDataInArray($withStandardFields = true, $withAttachementsFields = true) {
	$data = array();
	if ($withStandardFields) {
	    foreach ($this->fields as $fieldName => $v) {
		$data[$fieldName] = $v['value'];
	    }
	}
	if ($withAttachementsFields) {
	    foreach ($this->attachementFields as $fieldName => $v) {
		$data[$fieldName] = $v['outputfile'];
	    }
	}
	return $data;
    }


    /**
     * Redéfinit la classe CSS appliquée aux composants pour lesquels une erreur de validation a été relevée
     * @param string $className	Nom de la classe à appliquer
     */
    public function setErrorClassName($className) {
	$this->errorClassName = $className;
    }


    /**
     * Retourne la classe CSS actuellement appliquable aux composants pour lesquels une erreur de validation a été relevée
     * @return type
     */
    public function getErrorClassName() {
	return $this->errorClassName;
    }


    /**
     * Injecte un tableau de données dans le formulaire
     * @param array $values Valeurs à injecter
     * @return boolean Succès/Echec
     */
    public function populate($values) {
    if(!is_array($values)) {
        return false;
    }
    foreach ($this->fields as $fieldName => $v) {
        if(isset($values[$fieldName])) {
            $this->fields[$fieldName]['value'] = $values[$fieldName];
        }
    }
    foreach ($this->attachementFields as $fieldName => $v) {
        if(isset($values[$fieldName])) {
            $this->attachementFields[$fieldName]['value'] = $values[$fieldName];
        }
    }
    return true;
    }


    /**
     * Supprime toutes les données du formulaire
     */
    public function clear() {
    $data = array();
    foreach ($this->fields as $fieldName => $v) {
        $data[$fieldName] = null;
    }
    foreach ($this->attachementFields as $fieldName => $v) {
        $data[$fieldName] = null;
    }
    }

}



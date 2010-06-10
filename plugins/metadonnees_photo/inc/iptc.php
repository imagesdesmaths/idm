<?php
//#############################################################################################
//##############################################################################################

/* INFOS SUR LE FICHIER 

Nom : iptc.class.php 
Rôle : contient la classe permettant de gérer les IPTC d'un fichier image 
Développeur(s) : Arica Alex, Thies C. Arntzen 

FIN INFOS SUR LE FICHIER 


INFOS SUR LA CLASSE 'class_iptc' 

REFERENCES : Développée le 04 Octobre 02 par Arica Alex avec l'aide de Thies C. Arntzen 

ROLE : permet de manipuler les iptc d'une image 

VARIABLES : 
- $h_codesIptc 
- $h_cheminFichier 
- $h_iptcData 

METHODES : 
- fct_lireIPTC 
- fct_ecrireIPTC 
- fct_iptcMaketag 

FIN INFOS SUR LA CLASSE 

*/ 


class class_IPTC 
{ 



/* VARIABLES statics */ 

var $h_codesIptc; /* $h_codesIptc : (tableau associatif) contient les codes des champs IPTC associés à un libellé */ 
var $h_cheminImg; /* $h_cheminImg : (chaine) contient le chemin complet du fichier d'image */ 
var $h_iptcData; /* $h_iptcData : (chaine) contient les données encodées de l'iptc de l'image */ 

/* FIN VARIABLES statics 









------------------------------------------------------------------------------------------------------- 








INFOS SUR LA FONCTION 

ROLE : constructeur 
FONCTION : class_IPTC($cheminImg) 
DESCRIPTION DES PARAMETRES : 
- $cheminImg = (chaine) le chemin complet du fichier d'image à traiter 

FIN INFOS SUR LA FONCTION */ 


function class_IPTC($cheminImg) 
{ 

// Inititalisations 

// Les valeurs IPTC pouvant être manipulées 
$this -> h_codesIptc = array("005" => "objectName", 
"007" => "editStatus", 
"010" => "priority", 
"015" => "category", 
"020" => "supplementalCategory", 
"022" => "fixtureIdentifier", 
"025" => "keywords", 
"030" => "releaseDate", 
"035" => "releaseTime", 
"040" => "specialInstructions", 
"045" => "referenceService", 
"047" => "referenceDate", 
"050" => "referenceNumber", 
"055" => "createdDate", 
"060" => "createdTime", 
"065" => "originatingProgram", 
"070" => "programVersion", 
"075" => "objectCycle", 
"080" => "byline", 
"085" => "bylineTitle", 
"090" => "city", 
"095" => "provinceState", 
"100" => "countryCode", 
"101" => "country", 
"103" => "originalTransmissionReference", 
"105" => "headline", 
"110" => "credit", 
"115" => "source", 
"116" => "copyright", 
"120" => "caption", 
"121" => "localCaption", 
"122" => "captionWriter"); 


// On enregistre le chemin de l'image à traiter 
$this -> h_cheminImg = $cheminImg; 


// On extrait les données encodées de l'iptc 
// getimagesize($this -> h_cheminImg, &$info); //avant,marche pas sinon
getimagesize($this -> h_cheminImg, $info); //marche sans le & 
$this -> h_iptcData = $info["APP13"]; 

} 

/* FIN FONCTION class_IPTC(); 









------------------------------------------------------------------------------------------------------- 








INFOS SUR LA FONCTION 

ROLE : lit les IPTC d'une image et les renvoie dans un tableau associatif 
FONCTION : fct_lireIPTC() 
TYPE RETOURNE : chaine sous forme de tableau associatif 

FIN INFOS SUR LA FONCTION */ 

function fct_lireIPTC() 
{ 
	$tblIPTC = iptcparse($this -> h_iptcData); 
	
	while( (is_array($tblIPTC)) && (list($codeIPTC, $valeurIPTC) = each($tblIPTC)) ) 
	{ 
		$codeIPTC = str_replace("2#", "", $codeIPTC); 
		
		if( ($codeIPTC != "000") && ($codeIPTC != "140")  && $this->h_codesIptc["$codeIPTC"]) 
		{ 
			while(list($index, ) = each($valeurIPTC)) 
			{ 
				if ($this->h_codesIptc["$codeIPTC"]) $codeIPTC = $this->h_codesIptc["$codeIPTC"];
				$lesIptc[$codeIPTC] .= $valeurIPTC[$index].$retourLigne; 
				$retourLigne = "\n"; 
			} 
		} 
	} 
	
	if(is_array($lesIptc)) return $lesIptc; 
	else return false; 
} 

/* FIN FONCTION fct_lireIPTC(); 








------------------------------------------------------------------------------------------------------- 








INFOS SUR LA FONCTION 

ROLE : écrit des IPTC dans le fichier image 
FONCTION : fct_ecrireIPTC() 
DESCRIPTION DES PARAMETRES : 
- $tblIPTC_util = (tableau associatif) contient les codes des champs IPTC à modifier associés leur valeur 
- $cheminImgAModifier = (chaine) stocke le chemin de l'image dont l'IPTC est à modifier ; s'il est null 
le chemin sera celui contenu dans '$this -> h_cheminImg' 
TYPE RETOURNE : booléen 

FIN INFOS SUR LA FONCTION */ 

function fct_ecrireIPTC($tblIPTC_util, $cheminImgAModifier = "") 
{ 

// La tableau devant contenir des IPTC est vide ou n'est pas un tableau associatif 
if( (empty($tblIPTC_util)) || (!is_array($tblIPTC_util)) ) return false; 


// Si le chemin de l'image à modifier est vide alors on lui spécifie le chemin par défaut 
if(empty($cheminImgAModifier)) $cheminImgAModifier = $this -> h_cheminImg; 


// On récupère l'IPTC du fichier image courant 
$tblIPTC_old = iptcparse($this -> h_iptcData); 


// On prélève le tableau contenant les codes et les valeurs des IPTC de la photo 
while(list($codeIPTC, $codeLibIPTC) = each($this -> h_codesIptc)) 
{ 

// On teste si les données originelles correspondant au code en cours sont présents 
if (is_array($tblIPTC_old["2#".$codeIPTC])) $valIPTC_new = $tblIPTC_old["2#".$codeIPTC]; 
else $valIPTC_new = array(); 


// On remplace les valeurs des IPTC demandées 
if (is_array($tblIPTC_util[$codeIPTC])) 
{ 
if (count($tblIPTC_util[$codeIPTC])) $valIPTC_new = $tblIPTC_util[$codeIPTC]; 

}else{ 

$val = trim(strval($tblIPTC_util[$codeIPTC])); 
if (strlen($val)) $valIPTC_new[0] = $val; 
} 


// On crée un nouveau iptcData à partir de '$tblIPTC_new' qui contient le code et la valeur de l'IPTC 
foreach($valIPTC_new as $val) 
{ 
$iptcData_new .= $this -> fct_iptcMaketag(2, $codeIPTC, $val); 
} 

} 


/* A partir du nouveau iptcData contenu dans '$iptcData_new' on crée grâce à la fonction 'iptcembed()' 
le contenu binaire du fichier image avec le nouveau IPTC inclu */ 
$contenuImage = iptcembed($iptcData_new, $this -> h_cheminImg); 


// Ecriture dans le fichier image 
$idFichier = fopen($cheminImgAModifier, "wb"); 
fwrite($idFichier, $contenuImage); 
fclose($idFichier); 


return true; 

} 

/* FIN FONCTION fct_ecrireIPTC(); 








------------------------------------------------------------------------------------------------------- 








INFOS SUR LA FONCTION 

ROLE : permet de transformer une valeur de d'IPTC (code + valeur) en iptcData 
AUTEUR : Thies C. Arntzen 
FONCTION : fct_iptcMaketag($rec, $dat, $val) 
DESCRIPTION DES PARAMETRES : 
- $rec = (entier) toujours à mettre à 2 
- $dat = (chaine) le code de l'IPTC (de type '110' et non '2#110') 
- $val = (chaine) la valeur de l'IPTC 
TYPE RETOURNE : booléen 

FIN INFOS SUR LA FONCTION */ 

function fct_iptcMaketag($rec, $dat, $val) 
{ 
$len = strlen($val); 
if ($len < 0x8000) 
return chr(0x1c).chr($rec).chr($dat). 
chr($len >> 8). 
chr($len & 0xff). 
$val; 
else 
return chr(0x1c).chr($rec).chr($dat). 
chr(0x80).chr(0x04). 
chr(($len >> 24) & 0xff). 
chr(($len >> 16) & 0xff). 
chr(($len >> 8 ) & 0xff). 
chr(($len ) & 0xff). 
$val; 
} 

// FIN FONCTION fct_iptcMaketag(); 





} 

/* Fin class_IPTC */

?>
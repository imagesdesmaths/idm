<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\filesystem;

use jin\filesystem\File;
use jin\lang\StringTools;
use jin\JinCore;
use jin\log\Debug;

/** Permet d'utiliser des Assets, autrement dit des composants graphiques simples pouvant être rendus n'importe ou.
 * <br>Ils peuvt être soit des composant définis par Jin par défaut, soit des composants ajoutés. (Via le dossier surcharge)
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		22/04/2014
 */
class AssetFile {

    /**	Fichier
     *
     * @var jin\filesystem\File
     */
    private $file;


    /**	Url relative
     *
     * @var string
     */
    private $url;




    /**	Constructeur
     *
     * @param string $relativePath	    Chemin relatif
     */
    public function __construct($relativePath) {
	$surcharge = JinCore::getContainerPath() . JinCore::getConfigValue('surchargeAbsolutePath') . '/' . JinCore::getRelativePathAssets() . $relativePath;

	if(JinCore::getConfigValue('surcharge') && file_exists($surcharge)){
	    //Surcharge du fichier
	    $this->file = new File($surcharge);
	    $this->url = JinCore::getContainerUrl() . JinCore::getConfigValue('surchargeAbsolutePath') . '/' . JinCore::getRelativePathAssets();
	}else{
	    //Fichier natif
	    $this->file = new File(JinCore::getJinRootPath() . JinCore::getRelativePathAssets() . $relativePath);
	    $this->url = JinCore::getJinRootUrl() . JinCore::getRelativePathAssets();
	}
    }


    /**	Retourne le contenu HTML généré
     *
     * @return string
     */
    public function getContent() {
	$content = $this->file->getContent();
	$content = StringTools::replaceAll($content, '%asseturl%', $this->url);
	$content = StringTools::replaceAll($content, '%jinurl%', JinCore::getJinRootUrl());
	return $content;
    }

}

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


//
if (!defined('_ECRIRE_INC_VERSION')) return;

## cette API ne sait pas gerer les aliases ; a revoir...

global $tables_images, $tables_sequences, $tables_documents, $tables_mime;

$tables_images = array(
		       // Images reconnues par PHP
		       'jpg' => 1, 
		       'png' => 2, 
		       'gif' => 3,

		       // Autres images (peuvent utiliser le tag <img>)
		       'bmp' => 'BMP',
		       'psd' => 'Photoshop',
		       'tif' => 'TIFF'
		       );

// Multimedia (peuvent utiliser le tag <embed>)

$tables_sequences = array(
			  'aiff' => 'AIFF',
			  'asf' => 'Windows Media',
			  'avi' => 'Windows Media',
			  'flv' => 'Flash Video',
			  'mid' => 'Midi',
			  'mng' => 'MNG',
			  'mov' => 'QuickTime',
			  'mp3' => 'MP3',
			  'mpg' => 'MPEG',
			  'ogg' => 'Ogg',
			  'qt' => 'QuickTime',
			  'ra' => 'RealAudio',
			  'ram' => 'RealAudio',
			  'rm' => 'RealAudio',
			  'swf' => 'Flash',
			  'wav' => 'WAV',
			  'wmv' => 'Windows Media',
			  'svg' => 'Scalable Vector Graphics'
			  );

// Documents varies
$tables_documents = array(
			  'abw' => 'Abiword',
			  'ai' => 'Adobe Illustrator',
			  'bz2' => 'BZip',
			  'bin' => 'Binary Data',
			  'blend' => 'Blender',
			  'c' => 'C source',
			  'css' => 'Cascading Style Sheet',
			  'deb' => 'Debian',
			  'doc' => 'Word',
			  'djvu' => 'DjVu',
			  'dvi' => 'LaTeX DVI',
			  'eps' => 'PostScript',
			  'gz' => 'GZ',
			  'h' => 'C header',
			  'html' => 'HTML',
			  'pas' => 'Pascal',
			  'pdf' => 'PDF',
			  'pgn' => 'Portable Game Notation',
			  'ppt' => 'PowerPoint',
			  'ps' => 'PostScript',
			  'rpm' => 'RedHat/Mandrake/SuSE',
			  'rtf' => 'RTF',
			  'sdd' => 'StarOffice',
			  'sdw' => 'StarOffice',
			  'sit' => 'Stuffit',
			  'sxc' => 'OpenOffice Calc',
			  'sxi' => 'OpenOffice Impress',
			  'sxw' => 'OpenOffice',
			  'tex' => 'LaTeX',
			  'tgz' => 'TGZ',
			  'torrent' => 'BitTorrent',
			  'ttf' => 'TTF Font',
			  'txt' => 'texte',
			  'xcf' => 'GIMP multi-layer',
			  'xls' => 'Excel',
			  'xml' => 'XML',
			  'zip' => 'Zip',

			// open document format
			'odt' => 'opendocument text',
			'ods' => 'opendocument spreadsheet',
			'odp' => 'opendocument presentation',
			'odg' => 'opendocument graphics',
			'odc' => 'opendocument chart',
			'odf' => 'opendocument formula',
			'odb' => 'opendocument database',
			'odi' => 'opendocument image',
			'odm' => 'opendocument text-master',
			'ott' => 'opendocument text-template',
			'ots' => 'opendocument spreadsheet-template',
			'otp' => 'opendocument presentation-template',
			'otg' => 'opendocument graphics-template'
			  );

$tables_mime = array(
		// Images reconnues par PHP
		'jpg'=>'image/jpeg',
		'png'=>'image/png',
		'gif'=>'image/gif',

		// Autres images (peuvent utiliser le tag <img>)
		'bmp'=>'image/x-ms-bmp', // pas enregistre par IANA, variante: image/bmp
		'psd'=>'image/x-photoshop',	// pas IANA
		'tif'=>'image/tiff',

		// Multimedia (peuvent utiliser le tag <embed>)
		'aiff'=>'audio/x-aiff',
		'asf'=>'video/x-ms-asf',
		'avi'=>'video/x-msvideo',
		'flv' => 'video/x-flv',
		'mid'=>'audio/midi',
		'mng'=>'video/x-mng',
		'mov'=>'video/quicktime',
		'mp3'=>'audio/mpeg',
		'mpg'=>'video/mpeg',
		'ogg'=>'application/ogg',
		'qt' =>'video/quicktime',
		'ra' =>'audio/x-pn-realaudio',
		'ram'=>'audio/x-pn-realaudio',
		'rm' =>'audio/x-pn-realaudio',
		'swf'=>'application/x-shockwave-flash',
		'wav'=>'audio/x-wav',
		'wmv'=>'video/x-ms-wmv',
		'svg'=>'image/svg+xml',

		// Documents varies
		'ai' =>'application/illustrator',
		'abw' =>'application/abiword',
		'bin' => 'application/octet-stream', # le tout-venant
		'blend' => 'application/x-blender',
		'bz2'=>'application/x-bzip2',
		'c'  =>'text/x-csrc',
		'css'=>'text/css',
		'deb'=>'application/x-debian-package',
		'doc'=>'application/msword',
		'djvu'=>'image/vnd.djvu',
		'dvi'=>'application/x-dvi',
		'eps'=>'application/postscript',
		'gz' =>'application/x-gzip',
		'h'  =>'text/x-chdr',
		'html'=>'text/html',
		'pas'=>'text/x-pascal',
		'pdf'=>'application/pdf',
		'pgn' =>'application/x-chess-pgn',
		'ppt'=>'application/vnd.ms-powerpoint',
		'ps' =>'application/postscript',
		'rpm'=>'application/x-redhat-package-manager',
		'rtf'=>'application/rtf',
		'sdd'=>'application/vnd.stardivision.impress',
		'sdw'=>'application/vnd.stardivision.writer',
		'sit'=>'application/x-stuffit',
		'sxc'=>'application/vnd.sun.xml.calc',
		'sxi'=>'application/vnd.sun.xml.impress',
		'sxw'=>'application/vnd.sun.xml.writer',
		'tex'=>'text/x-tex',
		'tgz'=>'application/x-gtar',
		'torrent' => 'application/x-bittorrent',
		'ttf'=>'application/x-font-ttf',
		'txt'=>'text/plain',
		'xcf'=>'application/x-xcf',
		'xls'=>'application/vnd.ms-excel',
		'xml'=>'application/xml',
		'zip'=>'application/zip',

		// open document format
		'odt' => 'application/vnd.oasis.opendocument.text',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		'odp' => 'application/vnd.oasis.opendocument.presentation',
		'odg' => 'application/vnd.oasis.opendocument.graphics',
		'odc' => 'application/vnd.oasis.opendocument.chart',
		'odf' => 'application/vnd.oasis.opendocument.formula',
		'odb' => 'application/vnd.oasis.opendocument.database',
		'odi' => 'application/vnd.oasis.opendocument.image',
		'odm' => 'application/vnd.oasis.opendocument.text-master',
		'ott' => 'application/vnd.oasis.opendocument.text-template',
		'ots' => 'application/vnd.oasis.opendocument.spreadsheet-template',
		'otp' => 'application/vnd.oasis.opendocument.presentation-template',
		'otg' => 'application/vnd.oasis.opendocument.graphics-template'
	);
?>

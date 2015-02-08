<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

function yaml_sfyaml_encode($struct, $opt = array()) {
	require_once _DIR_PLUGIN_YAML.'sfyaml/sfYaml.php';
	require_once _DIR_PLUGIN_YAML.'sfyaml/sfYamlDumper.php';
	$opt = array_merge(
		array(
			'inline' => 2
		), $opt);
	$yaml = new sfYamlDumper();
	return $yaml->dump($struct, $opt['inline']);
}

function yaml_sfyaml_decode($input,$show_error=true) {
	require_once _DIR_PLUGIN_YAML.'sfyaml/sfYaml.php';
	require_once _DIR_PLUGIN_YAML.'sfyaml/sfYamlParser.php';

	$yaml = new sfYamlParser();

	try
	{
	  $ret = $yaml->parse($input);
	}
	catch (Exception $e)
	{
		if ($show_error) 
              throw new InvalidArgumentException(sprintf('Unable to parse string: %s', $e->getMessage()));
          else
              return false;       
	}

	return $ret;
}

?>
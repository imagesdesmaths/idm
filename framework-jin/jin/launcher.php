<?php

//Gestion de l'autoloader
require('jincore.php');
require('filesystem/inifile.php');
spl_autoload_register(array('jin\JinCore', 'autoload'));
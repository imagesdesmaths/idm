<?php

include '../../launcher.php';

use jin\output\ressources\CssLoader;

$css = new CssLoader($_GET['uid']);
echo $css->getContent();
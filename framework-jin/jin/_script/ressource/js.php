<?php

include '../../launcher.php';

use jin\output\ressources\JsLoader;

$js = new JsLoader($_GET['uid']);
echo $js->getContent();
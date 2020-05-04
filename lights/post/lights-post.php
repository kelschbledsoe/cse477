<?php

require __DIR__ . "/../vendor/autoload.php";
require '../lib/superlights.inc.php';

$controller = new SuperLights\LightsController($game, $_POST);

header("location:" . $controller->getRedirect());
/*var_dump($_POST);*/
exit;
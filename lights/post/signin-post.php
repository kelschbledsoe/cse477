<?php
require __DIR__ . "/../vendor/autoload.php";
require '../lib/superlights.inc.php';

$controller = new SuperLights\SigninController($game, $_POST);

header("location:".$controller->getRedirect());
exit;
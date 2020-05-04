<?php
require '../lib/site.inc.php';

$controller = new Felis\DeleteCaseController($site, $_GET, $_POST);
header("location: " . $controller->getRedirect());
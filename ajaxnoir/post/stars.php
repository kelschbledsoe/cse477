<?php
require '../lib/site.inc.php';

$controller = new Noir\StarController($site, USER, $_POST);
$view = new \Noir\HomeView($site, USER);
$movies = $view->presentTable();

$ret = json_decode($controller->getResult(), true);
$ret['movies'] = $movies;
echo json_encode($ret);
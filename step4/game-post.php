<?php
require 'lib/game.inc.php';
$controller = new Wumpus\WumpusController($wumpus, $_GET);
if($controller->isReset()) {
    unset($_SESSION[WUMPUS_SESSION]);
}

//$page = $controller->getPage();
//echo "<a href=\"$page\">$page</a>";
header('Location: ' . $controller->getPage());
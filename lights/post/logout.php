<?php
/*copied from step 7*/
require '../lib/superlights.inc.php';
unset($_SESSION[GAME_SESSION]);
header("location: " . $game->getRoot());
exit;

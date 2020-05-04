<?php
require __DIR__ . "/../vendor/autoload.php";
session_start();

define("GAME_SESSION", 'game');

// If there is already a Game session, use that. Otherwise, create one!
if(!isset($_SESSION[GAME_SESSION])) {
    $_SESSION[GAME_SESSION] = new SuperLights\Game();
}

$game = $_SESSION[GAME_SESSION];
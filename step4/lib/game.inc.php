<?php
require __DIR__ . "/../vendor/autoload.php";

// Start the PHP session system
session_start();

define("WUMPUS_SESSION", 'wumpus');

// If there is a Wumpus session, use that. Otherwise, create one
if(!isset($_SESSION[WUMPUS_SESSION])) {
    // Cheat mode!
    if(isset($_REQUEST['c'])){
        $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus(1422668587);
    }
    else {
        $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus();   // Seed: 1422668587
    }
}

$wumpus = $_SESSION[WUMPUS_SESSION];
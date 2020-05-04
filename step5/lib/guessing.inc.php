<?php
// Support auto loading
require __DIR__ . "/../vendor/autoload.php";

// Start the PHP session system
session_start();

// constant GUESSING_SESSION for session variable index
define("GUESSING_SESSION",'Guessing');

// If there is a session, use that. Otherwise, create one!
if(!isset($_SESSION[GUESSING_SESSION])){
    $_SESSION[GUESSING_SESSION] = new Guessing\Guessing();
}

// Simple cheating mechanism
if(isset($_GET['seed'])){
    $_SESSION[GUESSING_SESSION] = new Guessing\Guessing(strip_tags($_GET['seed']));
}

// Create variable assigned to a poniter to the session object from the session variable
$guessing = $_SESSION[GUESSING_SESSION];
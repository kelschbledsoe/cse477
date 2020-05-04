<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');
    $site->setEmail('kelschbl@cse.msu.edu');
    $site->setRoot('/~kelschbl/step8');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=kelschbl',
        'kelschbl',       // Database user
        '1m1ssb0baguys!',     // Database password
        'test8_');            // Table prefix
};

$site = new Felis\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}
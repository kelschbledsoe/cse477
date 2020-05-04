<?php
$open = true;
require '../lib/site.inc.php';
$controller = new Felis\PasswordValidateController($site, $_POST);
header("location: " . $controller->getRedirect());
/*var_dump($_POST);
$password1 = trim(strip_tags($_POST['password']));
$password2 = trim(strip_tags($_POST['password2']));
if($password1 !== $password2) {
    // Passwords do not match
    echo($password1);
    echo($password2);
}*/
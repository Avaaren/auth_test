<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'AuthClass.php';
use Lol\AuthClass;

AuthClass::checkLoginIsset();

if (AuthClass::checkLoginIsset()){
    $loginCleanedData = AuthClass::cleanLoginData();
    AuthClass::loginUser($loginCleanedData['login'], $loginCleanedData['password']);
}
else {
    print_r($_POST);
}
?>  
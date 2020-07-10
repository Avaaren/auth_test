<?php 

require_once 'conf.php';

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
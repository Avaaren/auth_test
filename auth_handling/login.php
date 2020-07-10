<?php 

require_once './config/conf.php';

include 'AuthClass.php';
use Lol\AuthClass;

AuthClass::checkLoginIsset();

if (AuthClass::checkLoginIsset()){
    $loginCleanedData = AuthClass::cleanLoginData();
    $loginStatus = AuthClass::loginUser($loginCleanedData['login'], $loginCleanedData['password']);
    if ($loginStatus['is_logged_in']==true){
        print_r($_COOKIE);
        echo "-------------------- <br>";
        print_r($_SESSION);
    }
    else {
        print_r($loginStatus['errors']);
    }
}
else {
    print_r($_POST);
}
?>  
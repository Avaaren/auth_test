<?php 

require_once './config/conf.php';

include 'AuthClass.php';
use Lol\AuthClass;

AuthClass::checkLoginIsset();

if (AuthClass::checkLoginIsset()){
    $loginCleanedData = AuthClass::cleanLoginData();
    $loginStatus = AuthClass::loginUser($loginCleanedData['login'], $loginCleanedData['password']);
    if ($loginStatus['is_logged_in']==true){
        header("Location: /auth_test/");
    }
    else {
        print_r($loginStatus['errors']);
    }
}
else {
    print_r($_POST);
}
?>  
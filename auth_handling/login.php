<?php 

require_once './config/conf.php';

include 'AuthClass.php';
use Lol\AuthClass;

$result = array();

if (AuthClass::checkLoginIsset()){
    $loginCleanedData = AuthClass::cleanLoginData();
    $loginStatus = AuthClass::loginUser($loginCleanedData['login'], $loginCleanedData['password']);
    if ($loginStatus['is_logged_in']==true){
        echo json_encode(array('success' => true, 'errors' => null));
    }
    else {
        AuthClass::unsuccessfulResponse($loginStatus['errors']);
    }
}
else {
    AuthClass::unsuccessfulResponse("Запрос отправлен неверно");
}
?>  
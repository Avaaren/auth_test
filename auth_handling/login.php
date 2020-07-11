<?php 

require_once './config/conf.php';

include 'AuthClass.php';
use Lol\AuthClass;

$result = array();

if (AuthClass::checkLoginIsset()){
    # Cleaning entered user data
    $loginCleanedData = AuthClass::cleanLoginData();
    # Try to log user in
    $loginStatus = AuthClass::loginUser($loginCleanedData['login'], $loginCleanedData['password']);
    if ($loginStatus['is_logged_in']==true){
        echo json_encode(array('success' => true, 'errors' => null));
    }
    else {
        AuthClass::unsuccessfulResponse($loginStatus['errors']);
    }
}
# If POST method doesn`t contain needed data
else {
    AuthClass::unsuccessfulResponse("Запрос отправлен неверно");
}
?>  
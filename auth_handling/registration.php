<?php 

require_once './config/conf.php';
include 'AuthClass.php';

use Lol\AuthClass;

$result = array();

if (AuthClass::checkRegistrationIsset()){
    $registrationCleanedData = AuthClass::cleanRegistrationData();
    # If errors array has errors -> display them
    if (!empty($registrationCleanedData['errors'])){
        AuthClass::unsuccessfulResponse($registrationCleanedData['errors']);
    }
    else {
        # Check user for unique and try to register him
        if (AuthClass::checkUserUniqueness($registrationCleanedData['login'], $registrationCleanedData['email'])){
            AuthClass::registerUser($registrationCleanedData);
            echo json_encode(array('success' => true, 'errors' => null));
        }
        else {
            AuthClass::unsuccessfulResponse("Такой пользователь уже существует");
        }
    }
    

}
else {
    AuthClass::unsuccessfulResponse("Неверно отправлен запрос");
}
?>
<?php 

require_once './config/conf.php';
include 'AuthClass.php';

use Lol\AuthClass;

$result = array();

function unsuccessfulResponse($error){
    if (is_array($error)){
        $result['errors'] = $error;
    }
    else {
        array_push($result['errors'], $error);
    }
    $result['success'] = false;
    echo json_encode($result);
}

if (AuthClass::checkRegistrationIsset()){
    $registrationCleanedData = AuthClass::cleanRegistrationData();
    # If errors array has errors -> display them
    if (!empty($registrationCleanedData['errors'])){
        unsuccessfulResponse($registrationCleanedData['errors']);
    }
    else {
        if (AuthClass::checkUserUniqueness($registrationCleanedData['login'], $registrationCleanedData['email'])){
            AuthClass::registerUser($registrationCleanedData);
            echo json_encode(array('success' => true, 'errors' => null));
        }
        else {
            unsuccessfulResponse("Такой пользователь уже существует");
        }
    }
    

}
else {
    unsuccessfulResponse("Неверно отправлен запрос");
}
?>
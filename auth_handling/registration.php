<?php 

require_once 'conf.php';
include 'AuthClass.php';

use Lol\AuthClass;

if (AuthClass::checkRegistrationIsset()){
    $registrationCleanedData = AuthClass::cleanRegistrationData();
    # If errors array has errors -> display them
    if (!empty($registrationCleanedData['errors'])){
        foreach ($registrationCleanedData['errors'] as $error){
            echo $error;
        }
    }
    else {
        if (AuthClass::checkUserUniqueness($registrationCleanedData['login'], $registrationCleanedData['email'])){
            AuthClass::registerUser($registrationCleanedData);
        }
        else {
            echo "Такой пользователь уже существует";
        }
    }
    

}
else {
    print_r($_POST);
}
?>
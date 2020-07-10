<?php 

include 'AuthClass.php';
use Lol\AuthClass;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (AuthClass::checkRegistrationIsset()){
    $registrationCleanedData = AuthClass::cleanRegistrationData();
    # If errors array has errors -> display them
    // print_r($registrationCleanedData);
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
<?php

namespace Lol;
require_once 'salt.php';

class AuthClass {

    public static function checkLoginIsset(){

        if (isset($_POST['login']) && isset($_POST['password'])){
            return true;
        }
        else {
            return false;
        }
    }

    public static function checkRegistrationIsset(){
        if (isset($_POST['login']) &&
            isset($_POST['email']) &&
            isset($_POST['name']) &&
            isset($_POST['password']) &&
            isset($_POST['password2'])){
                return true;
        }
        else {
            return false;
        }
    }

    public static function cleanLoginData(){
        $login = trim(htmlentities($_POST['login']));
        $password = trim(htmlentities($_POST['password']));

        return array('login'=>$login, 'password'=>$password);
    }

    public static function cleanRegistrationData(){
        $cleanedData = array();
        $errors = array();
        # Clean form data spaces and symbols
        $cleanedData['login'] = trim(htmlentities($_POST['login']));
        $cleanedData['email'] = trim(htmlentities($_POST['email']));
        $cleanedData['name'] = trim(htmlentities($_POST['name']));
        $cleanedData['password'] = trim(htmlentities($_POST['password']));
        $cleanedData['password2'] = trim(htmlentities($_POST['password2']));

        # If element is empty -> creating error
        foreach ($cleanedData as $key => $value){
            if ($value == ''){
                array_push($errors, "$key введен некорректно");
            }
        }
        # Check for passwords equality
        if ($cleanedData['password'] !== $cleanedData['password2']){
            array_push($errors, "Пароли не совпадают");
        }

        $cleanedData['errors'] = $errors;
        return $cleanedData;
    }

    public static function checkUserUniqueness($login, $email){
        $xml = simplexml_load_file('database.xml');

        foreach ($xml as $value){
            if ($login == $value->login || $email == $value->email){
                return false;
            }
        }
        return true;
    }
    public static function loginUser($login, $password){
        $xml = simplexml_load_file("database.xml");
        $user = null;

        foreach($xml as $value){
            if ($login == $value->login){
                $user['login'] = $value->login;
                $user['password'] = $value->password;
                break;
            }
        }
        if (empty($user)){
            array_push($errors, "Такого пользователя не найдено");
        }

        if (not ($user['password'] == sha1($password.$salt))){
            array_push($errors, "Пароли не совпадают");
        }
        
        return array('user'=>$user, 'errors'=>$errors);
    }

    public static function registerUser($userData){
        # Or we can use password_hash() method, but in task salt + sha1
        $userData['password'] = sha1($userData['password'].$salt);
        unset($userData['password2']);
        unset($userData['errors']);
        $xml = simplexml_load_file('database.xml');
        $newUser = $xml->addChild('user');
        
        foreach ($userData as $key => $value) {
            echo "$key -- $value <br>";
            $newUser->addChild($key, $value);
        }


        $xml->asXML('database.xml');
        

    }

}

?>



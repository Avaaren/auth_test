<?php

namespace Lol;

require_once 'salt.php';
require_once 'conf.php';

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
        $found = false;

        foreach($xml as $value){
            # Username is found
            if ($login == $value->login){
                $found = true;
                # Password is correct
                if (sha1($password.$salt) == $value->password){
                    # Generating random session code
                    $session_code = self::generateCode(15);
                    # Add user to current session
                    $_SESSION['login_user']=$login;
                    # Writing session code to db
                    $value->session->code_sess = $session_code;
                    # Setting cookies user and session code
                    setcookie("login_user", $_SESSION['login_user'], time()+3600*24*14);
                    setcookie("code_user", $session_code, time()+3600*24*14);
                    break;
                }
                else {
                    array_push($errors, "Пароли не совпадают");
                    break;
                } 
            }
        }
        if (!$found){
            array_push($errors, "Такого пользователя не найдено");
        }
        
        return array('errors'=>$errors);
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

    public static function checkCookieAndSession() {
        if (isset($_SESSION['login_user'])) return true;
        else {
          # Coockie existing check
          if (isset($_COOKIE['login_user']) and isset($_COOKIE['code_user'])) {
            # Cookie already exist -> compare with database by foreach
            $xml = simplexml_load_file("database.xml");

            foreach($xml as $value){
                # Comparing is correct -> start session and update cookies
                if ($_COOKIE['login_user'] == $value->login and $_COOKIE['code_user'] == $value->session->code_sess){
                    $_SESSION['login_user'] = $value->login;

                    setcookie("code_user", $value->session->code_sess, time()+3600*24*14);
                    return true;
                } else return false;
            }
        } else return false;
      }
    }

    public static function generateCode($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $chars_len = strlen($chars) - 1;  
        while (strlen($code) < $length) {
          $code .= $chars[mt_rand(0, $chars_len)];  
        }
        return $code;
      }
}

?>



<?php 

require_once './config/conf.php';

include 'AuthClass.php';
use Lol\AuthClass;

AuthClass::userLogout();
?>
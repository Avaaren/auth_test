<?php 
require_once 'conf.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
</head>
<body>
<br>
<br>
    <form method="post" action="registration.php" id="registration-form">
        <input type="text" id="login" name="login" placeholder="login"> <br>
        <input type="email" id="email" name="email" placeholder="email"> <br>
        <input type="text" id="name" name="name" placeholder="name"> <br>
        <input type="password" id="password" name="password" placeholder="password"> <br>
        <input type="password" id="password2" name="password2" placeholder="password2"> <br>
        <button id="register-submit" class="form-button">Зарегестрироваться</button>
    </form>
    <br>
    <form method="post" action="login.php" id="login-form">
        <input type="text" id="login" name="login" placeholder="login"> <br>
        <input type="password" id="password" name="password" placeholder="password"> <br>
        <button id="register-submit" class="form-button">Войти</button>
    </form>
</body>
</html>
<?php 
require_once './auth_handling/config/conf.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <link rel="stylesheet" href="static/css/base.css">
</head>
<body>
<?php include './page_components/header.php'; ?>
<?php if (isset($_SESSION['login_user'])):?>
    <?php 
        echo "Hello ".$_SESSION['login_user'];
    ?>
<?php else:?>
    <?php include './page_components/registration_form.php' ?>
    <?php include './page_components/login_form.php' ?>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="static/js/base.js"></script>
</body>
</html>
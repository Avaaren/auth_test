$(document).ready(function(){
    // Methods switching forms
    $('#registration-button').on('click', function(event){
        event.preventDefault();
        $('#registration-form').show();
        $('#login-form').hide();
    });

    $('#login-button').on('click', function(event){
        event.preventDefault();
        $('#registration-form').hide();
        $('#login-form').show();
    });

    // Ajax form sending methods

    $('#registration-submit').on('click', function(event){
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/auth_test/auth_handling/registration.php',
            data: $("#registration-form input").serialize(),
            success: function(data){
                console.log(data);
                var jsonData = JSON.parse(data);
                console.log(jsonData);
                if (!jsonData.success && jsonData.errors){
                    jsonData.errors.forEach((item) => {
                        alert(item);
                    });
                }
                else {
                    alert('Успешная регистрация');
                    window.location.href = '/auth_test/';
                }
            }
        });
    });

    $('#login-submit').on('click', function(event){
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/auth_test/auth_handling/login.php',
            data: $("#login-form input").serialize(),
            success: function(data){
                console.log(data);
                var jsonData = JSON.parse(data);
                console.log(jsonData);
                if (!jsonData.success && jsonData.errors){
                    jsonData.errors.forEach((item) => {
                        alert(item);
                    });
                }
                else {
                    alert('Успешная авторизация');
                    window.location.href = '/auth_test/';
                }
            }
        });
    });
});
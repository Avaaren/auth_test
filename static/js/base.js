$(document).ready(function(){
    $('#registration-button').on('click', function(event){
        event.preventDefault;
        $('#registration-form').show();
        $('#login-form').hide();
    });

    $('#login-button').on('click', function(event){
        event.preventDefault;
        $('#registration-form').hide();
        $('#login-form').show();
    });
});
var redirect = true;

$( document ).ready(function() {
    $("#submit").click(
        function() {
            sendAjaxForm('ajax_form', '../app/handlers/login_handler.php');
            return false;
        }
    );
});


function sendAjaxForm(ajax_form, url) {
    $.ajax({
        url:      url,
        type:     "POST",
        dataType: "html",
        data: $("#"+ajax_form).serialize(),
        success: function(response) {
            result = $.parseJSON(response);
            if (result.hasOwnProperty('name'))  {
                $('#nameHelp').html(result.name);
                redirect = false;
            }
            if (result.hasOwnProperty('email')) {
                $('#emailHelp').html(result.email);
                redirect = false;
            }
            if (result.hasOwnProperty('answer')) {
                $('#answer').html(result.answer);
                redirect = false;
            }
            if (redirect) {
                window.location.replace('/');
            }
        },
    });
}
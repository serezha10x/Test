var redirect = true;

$( document ).ready(function() {
    $("#submit").click(
        function() {
            sendAjaxForm('ajax_form', '../app/handlers/register_handler.php');
            sendAjaxFormWithFile('ajax_form', '../app/handlers/register_handler.php');
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
            if (result.hasOwnProperty('name')) {
                $('#nameHelp').html(result.name);
                redirect = false;
            }
            if (result.hasOwnProperty('email')) {
                $('#emailHelp').html(result.email);
                redirect = false;
            }
            if (result.hasOwnProperty('image')) {
                $('#imageHelp').html(result.image);
                redirect = false;
            }
            if (result.hasOwnProperty('captcha')) {
                $('#captchaHelp').html(result.captcha);
                redirect = false;
            }
        },
    });
}



function sendAjaxFormWithFile(ajax_form, url) {
    var $input = $("#image");
    var fd = new FormData;
    fd.append('image', $input.prop('files')[0]);

    $.ajax({
        url:      url,
        type:     "POST",
        data:     fd,
        processData: false,
        contentType: false,
        success: function(response) {
            result = $.parseJSON(response);
            if (result.hasOwnProperty('image')) {
                $('#imageHelp').html(result.image);
                redirect = false;
            }
             console.log(redirect);
            if (redirect) {
                window.location.replace(location.host);
            }
        },
        complete: function() {
            $('#submit').prop('disabled', false);
        },
    });
}
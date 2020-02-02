var usernameMinLength = 3;
var passwordMinLength = 5;

var userMsg = $('#user-feedback');
var passMsg = $('#pass-feedback');
var passRepeatMsg = $('#pass-repeat-feedback');

var userMess = 'Nazwa użytkownika musi mieć przynajmniej ' + usernameMinLength + ' znaki.'
$("#username").focus(function(){changeMsg(userMsg, 'alert-info', userMess)});
$("#username").blur(checkUsername);

var passMess = 'Hasło musi mieć przynajmniej ' + passwordMinLength + ' znaków.'
$("#password").focus(function(){changeMsg(passMsg, 'alert-info', passMess)});
$("#password").blur(checkPassword);

$("#password-repeat").blur(checkPasswordRepeat);

//Functions

function changeMsg(elem, className, message)
{
    //alert("xdd");
    elem.removeClass();
    elem.addClass(className);
    elem.html(message);
}

function checkUsername()
{
    if ($("#reg-username").val().length < usernameMinLength)
        {
            changeMsg(userMsg, 'alert-danger', 'Nazwa użytkownika zbyt krótka...');
        }
    else
        {
            userMsg.html("");
        }
}

function checkPassword()
{
    if ($("#password").val().length < passwordMinLength)
        {
            changeMsg(passMsg, 'alert-danger', 'Hasło zbyt krótkie...');
        }
    else
        {
            passMsg.html("");
        }
}

function checkPasswordRepeat()
{
    if ($("#password-repeat").val() != $("#password").val())
        {
            changeMsg(passRepeatMsg, 'alert-danger', 'Hasła nie są takie same!');
        }
    else
        {
            passRepeatMsg.html("");
        }
}

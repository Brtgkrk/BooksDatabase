//Login

$( "#login-button-canvas" ).click(function() {  //login click
    formAnimation('-60%', '0', '#login-form', '30%', '1');
});

$( "#login-quit" ).click(function() {   //login quit
    formAnimation('40%', '1', '#login-form', '-30%', '0');
});

//Register

$( "#register-button-canvas" ).click(function() {
    formAnimation('-60%', '0', '#register-form', '30%', '1');
});

$( "#register-quit" ).click(function() {
    formAnimation('40%', '1', '#register-form', '-30%', '0');
});

//Functions

function formAnimation(topButtons, opacityButtons, elem, topElem, opacityElem)
{
    $('#register-button-canvas').animate({
        top: topButtons,
        opacity: opacityButtons
    });
    $('#login-button-canvas').animate({
        top: topButtons,
        opacity: opacityButtons
    });

    $(elem).animate({
        top: topElem,
        opacity: opacityElem
    });
}

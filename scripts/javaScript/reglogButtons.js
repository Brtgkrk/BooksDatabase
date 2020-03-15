//Login

$("#btn-login").click(function () {  //login click
    formAnimation('10%', '1', '#login-form', '-30%', '0');
});

$("#login-quit").click(function () {   //login quit
    formAnimation('40%', '1', '#login-form', '-30%', '0');
});

//Register

$("#btn-register").click(function () {
    formAnimation('60%', '1', '#register-form', '-30%', '0');
});

$("#register-quit").click(function () {
    formAnimation('40%', '1', '#register-form', '-30%', '0');
});

//Functions

function formAnimation(topButtons, opacityButtons, elem, topElem, opacityElem) {
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

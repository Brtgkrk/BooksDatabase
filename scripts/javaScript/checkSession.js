let details = $('#login-form').serialize();

$.ajax({
    url: 'pages/checkSession.php',
    success: function (data) {
        if (parseInt(data)) $("body").load('pages/dashboard.php');
        else $("body").load('pages/main.php');
    }
});

/*$.post('', details, function (data) {

    if (data == "1") {
        $("html").load('pages/dashboard.php');
        alert("ładowanie");
    }
    else alert("nie ładuje bo " + data);
});*/
$(document).ready(function () {
    $("#logout-button").click(function () {
        // disable button
        $(this).prop("disabled", true);
        // add spinner to button
        $(this).html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Łączenie`
        );
        $.ajax({
            url: 'pages/logout.php',
            success: function (data) {
                if (parseInt(data)) $("body").load('pages/dashboard.php');
                else $("body").load('pages/main.php');
            }
        });
        $("body").load('pages/main.php');
    });
});
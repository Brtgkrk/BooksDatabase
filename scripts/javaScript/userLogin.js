$(document).ready(function () {
    $("#lgn-button").click(function () {
        // disable button
        $(this).prop("disabled", true);
        // add spinner to button
        $(this).html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Łączenie`
        );
    });
});
$('#login-form').on('submit', function (e) {
    e.preventDefault();

    let details = $('#login-form').serialize();

    $.post('pages/login.php', details, function (data) {
        let message;

        switch (parseInt(data)) {
            case 0: message = 'Jedno z pól jest puste';
                break;
            case 1: message = 'Błędna nazwa użytkownika lub hasło';
                break;
            case 2: message = 'Zalogowano poprawnie';
                break;
            default: message = 'Błąd wewnętrzny w skryptach jeśli widzisz ten komunikat proszę napisz mi o tym na email: pomoc@jkrok.pl lub powiadam mnie o tym na jednym z moich social mediów jeżeli chcesz otrzymać szybką odpowiedź Kod błędu: ' + data;
        }

        if (parseInt(data) != 2) {
            alert(message);
            $("#lgn-button").prop("disabled", false);
            $("#lgn-button").html(
                'Zaloguj się'
            );
        }
        else {
            $("body").load('pages/dashboard.php');
        }
    });
});

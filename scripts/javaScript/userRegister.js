$('#register-form').on('submit', function (e) {
    e.preventDefault();

    let details = $('#register-form').serialize();

    $.post('pages/register.php', details, function (data) {
        let message;

        switch (parseInt(data)) {
            case 0: message = 'Jedno z pól jest puste';
                break;
            case 1: message = 'Nazwa użytkownika musi posiadać co najmniej 3 znaki i nie więcej niż 20';
                break;
            case 2: message = 'Nazwa użytkownika musi posiadać tylko znaki alfanumeryczne';
                break;
            case 3: message = 'Hasło musi mieć co najmniej 6 znaków i więcej niż 50';
                break;
            case 4: message = 'Hasła nie pasują do siebie';
                break;
            case 5: message = 'Adres email jest niepoprawny';
                break;
            case 6: message = 'Regulamin musi zostać zaakceptowany';
                break;
            case 7: message = 'Nazwa użytkownika lub email jest już zajęty';
                break;
            case 8: message = 'Poprawnie dodano nowego użytkownika do bazy danych';
                break;
            case 9: message = 'Błąd wewnętrzny po stronie serwera, jeśli widzisz ten komunikat proszę napisz mi o tym na email: pomoc@jkrok.pl lub powiadam mnie o tym na jednym z moich social mediów jeżeli chcesz otrzymać szybką odpowiedź';
                break;
            default: message = data /*'Błąd wewnętrzny w skryptach jeśli widzisz ten komunikat proszę napisz mi o tym na email: pomoc@jkrok.pl lub powiadam mnie o tym na jednym z moich social mediów jeżeli chcesz otrzymać szybką odpowiedź'*/;
        }

        alert(message);
    });
});

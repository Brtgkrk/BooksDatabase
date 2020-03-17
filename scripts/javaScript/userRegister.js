$("#register-form").on('submit', function (e) {
    e.preventDefault();

    var details = $("#register-form").serialize();

    $.post('pages/register.php', details, function (data) {
        alert(data);
    });
});

$("#reg-username").on('keyup', function() {

    var userToCheck = $("#reg-username").val();

    if (userToCheck.length > 20)
    {
        changeMsg(userMsg, 'alert-danger', 'Nazwa uzytkownika za długa!');
    }
    else
    {
      $.post('checkUsername.php', { username: userToCheck }, function(data) {
          if(data == "1")
          {
              //alert("Uzytkownik istnieje!");
              changeMsg(userMsg, 'alert-danger', 'Użytkownik ' + userToCheck + ' już istnieje!');
          }
          else
          {
              changeMsg(userMsg, 'alert-danger', '');
          }
      });
    }


});

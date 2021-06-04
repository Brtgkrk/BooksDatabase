$("#add-author-button").on('click', function() {
    $("#author-modal-aname").val("");
    $("#author-modal-adescription").val("");
    $("#author-modal-alert").html("");
});

$("#add-genre-button").on('click', function() {
    $("#genre-modal-aname").val("");
    $("#genre-modal-adescription").val("");
    $("#genre-modal-alert").html("");
});

$("#add-author-form").on('submit', function(e) {
    e.preventDefault();
    //alert("Dodawanie nowego autora");

    if ($("#author-modal-aname").val() == "")
    {
        $("#author-modal-alert").html("Wypełnij to pole!<br/>");
    }
    else
    {
      var details = $("#add-author-form").serialize();

      $.post('pages/addAuthor.php', details, function(data) {
          showAlert(data);
          downloadAuthors();
          var currentAuthor = $("#author-modal-aname").val();
          var addAuthor = true;
          var authors = "";
          allAuthors.forEach(function(item, index) {
              authors += "<option>" + item.a_name + "</option>";
              //alert("czy " + item.a_name + "==" + currentAuthor);
              if (item.a_name == currentAuthor) addAuthor = false;
          });

          $("#add-author-modal").modal("hide");

          if (addAuthor) authors += "<option>" + currentAuthor + "</option>";

          $("#b-author").html(authors);
          $("#b-author").val(currentAuthor);
      });
    }
});

$("#add-genre-form").on('submit', function(e) {
    e.preventDefault();
    //alert("Dodawanie nowego gatunku");

    if ($("#genre-modal-aname").val() == "")
    {
        $("#genre-modal-alert").html("Wypełnij to pole!<br/>");
    }
    else
    {
      var details = $("#add-genre-form").serialize();

      $.post('pages/addGenre.php', details, function(data) {
          showAlert(data);
          downloadGenres();
          var currentGenre = $("#genre-modal-aname").val();
          var addGenre = true;
          var genres = "";
          allGenres.forEach(function(item, index) {
              genres += "<option>" + item.a_name + "</option>";
              //alert("czy " + item.a_name + "==" + currentgenre);
              if (item.a_name == currentGenre) addGenre = false;
          });

          $("#add-genre-modal").modal("hide");

          if (addGenre) genres += "<option>" + currentGenre + "</option>";

          $("#b-genres").html(genres);
          $("#b-genres").val(currentGenre);
      });
    }
});

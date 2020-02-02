<?php

    session_start();

    if(!isset($_SESSION['isLogged']))
    {
        header('Location: ../index.html');
        exit();
    }

?>

<!-- This file is full of trash, please dont judge me, I swear i will clean up here in the future -->

<!DOCTYPE html>
<html>
<head lang="pl">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Jakub Krok">
    <meta name="description" content="Site for management your books.">

    <title>Dashboard</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="js/jquery/jquery-3.4.1.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="icon" href="logo.svg" />

</head>
<body>

<nav>

  <img src="logo.svg" alt="book logo" id="book-logo">

  <?php echo "<span id='hello-span'>Witaj ".$_SESSION['user']."!</span>"; ?>

  <a href="logout.php"> <input class="btn" id="logout-button" type="button" value="Wyloguj się"/> </a>

</nav>

<!-- Alert div loader -->
<div id="alert-show"></div>


<div class="container">

  <!-- The Modal -->
  <div class="modal fade" id="book-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="book-change-title">Wprowadź zmiany w książce</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <form id="book-change-form" action="updateData.php" method="post">
            <div class="modal-body">

                    <label for="b-name">Nazwa książki</label>
                    <input type="text" class="form-control" name="book_title" placeholder="wprowadź nazwę książki" id="b-name">

                    <label for="b-author">Autor książki <span id="add-author-button" data-toggle="modal" data-target="#add-author-modal"><strong>&plus;</strong></span> </label>
                    <select class="form-control" id="b-author" name="book_author">

                        <option>opcja</option>

                    </select>

                    <label for="b-genre">Gatunek książki <span id="add-genre-button" data-toggle="modal" data-target="#add-genre-modal"><strong>&plus;</strong></span></label>
                    <select class="form-control" id="b-genres" name="book_genre">

                        <option>opcja</option>

                    </select>

                    <label for="b-pages">Liczba stron</label>
                    <input type="number" class="form-control" name="book_pages" placeholder="wprowadź Ilość stron" id="b-pages">

                    <label for="b-completion">Liczba przeczytanych stron</label>
                    <input type="number" class="form-control" name="book_completion" placeholder="Ile już stron przeczytałeś?" id="b-completion">

                    <label for="b-rating">Ocena książki</label>
                    <input type="number" class="form-control" name="book_rating" placeholder="Jak oceniasz tą książkę?" id="b-rating">

                    <label for="b-description">Opis książki</label>
                    <textarea class="form-control" name="book_description" placeholder="Wprowadź tutaj opis książki" id="b-description"></textarea>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <input class="btn btn-danger" data-toggle="modal" data-target="#delete-book-modal" id="button-remove-book" type="button" value="Usuń tę książkę">
              <input type="submit" class="btn btn-success" id="button-save-data" value="Zapisz zmiany">
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete book modal-->
  <div class="modal fade" id="delete-book-modal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Czy na pewno chcesz usunąć tę książkę?</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" id="delete-modal-book-title">
            <p>Nazwa książki.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie poczekaj, żartowałem</button>
            <button type="button" class="btn btn-danger" id="delete-book-button">Tak, nie chce jej już</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Author Modal-->
    <div class="modal fade" id="add-author-modal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <form action="index.php" class="" id="add-author-form" method="post">
              <div class="modal-header">
                <h4 class="modal-title">Dodawanie nowego Autora</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body" id="delete-modal-book-title">
                <label for="author-modal-aname">Nazwa autora:</label>
                <input class="form-control" type="text" name="a_name" id="author-modal-aname" placeholder="Wprowadź tutaj nazwę autora">
                <span id="author-modal-alert" style="color: red;"></span>
                <label for="author-modal-adescription">Opis autora:</label>
                <textarea class="form-control" name="description" id="author-modal-adescription" placeholder="Wprowadź tutaj opis autora (opcjonalne)"></textarea>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Dodaj autora</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Add Genre Modal-->
      <div class="modal fade" id="add-genre-modal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <form action="index.php" class="" id="add-genre-form" method="post">
                <div class="modal-header">
                  <h4 class="modal-title">Dodawanie nowego Gatunku</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="delete-modal-book-genre">
                  <label for="genre-modal-aname">Nazwa garunku:</label>
                  <input class="form-control" type="text" name="g_name" id="genre-modal-aname" placeholder="Wprowadź tutaj nazwę gatunku">
                  <span id="genre-modal-alert" style="color: red;"></span>
                  <label for="genre-modal-adescription">Opis gatunku:</label>
                  <textarea class="form-control" name="description" id="genre-modal-adescription" placeholder="Wprowadź tutaj opis gatunku (opcjonalne)"></textarea>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Dodaj gatunek</button>
                </div>
              </form>
            </div>
          </div>
        </div>

</div>

    <form action="showBooks.php" id="show" method="post">

    <input class="btn btn-primary mod-buttons" id="show-books" type="submit" value="Pokaż książki">
    <br /><input class="btn btn-secondary mod-buttons" id="add-book" data-toggle='modal' data-target='#book-modal' id="add-book-button" type="button" value="Dodaj książkę">

    <div id="search-div">

      <h5>Wyszukiwanie</h5>

      <select class="form-control" id="serach-select">

          <option>Nazwie książki</option>
          <option>Autorze</option>
          <option>Liczbie stron</option>
          <option>Gatunku</option>
          <option>Liczbie przeczytanych stron</option>
          <option>Ocenie</option>
          <option>Opisie</option>

      </select>

      <input class="form-control" id="find-book" name="book-name" type="text" placeholder="wyszukaj">

    </div>


    </form>

    <div class="table-responsive">

      <table class='table table-striped'>

          <tr><th class="title" id='sort-title'>Nazwa książki</th><th class="a_name" id='sort-author'>Autor</th><th class="pages" id='sort-pages'>Stron</th><th class="g_name" id='sort-genre'>Gatunek</th><th class="completion" id='sort-completion'>Przeczytanych stron</th><th class="rating" id='sort-rating'>Ocena</th><th class="description">Opis</th></tr>

      </table>

      <table class="table table-striped" id="content">

      </table>


    </div>


    <script src="js/scripts/alertController.js">

    </script>

    <script src="js/scripts/bookManagement.js"></script>
    <script src="js/scripts/bookEditor.js"></script>
    <script src="js/scripts/AGEdit.js"></script>

</body>
</html>

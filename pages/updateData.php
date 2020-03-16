<?php

    session_start();

    if(!isset($_SESSION['isLogged']))
    {
        echo "You are not loggeed";
        //header('Location: index.php');
        exit();
    }

    if((!isset($_POST['book_title'])) || (!isset($_POST['book_id'])) || (!isset($_POST['author_id'])) || (!isset($_POST['book_pages'])) || (!isset($_POST['genre_id'])) || (!isset($_POST['book_completion'])) || (!isset($_POST['book_rating'])) || (!isset($_POST['book_description'])))
    {
        echo "Post variables missing";
        //header('Location: index.php');
        exit();
    }

    require_once "../serverside/connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
        echo "Error: ".$connection->connect_errno;
    }
    else
    {
        $login = $_SESSION['id'];
        $to_delete = $_POST['to_delete'];

        $title = $_POST['book_title'];
        $author = $_POST['author_id'];
        $pages = $_POST['book_pages'];
        $genre = $_POST['genre_id'];
        $completion = $_POST['book_completion'];
        $rating = $_POST['book_rating'];
        $description = $_POST['book_description'];
        $idbook = $_POST['book_id'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        $title = htmlentities($title, ENT_QUOTES, "UTF-8");
        $author = htmlentities($author, ENT_QUOTES, "UTF-8");
        $pages = htmlentities($pages, ENT_QUOTES, "UTF-8");
        $genre = htmlentities($genre, ENT_QUOTES, "UTF-8");
        $completion = htmlentities($completion, ENT_QUOTES, "UTF-8");
        $rating = htmlentities($rating, ENT_QUOTES, "UTF-8");
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");
        $idbook = htmlentities($idbook, ENT_QUOTES, "UTF-8");

        if ($to_delete == 'true') //add owner check
        {
            if ($result =@$connection->query(sprintf("DELETE FROM books WHERE bookID = '%s' AND user = '%s'",
            mysqli_real_escape_string($connection, $idbook),
            mysqli_real_escape_string($connection, $login)
            )))
            {
                echo "1Pomyślnie usunięto książkę z bazy danych";
            }
            else
            {
                echo "3Nie udało się usunąć książki z bazy danych ;(";
            }
        }
        else
        {
            if($result =@$connection->query(sprintf("SELECT count(*) FROM books WHERE title = '%s' AND bookID <> '%s' AND user = '%s'",
            mysqli_real_escape_string($connection, $title),
            mysqli_real_escape_string($connection, $idbook),
            mysqli_real_escape_string($connection, $login)
            )))
            {
                $how_much = mysqli_fetch_assoc($result)['count(*)'];
                if($how_much > 0)
                {
                    echo "2Książka o nazwie <strong>".$title."</strong> już istnieje w bazie danych, poniechano więc jej dodanie";
                }
                else
                {
                    if ($idbook == 0)
                    {
                        if ($result = @$connection->query(sprintf("INSERT INTO books VALUES ('','%s', '%s', '%s','%s','%s', '%s', '%s', '%s')",
                            mysqli_real_escape_string($connection, $title),
                            mysqli_real_escape_string($connection, $login),
                            mysqli_real_escape_string($connection, $author),
                            mysqli_real_escape_string($connection, $pages),
                            mysqli_real_escape_string($connection, $genre),
                            mysqli_real_escape_string($connection, $completion),
                            mysqli_real_escape_string($connection, $rating),
                            mysqli_real_escape_string($connection, $description)
                        )))
                        {
                            echo  "1Pomyślnie dodano <strong>".$title."</strong> do bazy danych";
                        }
                        else
                        {
                            echo "3Nie udało się dodać książki do bazy danych";
                        }
                    }
                    else
                    {
                        if($result = @$connection->query(sprintf("
                        UPDATE books, users SET title='%s', author='%s', pages='%s', genre='%s', completion='%s', rating='%s', description='%s' WHERE users.ID='%s' AND bookID='%s'",
                        mysqli_real_escape_string($connection, $title),
                        mysqli_real_escape_string($connection, $author),
                        mysqli_real_escape_string($connection, $pages),
                        mysqli_real_escape_string($connection, $genre),
                        mysqli_real_escape_string($connection, $completion),
                        mysqli_real_escape_string($connection, $rating),
                        mysqli_real_escape_string($connection, $description),
                        mysqli_real_escape_string($connection, $login),
                        mysqli_real_escape_string($connection, $idbook)
                        )))
                        {
                            echo "1Dane zapisano poprawnie";
                        }
                        else
                        {
                            echo "3Nie udało się zaktualizować bazy danych";
                        }
                    }
                }
            }
            else
            {
              echo "3Nie udało się wykonać zapytania do bazy danych, napisz do administratora w celu uzyskania więcej informacji";
            }
        }

        $connection->close();
    }

?>

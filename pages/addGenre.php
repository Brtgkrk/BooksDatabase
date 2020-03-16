<?php

    session_start();

    if(!isset($_SESSION['isLogged']) || !isset($_POST['g_name']) || !isset($_POST['description']))
    {
        header('Location: index.php');
        echo "3Błąd przy przesyłaniu danych";
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
        $g_name = $_POST['g_name'];
        $description = $_POST['description'];
        $login = $_SESSION['id'];

        $g_name = htmlentities($g_name, ENT_QUOTES, "UTF-8");
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");

        if($result =@$connection->query(sprintf("SELECT count(*) FROM genres WHERE g_name = '%s' AND user = '%s'",
        mysqli_real_escape_string($connection, $g_name),
        mysqli_real_escape_string($connection, $login)
        )))
        {
            $how_much = mysqli_fetch_assoc($result)['count(*)'];
            if($how_much > 0)
            {
                echo "2Gatunek o nazwie <strong>".$g_name."</strong> już istnieje w bazie danych, poniechano więc jego dodania";
            }
            else
            {
                if($result =@$connection->query(sprintf("INSERT INTO genres VALUES('','%s', $login)",
                    mysqli_real_escape_string($connection, $g_name)
                )))
                {
                    echo "1Pomyślnie dodano gatunek do bazy danych";
                }
                else
                {
                    echo "3Nie udało się dodać gatunek do bazy danych";
                }
            }
        }
    }

 ?>

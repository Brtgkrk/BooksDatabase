<?php

    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if((strlen($username)<3) || (strlen($username)>20))
    {
        echo "Nazwa użytkownika musi mieć od 3 do 20 znaków.";
        exit();
    }
    if(ctype_alnum($username)==false)
    {
        echo "Nazwa użytkownika może posiadać wyłącznie znaki alfanumeryczne.";
        exit();
    }

    if((strlen($password)<5) || (strlen($password)>20))
    {
        echo "Hasło musi mieć od 5 do 20 znaków";
        exit();
    }

    $password_h = password_hash($password, PASSWORD_DEFAULT);

    if(!isset($_POST['reg']))
    {
        echo "Musisz zaakceptować regulamin!";
        exit();
    }

    require_once "../serverside/connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
        echo "Error ".$connection->connect_errno;
    }
    else
    {
        //is username is free
        $username = htmlentities($username, ENT_QUOTES, "UTF-8");

        if($result = @$connection->query(sprintf("SELECT COUNT(*) FROM users WHERE username = '%s'",
        mysqli_real_escape_string($connection, $username)
        )))
        {
            $how_many = mysqli_fetch_assoc($result)['COUNT(*)'];
            if($how_many > 0)
            {
                echo "Nazwa użytkownika zajęta";
            }
            else
            {
                if($connection->query(sprintf("INSERT INTO users VALUES('', '%s', '%s')",
                mysqli_real_escape_string($connection, $username),
                mysqli_real_escape_string($connection, $password_h)
                )))
                echo "Użytkownik został dodany pomyślnie";
            }
        }
        else
        {
            echo "Error";
        }
        $connection->close();
    }

 ?>

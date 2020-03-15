<?php

    session_start();
    /*
    if((!isset($_POST['login'])) || (!isset($_POST['password'])) || (isset($_POST['reg'])))
    {
        //header('Location: index.php');
        exit();
    }
    */
    $username = $_POST['username'];
    $password = $_POST['password'];

    if((strlen($username)<3) || (strlen($username)>20))
    {
        echo "Username must have 3 - 20 charracters";
        //header('Location: index.php');
        exit();
    }
    if(ctype_alnum($username)==false)
    {
        echo "Username must have only alphanumeric charracters";
        //header('Location: index.php');
        exit();
    }

    if((strlen($password)<5) || (strlen($password)>20))
    {
        echo "Password must have 5 - 20 charracters";
        //header('Location: index.php');
        exit();
    }

    $password_h = password_hash($password, PASSWORD_DEFAULT);

    if(!isset($_POST['reg']))
    {
        echo "reg is not checked";
        //header('Location: index.php');
        exit();
    }
    /*
    $secret = "";

    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);

    $answer = json_decode($check);

    if ($answer->success==false)
    {
        echo "Recaptcha is not valid";
        exit();
    }
    */
    require_once "../serverside/connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
        echo "Error".$connection->connect_errno;
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
                echo "username is taken";
            }
            else
            {
                if($connection->query(sprintf("INSERT INTO users VALUES('', '%s', '%s')",
                mysqli_real_escape_string($connection, $username),
                mysqli_real_escape_string($connection, $password_h)
                )))
                echo "User added properly";
            }
        }
        else
        {
            echo "Error";
        }
        $connection->close();
    }

 ?>

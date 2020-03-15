<?php

    session_start();

    if((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header('Location: ../index.html');
        exit();
    }

    require_once "../serverside/connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
        echo "Error".$connection->connect_errno;
    }
    else
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        //$password = password_hash($pass, PASSWORD_DEFAULT);

        $login = htmlentities($login, ENT_QUOTES, "UTF-8"); // sql injection defence
        //$password = htmlentities($password, ENT_QUOTES, "UTF-8");

        if($result = @$connection->query(sprintf("SELECT * FROM users WHERE username='%s'",
        mysqli_real_escape_string($connection,$login)
        ))) //if query is correct
        {
            $how_many_users = $result->num_rows; //how many users query return

            if($how_many_users>0)
            {
                $verse = $result->fetch_assoc(); //make table with variables from database

                if(password_verify($password, $verse['password']))
                {
                  $_SESSION['isLogged'] = true; //is user is logged



                  $_SESSION['id'] = $verse['ID'];
                  $_SESSION['user'] = $verse['username'];

                  unset($_SESSION['errorL']);

                  $result->close(); //delete query from memory

                  header('Location: dashboard.php');
                }
                else
                {
                    echo "Niepoprawne haslo";
                    header('Location: ../index.html');
                    exit();
                }

            }
            else
            {
                $_SESSION['errorL'] = '<span style="color:red"><br />Nieprawidłowy login lub hasło!</span>';
                //header('Location: index.php');
                header('Location: ../index.html');
                exit();
            }
        }

        $connection->close();
    }

?>

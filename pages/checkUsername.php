<?php

    session_start();

    if(!isset($_POST['username']))
    {
        echo "Nie można uzyskać dostępu do zmiennej username";
        exit();
    }

    require_once "../serverside/connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno!=0)
    {
        echo "Error: ".$connection->connect_errno;
    }
    else
    {
          $login = $_POST['username'];

          $login = htmlentities($login, ENT_QUOTES, "UTF-8");

          if($result = @$connection->query(sprintf("SELECT COUNT(*) FROM users WHERE username = '%s'",
          mysqli_real_escape_string($connection, $login)
          )))
          {
              $how_many = mysqli_fetch_assoc($result)['COUNT(*)'];
              if($how_many > 0)
              {
                  echo "1";
              }
              else
              {
                  echo "0";
              }
          }
          else
          {
              echo "Error";
          }
    }

 ?>

<?php
    /*if((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header('Location: ../index.html');
        exit();
    }*/

    /* Error Code Explanation:
        0 - One of the fields is empty
        1 - User or password incorrect
        2 - User logged in
    */

    session_start();
    $data = $_POST;

    if (empty($username = $data['username'])    ||
        empty($password = $data['password'])    ||
        empty($email = $data['username']))
    {
        exit('0');
    }

    require_once "../serverside/connect.php";

    $dsn = "mysql:host=$host;dbname=$db_name";

    try
    {
        $connection = new PDO($dsn, $db_user, $db_password);
    }
    catch (PDOException $exception)
    {
        exit ('Connection failied: ' . $exception->getMessage());
    }

    $userQuery = $connection->prepare('SELECT ID, username, password FROM users WHERE username = :username');
    $userQuery->bindValue(':username', $username, PDO::PARAM_STR);
    $userQuery->execute();
    
    //echo $userQuery->rowCount();
    
    $user = $userQuery->fetch();
    
    //echo $user['id'] . " " . $user['password'];
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['isLogged'] = true; // User is logged
        $_SESSION['id'] = $user['ID'];
        $_SESSION['user'] = $user['username'];
        exit('2');
    } else {
        exit('1');
    }

    /*

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0)
    {
        echo phpversion();
        echo "Error".$connection->connect_errno;
    }*/

        //$login = $_POST['login'];
        //$password = $_POST['password'];

        //$password = password_hash($pass, PASSWORD_DEFAULT);

        //$login = htmlentities($login, ENT_QUOTES, "UTF-8"); // sql injection defence
        //$password = htmlentities($password, ENT_QUOTES, "UTF-8");

    //$statement = $connection->prepare('SELECT * FROM users WHERE username = :username');

    //$statement = $connection->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
    /*
    $sth = $connection->prepare("SELECT * FROM users WHERE username = :username");
    $sth->execute([
        ':username' => $username,
    ]);

    /* Fetch all of the remaining rows in the result set 
    $xd = $sth->rowCount();
    $result = $sth->fetchAll();
    exit($xd.$result);

    /*if ($statement)
    {
        $statement->execute([
            ':username' => $username,
            ':email' => $email,
        ]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result))
        {
            exit('logowanie na'.$result['username']);
        }
    }

    /*if ($statement)
    {
        $statement->execute([
            ':username' => $username,
        ]);

        $result =$statement->FetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) exit('1'); // User doesn't exist

        if ($statement->rowCount() > 1) exit('2'); // There is more than 1 user with this nick

        //if(!password_verify($password, $result['password'])) exit('3');
        
        $user = $statement->fetch();
        if (empty($user['password'])) exit($result);
        else if ($user && password_verify($_POST['password'], $user['password']))
        {
            exit("valid!");
        } else {
            exit($user['password']);
        }
        */
        /*$_SESSION[isLogged] = true; // User is logged correctly
        $_SESSION['id'] = $result->ID;
        $_SESSION['user'] = $result->username;
        unset($_SESSION['errorL']);*/
        
        //exit('4'); // User logged in
    //}

        /*if($result = @$connection->query(sprintf("SELECT * FROM users WHERE username='%s'",
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
        }*/

        //$connection->close();


?>

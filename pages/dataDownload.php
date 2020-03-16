<?php
    
    session_start();

    if(!isset($_SESSION['isLogged']))
    {
        header('Location: index.php');
        exit();
    }

    require_once "../serverside/connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    $connection->set_charset("utf8"); //utf8 encoding

    if($connection->connect_errno!=0)
    {
        echo "Error".$connection->connect_errno;
    }
    else
    {
        $login = $_SESSION['user'];
        
        if ($user_query = @$connection->query("SELECT ID FROM users WHERE username = '$login'"))
        {
            $user_fetch = mysqli_fetch_assoc($user_query);
            $user_id = $user_fetch['ID'];
        }

        
        if($result = @$connection->query("SELECT * FROM books WHERE user = $user_id"))
        {
            $json_array = array();
            
            while($row = mysqli_fetch_assoc($result))
            {
                $aut = $row['author'];
                $gen = $row['genre'];
                $aut_res = @$connection->query("SELECT a_name FROM authors WHERE ID = $aut");
                $gen_res = @$connection->query("SELECT g_name FROM genres WHERE ID = $gen");
                $json_array[] = $row + mysqli_fetch_assoc($aut_res) + mysqli_fetch_assoc($gen_res);
            }
            
            
            echo json_encode($json_array);
        }
        
        $connection->close();
    }

?>
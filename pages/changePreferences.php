<?php

session_start();

if(!isset($_SESSION['isLogged']))
{
    header('Location: index.php');
    echo "3";
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

    $bReading = $_POST['b_reading'];
    $bQuequed = $_POST['b_quequed'];
    $bRead = $_POST['b_read'];

    echo $bReading + $bQuequed + $bRead;

    if($result =@$connection->query(sprintf("SELECT count(*) FROM authors WHERE a_name = '%s' AND user = '%s'",
    mysqli_real_escape_string($connection, $a_name),
    mysqli_real_escape_string($connection, $login)
    )))
    {
        $how_much = mysqli_fetch_assoc($result)['count(*)'];
        if($how_much > 0)
        {
            echo "2Autor o nazwie <strong>".$a_name."</strong> już istnieje w bazie danych, poniechano więc jego dodania";
        }
        else
        {
            if($result =@$connection->query(sprintf("INSERT INTO authors VALUES('','%s', $login, '%s')",
                mysqli_real_escape_string($connection, $a_name),
                mysqli_real_escape_string($connection, $description)
            )))
            {
                echo "1Pomyślnie dodano autora do bazy danych";
            }
            else
            {
                echo "3Nie udało się dodać autora do bazy danych";
            }
        }
    }
}

?>
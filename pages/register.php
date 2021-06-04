<?php

    session_start();
    $data = $_POST;

    /* Error Code Explanation:
        0 - One of the fields is empty
        1 - Username has less than 3 letters or has more than 20
        2 - Username contain non alphanumeric letter/s
        3 - Password has less than 6 letter or more than 50
        4 - Password don't match
        5 - Email is not valid
        6 - Rules is not accepted
        7 - Username is taken
        8 - Registration Done!
        9 - Script Error
    */

    if (empty($username = $data['username']) ||
        empty($password = $data['password']) ||
        empty($password_confirm = $data['password_confirm']) ||
        empty($email = $data['email']))
        {
            exit('0');
        }

    // Check Errors

    if ((strlen($username)<3) || (strlen($username)>20))
    {
        exit('1');
    }
    if (ctype_alnum($username)==false)
    {

        exit('2');
    }

    if ((strlen($password)<6) || (strlen($password)>50))
    {
        exit('3');
    }

    if ($password !== $password_confirm)
    {
        exit('4');
    }

    $password_h = password_hash($password, PASSWORD_DEFAULT);

    if (!checkEmail($email))
    {
        exit('5');
    }
    
    if (!isset($_POST['reg']))
    {
        exit('6');
    }

    // Connect to database

    require_once "../serverside/connect.php"; // You can set your database prefs in this file, if it doesn't exist just create it

    $dsn = "mysql:host=$host;dbname=$db_name";

    try
    {
        $connection = new PDO($dsn, $db_user, $db_password);
    }
    catch (PDOException $exception)
    {
        exit ('Connection failied: ' . $exception->getMessage());
    }

    // Check is username is free

    $statement = $connection->prepare('SELECT * FROM users WHERE username = :username OR email = :email');

    if ($statement)
    {
        $statement->execute([
            ':username' => $username,
            ':email' => $email,
        ]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result))
        {
            exit('7');
        }
    }

    // Insert data into database

    $statement = $connection->prepare('INSERT INTO users (ID, username, password, email) VALUES (:id, :username, :password, :email)');

    if ($statement)
    {
        $result = $statement->execute([
            ':id' => '',
            ':username' => $username,
            ':password' => $password_h,
            ':email' => $email,
        ]);
    }

    if ($result) {
        exit('8');
    }
    
    exit('9'); // This is display only if is error in code

    // Check correctness of email account

    function checkEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false && $find2 > $find1);
     }

 ?>
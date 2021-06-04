<?php

    session_start();

    if(isset($_SESSION['isLogged']))
    {
        exit('1'); // User is already logged in session
    }
    exit('0'); // User is not logged
?>
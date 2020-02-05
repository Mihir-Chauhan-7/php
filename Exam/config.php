<?php

function checkSession()
{
    return isset($_SESSION['uid']) && !empty($_SESSION['uid']) ? true : false;
}

function logOut()
{
    unset($_SESSION['uid']);
    header("Location:login.php");
}
?>
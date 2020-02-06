<?php
isset($_GET['logout']) ? logOut() : "";

function checkSession(){
    return isset($_SESSION['uid']) ? true : false;
}

function logOut(){
    session_start();
    unset($_SESSION['uid']);
    session_destroy();
    header("Location:login.php");
}
?>
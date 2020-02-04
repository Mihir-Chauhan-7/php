<?php

function checkSession()
{
    return isset($_SESSION['uid']) && !empty($_SESSION['uid']) ? true : false;
}

?>
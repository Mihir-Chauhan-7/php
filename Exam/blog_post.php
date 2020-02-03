<?php require_once 'operations.php';
    echo checkSession() ? 
    "<form method='POST'>
    <a href='manage_category.php'>Manage Category</a>
    <a href='manage_category.php'>My Profile</a>
    <input style='float : right' type='submit' value='Logout' name='logout'></form>" 
    :die("Your Are Not Logged In");
    isset($_POST['logout']) ? logOut() : "";
?>
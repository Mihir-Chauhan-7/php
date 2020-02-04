<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Manage Post</title>
</head>
<body>
<?php
     require_once 'config.php';
     require_once 'operations.php';
     require_once 'post_operations.php';
     echo checkSession() ? "
        
        <form method='POST'>
        <div class=btn-group' role='group' aria-label='Basic example'>
        <a class='btn btn-secondary' href='manage_category.php'>Manage Category</a>
        <a class='btn btn-secondary' href='register.php?id=".$_SESSION['uid']."'>My Profile</a>
        <a class='btn btn-secondary' href='add_post.php'>Add Post</a>
        <input class='btn btn-secondary' style='float : right' type='submit' 
        value='Logout' name='logout'></form></div>" 
     
     : die("Your Are Not Logged In");
    
    isset($_POST['logout']) ? logOut() : "";
    if(isset($_GET['action']) && isset($_GET['id']) 
       && !empty($_GET['action']) && !empty($_GET['id'])) {
        if($_GET['action'] == 'delete'){
            deletePost($_GET['id']);
        }
    }
?>
    <center><h2>Blog Post</h2></center>
    <div>
        <?php displayPostList(); ?>
    </div>
</body>
</html>
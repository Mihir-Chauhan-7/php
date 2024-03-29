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
     echo checkSession() 
        ? "<div style='margin:10px' class=btn-group mr-2' role='group'>
                <a class='btn btn-outline-dark' href='manage_category.php'>Manage Category</a>
                <a class='btn btn-outline-dark' href='register.php?id=".$_SESSION['uid']."'>
                    My Profile</a>
                <a class='btn btn-outline-dark' href='add_post.php'>Add Post</a>
            </div>
            <div style='margin:10px;float:right' class=btn-group mr-2' role='group'>
                <a class='btn btn-outline-dark' href='config.php?logout'>Logout</a>
            </div>" 
        : header("Location:login.php");;

    if(isset($_GET['action']) && isset($_GET['id']) 
       && !empty($_GET['action']) && !empty($_GET['id'])) {
        
        if($_GET['action'] == 'delete'){
            deletePost($_GET['id']);
        }
    }
?>
<center>
    <h2 class="display-4">Blog Post</h2>
</center>
    <div>
        <?php displayPostList(); ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Manage Category</title>
</head>
<body>
<?php 
      require_once 'config.php';
      require_once 'operations.php';
      require_once 'category_operations.php';
      echo checkSession() 
            ? "<div style='margin:10px' class=btn-group mr-2' role='group'>
                <a class='btn btn-outline-dark' href='manage_post.php'>Manage Post</a>
                <a class='btn btn-outline-dark' href='register.php?id=".$_SESSION['uid']."'>
                    My Profile</a>
                <a class='btn btn-outline-dark' href='add_category.php'>Add Category</a>
                </div>
            <div style='margin:10px;float:right' class=btn-group mr-2' role='group'>
                <a class='btn btn-outline-dark' href='config.php?logout'>Logout</a>
            </div>" 
            : header("Location:login.php");

    if(isset($_GET['action']) && isset($_GET['id']) && !empty($_GET['action']) 
        && !empty($_GET['id'])) {

        if($_GET['action'] == 'delete'){  
            deleteCategory($_GET['id']);
        }
    }
?>
<center>
    <h4 class="display-4">Blog Category</h4>
</center>
<div>
    <?php displayCategoryList(); ?>
</div>
</body>
</html>
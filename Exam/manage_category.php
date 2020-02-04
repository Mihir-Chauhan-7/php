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
      echo checkSession() ? "<form method='POST'>
        <a href='manage_post.php'>Manage Post</a>
        <a href='register.php?id=".$_SESSION['uid']."'>My Profile</a>
        <input style='float : right' type='submit' value='Logout' name='logout'></form>" 
        : die("Your Are Not Logged In");
    isset($_POST['logout']) ? logOut() : "";
    if(isset($_GET['action']) && isset($_GET['id']) 
        && !empty($_GET['action']) && !empty($_GET['id'])) {
            if($_GET['action'] == 'delete'){
                deleteCategory($_GET['id']);
            }
        }
?>
    <h2>Blog Category</h2>
    <a href="add_category.php">Add Category</a>
    <div>
        <?php displayCategoryList(); ?>
    </div>
</body>
</html>
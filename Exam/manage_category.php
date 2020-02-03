<!DOCTYPE html>
<html>
<head>
<title>Manage Category</title>
</head>
<body>
<?php require_once 'operations.php';
    require_once 'category_operations.php';
    echo checkSession() ? 
    "<form method='POST'>
    <a href='manage_post.php'>Manage Post</a>
    <a href='register.php?id=".$_SESSION['uid']."'>My Profile</a>
    <input style='float : right' type='submit' value='Logout' name='logout'></form>" 
    :die("Your Are Not Logged In");
    isset($_POST['logout']) ? logOut() : "";
    if(isset($_GET['action']) && isset($_GET['id']) 
    && !empty($_GET['action']) && !empty($_GET['id'])) 
    {
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
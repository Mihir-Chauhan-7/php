<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
</head>
<body>
<fieldset> 
    <?php
    require_once 'category_operations.php';
    isset($_GET['id']) ? setCategoryValue($_GET['id']) : "" ;
    isset($_POST['submit']) ? addCategory($_POST) : "";
    ?>
        <legend>Category Details</legend>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" value="<?php echo getCategoryValue('title'); ?>"><br><br>
            <input type="text" name="content" placeholder="Content" value="<?php echo getCategoryValue('content'); ?>"><br><br>
            <input type="text" name="url" placeholder="url" value="<?php echo getCategoryValue('url'); ?>"><br><br>
            <input type="text" name="meta_title" placeholder="Meta Title" value="<?php echo getCategoryValue('meta_title') ;?>"><br><br>
            <input type="file" name="image"><br><br>
            <input type="submit" name="submit" value="Add Category">
            
        </form>
</fieldset>
</body>
</html>
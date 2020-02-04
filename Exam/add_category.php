<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<fieldset> 
    <?php
    require_once 'config.php';
    require_once 'category_operations.php';
    echo checkSession() ? "<form method='POST'>
        <a href='manage_category.php'>Manage Category</a>
        <a href='register.php?id=".$_SESSION['uid']."'>My Profile</a>
        <input class='btn btn-primary' style='float : right' type='submit' value='Logout' name='logout'></form>" 
     
     : die("Your Are Not Logged In");
    isset($_POST['update']) ? updateCategory($_POST,$_GET['id'],$_FILES) : "";
    isset($_GET['id']) ? setCategoryValue($_GET['id']) : "" ;
    isset($_POST['submit']) ? addCategory($_POST,$_FILES) : "";
    ?>
        <legend>Category Details</legend>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" value="<?php echo getCategoryValue('title'); ?>"><br><br>
            <input type="text" name="content" placeholder="Content" value="<?php echo getCategoryValue('content'); ?>"><br><br>
            <input type="text" name="url" placeholder="url" value="<?php echo getCategoryValue('url'); ?>"><br><br>
            <input type="text" name="meta_title" placeholder="Meta Title" value="<?php echo getCategoryValue('meta_title') ;?>"><br><br>
            <?php $parentCatagoryList=getCategories(); ?>
                <select name="parent_id">
                <?php foreach($parentCatagoryList as $singleCategory) : ?>
                <?php $selected = $singleCategory['cid'] == getCategoryValue('parent_id') 
                ? 'selected'
                : ''; ?>
                <option value="<?php echo $singleCategory['cid'] ?>" <?php echo $selected; ?>>
                <?php echo $singleCategory['title'] ?>
                </option>
                <?php endforeach;?>
                </select>
            <input type="file" name="image"><br><br>
            <input type="submit" name="submit" value="Add Category" <?php echo getCategoryValue('btnAdd') ?> >
            <input type="submit" name="update" value="Update" <?php echo getCategoryValue('btnShow') ?> >
        </form>
</fieldset>
</body>
</html>
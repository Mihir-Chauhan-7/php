<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<?php
    require_once 'config.php';
    require_once 'category_operations.php';
    echo checkSession() ? "
        <div style='margin:10px' class=btn-group mr-2' role='group'>
        <form method='POST'>
        <a class='btn btn-outline-dark' href='manage_category.php'>Manage Category</a>
        <a class='btn btn-outline-dark' href='register.php?id=".$_SESSION['uid']."'>
        My Profile</a></div>
        <div style='float:right;margin:10px' class=btn-group mr-2' role='group'>
        <input class='btn btn-outline-dark' type='submit' value='Logout' name='logout'>
        </form></div>" 
        
     : die("Your Are Not Logged In");
    isset($_POST['logout']) ? logOut() : "";
    isset($_POST['update']) ? updateCategory($_POST,$_GET['id'],$_FILES) : "";
    isset($_GET['id']) ? setCategoryValue($_GET['id']) : "" ;
    isset($_POST['submit']) ? addCategory($_POST,$_FILES) : "";
?>
<div class="card text-center" style="margin-top:20px;margin-left:450px;width: 30rem">
  <div class="card-header">
        <h5 class="card-title">Category Details</h5>    
</div>
<div class="card-body">      
    <form method="POST" enctype="multipart/form-data">
        <input class="form-control" type="text" name="title" placeholder="Title" 
            value="<?php echo getCategoryValue('title'); ?>"><br>
        <input class="form-control" type="text" name="content" placeholder="Content" 
            value="<?php echo getCategoryValue('content'); ?>"><br>
        <input class="form-control" type="text" name="url" placeholder="url" 
            value="<?php echo getCategoryValue('url'); ?>"><br>
        <input class="form-control" type="text" name="meta_title" placeholder="Meta Title"
            value="<?php echo getCategoryValue('meta_title') ;?>"><br>
            <?php $parentCatagoryList=getCategories(); ?>
        
            <div class="input-group">
                <select class="form-control" name="parent_id">
                <?php foreach($parentCatagoryList as $singleCategory) : ?>
                <?php $selected = $singleCategory['cid'] == getCategoryValue('parent_id') 
                ? 'selected'
                : ''; ?>
                <option value="<?php echo $singleCategory['cid'] ?>" <?php echo $selected; ?>>
                <?php echo $singleCategory['title'] ?>
                </option>
                <?php endforeach;?>
                </select>
                <input style="width:300px" class="form-control" type="file" name="image"><br>
            </div>
</div>
<div class="card-footer text-muted">
        <input class="btn btn-outline-dark" type="submit" name="submit" 
            value="Add Category" <?php echo getCategoryValue('btnAdd') ?> >
        <input class="btn btn-outline-dark" type="submit" name="update" 
            value="Update" <?php echo getCategoryValue('btnShow') ?> >
        </form>
</div>
</div>
</body>
</html>
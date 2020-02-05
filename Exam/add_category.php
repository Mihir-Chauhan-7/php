<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
    require_once 'config.php';
    require_once 'category_operations.php';
    
    echo checkSession() 
        ? "<div style='margin:10px' class=btn-group mr-2' role='group'>
            <a class='btn btn-outline-dark' href='manage_category.php'>Manage Category</a>
            <a class='btn btn-outline-dark' href='register.php?id=".$_SESSION['uid']."'>
                My Profile</a>
        </div>
        <div style='float:right;margin:10px' class=btn-group mr-2' role='group'>
            <a class='btn btn-outline-dark' href='config.php?logout'>Logout</a>
        </div>"       
        : die("Your Are Not Logged In");
    
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
        <div>
            <input class="form-control" type="text" name="title" placeholder="Title" 
                value="<?php echo getCategoryValue('title'); ?>">
        </div>
        <div>
            <input class="form-control" type="text" name="content" placeholder="Content" 
                value="<?php echo getCategoryValue('content'); ?>">
        </div>
        <div>
            <input class="form-control" type="text" name="url" placeholder="url" 
                value="<?php echo getCategoryValue('url'); ?>">
        </div>
        <div>    
            <input class="form-control" type="text" name="meta_title" placeholder="Meta Title"
                value="<?php echo getCategoryValue('meta_title') ;?>">
        </div>
    
        <div class="input-group">
            <select class="form-control" name="parent_id">
                <?php $parentCatagoryList=getCategories(); ?>
                <?php foreach($parentCatagoryList as $singleCategory) : ?>
                <?php $selected = $singleCategory['cid'] == getCategoryValue('parent_id') 
                    ? 'selected'
                    : ''; ?>
                <option value="<?php echo $singleCategory['cid'] ?>" <?php echo $selected; ?>>
                    <?php echo $singleCategory['title'] ?>
                </option>
                <?php endforeach;?>
            </select>
        </div>
        <div>
            <input style="width:300px" class="form-control" type="file" name="image"><br>
        </div>
    </div>
    <div class="card-footer text-muted">
        <div>
            <input class="btn btn-outline-dark" type="submit" name="submit" 
                value="Add Category" <?php echo getCategoryValue('btnAdd') ?> >
        </div>
        <div>
            <input class="btn btn-outline-dark" type="submit" name="update" 
                value="Update" <?php echo getCategoryValue('btnShow') ?> >
        </div>
    </div>
</form>
</div>
</body>
</html>
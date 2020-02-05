<!DOCTYPE html>
<html>
<head>
<title>Add Blog Post</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
    <?php
    require_once 'config.php';
    require_once 'post_operations.php';
    require_once 'category_operations.php';
    echo checkSession() 
        ? "<div style='margin:10px' class=btn-group mr-2' role='group'>
                <a class='btn btn-outline-dark' href='manage_post.php'>Manage Post</a>
                <a class='btn btn-outline-dark' href='register.php?id=".$_SESSION['uid']."'>
                    My Profile</a></div>
            <div style='margin:10px;float:right' class=btn-group mr-2' role='group'>
                <a class='btn btn-outline-dark' href='config.php?logout'>Logout</a>
            </div>"
        : die("Your Are Not Logged In");
    isset($_POST['update']) ? updatePost($_POST,$_GET['id']) : "";
    isset($_POST['submit']) ? addPost($_POST) : "";
    isset($_GET['id']) ? setPostValue($_GET['id']) : "" ;
?>
    
    <div class="card text-center" style="margin-top:20px;margin-left:450px;width: 30rem">
        <div class="card-header">
        <h5 class="card-title">Blog Post Details</h5>    
    </div>
    <div class="card-body">
    <form method="POST">
            <div>
            <input class="form-control" type="text" name="title" placeholder="Title" 
                value="<?php echo getPostValue('title'); ?>">
            </div>
            <div>
            <input class="form-control" type="text" name="content" placeholder="Content" 
                value="<?php echo getPostValue('content'); ?>">
            </div>
            <div>
            <input class="form-control" type="text" name="url" placeholder="url" 
                value="<?php echo getPostValue('url'); ?>">
            </div>
            <div>
            <input class="form-control" type="date" name="published_at" 
                value="<?php echo getPostValue('published_at') ;?>">
            </div>
            <div>
            <input class="form-control" type="file" name="image">
            </div>
            <div class="input-group" >
                <div class="input-group-prepend">
                    <span class="input-group-text">Category</span>
                </div>
                <select style="width: 345px;" name="categories[]" multiple>
                <?php foreach(getCategories() as $category) : ?>
                    <?php $selected = in_array($category['title'],getPostValue('category'))  
                        ? 'selected'
                        : ''; ?>
                <option value="<?php echo $category['cid'] ?>" <?php echo $selected; ?>>
                    <?php echo $category['title'] ?>
                </option>
                <?php endforeach; ?>
                </select>
            </div>
    </div>
    <div class="card-footer text-muted">
        <div>
            <input class="btn btn-outline-dark" type="submit" name="submit" 
                value="Add Post" <?php echo getPostValue('btnAdd') ?>>
        </div>
        <div>
            <input class="btn btn-outline-dark" type="submit" name="update" 
            value="Update" <?php echo getPostValue('btnShow') ?>>
        </div>
    </div>
</div>
</form>    
</body>
</html>
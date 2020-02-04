<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
</head>
<body>
<fieldset> 
    <?php
    require_once 'category_operations.php';
    isset($_POST['update']) ? updateCategory($_POST,$_GET['id']) : "";
    isset($_GET['id']) ? setCategoryValue($_GET['id']) : "" ;
    isset($_POST['submit']) ? addCategory($_POST) : "";
    ?>
        <legend>Category Details</legend>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" value="<?php echo getCategoryValue('title'); ?>"><br><br>
            <input type="text" name="content" placeholder="Content" value="<?php echo getCategoryValue('content'); ?>"><br><br>
            <input type="text" name="url" placeholder="url" value="<?php echo getCategoryValue('url'); ?>"><br><br>
            <input type="text" name="meta_title" placeholder="Meta Title" value="<?php echo getCategoryValue('meta_title') ;?>"><br><br>
            <?php $parentCatagoryList=getCategories();
            ?>
                <select name="parent_id">
                <?php foreach($parentCatagoryList as $singleCategory) : ?>
                <?php $selected = $singleCategory == getCategoryValue('parent') 
                ? 'selected'
                : ''; ?>
                <option value="<?php echo $singleCategory['cid'] ?>" <?php echo $selected; ?>>
                <?php echo $singleCategory['title'] ?>
                </option>
                <?php endforeach; ?>
                </select>
            <input type="file" name="image"><br><br>
            <input type="submit" name="submit" value="Add Category" <?php echo getCategoryValue('btnAdd') ?> >
            <input type="submit" name="update" value="Update" <?php echo getCategoryValue('btnShow') ?> >
        </form>
</fieldset>
</body>
</html>
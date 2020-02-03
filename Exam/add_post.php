<!DOCTYPE html>
<html>
<head>
<title>Add Blog Post</title>
</head>
<body>
<fieldset> 
    <?php
    require_once 'post_operations.php';
    require_once 'category_operations.php';
    isset($_POST['submit']) ? addPost($_POST) : "";
    isset($_GET['id']) ? setPostValue($_GET['id']) : "" ;
    ?>
        <legend>Blog Post Details</legend>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" value="<?php echo getPostValue('title'); ?>"><br><br>
            <input type="text" name="content" placeholder="Content" value="<?php echo getPostValue('content'); ?>"><br><br>
            <input type="text" name="url" placeholder="url" value="<?php echo getPostValue('url'); ?>"><br><br>
            <input type="date" name="published_at" placeholder="Meta Title" value="<?php echo getPostValue('meta_title') ;?>"><br><br>
            <input type="file" name="image"><br><br>

        <label>Category</label>   
        <select name="categories[]" multiple>
        		<?php foreach(getCategories() as $category) : ?>
        		<?php $selected = in_array($category['title'],[])  
        		? 'selected'
        		: ''; ?>
        		<option value="<?php echo $category['title'] ?>" <?php echo $selected; ?>>
        			<?php echo $category['title'] ?>
        		</option>
            	<?php endforeach; ?>
    		</select><br><br>
            <input type="submit" name="submit" value="Add Post">
            
        </form>
</fieldset>
</body>
</html>
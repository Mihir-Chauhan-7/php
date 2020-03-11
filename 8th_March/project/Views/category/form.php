<!DOCTYPE html>
<html>
    <title>Categories</title>
    <body>
    <form action="<?php echo $this->getUrl('save') ?>" method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr>
                <td colspan="2">
                    <?php $category = $this->getCategory(); ?>
                    <h3>Category</h3>
                </td>
            </tr>
            <input type="hidden" name="id" value="<?php echo $category->id ?>">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $category->name ?>">
            </td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" 
                    value="<?php echo $category->description ?>"></td>
            </tr>
            <tr>
                <td>Parent ID</td>
                <td><input type="text" name="parent_id" 
                    value="<?php echo $category->parent_id ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Save"></td>
            </tr>
        </table>
    </form>
    </body>
</html>
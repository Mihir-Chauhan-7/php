<?php $category = $this->getCategory(); ?>
<form id="addCategory" 
    action="<?php echo $this
                ->getUrl('save',NULL,['id' => $category->id]) ?>" 
    method="POST">
    <table border="1" width=100% cellspacing="4">
        <tr>
            <td colspan="2">
                <h3>Category</h3>
            </td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" 
                    value="<?php echo $category->name ?>">
            </td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" name="description" 
                value="<?php echo $category->description ?>">
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td><Select name="status">
                <?php foreach($category->getStatusOptions() as $key => $value) : ?> 
                <option value="<?php echo $key ?>" 
                    <?php echo $key == $category->status 
                    ? 'selected' 
                    : '' ?>>
                    
                    <?php echo $value; ?>
                </option>
                <?php endforeach; ?>
        </tr>
        <tr>
            <td>Parent Category</td>
            <td>
                <select name="parent_id">
                    <option value="0">No Parent</option>
                    <?php foreach($this->getCategories() as $id => $name):?>
                    <option value="<?php echo $id ?>" 
                        <?php echo $category->parent_id == $id 
                        ? 'selected' 
                        : ''; ?>
                        <?php echo $category->id == $id 
                        ? 'disabled' 
                        : ''; ?>>
                        <?php echo $name ?>
                    </option>
                    <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td><button type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','category');?>'); ajax.load();">Back</button></td></td>
            <td><button type="button" onclick="ajax.setForm('addCategory'); ajax.saveForm()">Save</button></td>
        </tr>
    </table>
</form>
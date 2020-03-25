<?php 

$product = $this->getProduct(); ?>
    <form id="addProduct" action="<?php echo $this->getUrl('save',NULL,['id' => $product->id]) ?>" 
        method="POST">
        <table border="1" width="100%" cellspacing="4">
            <tr>
                <td colspan="2"><h3>Product</h3></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" 
                    value="<?php echo $product->name ?>"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="price" 
                    value="<?php echo $product->price ?>"></td>
            </tr>
            <tr>
                <td>Stock</td>
                <td><input type="text" name="stock" 
                    value="<?php echo $product->stock ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><Select name="status">
                    <?php foreach($product->getStatusOptions() as $key => $value) : ?> 
                    <option value="<?php echo $key ?>" 
                    <?php echo $key == $product->status 
                    ? 'selected' 
                    : '' ?>>
                    
                    <?php echo $value; ?>
                    </option>
                    <?php endforeach; ?>
            </tr>
            <tr>
                <td>Stock Keeping Unit</td>
                <td><input type="text" name="sku" 
                    value="<?php echo $product->sku ?>"></td>
            </tr>
            <tr>
                <td>Category</td>
                <td><Select name="categoryId">
                    <?php foreach($product->getCategories() as $key => $value) : ?> 
                    
                    <option value="<?php echo $key ?>" <?php echo $product->getSelectedCategory() == $key ? 'selected' : ''; ?>>
                        <?php echo $value; ?>
                    </option>
                    <?php endforeach; ?>
            </tr>
            <tr>
                <td><button type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','product');?>'); ajax.load();">Back</button></td>
                <td><button type="button" onclick="ajax.setForm('addProduct').saveForm()">Save</button>
            </tr>
        </table>
    </form>
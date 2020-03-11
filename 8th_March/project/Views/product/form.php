<!DOCTYPE html>
<html>
    <title>Product</title>
    <body>
    <form action="<?php echo $this->getUrl('save') ?>" method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr>
                <?php $product = $this->getProduct(); ?>
                <td colspan="2"><h3>Product</h3></td>
            </tr>
            <input type="hidden" name="id" value=<?php echo $product->id ?>>
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
                <td></td>
                <td><input type="submit" value="Save"></td>
            </tr>
        </table>
    </form>
    </body>
</html>
<!DOCTYPE html>
<html>
    <title>View</title>
    <body>
        <?php $product = $this->productModel->getProduct($this->request->getRequest('id')) ?>
    <form action="?c=product&a=update" method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr><td colspan="2"><h3>Update Product</h3></td></tr>
            <input type="hidden" name="id" value=<?php echo $product['id'] ?>>
            <tr><td>Name</td><td>
                <input type="text" name="name" value=<?php echo $product['name'] ?>>
            </td></tr>
            <tr><td>Price</td><td>
                <input type="text" name="price" value=<?php echo $product['price'] ?>>
            </td></tr>
            <tr><td>Stock</td><td>
                <input type="text" name="stock" value=<?php echo $product['stock'] ?>>
            </td></tr>
            <tr><td>Stock Keeping Unit</td><td>
                <input type="text" name="sku" value=<?php echo $product['sku'] ?>>
            </td></tr>
            <tr><td></td><td>
                <input type="submit" value="Update"></td></tr>
            
        </table>
    </form>
    </body>
</html>
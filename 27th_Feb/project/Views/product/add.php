<!DOCTYPE html>
<html>
    <title>View</title>
    <body>
    <form action="?c=product&a=save" method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr><td colspan="2"><h3>Add Product</h3></td></tr>
            <tr><td>Name</td><td><input type="text" name="name"></td></tr>
            <tr><td>Price</td><td><input type="text" name="price"></td></tr>
            <tr><td>Stock</td><td><input type="text" name="stock"></td></tr>
            <tr><td>Stock Keeping Unit</td><td><input type="text" name="sku"></td></tr>
            <tr><td></td><td><input type="submit" value="Add"></td></tr>
            
        </table>
    </form>
    </body>
</html>
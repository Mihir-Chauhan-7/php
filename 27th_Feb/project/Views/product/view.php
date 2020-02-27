<!DOCTYPE html>
<head>
    <title>Display Products</title>
    <body>
        <table border="1" width=100% cellspacing="4">
            <tr><td><h2>Product List<h2></td></tr>
            <table border="1" width=100% cellspacing="5" cellpadding="5">
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>SKU</th>
                <th colspan="2">Actions</th>
                <?php foreach($productList as $product): ?>
                    <tr>
                    <?php foreach($product as $value): ?>
                        <td><?php echo $value ?></td>
                    <?php endforeach; ?>
                        <td><a href="?c=product&a=edit">Edit</a></td>
                        <td><a href="?c=product&a=delete&id">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </table>
    </body>
</head>
</html>
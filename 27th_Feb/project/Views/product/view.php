<!DOCTYPE html>
<head>
    <title>Products</title>
    <body>
        <table border="1" width=100% cellspacing="4">
            <tr><td><h2>Product List<h2></td></tr>
            <a href="<?php echo $this->getUrl('add')?>">Add Product</a>
            <table border="1" width=100% cellspacing="5" cellpadding="5">
                <th><input onclick="selectAll(this)" type="checkbox"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>SKU</th>
                <th>Media</th>
                <th colspan="2">Actions</th>
                <form action="<?php echo $this->getUrl('delete')?>" method="POST">
                <input type="submit" value="Delete">
                <?php foreach($this->productModel->displayProduct() as $product): ?>
                    <tr>
                        <td><input type="checkbox" name="check[]" 
                                value="<?php echo $product['id']; ?>">
                        </td>
                    <?php foreach($product as $value): ?>
                        <td><?php echo $value ?></td>
                    <?php endforeach; ?>
                        <td>
                            <a href="<?php echo $this->getUrl('viewGallery',null,['id' => $product['id']])?>">View Gallery</a>
                        </td>
                        <td>
                            <a href=<?php echo $this->getUrl('edit',null,['id' => $product['id'] ])?>>Edit</a>
                        </td>
                        <td>
                            <a href=<?php echo $this->getUrl('delete',null,['id' => $product['id'] ])?>>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </form>
            </table>
            <script>
                function selectAll(el){
                    var boxes = document.getElementsByName('check[]');
                    if(el.checked){
                        for(i=0;i<boxes.length;i++){
                            boxes[i].checked=true;
                        }
                    }
                    else{
                        for(i=0;i<boxes.length;i++){
                            boxes[i].checked=false;
                        }
                    }
                }
            </script> 
    </body>
</head>
</html>
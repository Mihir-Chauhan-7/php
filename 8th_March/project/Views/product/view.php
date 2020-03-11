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
                <th>Base Image</th>
                <th>Thumbnail Image</th>
                <th>Small Image</th>
                <th>Media</th>
                <th colspan="2">Actions</th>
                <form action="<?php echo $this->getUrl('delete')?>" 
                    method="POST">
                <input type="submit" value="Delete">
                <?php 
                
                foreach($this->getProducts() as $row): ?>
                    <tr>
                        <td><input type="checkbox" name="check[]" 
                                value="<?php echo $row->id; ?>">
                        </td>
                            <td><?php echo $row->id ?></td>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->price ?></td>
                            <td><?php echo $row->stock ?></td>
                            <td><?php echo $row->status ?></td>
                            <td><?php echo $row->sku ?></td>
                            <td><?php echo $row->base_image ?></td>
                            <td><?php echo $row->thumbnail_image ?></td>
                            <td><?php echo $row->small_image ?></td>
                        <td>
                            <a href="<?php echo $this->
                                getUrl('viewGallery',null,['id' => $row->id])?>">View Gallery
                                </a>
                        </td>
                        <td>
                            <a href=<?php echo $this->
                                getUrl('edit',null,['id' => $row->id ])?>>Edit</a>
                        </td>
                        <td>
                            <a href=<?php echo $this->
                                getUrl('delete',null,['id' => $row->id ])?>>Delete</a>
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
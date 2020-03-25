    <form id="deleteProduct" action="<?php echo $this->getUrl('delete')?>" method="POST">
            <table class="table-striped" width=100% cellspacing="10" cellpadding="14">
                <tr>
                    <td align="center" colspan="13">
                        <h2>Product List</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="btn btn-outline-primary" type="button" onclick="ajax.setForm('deleteProduct'); ajax.saveForm();" value="Delete">
                    </td>
                    <td colspan="13">
                        <button class="btn btn-outline-primary" type="button" 
                            onclick="ajax.setUrl('<?php echo $this->getUrl('add')?>'); ajax.load();">
                            Add Product</button>
                    </td>
                </tr>
                <tr style="height: 60px">
                <th>
                    <input onclick="selectAll(this)" type="checkbox">
                </th>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>SKU</th>
                <th>Status</th>
                <th>Base Image</th>
                <th>Thumbnail Image</th>
                <th>Small Image</th>
                <th width="140px">Media</th>
                <th colspan="2">Actions</th>
                </tr>
                <?php if(empty($this->getProducts())): ?>
                    <tr>
                        <td colspan="13" align="center"><h3>No Records...</h3></td>
                    </tr>
                <?php else: ?>
                    <?php foreach($this->getProducts() as $row): ?>
                    <tr>
                        <td><input type="checkbox" name="check[]" 
                                value="<?php echo $row->id; ?>">
                        </td>
                            <td><?php echo $row->id ?></td>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->price ?></td>
                            <td><?php echo $row->stock ?></td>
                            <td><?php echo $row->sku ?></td>
                            <td class="<?php echo $row->status == 1 ? 'badge badge-success' : 'badge badge-danger'; ?>"><?php echo $this->productModel->getStatusLabel($row->status); ?></td>
                            <td><?php echo $row->base_image ?></td>
                            <td><?php echo $row->thumbnail_image ?></td>
                            <td><?php echo $row->small_image ?></td>
                        <td>
                            <button class="btn btn-outline-info btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('viewGallery','product_media',['id' => $row->id])?>'); ajax.load()">View Gallery</button>
                        </td>
                        <td>
                            <button class="btn btn-outline-success btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('edit',null,['id' => $row->id ])?>'); ajax.load()">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-outline-danger btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('delete',null,['id' => $row->id ])?>'); ajax.load()">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
        </table>
        </form>
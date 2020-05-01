<div class="container-fluid">
<div class="title">Products</div>
<form id="deleteProduct" action="<?php echo $this->getUrl('delete')?>" method="POST">
    <input class="btn btn-outline-secondary bp" type="button" onclick="ajax.setForm('deleteProduct'); ajax.saveForm();" value="Delete">
    <button class="btn btn-outline-secondary bp" type="button" 
        onclick="ajax.setUrl('<?php echo $this->getUrl('add')?>'); ajax.load();">
        Add Product</button>
    
    <table class="table-striped" width=100% cellspacing="10" cellpadding="14">
        <thead>
            <tr align="center" style="height: 60px">
            <th>
                <input onclick="selectAll(this)" type="checkbox"> All
            </th>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>SKU</th>
            <th>Status</th>
            <th>Media</th>
            <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if(empty($this->getProducts())): ?>
            <tr>
                <td colspan="13" align="center"><h3>No Records...</h3></td>
            </tr>
        <?php else: ?>
            <?php foreach($this->getProducts() as $row): ?>
            <tr align="center">
                <td><input type="checkbox" name="check[]" 
                        value="<?php echo $row->id; ?>">
                </td>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo strlen($row->name) > 30 
                        ? substr($row->name,0,30).".."
                        : $row->name; ?></td>
                    <td>$<?php echo $row->price ?></td>
                    <td><?php echo $row->stock ?></td>
                    <td><?php echo $row->sku ?></td>
                    <td>
                        <span class="<?php echo $row->status == 1 
                            ? 'badge badge-success' 
                            : 'badge badge-danger'; ?>">
                            <?php echo $this->productModel
                                ->getStatusLabel($row->status); ?>
                        </span>
                    </td>
                <td>
                    <button class="btn btn-outline-secondary bp btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('viewGallery','product_media',['id' => $row->id])?>'); ajax.load()">View Gallery</button>
                </td>
                <td>
                    <button class="btn btn-outline-secondary bp btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('edit',null,['id' => $row->id ])?>'); ajax.load()">Edit</button>
                </td>
                <td>
                    <button class="btn btn-outline-secondary bp btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('delete',null,['id' => $row->id ])?>'); ajax.load()">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
</table>
</form>
</div>
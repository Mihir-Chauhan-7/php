<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Sku</th>
            <th>Price</th>
            <th>Action</th>
            <th><button type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('show','checkout',['flag' => 1 ]); ?>'); ajax.load()">Show Cart</button></th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach($this->getProducts() as $product): ?>
        <tr>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->sku; ?></td>
            <td><?php echo $product->price; ?></td>
            <td><button type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('add','checkout',['productId' => $product->productId]) ?>'); ajax.load()">Add To Cart</button></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div style="padding: 10px">
<fieldset class="fieldset">
    <legend>Products</legend>
<table style="margin-top: 20px ;text-align: center" 
    class="table table-striped">
    <thead>
        <tr style="color: whitesmoke;background-color: #283593">
            <th>Name</th>
            <th>Sku</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach($this->getProducts() as $product): ?>
        <tr>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->sku; ?></td>
            <td>$<?php echo $product->price; ?></td>
            <td colspan="100%">
                <button class="btn btn-outline-secondary bp btn-sm" 
                type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('add','checkout',['productId' => $product->productId]) ?>'); ajax.load()">Add To Cart</button></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="100%" 
                style="color: whitesmoke;background-color: #283593">
            </td>    
        </tr>
        <tr>
            <td colspan="100%" align="right">
            <button class="btn btn-outline-secondary bp btn-sm" 
                type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('show','checkout',['flag' => 1 ]); ?>'); ajax.load()">Show Cart</button>
            </td>
        </tr>
    </tfoot>
</table>
</fieldset>
</div>
<?php $cart = $this->getCart(); $cartItems = $cart->getCartItems();?>
<div>
    <hr>
    <div>
        <table style="text-align: center;box-shadow: 1px 1px 10px 1px #888888" class="table table-sm table-striped">
            <tr class="table-info">
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
                <th><th><button type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('show','checkout',['flag' => 0 ]); ?>'); ajax.load()">Add Product</button></th></th>
            </tr>
        <?php if(!empty($cartItems)): ?>
            <?php foreach($cartItems as $item): ?>
                <tr>
                    <?php $product = $item->getProduct(); ?>
                    <td><?php echo $product->name ?></td>
                    <td><?php echo $product->price ?></td>
                    <td>
                        <input type="button" class="btn btn-outline-primary btn-sm" value="-" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['id' => $item->itemId,'flag' => 0 ]);?>').load()">
                            <?php echo $item->quantity ?>
                        <input type="button" class="btn btn-outline-primary btn-sm" value="+" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['id' => $item->itemId,'flag' => 1 ]);?>').load()">    
                    </td>
                    <td><?php echo $product->price*$item->quantity; ?></td>
                    <td><input class="btn btn-outline-danger btn-sm" type="button" value="x" onclick="ajax.setUrl('<?php echo $this->getUrl('remove','checkout',[ 'itemId' => $item->itemId ]) ?>').load()"></td>
                </tr>
            <?php endforeach; ?>
            <tr class="table-info">
                <th colspan="100%">Grand Total <?php echo $cart->total; ?></th>
            </tr>
        </table>
        <?php else: ?>
            <tr class="table-warning">
                <td align="center" colspan="100%"><h5>Empty Cart</h5></td>
            </tr>
        <?php endif; ?>    
        </table>
    </div>
</div>

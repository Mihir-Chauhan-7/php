<?php $cart = $this->getCart(); $cartItems = $cart->getCartItems();?>
<div style="padding: 10px">
<fieldset class="fieldset">
    <legend>Cart</legend>
    <table style="margin-top: 20px;text-align: center" class="table table-striped">
        <thead>
        <tr style="color: whitesmoke;background-color: #283593">
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th colspan="100%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($cartItems)): ?>
            <?php foreach($cartItems as $item): ?>
            <tr>
                <?php $product = $item->getProduct(); ?>
                <td><?php echo $product->name ?></td>
                <td>$<?php echo $product->price ?></td>
                <td>
                    <input type="button" class="btn btn-outline-secondary bp btn-sm" 
                        value="-" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','checkout',['productId' => $product->id ,'flag' => 0 ]);?>').load()">
                        <?php echo $item->quantity ?>
                    <input type="button" class="btn btn-outline-secondary bp btn-sm" 
                        value="+" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','checkout',['productId' => $product->id ,'flag' => 1 ]);?>').load()">    
                </td>
                <td>$<?php echo $product->price*$item->quantity; ?></td>
                <td colspan="100%">
                    <input class="btn btn-outline-secondary bp btn-sm"  type="button" 
                        value="x" onclick="ajax.setUrl('<?php echo $this->getUrl('remove','checkout',[ 'productId' => $product->id ]) ?>').load()"></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr style="color: whitesmoke;background-color: #283593">
                <th colspan="100%">Grand Total $<?php echo $cart->total; ?></th>
            </tr>
            <tr>
                <td colspan="100%" align="right">
                    <button class="btn btn-outline-secondary bp btn-sm" 
                        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('show','checkout',['flag' => 0 ]); ?>'); ajax.load()">Add Product</button>
                </td>
            </tr> 
        </tfoot>
    </table>
        <?php else: ?>
            <tr>
                <td align="center" colspan="100%"><h5>Empty Cart</h5></td>
            </tr>
        <?php endif; ?>    
    </table>
</fieldset>
</div>

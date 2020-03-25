<?php $cart = $this->getCart(); $cartItems = $cart->getCartItems();?>
<div>
    <div class="heading">
        <h4 style="float: left">My Cart</h4>
        <button style="margin-left: 138px" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('removeCart','category_index',[ 'id' => $cart->cartId]) ?>').load()">Clear Cart</button>
    </div>
    <hr>
    <div>
        <table border="1" width="100%">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        <?php if(!empty($cartItems)): ?>
            <?php foreach($cartItems as $item): ?>
                <tr>
                    <?php $product = $item->getProduct(); ?>
                    <td><?php echo $product->name ?></td>
                    <td><?php echo $product->price ?></td>
                    <td>
                        <input type="button" value="-" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['id' => $item->itemId,'flag' => 0 ]);?>').load()">
                            <?php echo $item->quantity ?>
                        <input type="button" value="+" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['id' => $item->itemId,'flag' => 1 ]);?>').load()">    
                    </td>
                    <td><?php echo $product->price*$item->quantity; ?></td>
                    <td><input type="button" value="x" onclick="ajax.setUrl('<?php echo $this->getUrl('remove','category_index',[ 'id' => $item->itemId ]) ?>').load()"></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="100%">Grand Total <?php echo $cart->total; ?></th>
            </tr>
        </table>
    <div>
    <button style="float: right" type="button">Checkout</button>
    </div>
        <?php else: ?>
            <tr>
                <td align="center" colspan="100%"><h5>Empty Cart</h5></td>
            </tr>
        <?php endif; ?>
            <tr>
                <td colspan="100%">
                    <div>
                        <select onchange="(changeCustomer(this,'<?php echo $this->getUrl('index','category_index')?>'))">
                            <?php foreach($this->getCustomers() as $key => $value): ?>
                            <option value="<?php echo $key; ?>" <?php echo $this->customerId == $key ? 'selected' : ''; ?> >
                                <?php echo $value; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </td>
            </tr>    
        </table>
    </div>
</div>

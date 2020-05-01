<?php $cart = $this->getCart(); $cartItems = $cart->getCartItems();?>
<div>
    <div class="heading">
        <h4 style="float: left">My Cart</h4>
        <button style="margin-left: 100px" class="btn btn-outline-secondary bp btn-sm" 
            type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('display','order',[ 'customerId' => $this->customerId]); ?>'); ajax.load()">Orders</button>
        <button class="btn btn-outline-secondary bp btn-sm" type="button" 
            onclick="ajax.setUrl('<?php echo $this->getUrl('removeCart','category_index',[ 'id' => $cart->cartId]) ?>').load()">Clear Cart</button>
    </div>
    <hr>
    <div class="table-responsive cart-table-div">
        <table class="table table-sm table-striped cart-table">
            <thead>
            <tr class="cart-table-th">
                <th>Name</th>
                <th>Price</th>
                <th style="width: 80px">Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
        <?php if(!empty($cartItems)): ?>
            <?php foreach($cartItems as $item): ?>
                <tr>
                    <?php $product = $item->getProduct(); ?>
                    <td>
                        <?php echo strlen($product->name) > 12 
                        ? substr($product->name,0,12).".." 
                        : $product->name ?>
                    </td>
                    <td>$<?php echo $product->price ?></td>
                    <td><div class="d-flex">
                        <input type="button" class="btn btn-outline-secondary bp btn-sm" 
                            value="-" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['productId' => $product->id,'flag' => 0 ]);?>').load()">
                            &nbsp;<?php echo $item->quantity ?>&nbsp;
                        <input type="button" class="btn btn-outline-secondary bp btn-sm" 
                            value="+" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['productId' => $product->id,'flag' => 1 ]);?>').load()">    
                        </div>
                    </td>
                    <td>$<?php echo $product->price*$item->quantity; ?></td>
                    <td>
                        <input type="button" class="btn btn-outline-secondary bp btn-sm" 
                            value="x" onclick="ajax.setUrl('<?php echo $this->getUrl('remove','category_index',[ 'productId' => $product->id ]) ?>').load()">
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="cart-table-th">
                <th colspan="100%">
                    Grand Total $<?php echo $cart->total; ?>
                </th>
            </tr>
        </table>
        <div style="margin-bottom: -20px; padding: 10px">
            <button style="float: right" class="btn btn-outline-secondary bp" 
                type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('index','checkout'); ?>').load()">Checkout</button>
        </div>
        <?php else: ?>
            <tr>
                <td align="center" colspan="100%"><h5>Empty Cart</h5></td>
            </tr>
        <?php endif; ?>
            <tr>
                <td colspan="100%">
                    <div style="padding: 10px">
                        <select class="customer-dropdown form-control col-6" onchange="(changeCustomer(this,'<?php echo $this->getUrl('index','category_index')?>'))">
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

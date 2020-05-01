<?php $orders = $this->getOrders(); ?>
<div class="container">
<fieldset style="margin-top: 20px" class="fieldset">
    <legend>
        <div class="heading">
            <h4 style="float: left">Your Orders</h4>
        </div>
    </legend>
<?php if(!empty($orders)): ?>
    <?php foreach($orders as $order): ?>
        <?php $items = $order->getOrderItems(); ?>
        <div class="card" style="margin-bottom: 20px;margin-left: 140px;box-shadow: 1px 1px 8px 1px #c4c5cc;margin-top: 20px;max-width: 55rem;">
            <div class="card-header bg-transparent border-info">
                <p class="float-left order-text">Order Id : <?php echo $order->orderId ?></p>
                <button class="btn btn-outline-secondary bp btn-sm float-right" type="button" onclick="ajax.setUrl(''); ajax.load()">Details</button>
            </div>
            <div>
                <span class="badge badge-primary float-right" style="margin: 10px">
                    <?php echo $order->getStatusLabel($order->status); ?>
                </span>
            </div>    
            <?php foreach($items as $item):?>
                <div class="card-body text-info">
                     <div style="float: left;margin-right: 20px">
                        <img class="img-thumbnail" style="float: left" height="150px" width="150px" src="<?php echo $item->getProduct()->getImage(); ?>">
                    </div>
                    <div >
                        <h5 class="card-title">
                            <?php echo $itemName = strlen($item->name) > 50 ?  substr($item->name,0,50).".." : $item->name; ?>
                        </h5>
                        <p class="card-text">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo $itemName."  x  ".$item->quantity." = $".($item->price*$item->quantity); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="card-footer bg-transparent border-info">
                    <div class="row">
                    <p class="order-text">Discount : $<?php echo $order->discount; ?>
                    <p class="order-text">Shipping Charges : $<?php echo $order->shippingAmount."  (".$order->getShippingMethod()
                        ->name.")";  ?></p>
                    <p class="order-text">Payment Method : <?php echo $order->getPaymentMethod()->name; ?></p>
                    <p class="order-text">Grand Total : $<?php echo (($order->total)-($order->discount))+$order->shippingAmount; ?></p>
                    </div>
                        
                </div>
                </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div>No Orders</div>
    <?php endif; ?>
</div>
</fieldset>
</div>
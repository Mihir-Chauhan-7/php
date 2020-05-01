<?php $details = $this->getCartDetails(); ?>
<div class="container">
<fieldset>
    <legend>Summary</legend>
    <?php if(!$details->total == 0): ?>
        <div class="order-summary d-flex">
            <div class="label-sum">Total :&nbsp;$</div><?php echo $details->total; ?>    
        </div>
        <div class="order-summary d-flex">
            <div class="label-sum">Shpping Charge : &nbsp;</div>
            <div>$<?php echo $details->getShipmentMethod()->amount ;?> (<?php echo $details->getShipmentMethod()->name ;?> Delivery)</div>
        </div> 
        <div class="order-summary d-flex">
            <button id="applyDiscount" name="applyDiscount" class="btn btn-outline-secondary bp btn-sm" 
                type="button" onclick="call('discount','<?php echo $this->getUrl('applyDiscount','checkout'); ?>');">Apply</button> 
            <div class="label-sum">&nbsp; &nbsp;Discount : &nbsp;</div>
                <div>
                    <input id="discount" type="text" 
                        value="<?php echo $details->discount; ?>">
                </div> 
        </div>
        <div class="order-summary d-flex">
            <div class="label-sum">Grand Total : &nbsp;$</div>
            <div style="font-size: larger">
                <?php echo (($details->total-$details->discount)+($details
                    ->getShipmentMethod()->amount)) ?> 
            </div>
        </div>
        <div>
            <div style="float:right">
                <button class="btn btn-outline-secondary bp" 
                type="button" onclick="orderForm.checkValidity() ? (shippingSubmit.click(), billingSubmit.click(), applyDiscount.click(), ajax.setForm('orderForm'), ajax.saveForm()) : orderForm.reportValidity();">Order Now</button>
            </div>
        </div>
</div>
    <?php else:?>
        <div class="order-summary">
            <button class="btn btn-outline-secondary bp" 
                onclick="ajax.setUrl('<?php echo $this->getUrl('index','category_index'); ?>'); ajax.load();">Back 
                To Home</button>
        </div>
    <?php endif ?>
</fieldset>
</div>
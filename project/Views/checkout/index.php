<div>
    <div id="customer"><?php echo $this->getChild('customer')->toHtml() ?></div>
    <div id="address"><?php echo $this->getChild('address')->toHtml() ?></div>
    <div>
        <div style="float:left" id="payment">
            <?php echo $this->getChild('paymentMethod')->toHtml() ?>
        </div>
        <div style="float:left" id="shipment">
            <?php echo $this->getChild('shipmentMethod')->toHtml() ?>
        </div>
    </div>
    
    <div id="products">Products</div>
    <div id="cartSummary">Cart Summary</div>
    <div id="details"></div>
</div>
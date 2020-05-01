<div class="container-fluid">
    <div id="customer">
        <?php echo $this->getChild('customer')->toHtml() ?>
    </div>
</div>
<hr>
<div class="container">
    <form id="orderForm" action="<?php echo $this->getUrl('add','order'); ?>" method="POST">
    <div id="address">
        <?php echo $this->getChild('address')->toHtml() ?>
    </div>
<hr>
    <div style="padding: 10px" class="d-flex">
        <div class="col-lg-6" id="payment">
            <?php echo $this->getChild('paymentMethod')->toHtml() ?>
        </div>
        <div class="col-lg-6" id="shipment">
            <?php echo $this->getChild('shipmentMethod')->toHtml() ?>
        </div>
    </div>
<hr>    
    <div>
        <div id="productCart">
            <?php echo $this->getChild('productCart')->toHtml() ?></div>
        </div>
    </div>
<hr>
    <div id="details"><?php echo $this->getChild('details')->toHtml() ?></div>
    </form>
</div>
<hr>
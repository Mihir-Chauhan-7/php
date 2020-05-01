<div class="menues">
    <button class="btn header-btn" type="button" name="viewCategory" onclick="ajax.setUrl('<?php echo $this->getUrl('index','category_index');?>'); ajax.load();">Home</button>
    <button class="btn header-btn" type="button" name="viewCategory" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','category');?>'); ajax.load();">Categories</button>
    <button class="btn header-btn" type="button" name="viewProduct" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','product');?>'); ajax.load();">Products</button>
    <button class="btn header-btn" type="button" name="viewCustomer" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','customer');?>'); ajax.load();">Customers</button>
    <button class="btn header-btn" type="button" name="viewCustomerGroup" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','customer_group');?>'); ajax.load();">Customer Groups</button>
    <button class="btn header-btn" type="button" name="viewOrders" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','order');?>'); ajax.load();">Orders</button>
    <button class="btn header-btn" type="button" name="viewPaymentMethod" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','payment_method');?>'); ajax.load();">Payment Methods</button>
    <button class="btn header-btn" type="button" name="viewShipmentMethod" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','shipment_method');?>'); ajax.load();">Shipment Methods</button>
</div> 
<table align="center" width=80% cellspacing="5" cellpadding="5">
    <tr align="center">
        <td><button class="btn header-btn" type="button" name="viewCategory" onclick="ajax.setUrl('<?php echo $this->getUrl('index','category_index');?>'); ajax.load();">Home</button></td>
        <td><button class="btn header-btn" type="button" name="viewCategory" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','category');?>'); ajax.load();">Manage Category</button></td>
        <td><button class="btn header-btn" type="button" name="viewProduct" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','product');?>'); ajax.load();">Manage Products</a></td>
        <td><button class="btn header-btn" type="button" name="viewCustomer" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','customer');?>'); ajax.load();">Manage Customers</a></td>
        <td><button class="btn header-btn" type="button" name="viewPaymentMethod" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','payment_method');?>'); ajax.load();">Manage Payment Method</a></td>
        <td><button class="btn header-btn" type="button" name="viewShipmentMethod" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','shipment_method');?>'); ajax.load();">Manage Shipment Method</a></td>
    </tr>
</table> 
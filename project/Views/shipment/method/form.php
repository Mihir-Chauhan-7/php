<?php $method = $this->getShipmentMethod(); ?>
    <form id="addShipmentMethod" action="<?php echo $this->getUrl('save',NULL,['id' => $method->id]) ?>" 
        method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr>
                <td colspan="2">
                    <h3>Shipment Method</h3>
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $method->name ?>">
            </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td><input type="text" name="amount" 
                    value="<?php echo $method->amount ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><input type="text" name="status" 
                    value="<?php echo $method->status ?>"></td>
            </tr>
            <tr>
                <td><button type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','shipment_method');?>'); ajax.load();">Back</button></td>
                <td><button type="button" onclick="ajax.setForm('addShipmentMethod'); ajax.saveForm();">Save</button></td>
            </tr>
        </table>
    </form>
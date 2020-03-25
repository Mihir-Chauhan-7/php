    <form id="deleteShipment" action="<?php echo $this->getUrl('delete')?>" method="POST">
            <table class="table-striped" width=100% cellspacing="10" cellpadding="15">
                <tr>
                    <td align="center" colspan="100%">
                        <h2>Shipment Method List</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="btn btn-outline-primary" type="button" onclick="ajax.setForm('deleteShipment'); ajax.saveForm()" value="Delete">
                    </td>
                    <td colspan="100%">
                        <button class="btn btn-outline-primary" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('add')?>'); ajax.load();">Add Shipment Method</button>
                    </td>
                </tr>
                <tr style="height: 60px">
                <th width="50px">
                    <input onclick="selectAll(this)" type="checkbox">All
                </th>
                <th>Id</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th colspan="2">Actions</th>
                <?php if(empty($methods= $this->getShipmentMethods())): ?>
                    <tr>
                        <td colspan="100%" align="center"><h3>No Records...</h3></td>
                    </tr>
                <?php else: ?>
                    <?php foreach($methods as $method): ?>
                    <tr>
                        <td><input type="checkbox" name="check[]" 
                                value="<?php echo $method->id; ?>">
                        </td>
                        <td><?php echo $method->id ?></td>
                        <td><?php echo $method->name ?></td>
                        <td><?php echo $method->amount ?></td>
                        <td class="<?php echo $method->status == 1 ? 'badge badge-success' : 'badge badge-danger'; ?>"><?php echo $this->shipmentMethodModel->getStatusLabel($method->status); ?></td>
                        <td>
                            <button class="btn btn-outline-success" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('edit',NULL,['id' => $method->id])?>'); ajax.load()">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-outline-danger" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('delete',NULL,['id' => $method->id])?>'); ajax.load()">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
        </table>
</form>
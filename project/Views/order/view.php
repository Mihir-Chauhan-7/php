<div class="container-fluid">
<div class="title">Orders</div>
<div>
    <input class="btn btn-outline-secondary bp" type="button" 
        onclick="ajax.setForm('deleteOrders'); ajax.saveForm();" 
        value="Delete">
    <button class="btn btn-outline-secondary bp" type="button"
        onclick="ajax.setUrl('<?php echo $this->getUrl('index','category_index')?>');
        ajax.load()">Add Order</button>
</div>
<?php $orders = $this->getOrders(); ?>
<form id="deleteOrders" action="<?php echo $this->getUrl('delete')?>" 
    method="POST">
    <table class="table-striped table-sm" width=100%>
        <thead>
            <tr>
                <th width="50px">
                    <input onclick="selectAll(this)" type="checkbox"> All
                </th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Discount</th>
                <th>Shipping Charges</th>
                <th>ShippingMethod</th>
                <th>PaymentMethod</th>
                <th>Status</th>
                <th>Total</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(empty($orders)): ?>
            <tr>
                <td colspan="100%" align="center">
                    <h3>No Records...</h3>
                </td>
            </tr>
        <?php else: ?>
            
            <?php foreach($orders as $row) :?>
            <tr>
                <td>
                    <input type="checkbox" name="check[]" 
                        value="<?php echo $row->orderId ?>">
                </td>
                <td><?php echo $row->orderId ?></td>
                <td><?php echo $row->firstName; ?></td>
                <td><?php echo $row->lastName; ?></td>
                <td><?php echo $row->email; ?></td>
                <td><?php echo $row->mobileNo; ?></td>
                <td><?php echo $row->discount; ?></td>
                <td><?php echo $row->shippingAmount; ?></td>
                <td><?php echo $row->getShippingMethod()->name; ?></td>
                <td><?php echo $row->getPaymentMethod()->name; ?></td>
                <td>
                    <span class="badge badge-primary">
                        <?php echo $row->getStatusLabel($row->status); ?>
                    </span>
                </td>
                <td><?php echo $row->total; ?></td>
                <td>
                    <button class="btn btn-outline-secondary bp btn-sm" 
                        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('edit',NULL,['orderId' => $row->orderId ]) ?>'); ajax.load()">Edit</button>
                </td>
                <td>
                    <button class="btn btn-outline-secondary bp btn-sm" 
                        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('delete',NULL,['orderId' => $row->orderId ]) ?>'); ajax.load()">Delete</button>
                </td>
            </tr>
            <?php endforeach ?>
            <?php endif; ?>
            <tr>
        </tr>
        </tbody>
    </table>
</form>
</div>
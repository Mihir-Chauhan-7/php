<div class="container-fluid">
<div class="title">Customers</div>
<div>
    <button class="btn btn-outline-secondary bp" 
        type="button" onclick="ajax.setForm('deleteCustomer'); ajax.saveForm();">Delete</button>    
    <button class="btn btn-outline-secondary bp" 
        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('add') ?>'); ajax.load()">Add Customer</button>
</div>
<form id="deleteCustomer" action="<?php echo $this->getUrl('delete')?>" method="POST">
    
        <table class="table-striped" width=100% cellspacing="10" cellpadding="15">
            <thead>
                <th>
                    <input onclick="selectAll(this)" type="checkbox"> All
                </th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Password</th>
                <th>Manage Address</th>
                <th>Manage Orders</th>
                <th colspan="2">Actions</th>
            </thead>
            <tbody>
            <?php if(empty($this->getCustomers())): ?>
                <tr>
                    <td colspan="100%" align="center"><h3>No Records...</h3></td>
                </tr>
            <?php else: ?>
                <?php foreach($this->getCustomers() as $row) :?>
                <tr>
                <td>
                    <input type="checkbox" name="check[]" value="<?php echo $row->customerId ?>">
                </td>
                    <td><?php echo $row->customerId ?></td>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->mobileNo ?></td>
                    <td><?php echo $row->password ?></td>
                    <td>
                        <button class="btn btn-outline-secondary bp btn-sm" 
                            type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','customer_address',['customerId' => $row->customerId]) ?>'); ajax.load()">Manage Address</button>
                    </td>
                    <td>
                        <button class="btn btn-outline-secondary bp btn-sm" 
                            type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('index','category_index',['cid' => $row->customerId]) ?>'); ajax.load()">Manage Order</button>
                    </td>
                    <td>
                        <button class="btn btn-outline-secondary bp btn-sm" 
                            type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('edit',NULL,['customerId' => $row->customerId]) ?>'); ajax.load()">Edit</button>
                    </td>
                    <td>
                        <button class="btn btn-outline-secondary bp btn-sm" 
                            type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('delete',NULL,['customerId' => $row->customerId]) ?>'); ajax.load()">Delete</button>
                    </td>
                </tr>
                <?php endforeach ?>
            <?php endif; ?>
            </tbody>
        </table>
</form>
</div>
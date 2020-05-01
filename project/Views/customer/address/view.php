<?php $customer = $this->getCustomer(); 
    $rows = $customer->getAddreses(); ?>
<div class="container-fluid">
<div class="title">Address</div>
<div>
    <button class="btn btn-outline-secondary bp btn-sm" 
        type="button" onclick="ajax.setForm('deleteAddress'); ajax.saveForm()">Delete</button>
    <button class="btn btn-outline-secondary bp btn-sm" 
        type="button" onclick="ajax.setForm('deleteAddress'); ajax.setUrl('<?php echo $this->getUrl('updateType', NULL, [ 'customerId' => $customer->customerId ])?>'); ajax.saveForm()">Update</button>
    <button class="btn btn-outline-secondary bp btn-sm" 
        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('add', NULL , [ 'customerId' => $customer->customerId ]) ?>'); ajax.load()">Add Address</button>
</div>
<form id="deleteAddress" action="<?php echo $this->getUrl('delete', NULL, [ 'customerId' => $customer->customerId ])?>" method="POST">
    <table class="table-striped" width=100% cellspacing="10" cellpadding="15">    
        <thead>
            </tr>
                <th>
                    <input onclick="selectAll(this)" type="checkbox"> All
                </th>
                <th>Shipping</th>
                <th>Billing</th>
                <th>Id</th>
                <th>Line 1</th>
                <th>Line 2</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Code</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if(empty($rows)): ?>
            <tr>
                <td colspan="100%" align="center">
                    <h3>No Records...</h3>
                </td>
            </tr>
        <?php else: ?>
            <?php foreach($rows as $row): ?>
            <tr>
                <td>
                    <input type="checkbox" name="check[]" value="<?php echo $row->addressId ?>">
                </td>
                <td>
                    <input type="radio" name="address[shipping]" 
                        value="<?php echo $row->addressId; ?>" 
                        <?php echo $row->type == 1 
                            ? 'checked' 
                            : ''; 
                        ?>>
                </td>
                <td>
                    <input type="radio" name="address[billing]" 
                        value="<?php echo $row->addressId; ?>" 
                        <?php echo $row->type == 0 
                            ? 'checked' 
                            : ''; 
                        ?>>
                </td>
                <td><?php echo $row->addressId ?></td>
                <td><?php echo $row->line1 ?></td>
                <td><?php echo $row->line2 ?></td>
                <td><?php echo $row->city ?></td>
                <td><?php echo $row->state ?></td>
                <td><?php echo $row->country ?></td>
                <td><?php echo $row->code ?></td>
                <td>
                    <button class="btn btn-outline-secondary bp btn-s" 
                        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('edit',NULL,['addressId' => $row->addressId ]); ?>').load();">Edit</button>
                </td>
                <td>
                    <button class="btn btn-outline-secondary bp btn-s" 
                        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('delete',NULL,['addressId' => $row->addressId , 'customerId' => $customer->customerId ]); ?>').load();">Delete</button>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif; ?>
        </tbody>
    </table>
</form>
</div>
<form id="deleteCustomer" action="<?php echo $this->getUrl('delete')?>" method="POST">
            <table class="table-striped" width=100% cellspacing="10" cellpadding="15">
                    <td colspan="100%" align="center">
                        <h2>Customer List</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="btn btn-outline-primary" type="button" onclick="ajax.setForm('deleteCustomer'); ajax.saveForm();" value="Delete">
                    </td>
                    <td colspan="100%">
                        <button class="btn btn-outline-primary" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('add')?>'); ajax.load()">Add Customer</button>
                    </td>
                </tr>
                <tr style="height: 60px">
                <th>
                    <input onclick="selectAll(this)" type="checkbox">
                </th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Manage Address</th>
                <th colspan="2">Actions</th>
                <?php if(empty($this->getCustomers())): ?>
                    <tr>
                        <td colspan="100%" align="center"><h3>No Records...</h3></td>
                    </tr>
                <?php else: ?>
                    <?php foreach($this->getCustomers() as $row) :?>
                    <tr>
                    <td>
                        <input type="checkbox" name="check[]" value="<?php echo $row->id ?>">
                    </td>
                        <td><?php echo $row->id ?></td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->email ?></td>
                        <td><?php echo $row->password ?></td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','customer_address',['cid' => $row->id]) ?>'); ajax.load()">Manage Address</button>
                        </td>
                        <td>
                            <button class="btn btn-outline-success btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('edit',NULL,['id' => $row->id]) ?>'); ajax.load()">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-outline-danger btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('delete',NULL,['id' => $row->id]) ?>'); ajax.load()">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php endif; ?>
        
        </table>
        </form>
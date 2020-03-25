<?php $rows = $this->getAddreses(); ?>
<form action="<?php echo $this->getUrl('delete',NULL,[ 'cid' => $this->customerModel->id ])?>" method="POST">
    <table border="1" width="100%" cellspacing="4" cellpadding="4">    
            <tr>
                <td colspan="100%" align="center">
                    <h2>Address List</h2>
                </td>
            </tr>
            <tr>
                <td colspan="100%">
                    <a href="<?php echo $this->getUrl('add',NULL,[ 'cid' => $this->customerModel->id ])?>">Add Address</a>
                </td>
            </tr>
            <th>
                <input onclick="selectAll(this)" type="checkbox">
            </th>
            <th>Id</th>
            <th>Address Line 1</th>
            <th>Address Line 2</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Code</th>
            <th colspan="2">Actions</th>
        </tr>
    <?php if(empty($rows)): ?>
        <tr><td colspan="100%" align="center"><h3>No Records...</h3></td></tr>
    <?php else: ?>
        <?php foreach($rows as $row):?>
            <tr>
                <td>
                    <input type="checkbox" name="check[]" value="<?php echo $row->id ?>">
                </td>
                <td><?php echo $row->id ?></td>
                <td><?php echo $row->line1 ?></td>
                <td><?php echo $row->line2 ?></td>
                <td><?php echo $row->city ?></td>
                <td><?php echo $row->state ?></td>
                <td><?php echo $row->country ?></td>
                <td><?php echo $row->code ?></td>
                <td><a href="<?php echo $this->getUrl('edit',NULL,['id' => $row->id , 'cid' => $row->cid ]); ?>">Edit</a></td>
                <td><a href="<?php echo $this->getUrl('delete',NULL,['id' => $row->id , 'cid' => $row->cid ]); ?>">Delete</a></td>
            </tr>
        <?php endforeach;?>
    <?php endif; ?>
            <tr>
                <td colspan="8">
                    <input type="submit" value="Delete">
                </td>
            </tr>
    </table>
</form>
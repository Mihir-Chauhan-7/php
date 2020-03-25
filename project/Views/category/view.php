<form id="deleteCategories" action="<?php echo $this->getUrl('delete')?>" 
    method="POST">
    <table class="table-striped" width=100% cellspacing="10" 
        cellpadding="12">
        <tr>
            <td align="center" colspan="100%">
                <h2>Category List</h2>
            </td>
        </tr>
        <tr>
            <td>
                <input class="btn btn-outline-primary" type="button" 
                    onclick="ajax.setForm('deleteCategories'); 
                    ajax.saveForm();" value="Delete">
            </td>
            <td colspan="100%">  
                <button type="button" class="btn btn-outline-primary"
                onclick="ajax.setUrl('<?php echo $this->getUrl('add')?>');
                ajax.load()">Add Category</button>
            </td>
        </tr>
        <tr style="height: 60px">
        <th width="50px">
            <input onclick="selectAll(this)" type="checkbox">All
        </th>
        <th>ID</th>
        <th>Status</th>
        <th>Path</th>
        <th>Level</th>
        <th>Parent ID</th>
        <th colspan="2">Actions</th>
        </tr>
        <?php if(empty($this->getCategories())): ?>
            <tr>
                <td colspan="100%" align="center">
                    <h3>No Records...</h3>
                </td>
            </tr>
        <?php else: ?>
            
            <?php foreach($this->getCategories() as $row) :?>
            <tr>
                <td>
                    <input type="checkbox" name="check[]" 
                        value="<?php echo $row->id ?>">
                </td>
                <td><?php echo $row->id ?></td>
                <td class="<?php echo $row->status == 1 
                    ? 'badge badge-success' 
                    : 'badge badge-danger'; ?>">
                    <?php echo $this
                                    ->add
                                    ->categoryModel
                                    ->getStatusLabel($row->status); ?>
                </td>
                <td><?php echo $this->add->getCategories($row->path) ?></td>
                <td><?php echo $row->level ?></td>
                <td class="<?php echo $row->parent_id > 0 
                    ? 'badge badge-info' 
                    : 'badge badge-secondary'; ?>">
                    <?php echo $row->parent_id != 0 
                        ? $this->getParentName($row->parent_id) 
                        : 'No Parent' ?>
                </td>
                <td>
                    <button class="btn btn-outline-success btn-sm" 
                        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('edit',NULL,['id' => $row->id ]) ?>'); ajax.load()">Edit</button>
                </td>
                <td>
                    <button class="btn btn-outline-danger btn-sm" 
                        type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('delete',NULL,['id' => $row->id ]) ?>'); ajax.load()">Delete</button>
                </td>
            </tr>
            <?php endforeach ?>
            <?php endif; ?>
            <tr>
        </tr>
    </table>
</form>

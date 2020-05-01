<?php 

$columns = $this->getColumns(); 
$actions = $this->getActions();
$rows = $this->getCollection(); 
?>
<div style="margin-top: 10px" class="title">
    <?php echo $this->getTitle(); ?>
</div>
<?php if(key_exists('massDelete',$columns)): ?>
    <form id="deleteForm" method="POST" 
        action="<?php echo $this->getUrl('delete'); ?>">
    <button class="btn btn-outline-secondary bp btn-sm" 
        type="button" onclick="ajax.setForm('deleteForm'); ajax.saveForm()">
        Delete
    </button>
<?php endif; ?>
<button class="btn btn-outline-secondary bp btn-sm" type="button" 
    onclick="ajax.setUrl('<?php echo $this->getAddUrl(); ?>'); ajax.load()">Add</button>
<!-- <button class="btn btn-outline-secondary bp btn-sm" 
    type="button" onclick="ajax.setUrl('<?php //echo $this->getUrl('add'); ?>'); ajax.load()">Add</button> -->

<table class="table-striped" width=100% cellspacing="10" cellpadding="15">
    <thead>
        <tr>
            <?php foreach($columns as $column): ?>
                <th><?php echo $column['label']; ?></th>
            <?php endforeach; ?>
            <?php foreach($actions as $action): ?>
                <th><?php echo $action['label']; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as  $row): ?>
        <tr>
            <?php foreach($columns as  $column): ?>
            
            <td>
                <?php if(key_exists('method',$column)): ?>
                    <?php echo $this->{$column['method']}($row); ?>
                <?php else: ?>
                    <?php echo $row->{$column['column']}; ?>
                <?php endif; ?>                
            </td>
            <?php endforeach; ?>
            <?php foreach($actions as  $action): ?>
            <td>
                <button class="btn btn-outline-secondary bp btn-sm" type="button" onclick="ajax.setUrl('<?php echo $this->{$action['method']}($row); ?>'); ajax.load()">
                    <?php echo $action['label']; ?>
                </button>                
            </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if(key_exists('massDelete',$columns)): ?>
</form>
<?php endif; ?>
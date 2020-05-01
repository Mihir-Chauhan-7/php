<div class="card-page">
<div class="card border-secondary mb-3" style="width: 30rem">
    <form id="addForm" action="<?php echo $this
            ->getUrl('save',NULL,[ $this->object->getPrimaryKey() => $this->object->getData($this->object->getPrimaryKey()) ]) ?>" method="POST">
        <div class="card-header">
            <div class="title-card"><?php $this->getTitle(); ?></div>
        </div>
        <div class="card-body text-info">
            <?php foreach($this->getFormFields() as $name => $field): ?>
                <div class="form-group">
                    <label>
                        <?php echo $field['label']; ?>
                    </label>
                    <?php echo $this->getField($name,$field); ?>
                </div>
            <?php endforeach; ?>
            <div class="form-group">
                <button class="btn btn-outline-secondary bp" 
                    type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid');?>'); ajax.load();">Back</button>
        
                <button class="btn btn-outline-secondary bp" 
                    type="button" onclick="addForm.checkValidity() ? (ajax.setForm('addForm'), ajax.saveForm()) : addForm.reportValidity();">Save</button>
            </div>
        </div>
    </form>
</div>
</div>
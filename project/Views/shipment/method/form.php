<?php $method = $this->getShipmentMethod(); ?>
<form id="addShipmentMethod" action="<?php echo $this->getUrl('save',NULL,['id' => $method->id]) ?>" 
    method="POST">
    <div class="card-page">
    <div class="card border-secondary mb-3" style="width: 30rem">
        <div class="card-header">
            <div class="title-card">Shipment Method</div>
        </div>
        <div class="card-body text-info">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" 
                    value="<?php echo $method->name ?>" required>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input class="form-control" type="text" name="amount" 
                    value="<?php echo $method->amount ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <?php foreach($method->getStatusOptions() as $key => $value): ?>
                        <option value="<?php echo $key ?>" 
                            <?php echo $method->status == $key 
                                ? 'selected' 
                                : '' ?>>

                                <?php echo $value ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-outline-secondary bp" 
                    type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','shipment_method');?>'); ajax.load();">Back</button>
                <button class="btn btn-outline-secondary bp" 
                    type="button" onclick="addShipmentMethod.checkValidity() ? (ajax.setForm('addShipmentMethod'), ajax.saveForm()) : addShipmentMethod.reportValidity(); ">Save</button>
            </div>
        </div>
    </div>
    </div>
</form>
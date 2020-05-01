<?php $address = $this->getAddress(); ?>
<form id="addressForm" method="POST" action="<?php echo $this->getUrl('save',NULL,['customerId' => $address->customerId, 'addressId' => $address->addressId ]) ?>">
    <div class="card-page">
    <div class="card border-secondary mb-3" style="width: 30rem">
        <div class="card-header">
            <div class="title-card">Address</div>
        </div>
        <div class="card-body text-info">
            <div class="form-group">
                <label>Line 1</label>
                <input class="form-control" type="text" name="line1" 
                    value="<?php echo $address->line1 ?>" required>
            </div>
            <div class="form-group">
                <label>Line 2</label>
                <input class="form-control" type="text" name="line2" 
                    value="<?php echo $address->line2 ?>">
            </div>
            <div class="form-group">
                <label>City</label>
                <input class="form-control" type="text" name="city" 
                    value="<?php echo $address->city ?>" required>
            </div>
            <div class="form-group">
                <label>State</label>
                <input class="form-control" type="text" name="state" 
                    value="<?php echo $address->state ?>" required>
            </div>
            <div class="form-group">
                <label>Country</label>
                <input class="form-control" type="text" name="country" 
                    value="<?php echo $address->country ?>" required>
            </div>
            <div class="form-group">
                <label>Zip Code</label>
                <input class="form-control" type="text" name="code" 
                    value="<?php echo $address->code ?>" required>
            </div>
            <div class="form-group">
                <button class="btn btn-outline-secondary bp" 
                    type="button" onclick="addressForm.checkValidity() ? (ajax.setForm('addressForm'), ajax.saveForm()) : addressForm.reportValidity(); ">Save</button>
            </div>
        </div>
    </div>
    </div>
</form>
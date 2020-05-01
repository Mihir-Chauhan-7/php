<?php $customer = $this->getCustomer();?>
<div class="card-page">
<div class="card border-secondary mb-3" style="width: 30rem">
<form id="addCustomer" action="<?php echo $this->getUrl('save',NULL,['customerId' => $customer->customerId]) ?>" method="POST">
    <div class="card-header">
        <div class="title-card">Customer</div>
    </div>
    <div class="card-body text-info">
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" type="text" name="name" 
                    value="<?php echo $customer->name ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="email" 
                    value="<?php echo $customer->email ?>" required>
        </div>
        <div class="form-group">
            <label>Mobile No</label>
            <input class="form-control" type="text" name="mobileNo" 
                    value="<?php echo $customer->mobileNo ?>" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="text" name="password" 
                    value="<?php echo $customer->password ?>" required>
        </div>
        <div class="form-group">
            <button class="btn btn-outline-secondary bp" 
                type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','customer');?>'); ajax.load();">Back</button>
            <button class="btn btn-outline-secondary bp" 
                type="button" onclick="addCustomer.checkValidity() ? (ajax.setForm('addCustomer'), ajax.saveForm()) : addCustomer.reportValidity();">Save</button>
        </div>
    </div>    
</form>
</div>
</div>
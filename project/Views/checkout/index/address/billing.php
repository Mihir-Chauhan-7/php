<?php $address = $this->getAddress(0); ?>
    
<fieldset>
<legend>Billing Address</legend>
    <div class="form-group">  
        <input name="billing[line1]" type="text" placeholder="Address Line 1" class="form-control input-md" required value="<?php echo $address->line1; ?>">
    </div>

    <div class="form-group">  
        <input name="billing[line2]" type="text" placeholder="Address Line 2" class="form-control input-md" required value="<?php echo $address->line2; ?>">
    </div>

    <div class="form-group"> 
        <input name="billing[city]" type="text" placeholder="City" class="form-control input-md" required value="<?php echo $address->city; ?>">
    </div>

    <div class="form-group">  
        <input name="billing[state]" type="text" placeholder="State" class="form-control input-md" required value="<?php echo $address->state; ?>">
    </div>

    <div class="form-group">
        <input name="billing[country]" type="text" placeholder="Country" class="form-control input-md" required value="<?php echo $address->country; ?>">
    </div>

    <div class="form-group"> 
        <input name="billing[code]" type="text" placeholder="Zip Code" class="form-control input-md" required value="<?php echo $address->code; ?>"> 
    </div>

    <div class="form-group">
        <button id="billingSubmit" type="button" onclick="ajax.setForm('orderForm'); ajax.setUrl('<?php echo $this->getUrl('updateAddress','checkout',['type' => 0 ]) ?>'); ajax.load()">Update</button>
    </div>

</fieldset>



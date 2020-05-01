<?php $address = $this->getAddress(1); ?>
<fieldset>

<legend>Shipping Address</legend>
<div class="form-group">  
    <input  name="shipping[line1]" type="text" placeholder="Address Line 1" class="form-control input-md" required="" value="<?php echo $address->line1; ?>">
</div>

<div class="form-group">  
    <input name="shipping[line2]" type="text" placeholder="Address Line 2" class="form-control input-md" required="" value="<?php echo $address->line2; ?>">
</div>

<div class="form-group"> 
    <input name="shipping[city]" type="text" placeholder="City" class="form-control input-md" required="" value="<?php echo $address->city; ?>">
</div>

<div class="form-group">  
    <input name="shipping[state]" type="text" placeholder="State" class="form-control input-md" required="" value="<?php echo $address->state; ?>">
</div>
<div class="form-group"> 
    <input name="shipping[country]" type="text" placeholder="Country" class="form-control input-md" required="" value="<?php echo $address->country; ?>">
</div>

<div class="form-group"> 
    <input name="shipping[code]" type="text" placeholder="Zip Code" class="form-control input-md" required="" value="<?php echo $address->code; ?>">    
</div>
<div class="form-group"> 
    <button id="shippingSubmit" class="btn btn-outline-secondary bp btn-sm" 
        type="button" onclick="ajax.setForm('orderForm'); ajax.setUrl('<?php echo $this->getUrl('updateAddress','checkout',['type' => 1 ]) ?>'); ajax.saveForm()">Update</button>
</div>
</fieldset>



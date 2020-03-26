<?php $address = $this->getAddress(0); ?>

<form class="form-horizontal">
<fieldset>

<legend>Billing Address</legend>

<div class="form-group">  
  <div class="col-md-5">
    <input id="line1" name="line1" type="text" placeholder="Address Line 1" class="form-control input-md" required="" value="<?php echo $address->line1; ?>">
  </div>
</div>

<div class="form-group">  
  <div class="col-md-5">
    <input id="line2" name="line2" type="text" placeholder="Address Line 2" class="form-control input-md" required="" value="<?php echo $address->line2; ?>">
  </div>
</div>

<div class="form-group"> 
  <div class="col-md-5">
  <input id="city" name="city" type="text" placeholder="City" class="form-control input-md" required="" value="<?php echo $address->city; ?>">
    
  </div>
</div>

<div class="form-group">  
  <div class="col-md-5">
  <input id="state" name="state" type="text" placeholder="State" class="form-control input-md" required="" value="<?php echo $address->state; ?>">
    
  </div>
</div>
<div class="form-group"> 
  <div class="col-md-5">
  <input id="country" name="country" type="text" placeholder="Country" class="form-control input-md" required="" value="<?php echo $address->country; ?>">
    
  </div>
</div>

<div class="form-group"> 
  <div class="col-md-4">
  <input id="code" name="code" type="text" placeholder="Zip Code" class="form-control input-md" required="" value="<?php echo $address->code; ?>">
    
  </div>
</div>

</fieldset>
</form>



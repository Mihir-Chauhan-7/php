<?php $selected = $this->getSelected(); ?>
<fieldset>
    <legend>Shipping Method</legend>
    <?php foreach($this->getShipmentMethods() as $method):?>
        <div>
            <input id="
            method<?php echo $method->id ?>" type="radio" 
                name="ShippingMethodId" onchange="ajax.setUrl('<?php echo $this->getUrl('updateMethod','checkout',[ 'id' => $method->id , 'flag' => 0 ]) ?>').load()" value="<?php echo $method->id; ?>" <?php echo $selected == $method->id ? 'checked' : '' ?> class="require">
            <label for="method<?php echo $method->id ?>">
                <?php echo $method->name; ?>
            </label>
        </div>
    <?php endforeach; ?>
</fieldset>
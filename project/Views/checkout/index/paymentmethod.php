<?php $selected = $this->getSelected(); ?>
<fieldset>
    <legend>Payment Method</legend>
    <?php foreach($this->getPaymentMethods() as $method):?>
    <div>
        <input id="method<?php echo $method->methodId; ?>" onchange="ajax.setUrl('<?php echo $this->getUrl('updateMethod','checkout',[ 'id' => $method->methodId ,'flag' => 1 ]) ?>').load()" type="radio" 
            name="PaymentMethodId" value="<?php echo $method->methodId; ?>" <?php echo $selected == $method->methodId ? 'checked' : '' ?>>
        <label for="method<?php echo $method->methodId; ?>">
            <?php echo $method->name; ?>
        </label>
    </div>
    <?php endforeach; ?>
</fieldset>
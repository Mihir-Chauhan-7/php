<select name="methodId">
<?php foreach($this->getPaymentMethods() as $method):?>
    <option value="<?php echo $method->methodId; ?>">
        <?php echo $method->name; ?>    
    </option>
<?php endforeach; ?>
</select>
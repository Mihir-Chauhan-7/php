<select name="methodId">
<?php foreach($this->getShipmentMethods() as $method):?>
    <option value="<?php echo $method->id; ?>">
        <?php echo $method->name; ?>    
    </option>
<?php endforeach; ?>
</select>
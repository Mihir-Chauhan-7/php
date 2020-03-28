<?php $details = $this->getCartDetails(); ?>

<table>
<?php if(!$details->total == 0): ?>
        <tr>
            <td>Total : <?php echo $details->total; ?></td>    
        </tr>
        <tr>
            <td>Shpping Charge : <?php echo $details->getShipmentMethod()->amount ;?> (<?php echo $details->getShipmentMethod()->name ;?> Delivery)</td>
        </tr> 
        <tr>
            <td>
                <button type="button" onclick="call('discount','<?php echo $this->getUrl('applyDiscount','checkout'); ?>');">Apply</button> 
               <td> Discount : <input id="discount" type="text" value="<?php echo $details->discount; ?>"></td>
            </td>
        </tr>
            <td>Grand Total : <?php echo (($details->total-$details->discount)+($details->getShipmentMethod()->amount)) ?></td>
            <td><button type="button" onclick="orderForm.checkValidity() ? (shippingSubmit.click(), billingSubmit.click(), ajax.setForm('orderForm'), ajax.saveForm()) : orderForm.reportValidity();">Order Now</button></td>           
        </tr>
                  
<?php else:?>

<?php endif ?>
</table>

<?php $address = $this->getAddress();?>
    <form action="<?php echo $this->getUrl('save',NULL,['id' => $address->id ,'cid' => $address->cid ]) ?>" 
        method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr>
                <td colspan="100%">
                    <h3>Address</h3>
                </td>
            </tr>
            <tr>
            <td>Address Line 1</td>
                <td><input type="text" name="line1" 
                    value="<?php echo $address->line1 ?>">
                </td>
            </tr>
            <tr>
                <td>Address Line 2</td>
                <td><input type="text" name="line2" 
                    value="<?php echo $address->line2 ?>">
                </td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="city" 
                    value="<?php echo $address->city ?>">
                </td>
            </tr>
            <tr>
                <td>State</td>
                <td><input type="text" name="state" 
                    value="<?php echo $address->state ?>">
                </td>
            </tr>
            <tr>
                <td>Country</td>
                <td><input type="text" name="country" 
                    value="<?php echo $address->country ?>">
                </td>
            </tr>
            <tr>
                <td>Zip Code</td>
                <td><input type="text" name="code" 
                    value="<?php echo $address->code ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Save"></td>
            </tr>
        </table>
    </form>
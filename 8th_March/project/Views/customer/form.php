<!DOCTYPE html>
<html>
    <title>Customer</title>
    <body>
    <form action="<?php echo $this->getUrl('save') ?>" method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr>
            <?php $customer = $this->getCustomer();
                  $address = $this->getAddress();
            ?>
                <td colspan="2">
                    <h3>Customer</h3>
                </td>
            </tr>
            <input type="hidden" name="customer[id]" 
                value="<?php echo $customer->id ?>">
            <tr>
                <td>Name</td>
                <td><input type="text" name="customer[name]" 
                    value="<?php echo $customer->name ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="customer[email]" 
                    value="<?php echo $customer->email ?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="customer[password]" 
                    value="<?php echo $customer->password ?>"></td>
            </tr>
            <tr>
                <td>Address Line 1</td>
                <td><input type="text" name="address[line1]" 
                    value="<?php echo $address->line1 ?>"></td>
            </tr>
            <tr>
                <td>Address Line 2</td>
                <td><input type="text" name="address[line2]" 
                    value="<?php echo $address->line2 ?>"></td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="address[city]" 
                    value="<?php echo $address->city ?>"></td>
            </tr>
            <tr>
                <td>State</td>
                <td><input type="text" name="address[state]" 
                    value="<?php echo $address->state ?>"></td>
            </tr>
            <tr>
                <td>Country</td>
                <td><input type="text" name="address[country]" 
                    value="<?php echo $address->country ?>"></td>
            </tr>
            <tr>
                <td>Zip Code</td>
                <td><input type="text" name="address[code]" 
                    value="<?php echo $address->code ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Save"></td>
            </tr>  
        </table>
    </form>
    </body>
</html>
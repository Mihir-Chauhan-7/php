<!DOCTYPE html>
<html>
    <title>Customer</title>
    <body>
    <form action="<?php echo $this->getUrl('save') ?>" method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr>
            <?php $customer = $this->getCustomer(); ?>
                <td colspan="2">
                    <h3><?php echo $this->action; ?> Customer</h3>
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
                <td>Address</td>
                <td><input type="text" name="address[line1]" 
                    value="<?php echo $customer->line1 ?>"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type="text" name="address[line2]" 
                    value="<?php echo $customer->line2 ?>"></td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="address[city]" 
                    value="<?php echo $customer->city ?>"></td>
            </tr>
            <tr>
                <td>State</td>
                <td><input type="text" name="address[state]" 
                    value="<?php echo $customer->state ?>"></td>
            </tr>
            <tr>
                <td>Country</td>
                <td><input type="text" name="address[country]" 
                    value="<?php echo $customer->country ?>"></td>
            </tr>
            <tr>
                <td>Zip Code</td>
                <td><input type="text" name="address[code]" 
                    value="<?php echo $customer->code ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="<?php echo $this->action; ?>"></td>
            </tr>  
        </table>
    </form>
    </body>
</html>
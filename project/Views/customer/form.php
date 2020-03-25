<?php $customer = $this->getCustomer();?>
<form id="addCustomer" action="<?php echo $this->getUrl('save',NULL,['id' => $customer->id]) ?>" method="POST">
        <table border="1" width=100% cellspacing="4">
            <tr>
                <td colspan="2">
                    <h3>Customer</h3>
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" 
                    value="<?php echo $customer->name ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" 
                    value="<?php echo $customer->email ?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="password" 
                    value="<?php echo $customer->password ?>"></td>
            </tr>
            <tr>
                <td><button type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','customer');?>'); ajax.load();">Back</button></td>
                <td><button type="button" onclick="ajax.setForm('addCustomer'); ajax.saveForm();">Save</button></td>
            </tr> 
        </table>
    </form>
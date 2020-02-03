<!DOCTYPE html>
<html>
<head>
    <title>Update Form</title>
</head>
<body>
        <?php require_once 'data.php';
        global $customerId;
        
        if(isset($_GET['Submit']))
        {
                updateData($_GET);
        }
        else
        {
            isset($_GET['id']) && !empty($_GET['id'])? $customerId=$_GET['id'] : die("Customer Not Found");
        }
    ?>
<form method="GET">
<fieldset>
    <legend>Personal Information</legend>
    <?php $prefix = ['Mr','Miss','Mrs','Dr']; ?>
    <select name="account[prefix]">
        <?php foreach($prefix as $value) : ?>
        <?php $selected = $value == getValue('account','prefix',$customerId) 
        ? 'selected'
        : ''; ?>
        <option value="<?php echo $value ?>" <?php echo $selected; ?>>
        <?php echo $value ?>
        </option>
            <?php endforeach; ?>
    </select>

        <input type="hidden" name="customerId" value="<?php echo $customerId ?>">
        <input type="text" name="account[fname]" placeholder="First Name" 
                value="<?php echo getValue('account','fname',$customerId); ?>" required><br><br>
        <input type="text" name="account[lname]" placeholder="Last Name" 
                value="<?php echo getValue('account','lname',$customerId); ?>" required><br><br>
        <input type="date" name="account[dob]" 
                value="<?php echo getValue('account','dob',$customerId); ?>"><br><br>
        <input type="text" name="account[phone]" placeholder="Phone No" 
                value="<?php echo getValue('account','phone',$customerId); ?>" required>
                <br><br>
        <input type="text" name="account[email]" placeholder="Email"
                value="<?php echo getValue('account','email',$customerId); ?>" required>
                <br><br>
        <input type="password" name="account[password]" placeholder="Password"
                value="<?php echo getValue('account','password',$customerId); ?>" required><br><br>
</fieldset>
<fieldset>
    <legend>Address Information</legend>
        <input type='text' name='address[addressline1]' placeholder='Address Line 1' 
                value="<?php echo getValue('address','addressline1',$customerId); ?>" required>
                
                <br><br>
        <input type='text' name='address[addressline2]' placeholder='Address Line 2' 
                value="<?php echo getValue('address','addressline2',$customerId); ?>" required>
                
                <br><br>
        <input type='text' name='address[companyname]' placeholder='Company Name' 
                value="<?php echo getValue('address','companyname',$customerId); ?>"><br><br>
        <input type='text' name='address[city]' placeholder='City' 
                value="<?php echo getValue('address','city',$customerId); ?>"><br><br>
            
        <?php $countryArray = ['India','Sri-Lanka','China']; ?>
    <select name="address[country]" required>
        <?php foreach($countryArray as $value) : ?>
            <?php $selected = $value == getValue('address','country',$customerId) 
            ? 'selected' 
            : ''; ?>
            <option value="<?php echo $value ?>" <?php echo $selected ?>>
                <?php echo $value ?>
            </option>
        <?php endforeach; ?>

    </select><br><br>    
        <input type='text' name='address[postalcode]' placeholder='Postal Code' 
                value="<?php echo getValue('address','postalcode',$customerId); ?>" required>
                <br><br>
</fieldset>
            
<fieldset>
    <legend>Other Information</legend>
        <div id="otherInfo">
        <textarea placeholder='Describe Yourself' name='other[aboutself]' 
        required><?php echo getValue('other','aboutself',$customerId); ?>
        </textarea><br><br>    
        
        <label>Image </label><input type='file' name='other[image]'><br><br>
        <label>Certificate </label><input type='file' name='other[certificate]'><br><br>
        
        <label>No of Years in Business </label>
        <?php $years = ['Under 1','1 to 2','2 to 5','5 to 10','Over 10'];
        
        ?>
            <?php foreach($years as $value) : ?>
               
                <?php $result = $value == getValue('other','businessyears',$customerId) 
                ? 'checked' 
                : ''; ?>
                <input type='radio' name='other[businessyears]' 
                        value='<?php echo $value; ?>' <?php echo $result; ?>><?php echo $value; ?>
            <?php endforeach; ?><br><br>
        <label>How Do You Like Us To Get in Touch with You ? </label>
        <?php $contactTypes = ['Post','Email','SMS','Phone'] ?>
        <?php foreach($contactTypes as $value) : ?>
            <?php $result = in_array($value,getValue('other','contactType',$customerId)) 
            ? 'checked' 
            : ''; ?>
            <input type="checkbox" name="other[contactType][]" 
                    value="<?php echo $value ?>" <?php echo $result ?>><?php echo $value ?>
            <?php endforeach; ?><br><br>

        <?php $hobbies=['Listening Music','Reading','Dancing']; ?>
        <label>Hobbies</label>    
        <select name="other[hobbies][]" multiple>
        		<?php foreach($hobbies as $value) : ?>
        		<?php $selected = in_array($value, getValue('other','hobbies',$customerId))  
        		? 'selected'
        		: ''; ?>
        		<option value="<?php echo $value ?>" <?php echo $selected; ?>>
        			<?php echo $value ?>
        		</option>
            	<?php endforeach; ?>
    		</select><br><br>
        </div>
</fieldset>
            <input type="submit" name="Submit" value="Update">
</form>
</body>
</html>
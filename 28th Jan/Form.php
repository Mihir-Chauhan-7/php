<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
    <?php require_once 'Form_Data.php'; 
        echo "GET <pre>";
        print_r($_GET);
        echo "</pre>";
    ?>
<form method="GET">
<fieldset>
    <legend>Personal Information</legend>
    <?php $prefix = ['Mr','Miss','Mrs','Dr']; ?>
    <select name="account[prefix]">
        <?php foreach($prefix as $value) : ?>
        <?php $selected = $value == getValue('account','prefix') 
        ? 'selected'
        : ''; ?>
        <option value="<?php echo $value ?>" <?php echo $selected; ?>>
        <?php echo $value ?>
        </option>
            <?php endforeach; ?>
    </select>

        <input type="text" name="account[fname]" placeholder="First Name" 
                value="<?php echo getValue('account','fname'); ?>" required>
                <?php echo validateField('account','fname','text') 
                ? " " 
                : "* Invalid Details" ?>
                <br><br>
        <input type="text" name="account[lname]" placeholder="Last Name" 
                value="<?php echo getValue('account','lname'); ?>" required>
                <?php echo validateField('account','lname','text') 
                ? " " 
                : "Invalid Details" ?>
                <br><br>
        <input type="date" name="account[dob]" 
                value="<?php echo getValue('account','dob'); ?>"><br><br>
        <input type="text" name="account[phone]" 
                value="<?php echo getValue('account','phone'); ?>" required>
                <?php echo validateField('account','phone','no') 
                ? " " 
                : "* Invalid Details" ?>
                <br><br>
        <input type="text" name="account[email]" 
                value="<?php echo getValue('account','email'); ?>" required>
                <?php echo validateField('account','email','email') 
                ? " " 
                : "* Invalid Email" ?>
                <br><br>
        <input type="password" name="account[password]" 
                value="<?php echo getValue('account','password'); ?>" required><br><br>
        <input type="password" name="account[confirmpassword]" 
                value="<?php echo getValue('account','confirmpassword'); ?>" required><br><br>
</fieldset>
<fieldset>
    <legend>Address Information</legend>
        <input type='text' name='address[addressline1]' placeholder='Address Line 1' 
                value="<?php echo getValue('address','addressline1'); ?>" required>
                <?php echo validateField('address','addressline1','address') 
                ? " " 
                : "* Invalid Address" ?>
                <br><br>
        <input type='text' name='address[addressline2]' placeholder='Address Line 2' 
                value="<?php echo getValue('address','addressline2'); ?>" required>
                <?php echo validateField('address','addressline2','address') 
                ? " " 
                : "* Invalid Address" ?>
                <br><br>
        <input type='text' name='address[companyname]' placeholder='Company Name' 
                value="<?php echo getValue('address','companyname'); ?>"><br><br>
        <input type='text' name='address[city]' placeholder='City' 
                value="<?php echo getValue('address','city'); ?>"><br><br>
            
        <?php $countryArray = ['India','Sri-Lanka','China']; ?>
    <select name="address[country]" required>
        <?php foreach($countryArray as $value) : ?>
            <?php $selected = $value == getValue('address','country') 
            ? 'selected' 
            : ''; ?>
            <option value="<?php echo $value ?>" <?php echo $selected ?>>
                <?php echo $value ?>
            </option>
        <?php endforeach; ?>

    </select><br><br>    
        <input type='text' name='address[postalcode]' placeholder='Postal Code' 
                value="<?php echo getValue('address','postalcode'); ?>" required>
                <?php echo validateField('address','postalcode','code') 
                ? " " 
                : "* Invalid Code" ?>
                <br><br>
</fieldset>
<fieldset>
    <legend><input type='checkbox' onclick='showOther(this)'>Other Information</legend>
        <div id="otherInfo" style="display: none">
        <textarea placeholder='Describe Yourself' name='other[aboutself]' required><?php echo getValue('other','aboutself'); ?>
        </textarea><br><br>    
        
        <input type='file' name='other[image]'><br><br>
        <input type='file' name='other[certificate]'><br><br>
        
        <?php $years = ['Under 1','1 to 2','2 to 5','5 to 10','Over 10'];?>
            <?php foreach($years as $value) : ?>
                <?php $result = $value == getValue('other','businessyears') 
                ? 'checked' 
                : ''; ?>
                <input type='radio' name='other[businessyears]' 
                        value='<?php echo $value; ?>' <?php echo $result; ?>><?php echo $value; ?><br><br>
            <?php endforeach; ?>
        <label>How Do You Like Us To Get in Touch with You ? </label>
        <?php $contactTypes = ['Post','Email','SMS','Phone'] ?>
        <?php foreach($contactTypes as $value) : ?>
            <?php $result = in_array($value,getValue('other','contactType',[])) 
            ? 'checked' 
            : ''; ?>
            <input type="checkbox" name="other[contactType][]" 
                    value="<?php echo $value ?>" <?php echo $result ?>><?php echo $value ?>
            <?php endforeach; ?><br><br>

        <?php $hobbies=['Listening Music','Reading','Dancing']; ?>
    		<select name="other[hobbies][]" multiple>
        		<?php foreach($hobbies as $value) : ?>
        		<?php $selected = in_array($value, getValue('other','hobbies',[]))  
        		? 'selected'
        		: ''; ?>
        		<option value="<?php echo $value ?>" <?php echo $selected; ?>>
        			<?php echo $value ?>
        		</option>
            	<?php endforeach; ?>
    		</select><br><br>
        </div>

            
            <input type="submit" name="Submit">
            <input type='reset' value='Clear'>
</fieldset>
</form>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
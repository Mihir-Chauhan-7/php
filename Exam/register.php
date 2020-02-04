<?php
    require_once 'operations.php';
    isset($_POST['update']) ? updateUser($_POST) : "";
    isset($_POST['submit']) ? registerUser($_POST) : "";
    isset($_GET['id']) ? setUserValues($_GET['id']) : "";
?>
<fieldset>
        <legend>Add User</legend>
        <form method="POST">
        <?php $prefix = ['Mr','Miss','Mrs','Dr']; ?>
        <select name="prefix">
            <?php foreach($prefix as $value) : ?>
            <?php $selected = $value == getValue('prefix') 
            ? 'selected'
            : ''; ?>
        <option value="<?php echo $value ?>" <?php echo $selected; ?>>
            <?php echo $value ?>
        </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="fname" placeholder="First Name" 
            value="<?php echo getValue('fname'); ?>"><br><br>
        <input type="text" name="lname" placeholder="Last Name" 
            value="<?php echo getValue('lname'); ?>"><br><br>
        <input type="text" name="email" placeholder="Email" 
            value="<?php echo getValue('email'); ?>"><br><br>
        <input type="text" name="mno" placeholder="Mobile No" 
            value="<?php echo getValue('mno'); ?>"><br><br>
        <input type="password" name="password" placeholder="Password" 
            value="<?php echo getValue('password') ;?>"><br><br>
        <input type="password" name="cpassword" placeholder="Confirm Password"><br><br>
        <input type="text" name="information" placeholder="Information"><br><br>
        <input type="submit" name="submit" value="Add">
        <input type="submit" name="update" value="Update" <?php echo getValue('btnShow') ?>>
            
        </form>
    </fieldset>
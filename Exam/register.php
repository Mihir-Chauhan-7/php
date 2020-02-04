<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>    
<?php
    require_once 'operations.php';
    if(isset($_POST['submit'])){
         registerUser($_POST); 
    }else if(isset($_POST['update'])){
        updateUser($_POST);
    }else if(isset($_GET['id'])){
        setUserValues($_GET['id']);
    }
    
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
        <input type="text" name="information" placeholder="Information"
            value="<?php echo getValue('information') ?>"><br><br>
            <input type="password" name="password" placeholder="Password" 
        <?php echo getValue('btnAdd')?>><br><br>
        <input type="password" name="cpassword" placeholder="Confirm Password"
        <?php echo getValue('btnAdd')?>><br><br>
        <input type="checkbox" name="terms" <?php echo getValue('btnAdd')?>>
        <label for="terms" <?php echo getValue('btnAdd')?>>
        Hereby,I Accept Terms & Conditions.</label><br><br>
        <input type="submit" name="submit" value="Add" <?php echo getValue('btnAdd')?>>
        <input type="submit" name="update" value="Update" <?php echo getValue('btnShow') ?>>
            
        </form>
    </fieldset>
</body>
</html>
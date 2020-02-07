<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>    
<?php
    $title = "Registration";
    require_once 'operations.php';
    if(isset($_POST['submit'])){
        $title = "Registration";
        registerUser($_POST);
    }
    else if(isset($_POST['update'])){
        updateUser($_POST,$_GET['id']);
    }
    else if(isset($_GET['id'])){
        $title = "Update";
        setUserValues($_GET['id']);
    }
    
?>
<div class="card text-center" style="margin-top:20px;margin-left:450px;width: 30rem">
    <div class="card-header">
    <h5 class="card-title"><?php echo $title; ?></h5>
    </div>
    <div class="card-body">
    <form method="POST">
        <div>
            <div class="input-group"> 
                <?php $prefix = ['Mr','Miss','Mrs','Dr']; ?>
                <select class="form-control" name="prefix">
                    <?php foreach($prefix as $value) : ?>
                        <?php $selected = $value == getValue('prefix') 
                            ? 'selected' 
                            : ''; ?>
                <option value="<?php echo $value ?>" <?php echo $selected; ?>>
                    <?php echo $value ?>
                </option>
                    <?php endforeach; ?>
                </select>
            <div>
            <input class="form-control" type="text" name="fname" 
                placeholder="First Name" value="<?php echo getValue('fname'); ?>">
            </div>
        </div>
    <div>
        <input class="form-control" type="text" name="lname" placeholder="Last Name"
            value="<?php echo getValue('lname'); ?>">
    </div>
    </div>
        <input class="form-control" type="text" name="email" placeholder="Email" 
            value="<?php echo getValue('email'); ?>">
    <div>
    <div>
        <input class="form-control" type="text" name="mno" placeholder="Mobile No" 
            value="<?php echo getValue('mno'); ?>">
    </div>
    <div>
        <input class="form-control" type="text" name="information" placeholder="Information"
            value="<?php echo getValue('information') ?>">
    </div>
    <div>
        <input class="form-control" type="password" name="password" placeholder="Password" 
            <?php  echo getValue('btnAdd')?>>
    </div>
    <div>
        <input class="form-control" type="password" name="cpassword" 
            placeholder="Confirm Password" <?php echo getValue('btnAdd')?>><br>
    </div>
    <div>    
        <input type="checkbox" name="terms" <?php echo getValue('btnAdd')?>>
        <label for="terms" <?php echo getValue('btnAdd')?>>
            Hereby,I Accept Terms & Conditions.</label> 
        <?php echo isset($_GET['error']) ? $_GET['error'] : ""; ?>
        <?php echo isset($_SESSION['errorListRegister']) ? $_SESSION['errorListRegister'] : ""; 
            unset($_SESSION['errorListRegister']);
        ?>     
    </div>
    <div class="card-footer text-muted">
        <input class="btn btn-outline-dark" type="submit" name="submit" value="Add" 
            <?php echo getValue('btnAdd')?>>
        <input class="btn btn-outline-dark" type="submit" name="update" value="Update" 
            <?php echo getValue('btnShow') ?>>
    </div>
    </form>
</div>
</body>
</html>
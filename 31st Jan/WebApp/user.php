<!DOCTYPE html>
<title>User</title>
<body>
<?php require_once 'connect.php';
    echo $_SESSION['loginTime'];
    isset($_POST['update']) ? updateUser($_POST) : "";
    isset($_POST['logout']) ? logOut() : "";
    isset($_POST['submit']) ? addUser($_POST) : "";
    if(isset($_GET['action']) && isset($_GET['id']) 
    && !empty($_GET['action']) && !empty($_GET['id'])) 
    {
        if($_GET['action'] == 'edit'){
            setValues($_GET['id']);
        }
        else if($_GET['action'] == 'delete'){
            deleteUser($_GET['id']);
        }
    }
    if(checkSession()){
        echo "<form method='POST'>Welcome , ".$_SESSION['userName'].'
        <a href="userSession.php">User Session</a>
        <input style="float : right" type="submit" value="Logout" name="logout"></form>';
        
    }
    else
    {
        $_SESSION['msg']="Please Login First";
        die("You are Not Logged In");
    }
    
    ?>
    <fieldset>
        <legend>Add User</legend>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo getValue('user','id'); ?>">
            <input type="text" name="fname" placeholder="First Name" value="<?php echo getValue('user','fname'); ?>">
            <input type="text" name="lname" placeholder="Last Name" value="<?php echo getValue('user','lname'); ?>">
            <input type="text" name="email" placeholder="Email" value="<?php echo getValue('user','email'); ?>">
            <input type="password" name="password" placeholder="Password" value="<?php echo getValue('user','password') ;?>">
            <input type="date" name="dob" value="<?php echo getValue('user','dob') ;?>">
            <input type="submit" name="submit" value="Add">
            <input type="submit" name="update" value="Update" <?php echo getValue('user','btnShow') ?>>
            
        </form>
    </fieldset>
    <?php displayUsers(); ?>
</body>
</html>
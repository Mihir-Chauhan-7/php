<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
    <fieldset>
        <?php require_once 'connect.php';
            echo $_SESSION['loginTime']." ".$_SESSION['logoutTime'];
            echo isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
            unset($_SESSION['msg']);  
            if(isset($_POST['uemail']) && isset($_POST['upassword']))
            {
                if(!empty($_POST['uemail']) && !empty($_POST['upassword']))
                {
                    checkLogin($_POST['uemail'],$_POST['upassword']) ?
                    header('Location:user.php'): print("Failed"); 
                }
                else
                {
                    echo "Please Enter Valid Email & Password";
                }
            }
        ?>
        <legend>Login</legend>
        <form method="POST">
            <input type="text" name="uemail" placeholder="Email"><br><br>
            <input type="text" name="upassword" placeholder="Password"><br><br>
            <input type="Submit" value="Login">
        </form>
    </fieldset>
</body>
</html>
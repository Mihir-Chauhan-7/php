<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
    <fieldset>
        <?php require_once 'operations.php';
            if(isset($_POST['email']) && isset($_POST['password']))
            {
                if(!empty($_POST['email']) && !empty($_POST['password']))
                {
                    checkLogin($_POST['email'],$_POST['password']) ?
                    header('Location:blog_post.php') : print("<strong>Invalid Email & Password</strong>"); 
                }
                else
                {
                    echo "Please Enter Valid Email & Password";
                }
            }
        ?>
        <legend>Login</legend>
        <form method="POST">
            <input type="text" name="email" placeholder="Email"><br><br>
            <input type="text" name="password" placeholder="Password"><br><br>
            <input type="Submit" value="Login">
            <a href="register.php">Register</a>
        </form>
    </fieldset>
</body>
</html>
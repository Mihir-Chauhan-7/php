<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                    header('Location:manage_post.php') 
                    : print("<strong>Invalid Email & Password</strong>"); 
                }
                else
                {
                    echo "Please Enter Valid Email & Password";
                }
            }
        ?>
        <div class="card text-center" style="margin-top: 100px;margin-left: 400px;
        width: 18rem;">
        <form method="POST">
            <div class="card-body" >
                <h4 class="card-title">Login</h4>
                    <input type="text" class="form-control" name="email" placeholder="Email">
                        <br>
                    <input type="password" class="form-control" name="password" 
                        placeholder="Password"><br><br>
                    <input class="btn btn-outline-dark" type="Submit" value="Login">
                    <a style="margin-left: 20px" class="btn btn-outline-dark" href="register.php">Register</a>
            </div>
        </form></div>
    </fieldset>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Login</title>
</head>
<body>
<?php require_once 'operations.php';
    if(isset($_POST['email']) && isset($_POST['password'])){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            checkLogin($_POST['email'],$_POST['password']) 
            ? header('Location:manage_post.php') 
            : print("<strong>Invalid Email & Password</strong>"); 
        }
        else{
            echo "Please Enter Valid Email & Password";
        }
    }
?> 
<div class="card text-center" style="margin-top: 120px;margin-left: 520px;width: 20rem;">
    <form method="POST">
        <div class="card-body" >
            <h4 class="card-title">Login</h4>
            <div>
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div>
                <input type="password" class="form-control" name="password" 
                    placeholder="Password"><br>
            </div>
            <div>
                <input class="btn btn-outline-dark" type="Submit" value="Login">
                <a style="margin-left: 20px" class="btn btn-outline-dark" href="register.php">
                    Register</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
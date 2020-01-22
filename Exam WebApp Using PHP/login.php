<?php
session_start();
require 'connect.inc.php';
if(isset($_POST['txtemail']) && isset($_POST['txtpass']))
{
	$email = $_POST['txtemail'];
	$pass = $_POST['txtpass'];
	if(!empty($email) && !empty($pass))
	{
		$query = "Select id from sub_user where email='$email' and password='$pass'";
		if($result = mysqli_query($conn,$query))
		{
			if(mysqli_num_rows($result) > 0)
			{
				echo "Success";
				$row = mysqli_fetch_assoc($result);
				$_SESSION["id"] = $row['id'];
				$_SESSION["loginTime"]=date("h:i:sA");		
				header("Location: user.php");
			}	
			else
			{
				echo "Incorrect email or password";			
			}
			
		}		
		else
		{
			echo '<br>'.mysqli_error($conn);
		}
	}
	else
	{
		echo "Please Enter Email And Password";
	}
	
}
?>
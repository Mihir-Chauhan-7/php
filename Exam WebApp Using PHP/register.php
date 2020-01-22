<?php

require 'connect.inc.php';

if(isset($_POST['txtemail']) && isset($_POST['txtpass']))
{
	$email = $_POST['txtemail'];
	$pass = $_POST['txtpass'];
	if(!empty($email) && !empty($pass))
	{
		$query = "Insert into sub_user values(NULL,'$email','$pass')";
		if(mysqli_query($conn,$query))
		{
			header("Location: Login.html");
		}		
		else
		{
			echo '<br>'.mysqli_error($conn);
		}
	}
	else
	{
		echo "Please Enter All Details";
	}
}
?>
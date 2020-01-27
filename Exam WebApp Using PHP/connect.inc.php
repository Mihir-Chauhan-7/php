<?php

$conn=@mysqli_connect('localhost','root','','demo') or die("Not Connected");


function logout()
{
	global $conn;
	
	echo "Logout Successful";
	$id=$_SESSION['id'];
	echo "<br> ".$logoutTime = date("h:i:sA");
	$loginTime = $_SESSION['loginTime'];
	$query = "Insert into session_log values(NULL,'$loginTime','$logoutTime','$id')";
		echo $query;
		if(mysqli_query($conn,$query))
		{
			echo "Inserted";
			unset($_SESSION['id']);
			header("Location: Login.html");
		}		
		else
		{
			echo '<br>'.mysqli_error($conn);
		}
}
?>
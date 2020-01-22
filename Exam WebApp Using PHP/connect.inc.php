<?php

$conn=@mysqli_connect('localhost','root','','demo') or die("Not Connected");


function logout()
{
	global $conn;
	unset($_SESSION['id']);
	echo "Logout Successful";
	echo "<br> ".$logoutTime = date("h:i:sA");
	$loginTime = $_SESSION['loginTime'];
	$query = "Insert into session_log values(NULL,'$loginTime','$logoutTime')";
		echo $query;
		if(mysqli_query($conn,$query))
		{
			echo "Inserted";
			header("Location: Login.html");
		}		
		else
		{
			echo '<br>'.mysqli_error($conn);
		}
}
?>
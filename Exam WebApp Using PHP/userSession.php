<?php

require 'connect.inc.php';

session_start();	
if(isset($_GET['btnlogout']))
{
	logout();
}
if(isset($_SESSION['id']))
{
	$query = "Select * From session_log";
	if($result = mysqli_query($conn , $query))
	{
		echo "<table border='1'><th>Log Id</th><th>User Id</th><th>Login Time</th><th>Logout Time</th>";
		while($row=mysqli_fetch_assoc($result))
	{
		echo "<tr><td>".$row['id']."</td><td>".$row['sub_user_id']."</td><td>".$row['login_time']."</td><td>".$row['logout_time']."</td></tr>";	
	}
		echo "</table>";
	}
	else
	{
		echo "Failed While Fetching Session Log";
	}
}
else
{
	die("You are not logged in");
}
?>
<form method="GET">
<input type="submit" name="btnlogout" value="Logout">
</form>

<?php
require 'connect.inc.php';

$rowData = [];
session_start();	
if(isset($_GET['btnlogout']))
{
	logout();
}
else if(isset($_GET['btnadd']))
{
	if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['pass']) && isset($_GET['dob']))
	{
		if(!empty($_GET['name']) && !empty($_GET['email']) && !empty($_GET['pass']) && !empty($_GET['dob']))
		{
			$name=$_GET['name'];
			$email=$_GET['email'];
			$pass=$_GET['pass'];
			$dob=$_GET['dob'];
			$query = "INSERT INTO users(name, email, password, dob) VALUES ('$name','$email','$pass','$dob')";
			if(mysqli_query($conn,$query))
			{
				echo "Inserted";
				header("Location: user.php");
			}		
			else
			{
				echo '<br>'.mysqli_error($conn);
			}
		}
	}
	
}
else if(isset($_GET['edit']) && !empty($_GET['edit']))
{
	global $conn;
	$id=$_GET['edit'];
	$query = 'Select * from users where id='.$id;
		if($result=mysqli_query($conn,$query))
		{
			$rowData = mysqli_fetch_assoc($result);
			//echo "<pre>";
			//print_r($rowData);		
		}		
		else
		{
			echo '<br>'.mysqli_error($conn);
		}
}
else if(isset($_GET['delete']) && !empty($_GET['delete']))
{
	global $conn;
	$id=$_GET['delete'];
	$query = 'Delete from users where id='.$id;
		if($result=mysqli_query($conn,$query))
		{
			echo "Deleted : ".$id;
			header("Location: user.php");		
		}		
		else
		{
			echo '<br>'.mysqli_error($conn);
		}
}

if(isset($_SESSION['id']))
{
	$query = 'Select name from sub_user where id='.$_SESSION['id'];
	if($result = mysqli_query($conn,$query))
	{
		$row = mysqli_fetch_assoc($result);
		echo "Hello ".$row['name'];
		displayUsers();
	}
	else
	{
		echo "You are not logged in";
	}	
}
else
{
	die("You are not logged in");
}

function displayUsers()
{
	global $conn;
	$query = "Select * From users";
	if($result = mysqli_query($conn , $query))
	{
		echo "<table border='1'><th>Id</th><th>Name</th><th>Email</th><th>Password</th><th>Dob</th><th colspan='2'>Actions</th>";
		while($row=mysqli_fetch_assoc($result))
	{
		echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['email']."</td>"."<td>".$row['password']."</td>"."<td>".$row['dob']."</td><td><a href='user.php?edit=".$row['id']."'>Edit</a></td><td><a href='user.php?delete=".$row['id']."'>Delete</a></td></tr>";	
	}
		echo "</table>";
	}
	else
	{
		echo "Failed While Fetching Session Log";
	}
}

?>
<a href="userSession.php">User Session</a>
<fieldset>
	<legend>Add Sub User</legend>
<form method="GET">
	
	<input type="text" name="name" placeholder="Name" value="<?php if(isset($_GET['edit'])){echo $rowData['name'];	}?>">
	<input type="email" name="email" placeholder="Email" value="<?php if(isset($_GET['edit'])){echo $rowData['email'];	}?>">
	<input type="password" name="pass" placeholder="Password" value="<?php if(isset($_GET['edit'])){echo $rowData['password'];	}?>">
	<input type="date" name="dob" value="<?php if(isset($_GET['edit'])){ echo $rowData['dob']; }?>">
	<input type="submit" name="btnadd" value="Add">

</form>
</fieldset>
<form method="GET">

	<input type="submit" name="btnlogout" value="Logout">

</form>
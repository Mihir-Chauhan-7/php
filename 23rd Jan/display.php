<?php
session_start();
$isAllSet=isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['dob']) && isset($_GET['mobileno']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['confirmpassword']) && isset($_GET['addressline1']) && isset($_GET['addressline2']) && isset($_GET['companyname']) && isset($_GET['city']) && isset($_GET['country']) && isset($_GET['postalcode']);

$isAllNotEmpty=!empty($_GET['firstname']) && !empty($_GET['lastname']) && !empty($_GET['dob']) && !empty($_GET['mobileno']) && !empty($_GET['email']) && !empty($_GET['password']) && !empty($_GET['confirmpassword']) && !empty($_GET['addressline1']) && !empty($_GET['addressline2']) && !empty($_GET['companyname']) && !empty($_GET['city']) && !empty($_GET['country']) && !empty($_GET['postalcode']);

$isOtherSet=isset($_GET['aboutself']) && isset($_GET['image']) && isset($_GET['certificate']) && isset($_GET['businessyears']);
$isOtherNotEmpty=!empty($_GET['aboutself']) && !empty($_GET['image']) && !empty($_GET['certificate']) && !empty($_GET['businessyears']);

if($isAllSet && $isAllNotEmpty)
{
	if($isOtherSet && $isOtherNotEmpty)
	{
	
		saveInformation();//echo "True";
	}
	else
	{
		echo "Only Personal And Address Information";
		saveInformation();
	}
	
}
else
{ 	
	echo "Please Fill All Details";
}

function saveInformation()
{
	echo "<table>";
	$_SESSION['formData']=$_GET;
	 foreach ($_SESSION['formData'] as $key => $value) {
	 	echo "<tr><td>".$key."</td><td> : </td> <td>".$value."</td></tr>";
	 }
	 echo "</table>";
}

?>

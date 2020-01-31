<?php
session_start();
$hostName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'customer_portal';

function connect()
{
	global $hostName,$userName,$password,$dbName;
	$connection = @mysqli_connect($hostName,$userName,$password,$dbName);
	return $connection ? $connection : false;	
}
function insertData($tablename,$formData)
{
	$conn = connect();
	$i = 0;
	$columns = '';
	$values = '';
	foreach($formData as $key => $val){
		$pre = ($i > 0)?', ':''; $columns .= $pre.$key; $values .= $pre."'".$val."'";
		$i++;
	}
	$query = "Insert into $tablename ($columns) values ($values)";
	//echo "Query ".$query."<br>";
	if(mysqli_query($conn,$query))
	{
		$_SESSION['last_id'] = mysqli_insert_id($conn);
		return true;
	}
	else
	{
		echo "Error ".mysqli_error($conn);
		return false;
	}
}

function fetchAllData($tablename)
{
	$query = "Select * From $tablename";
	return mysqli_fetch_all(executeQuery($query),MYSQLI_ASSOC);
}

function fetchData($tablename,$id)
{
	$query = "Select * From $tablename where cid=$id limit 1";
	return mysqli_fetch_all(executeQuery($query),MYSQLI_ASSOC);

}

function executeQuery($query)
{
	$conn = connect();
	if($result = mysqli_query($conn,$query))
	{
		//echo '<br>Success';
		return $result;
	}
	else
	{
		echo "Error ".mysqli_error($conn);
		return false;
	}
}

function load($tablename,$id='')
{
	echo "<pre>";
	$id > 0 ? print_r(fetchData($tablename,$id)) : print_r(fetchAllData($tablename));
	echo "</pre>";
	// foreach($result[0] as $key => $value)
	// {
	// 	echo $key." : ".$value."<br>";
	// }
}


//load("customers",1);
//load("customer_address",1);
//load("customer_additional_info",1);
?>
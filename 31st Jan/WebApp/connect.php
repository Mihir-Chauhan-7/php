<?php
session_start();
$hostName="localhost";
$userName="root";
$password="";
$dbName="demo";
global $user;
function checkSession()
{
    return isset($_SESSION['userName']) && !empty($_SESSION['userName']) ? true :false;
}
function getConnection()
{
    global $hostName,$userName,$password,$dbName;
    if($conn=mysqli_connect($hostName,$userName,$password,$dbName)){
        return $conn;
    }else{
        return false;
    }
}

function checkLogin($email,$password)
{
    $query="Select * From users Where email='$email' limit 1";
    $result=executeSQL($query)[0]; 
    if($email == $result['email'] && $password == $result['password']){
        $_SESSION['userName']=$result['fname'];
        $_SESSION['loginTime']=date('h:i:sA');
        return true;
    }else{
        return false;
    }
}

function fetchUser($tableName,$id)
{
    $query="Select * From $tableName Where id=$id limit 1";
    return executeSQL($query);
}
function fetchUsers($tableName)
{
    $query="Select * From $tableName";
    return executeSQL($query);
}

function executeSQL($query)
{
    $conn=getConnection();
    if(mysqli_query($conn,$query))
    {
        return @mysqli_fetch_all(mysqli_query($conn,$query),MYSQLI_ASSOC);
    }
    else
    {
        echo "Error ".mysqli_error($conn);
        return false;
    }
}
function displayUsers()
{
    $bdayList="";
    $users=fetchUsers('users');
    if(count($users)>0)
    {
        echo "<fieldset><legend>User List</legend><table border=1>
            <th>Id</th><th>First Name</th><th>Last Name</th><th>Email</th>
            <th>Password</th><th>Dob</th><th colspan=2>Action</th>";
        foreach($users as $singleUser)
        {
            echo "<tr><td>".$singleUser['id']."</td>
                <td>".$singleUser['fname']."</td><td>".$singleUser['lname']."</td>
                <td>".$singleUser['email']."</td><td>".$singleUser['password']."</td>
                <td>".$singleUser['dob']."</td>
                <td><a href='user.php?action=edit&id=".$singleUser['id']."'>Edit</a></td>
                <td><a href='user.php?action=delete&id=".$singleUser['id']."'>Delete</a></td></tr>";
                echo date('d-m',strtotime($singleUser['dob']));
                echo date('d-m');
                if(date('d-m',strtotime($singleUser['dob'])) == date('d-m'))
                {
                    $bdayList .="Today is ".$singleUser['fname']."'s Birthday<br>"; 
                }
        }
        echo "<tr><td colspan=8 align='center'>".$bdayList."</td></tr>";
        echo "</table></fieldset>";
    }
}

function addUser($formData)
{
    $i = 0;
    $pre='';
    $keys = '';
    $values = '';
    $error='';
    $flag=0;
    unset($formData['id']);
    unset($formData['submit']);
    foreach($formData as $key => $value)
    {
        $i>0 ? $pre = "," : "";
        $keys .= $pre.$key;
        $values .= $pre."'".$value."'";
        validateField($key,$value) ? "" : $flag=1 ;
        $error .= validateField($key,$value) ? "" : $key." is Invalid<br>";
        $i++;
    }   
    print_r($formData);
    if($flag==0)
    {
        $query="Insert into users ($keys) values($values)";
        executeSQL($query);
    }
    else
    {
        echo $error;
    }
    
}

function logOut()
{
    $_SESSION['logoutTime']=date("h:i:sA");
    unset($_SESSION['userName']);
    header("Location:index.php");
}

function getValue($form,$fieldname)
{
    global $user;
    if($form=='user')
    {
        if($fieldname=='btnShow')
        {
            return isset($user[0][$fieldname]) ? $user[0][$fieldname] : "hidden";      
        }
        return isset($user[0][$fieldname]) ? $user[0][$fieldname] : "";  
    }
}
function setValues($id)
{
    global $user;
    $user=fetchUser("Users",$id);
    $user[0]['btnShow']="true";
}
function updateUser($newData)
{
    $i = 0;
    $pre='';
    $fields='';
    $id=$newData['id'];
    unset($newData['id']);
    unset($newData['update']);
    foreach($newData as $key => $value)
    {
        $i>0 ? $pre = "," : "";
        $fields .= $pre.$key."='".$value."'";
        $i++;
    }
    $query="Update Users SET $fields Where id=$id";
    //echo $query;
    executeSQL($query);
    header("Location:user.php");
    exit();
}
function deleteUser($id)
{
    $query="Delete From Users where id=$id";
    executeSQL($query);
}

function validateField($key,$value)
{
	switch ($key) {
        case 'fname':
        case 'lname':
			return strlen($value)>0 && preg_match("/^[A-Za-z]+$/",$value);
			break;
		case 'no':
			return preg_match('/^[6-9][0-9]{9}$/',$value);
			break;
		case 'address':
			return preg_match('/^[A-Za-z0-9]+$/',$value);
			break;
		case 'email':
			return strlen($value)>0 && preg_match('/^([A-Za-z0-9\.]+)@([A-Za-z]+).([a-z]{1,8})([.a-z]{1,4})?$/', $value);
			break;
		case 'code':
			return preg_match('/^[0-9]{1,8}$/', $value);
        default:
            return true;
			break;
	}
}
?>
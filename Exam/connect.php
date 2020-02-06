<?php
session_start();
$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "blog";
global $user;

function getConnection(){
    global $hostName,$userName,$password,$dbName;
    if($conn = mysqli_connect($hostName,$userName,$password,$dbName)){    
        return $conn;
    }
    else{
        return false;
    }
}

function executeSQL($query){
    $conn = getConnection();
	if($result = mysqli_query($conn,$query)){
		$_SESSION['last_id'] = mysqli_insert_id($conn);
		return @mysqli_fetch_all($result,MYSQLI_ASSOC);
	}
	else{
		echo "Error ".mysqli_error($conn);
		return false;
	}
}

function prepareData($tablename,$data){
    $keys = array_keys($data);
    $values = array_values($data);
    $query = "INSERT INTO $tablename (" . implode(', ', $keys) . ") "
        . "VALUES ('" . implode("', '", $values) . "')";
    return $query;
}
function prepareUpdateData($tablename,$data,$where){
    $i = 0;
    $pre = '';
    $fields = '';
    foreach($data as $key => $value){
        $i>0 ? $pre = "," : "";
        $fields .= $pre.$key."='".$value."'";
        $i++;
    }
    $query = "Update $tablename SET $fields Where $where";
    return $query;
}

function fetchData($tablename,$where = ""){
    $query = "Select * From $tablename Where $where limit 1"; 
    return executeSQL($query);
}
function deleteData($tablename,$where){
    $query = "Delete From $tablename Where $where"; 
    executeSQL($query);
}
function checkExist($tablename,$where){
    return sizeof(fetchData($tablename,$where))>0 ? true : false;
}

function saveImage($file){
    $name = $file['image']['name'];
    $tmpname = $file['image']['tmp_name'];
    $extension = substr($name, strpos($name, '.') + 1);
    if (!empty($name) && $extension == 'jpg') {
	    if (move_uploaded_file($tmpname, 'uploads/' . $name)){
            return "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) 
                . "/uploads/" . $name;
        }
    }
}

function validateFields($data){
    $errorList="";
    foreach($data as $key => $value)
    {
        switch ($key) {
            case 'fname' :
                $errorList .= strlen($value)>0 && preg_match("/^[A-Za-z]+$/",$value) 
                    ? "" 
                    : "Invalid First Name \n"; 
                break;
            case 'lname' :
                $errorList .= strlen($value)>0 && preg_match("/^[A-Za-z]+$/",$value) 
                    ? "" 
                    : "Invalid Last Name \n"; 
                break;
            case 'mno' :
                $errorList .= preg_match('/^[6-9][0-9]{9}$/',$value) 
                    ? "" 
                    : "Invalid Mobile No \n";
                break;
            case 'email' :
                $errorList .= strlen($value)>0 && 
                preg_match('/^([A-Za-z0-9\.]+)@([A-Za-z]+).([a-z]{1,8})([.a-z]{1,4})?$/', $value)
                    ? "" 
                    : "Invalid Email \n"; 
                break;
            case 'password' :
                $errorList .= strlen($value)>0 && $value == $data['cpassword']
                    ? "" 
                    : "Invalid Password \n";
            default:
                break;
        }
    }
    return strlen($errorList)>0 ? $errorList : false;
	
}
?>
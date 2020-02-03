<?php
session_start();
$hostName="localhost";
$userName="root";
$password="";
$dbName="blog";
global $user;

function getConnection()
{
    global $hostName,$userName,$password,$dbName;
    if($conn=mysqli_connect($hostName,$userName,$password,$dbName)){
        return $conn;
    }else{
        return false;
    }
}

function executeSQL($query)
{
    $conn=getConnection();
    if(mysqli_query($conn,$query))
    {
        $_SESSION['last_id'] = mysqli_insert_id($conn);
        return @mysqli_fetch_all(mysqli_query($conn,$query),MYSQLI_ASSOC);
    }
    else
    {
        echo "Error ".mysqli_error($conn);
        return false;
    }
}

function prepareData($tablename,$data)
{
    $keys = array_keys($data);
        $values = array_values($data);
        $query = "INSERT INTO $tablename (" . implode(', ', $keys) . ") "
         . "VALUES ('" . implode("', '", $values) . "')";
        echo $query;
        return $query;
}

function fetchData($tablename,$where="")
{
    $query="Select * From $tablename Where $where limit 1"; 
    return executeSQL($query);
}
function deleteData($tablename,$where)
{
    $query="Delete From $tablename Where $where"; 
    executeSQL($query);
}
?>
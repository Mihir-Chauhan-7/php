<?php

require_once 'connect.php';

function registerUser($userData)
{
    if($userData['email']==fetchData('user',"email='".$userData['email']."'")[0]['email'])
    {
        echo "Email Id is Already Registered";
    }
    else
    {
        unset($userData['submit']);
        unset($userData['cpassword']);
        executeSQL(prepareData('user',$userData));
        header("Location:login.php");
    }
    
 
}
function checkSession()
{
    return isset($_SESSION['uid']) && !empty($_SESSION['uid']) ? true :false;
}

function checkLogin($email,$password)
{
    $query="Select * From user Where email='$email' limit 1";
    $result=executeSQL($query)[0];
    if($email == $result['email'] && $password == $result['password']){
        $_SESSION['uid']=$result['uid'];
        $query="UPDATE user SET last_login='".date("h:i:sA")."' where uid=".$result['uid'];
        executeSQL($query);
        return true;
    }else{
        return false;
    }
}

function logOut()
{
    unset($_SESSION['uid']);
    header("Location:login.php");
}

function getValue($fieldname)
{
    global $user;
        if($fieldname=='btnShow')
        {
            return isset($user[0][$fieldname]) ? $user[0][$fieldname] : "hidden";      
        }
        return isset($user[0][$fieldname]) ? $user[0][$fieldname] : "";  

}
function setUserValues($id)
{
    global $user;
    $user=fetchData('user',"uid=$id");
    $user[0]['btnShow']="true";
}
?>
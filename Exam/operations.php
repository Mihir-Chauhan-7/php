<?php

require_once 'connect.php';

function registerUser($userData){
    if(checkExist('user',"email='".$userData['email']."'")){
        echo "Email Id is Already Registered";
    }
    else{
        if($error=validateFields($userData)){
            echo "<strong>".$error."</strong>";   
        }
        else{
            unset($userData['submit']);
            unset($userData['cpassword']);
            $userData['password'] = md5($userData['password']);
            executeSQL(prepareData('user',$userData));
            header("Location:login.php");
        }
    }
}

function checkLogin($email,$password){
    $query = "Select * From user Where email='$email' limit 1";
    $result = executeSQL($query);
    $result = count($result[0]) > 0 ? $result[0] : false;
    if($result != false && $email == $result['email'] 
        && md5($password) == $result['password']){
        
        $_SESSION['uid'] = $result['uid'];
        $query = "UPDATE user SET last_login='".date("Y-m-d h:i:sA")."' where uid="
            .$result['uid'];
        executeSQL($query);
        return true;
    }
    else{
        return false;
    }
}
function getValue($fieldname){
    global $user;
    if($fieldname == 'btnShow'){
        return isset($user[0][$fieldname]) ? $user[0][$fieldname] : "hidden";      
    }
    return isset($user[0][$fieldname]) ? $user[0][$fieldname] : "";  

}
function setUserValues($id){
    global $user;
    $user = fetchData('user',"uid=$id");
    $user[0]['btnShow'] = "true";
    $user[0]['btnAdd'] = "hidden";
}
function updateUser($newData,$id){
    if(checkExist('user',"email='".$newData['email']."' AND uid!=".$id)){
        echo "Email Id is Already Registered";
    }
    else{
        unset($newData['password']);
        unset($newData['cpassword']);
        unset($newData['update']);
        if($error=validateFields($newData)){
            header("Location:register.php?id=".$_SESSION['uid']."&error=<strong>".$error."</strong>");
        }
        else{
            echo prepareUpdateData('user',$newData,"uid='".$_SESSION['uid']."'");
            executeSQL(prepareUpdateData('user',$newData,"uid='".$_SESSION['uid']."'"));
            header("Location:manage_post.php");
        }
    }
}
?>
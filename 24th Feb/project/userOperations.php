<?php
    session_start();
    require_once 'Adapter.php';
    
function getValue($key){
    return isset($_SESSION['userData']) ? $_SESSION['userData'][$key] : "";
}
function add($data){
    $adapter = new Adapter();
    $adapter->insert("INSERT INTO `users` (`fname`, `lname`, `email`, `password`,
    `contact`) VALUES ("."'".$data['fname']."','".$data['lname']."','".$data['email']."','"
        .$data['password']."','".$data['contact']."')");
    header('Location:Users.php');

}
function edit($id){
    $adapter = new Adapter();
    $_SESSION['userData'] = $adapter->fetchRow(
        "SELECT * FROM `users` WHERE `user_id`=".$id);
    header('Location:editUser.php');
}

function update($data){
    $adapter = new Adapter();
    print_r($data);
    $i = 0;
    $pre = '';
    $fields = '';
    $id = $data['id'];
    unset($data['id']);
    unset($data['save']);
    foreach($data as $key => $value){
        $i>0 ? $pre = "," : "";
        $fields .= $pre.$key."='".$value."'";
        $i++;
    }
    $adapter->update("UPDATE `users` SET $fields Where `user_id`='".$id."'");
    header('Location:Users.php');
}
function delete($id){
    $adapter = new Adapter();
    $adapter->delete("DELETE FROM `users` WHERE `user_id`=".$id);
}
function getUserList(){
    $adapter = new Adapter();
    return $adapter->fetchAll("SELECT * FROM `users`");
}

?>
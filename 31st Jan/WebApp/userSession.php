<?php 

require_once 'connect.php';
if(checkSession())
{
    $query="Select * From session_log";
    $sessionLog=executeSQL($query);
    foreach($sessionLog as $log)
    echo "<table border=1><tr><td>".$log['sub_user_id']."</td><td>".$log['login_time']."</td>
    <td>".$log['logout_time']."</td></tr></table>";
}
else
{
    die("You are not Logged In");
}



?>
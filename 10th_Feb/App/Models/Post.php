<?php

namespace App\Models;

class Post extends \Core\Model
{
    public static function getAll(){
    
        $conn=static::getDB();
        $query="SELECT * FROM users";
        if($result=mysqli_query($conn,$query)){
            return mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        
    }
}

?>
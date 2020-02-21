<?php

namespace App\Models;

use PDO;

class User extends \Core\Model
{
    protected static $table = "users";
    protected static $primaryKey = "user_id";
    protected static $discardList=["user_id","street","city","state","country","zipcode"];

}

?>
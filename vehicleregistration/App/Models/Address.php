<?php

namespace App\Models;

use PDO;

class Address extends \Core\Model
{
    protected static $table = "user_addresses";
    protected static $primaryKey = "address_id";
    protected static $discardList=["fname","lname","email","password","contact"];

}

?>
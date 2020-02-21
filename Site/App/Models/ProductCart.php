<?php

namespace App\Models;

use PDO;

class ProductCart extends \Core\Model
{
    protected static $table = "cart_product";
    protected static $primaryKey = "cart_id";
    
}

?>
<?php

namespace App\Models;

use PDO;

class Product extends \Core\Model
{
    protected static $table = "product";
    protected static $primaryKey = "pid";

    public static function getProductList(){
        return ['Product1','Product2'];
    }

}

?>
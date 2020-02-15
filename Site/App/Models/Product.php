<?php

namespace App\Models;

use PDO;

class Product extends \Core\Model
{
    protected static $table = "products";
    protected static $primaryKey = "pid";
    protected static $keyList=['Id','Name','URL','Image','Status','Description',
        'Short_Description','Price','Stock','SKU','Created At'];
    protected static $discardList = ['id','Add'];
    public static function getProductList(){
        return ['Product1','Product2'];
    }

}

?>
<?php

namespace App\Models;

use PDO;

class ProductCategory extends \Core\Model
{
    protected static $table = "products_categories";
    protected static $primaryKey = "cid";
    protected static $discardList = ['id','submit'];

    public static function getProductList($cid){
        return static::join('INNER',['cid'],['pid','url','image','name','price'],'products','pid','pid',"A.cid=$cid");
    }
    public static function addProduct($cid){
        return static::insertData(['cid' => $cid , 'pid' => static::getLastId() ]) 
            ? true 
            : false;
    }
    public static function updateCategory($pid,$cid){
        static::executeSQL("DELETE FROM products_categories WHERE pid=$pid");
            return static::insertData(['cid' => $cid , 'pid' => $pid])
            ? true 
            : false;
    }
}

?>
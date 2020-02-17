<?php

namespace App\Models;

use Core\Model;
use App\Models\ProductCategory;
use App\Models\Category;
use PDO;

class Product extends \Core\Model
{
    protected static $table="products";
    protected static $primaryKey = "pid";
    protected static $keyList=['Id','Name','URL','Image','Status','Description',
        'Short_Description','Price','Stock','SKU','Created At'];
    protected static $discardList = ['id','Add','cid'];
    
    public static function insertProduct($data,$file){
        Product::saveImage($file) ? $data['image'] = $file['image']['name'] : "";
        if(Product::insertData($data) && ProductCategory::addProduct($data['cid'])){
            return true;
        }
        else{
            return false;
        }
        
    }

    public static function getProductList(){
        return ['Product1','Product2'];
    }
    public static function getCategoryList(){
        return Category::getAll();
    }
}

?>
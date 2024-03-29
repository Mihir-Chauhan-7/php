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
    protected static $urlField = "name";
    protected static $mainUrl ="admin/product/";
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
    public static function updateProduct($data,$file){
        Product::saveImage($file) ? $data['image'] = $file['image']['name'] : "";
        isset($data['cid']) ? ProductCategory::updateCategory($data['id'],$data['cid']) : "";
        if(Product::updateData($data)){
            return true;
        }
        else{
            return false;
        }
        
    }
    public static function getProductData($id){
        return $productData=static::joinThree('LEFT',['*'],[],['cid','cname']
                ,'products_categories','categories',['pid','pid'],['cid','cid']
                ,"A.pid=".$id)[0];
    }
    public static function getCategoryList(){
        return Category::getAll();
    }
}

?>
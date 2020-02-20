<?php
namespace App\Models;

use PDO;

class Category extends \Core\Model
{
    protected static $table = "categories";
    protected static $primaryKey = "cid";
    protected static $urlField = "cname";
    protected static $mainUrl ="admin/categories/";
    protected static $keyList=['Id','Parent','Name','Url','Image','Status','Description'
        ,'Created At'];
    protected static $discardList = ['id','submit'];
    public static function insertCategory($data,$file){
        Category::saveImage($file) ? $data['image'] = $file['image']['name'] : "";
        return Category::insertData($data) ? true : false;
    }
    public static function updateCategory($data,$file){
        Category::saveImage($file) ? $_POST['image'] = $file['image']['name'] : "";
        return Category::updateData($data) ? true : false;
    }
    public static function displayCategories(){
        $categoryData = Category::join('LEFT',['cid','cname','url','image','status'
        ,'description','created_at'],['cname AS parent_name'],'categories'
        ,'parent_id','cid');
        return $categoryData;
    }
    public static function getParents(){
        return $parentList=Category::getAll();
    }
    public static function getParentChild(){
        $parentList=[];
        function getChild($id){
            return Category::executeSQL(
                "SELECT url,cid as child_id,cname as child_name FROM categories WHERE parent_id=".$id);
        }
        $parentList=Category::executeSQL("SELECT DISTINCT(parent_id) FROM categories WHERE parent_id!=0");
        for($i = 0; $i<sizeof($parentList); $i++){
            $parentList[$i]['childs']=getChild($parentList[$i]['parent_id']);
        }
        for($i = 0; $i<sizeof($parentList); $i++){
            $parentList[$i]['pname']=Category::executeSQL("SELECT cname as pname FROM categories WHERE cid=".$parentList[$i]['parent_id'])[0]['pname'];
            $parentList[$i]['purl']=Category::executeSQL("SELECT url as purl FROM categories WHERE cid=".$parentList[$i]['parent_id'])[0]['purl'];
        }
        return $parentList;
    }
}

?>
<?php

namespace App\Controllers;

use App\Models\Category as CategoryModel;
use App\Models\ProductCategory;
use Core\View;
use App\Config;

class Category extends \Core\Controller {

    public function index(){
        View::renderTemplate('Product/index.html',[
            'name' => 'Mihir',
            
        ]);
    }
    public function view(){
        $parentList=[];
        function getChild($id){
            return CategoryModel::executeSQL(
                "SELECT url,cid as child_id,cname as child_name FROM categories WHERE parent_id=".$id);
        }
        $count=0;
        $parentList=CategoryModel::executeSQL("SELECT DISTINCT(parent_id) FROM categories WHERE parent_id!=0");
        for($i = 0; $i<sizeof($parentList); $i++){
            $parentList[$i]['childs']=getChild($parentList[$i]['parent_id']);
        }
        for($i = 0; $i<sizeof($parentList); $i++){
            $parentList[$i]['pname']=CategoryModel::executeSQL("SELECT cname as pname FROM categories WHERE cid=".$parentList[$i]['parent_id'])[0]['pname'];
            $parentList[$i]['purl']=CategoryModel::executeSQL("SELECT url as purl FROM categories WHERE cid=".$parentList[$i]['parent_id'])[0]['purl'];
        }
        $category = CategoryModel::fetchData("url='".
            explode(".",$this->route_params['url'])[0]."'");
        $id = $category[0]['cid'];
        View::renderTemplate('Product/index.html',[
            'name' => 'Mihir',
            'categoryList' => $parentList,
            'productList' => ProductCategory::getProductList($id)
        ]);
    }
    
}

?>
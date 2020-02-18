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
        print_r(CategoryModel::executeSQL("SELECT DISTINCT(parent_id),cid,GROUP_CONCAT(cid) as child_id,GROUP_CONCAT(cname) as child_name 
        FROM categories
        GROUP BY parent_id"));
        $category = CategoryModel::fetchData("url='".
            explode(".",$this->route_params['url'])[0]."'");
        $id = $category[0]['cid'];
        View::renderTemplate('Product/index.html',[
            'name' => 'Mihir',
            'categoryList' => CategoryModel::getAll(),
            'productList' => ProductCategory::getProductList($id)
        ]);
    }
    
}

?>
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
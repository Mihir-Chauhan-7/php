<?php

namespace App\Controllers;

use App\Models\Category as CategoryModel;
use App\Models\ProductCategory;
use Core\View;
use App\Config;

class Category extends \Core\Controller {

    public function index(){
        View::renderTemplate('Product/index.html',[
            'controller_action' => 'category/view/'
        ]);
    }
    public function view(){
        $id = CategoryModel::fetchData("url='".explode(".",$this->route_params['url'])
            [0]."'")[0]['cid'];

        View::renderTemplate('Product/index.html',[
            'controller_action' => 'category/view/',
            'categoryList' => CategoryModel::getParentChild(),
            'productList' => ProductCategory::getProductList($id)
        ]);
    }
    
}

?>